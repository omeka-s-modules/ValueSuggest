<?php
namespace ValueSuggest\Suggester\Unesco;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class Sparql implements SuggesterInterface
{
    const ENDPOINT = 'http://skos.um.es/sparql';

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
        $sparqlQuery = sprintf('
SELECT ?Subject ?Label
WHERE {
  GRAPH <%s> {
    ?Subject skos:prefLabel ?Label ;
    rdf:type skos:Concept .
    FILTER regex(?Label, "%s", "i")
    FILTER langMatches(lang(?Label), "%s")
  }
}
LIMIT 500',
            addslashes($this->graph),
            addslashes($query),
            addslashes($lang) ?: 'es' // The defualt lang is spanish
        );

        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet([
            'output' => 'json',
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
