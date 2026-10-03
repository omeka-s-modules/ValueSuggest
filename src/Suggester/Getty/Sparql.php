<?php
namespace ValueSuggest\Suggester\Getty;

use ValueSuggest\Suggester\PrimaryLanguageTrait;
use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class Sparql implements SuggesterInterface
{
    use PrimaryLanguageTrait;

    const ENDPOINT = 'https://vocab.getty.edu/sparql.json';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string The skos:inScheme portion of the SPARQL query.
     */
    protected $scheme;

    public function __construct(Client $client, $scheme)
    {
        $this->client = $client;
        $this->scheme = $scheme;
    }

    /**
     * Retrieve suggestions from the Getty Vocabularies SPARQL endpoint.
     *
     * @see http://vocab.getty.edu/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        // Use Getty's Lucene full text search to retrieve suggestions in order
        // of relevance, filtering by the provided language, falling back on
        // english.
        // @see http://vocab.getty.edu/doc/#Full_Text_Search
        //
        // Terms are tagged with bare languages, so use the primary subtag.
        $lang = $this->getPrimaryLanguage($lang, 'en');
        $sparqlQuery = sprintf('
SELECT ?Subject ?Term ?Parents ?ScopeNote ?ScopeNoteEn {
    ?Subject a skos:Concept ;
    luc:text "%s" ;
    skos:inScheme %s: ;
    skosxl:prefLabel [xl:literalForm ?Term] .
    OPTIONAL {?Subject gvp:parentString ?Parents}
    OPTIONAL {?Subject skos:scopeNote [dct:language gvp_lang:%s; rdf:value ?ScopeNote]}
    OPTIONAL {?Subject skos:scopeNote [dct:language gvp_lang:en; rdf:value ?ScopeNoteEn]}
    %s
} LIMIT 500',
            addslashes($this->escapeLucene($query)),
            $this->scheme,
            $lang,
            // Do not filter by language when querying names from ULAN.
            'ulan' === $this->scheme ? '' : sprintf('FILTER langMatches(lang(?Term), "%s")', $lang)
        );
        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet([
            'query' => $sparqlQuery,
        ]);

        // Must include Accept header or endpoint returns 400 Bad Request with
        // message: "The request sent by the client was syntactically incorrect."
        $client->getRequest()->getHeaders()->addHeaderLine('Accept', 'application/sparql-results+json');
        $response = $client->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response. Getty provides disambiguating information
        // in ScopeNote and Parents. If ScopeNote in the provided language is
        // not available, fall back on english ScopeNoteEn, then on the Parent.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['results']['bindings'] ?? [] as $result) {
            $info = null;
            if (isset($result['ScopeNote']['value'])) {
                $info = $result['ScopeNote']['value'];
            } elseif (isset($result['ScopeNoteEn']['value'])) {
                $info = $result['ScopeNoteEn']['value'];
            } elseif (isset($result['Parents']['value'])) {
                $info = $result['Parents']['value'];
            }
            $suggestions[] = [
                'value' => $result['Term']['value'],
                'data' => [
                    'uri' => $result['Subject']['value'],
                    'info' => $info,
                ],
            ];
        }

        return $suggestions;
    }

    /**
     * Escape Lucene query syntax so a query like "chair (" matches literally.
     *
     * An unbalanced parenthesis or quote makes Getty's full text search return
     * nothing. The * wildcard is left as is, since users may type it on purpose.
     * The query is lowercased so AND, OR and NOT aren't read as operators; the
     * full text index is lowercased, so matching is unaffected.
     *
     * @param string $query
     * @return string
     */
    private function escapeLucene($query)
    {
        return preg_replace('/[+\-!(){}\[\]^"~?:\\\\\/]|&&|\|\|/', '\\\\$0', mb_strtolower((string) $query));
    }
}
