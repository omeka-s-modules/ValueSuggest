<?php
namespace ValueSuggest\Suggester\Thub;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class Sparql implements SuggesterInterface
{
    const ENDPOINT = 'https://data.coeli.cat/thub/sparql';

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve suggestions from the Thesaurus de la Universitat de Barcelona
     * (THUB) SPARQL endpoint.
     *
     * It appears that this service has no schemes (skos:ConceptScheme), so
     * we're omitting the skos:inScheme clause.
     *
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $sparqlQuery = sprintf('
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
SELECT ?Subject ?Label ?ScopeNote
WHERE {
    ?Subject skos:prefLabel ?Label ;
    OPTIONAL {?Subject skos:scopeNote ?ScopeNote}
    FILTER regex(?Label, "%s", "i")
    FILTER langMatches(lang(?Label), "%s")
}
LIMIT 500',
            addslashes($query),
            addslashes($lang) ?: 'ca' // The defualt lang is Catalan
        );

        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet([
            'query' => $sparqlQuery,
        ]);
        $client->setHeaders([
            'Accept' => 'application/sparql-results+json',
        ]);
        $response = $client->send();
        if (!$response->isSuccess()) {
            return [];
        }

        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['results']['bindings'] as $result) {
            $suggestions[] = [
                'value' => $result['Label']['value'],
                'data' => [
                    'uri' => $result['Subject']['value'],
                    'info' => $result['ScopeNote']['value'] ?? null,
                ],
            ];
        }
        usort($suggestions, function ($a, $b) {
            return strcmp($a['value'], $b['value']);
        });

        return $suggestions;
    }
}
