<?php
namespace ValueSuggest\Suggester\Unesco;

use ValueSuggest\Suggester\PrimaryLanguageTrait;
use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class Sparql implements SuggesterInterface
{
    use PrimaryLanguageTrait;

    const ENDPOINT = 'https://skos.um.es/sparql/';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string The GRAPH portion of the SPARQL query.
     */
    protected $graph;

    public function __construct(Client $client, $graph)
    {
        $this->client = $client;
        $this->graph = $graph;
    }

    /**
     * Retrieve suggestions from the UNESCO Vocabularios SPARQL endpoint.
     *
     * @see http://skos.um.es/vocabularios/index.php
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        // Labels are tagged with bare languages, so use the primary subtag. The
        // defualt lang is spanish.
        $lang = $this->getPrimaryLanguage($lang, 'es');

        // Match the query literally. The endpoint strips backslash escapes
        // before running the regex, so wrap metacharacters in brackets instead.
        // ^ and \ can't be bracketed this way; drop them.
        $pattern = preg_replace('/[.+*?()\[\]{}|$]/', '[$0]', str_replace(['^', '\\'], '', $query));

        // The endpoint's SPARQL engine (ARC2) returns nothing when an OPTIONAL
        // pattern that matches nothing in the graph is combined with another
        // OPTIONAL or with a FILTER on its variable. The Floridablanca graph has
        // no alternate labels or broader terms. Querying alternate labels
        // separately would double the response time, so query only the broader
        // term, unfiltered, and select its language below. Alternate labels are
        // not shown; they never affected matching.
        //
        // Broader labels in every language multiply the rows per concept, so
        // order by label to make the LIMIT cut off the end of the alphabet. The
        // endpoint's collation also sorts accented labels correctly.
        $limit = 1000;
        $sparqlQuery = sprintf('
SELECT ?Subject ?Label ?Broader
WHERE {
  GRAPH <%s> {
    ?Subject skos:prefLabel ?Label ;
    rdf:type skos:Concept .
    OPTIONAL {?Subject skos:broader [skos:prefLabel ?Broader]}
    FILTER regex(?Label, "%s", "i")
    FILTER langMatches(lang(?Label), "%s")
  }
}
ORDER BY ?Label
LIMIT %d',
            addslashes($this->graph),
            addslashes($pattern),
            addslashes($lang),
            $limit
        );

        // Without an Accept header the endpoint prepends PHP warnings to its
        // JSON response, which then fails to decode.
        $headers = $this->client->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/sparql-results+json');
        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet([
            'output' => 'json',
            'query' => $sparqlQuery,
        ]);
        $response = $client->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Each row pairs a concept with one label of one broader term, so a
        // concept can span several rows. Keep one suggestion per concept, in
        // the endpoint's order, with its broader terms in the requested language.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        $bindings = $results['results']['bindings'] ?? [];
        foreach ($bindings as $result) {
            $uri = $result['Subject']['value'];
            if (!isset($suggestions[$uri])) {
                $suggestions[$uri] = [
                    'value' => $result['Label']['value'],
                    'data' => [
                        'uri' => $uri,
                        'info' => [],
                    ],
                ];
            }
            if (isset($result['Broader']['value'])) {
                $broaderLang = strtolower($result['Broader']['xml:lang'] ?? '');
                if ($lang === $broaderLang || 0 === strpos($broaderLang, $lang . '-')) {
                    $suggestions[$uri]['data']['info'][] = $result['Broader']['value'];
                }
            }
        }
        // At the limit, the last concept's rows may have been cut off.
        if ($limit === count($bindings)) {
            array_pop($suggestions);
        }

        return array_map(function ($suggestion) {
            $suggestion['data']['info'] = implode(', ', array_unique($suggestion['data']['info']));
            return $suggestion;
        }, array_values($suggestions));
    }
}
