<?php
namespace ValueSuggest\Suggester\Getty;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class Sparql implements SuggesterInterface
{
    const ENDPOINT = 'http://vocab.getty.edu/sparql.json';

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
     * @return array
     */
    public function getSuggestions($query)
    {
        // Use case-insensitive fulltext search to retrieve suggestions.
        // @see http://vocab.getty.edu/doc/queries/#Case-insensitive_Full_Text_Search_Query
        $sparqlQuery = sprintf('
select ?Subject ?Term ?Parents ?ScopeNote {
    ?Subject a skos:Concept ; luc:term "%s" ; skos:inScheme %s: ;
        gvp:prefLabelGVP [xl:literalForm ?Term] .
    optional {?Subject gvp:parentString ?Parents}
    optional {?Subject skos:scopeNote [dct:language gvp_lang:en; rdf:value ?ScopeNote]}
} order by asc(lcase(str(?Term))) limit 500',
            addslashes($query),
            $this->scheme
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
        // in ScopeNote and Parents.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['results']['bindings'] as $result) {
            $info = null;
            if (isset($result['ScopeNote']['value'])) {
                $info = $result['ScopeNote']['value'];
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
}
