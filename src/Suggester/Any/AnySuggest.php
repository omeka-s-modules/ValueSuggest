<?php
namespace ValueSuggest\Suggester\Any;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class AnySuggest implements SuggesterInterface
{
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
     * Retrieve suggestions from any suggester.
     *
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
    }
}
