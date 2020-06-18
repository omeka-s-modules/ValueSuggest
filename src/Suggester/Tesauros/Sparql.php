<?php
namespace ValueSuggest\Suggester\Tesauros;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class Sparql implements SuggesterInterface
{
    const ENDPOINT = 'http://tesauros.mecd.es/tesauros/sparql';

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
     * Retrieve suggestions from the Tesauros-Diccionarios del patrimonio
     * cultural de España SPARQL endpoint.
     *
     * @see http://tesauros.mecd.es/tesauros/tesauros
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $sparqlQuery = sprintf('
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
SELECT ?Subject ?Label ?Definition
WHERE {
    ?Subject skos:prefLabel ?Label ;
    skos:inScheme <%s>
    OPTIONAL {?Subject skos:definition ?Definition}
    FILTER regex(?Label, "%s", "i")
    FILTER langMatches(lang(?Label), "%s")
}
LIMIT 500',
            addslashes($this->scheme),
            addslashes($query),
            addslashes($lang) ?: 'es' // The defualt lang is spanish
        );

        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet([
            'format' => 'application/rdf+json',
            'query' => $sparqlQuery,
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
                    'info' => isset($result['Definition']['value'])
                        ? $result['Definition']['value'] : null,
                ],
            ];
        }
        usort($suggestions, function ($a, $b) {
            return strcmp($a['value'], $b['value']);
        });

        return $suggestions;
    }
}
