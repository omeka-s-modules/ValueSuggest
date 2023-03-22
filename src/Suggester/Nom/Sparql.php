<?php
namespace ValueSuggest\Suggester\Nom;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class Sparql implements SuggesterInterface
{
    const ENDPOINT = 'https://nomenclature.info/repositories/nom';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $category;

    public function __construct(Client $client, $category)
    {
        $this->client = $client;
        $this->category = $category;
    }

    /**
     * Retrieve suggestions from the Nomenclature SPARQL endpoint.
     *
     * @see https://nomenclature.info
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $sparqlQuery = sprintf('
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX nom: <https://nomenclature.info/nom/>
SELECT ?subject ?label
WHERE {
    ?subject skos:prefLabel ?label .
    ?subject rdf:type skos:Concept ;
    FILTER regex(?label, "%s", "i")
    FILTER langMatches(lang(?label), "%s")
    %s
}
LIMIT 500',
            addslashes($query),
            addslashes((string) $lang) ?: 'en', // The defualt lang is Italian
            $this->category ? sprintf('FILTER EXISTS {?subject skos:broader* %s}', $this->category) : null
        );

        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet([
            'Accept' => 'application/sparql-results+json',
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
                'value' => $result['label']['value'],
                'data' => [
                    'uri' => $result['subject']['value'],
                    'info' => null,
                ],
            ];
        }
        usort($suggestions, function ($a, $b) {
            return strcmp($a['value'], $b['value']);
        });

        return $suggestions;
    }
}
