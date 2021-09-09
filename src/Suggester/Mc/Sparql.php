<?php
namespace ValueSuggest\Suggester\Mc;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class Sparql implements SuggesterInterface
{
    const ENDPOINT = 'http://data.culture.fr/thesaurus/sparql';

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
     * Retrieve suggestions from Les vocabulaires du Ministère de la Culture et
     * de la Communication SPARQL endpoint.
     *
     * @see http://data.culture.fr/thesaurus/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $sparqlQuery = sprintf('
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
SELECT ?concept ?label WHERE {
    ?concept skos:inScheme <%s> .
    ?concept skos:prefLabel ?label .
    FILTER (lang(?label)="%s")
}
ORDER BY ?label',
            addslashes($this->scheme),
            addslashes($lang) ?: 'fr-fr' // The defualt lang is french
        );

        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet([
            'query' => $sparqlQuery,
        ]);
        $response = $client->send();
        if (!$response->isSuccess()) {
            return [];
        }

        $suggestions = [];
        $sparql = new \SimpleXMLElement($response->getBody());
        foreach ($sparql->results->result as $result) {
            $suggestions[] = [
                'value' => (string) $result->binding[1]->literal,
                'data' => [
                    'uri' => (string) $result->binding[0]->uri,
                    'info' => null,
                ],
            ];
        }
        return $suggestions;
    }
}
