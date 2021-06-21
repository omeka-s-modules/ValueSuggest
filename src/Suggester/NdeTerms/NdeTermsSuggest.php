<?php
namespace ValueSuggest\Suggester\NdeTerms;

use Laminas\Http\Client;
use ValueSuggest\Suggester\SuggesterInterface;

/**
 * Implementation following the structure of other Suggester classes, mainly RdaSuggestAll
 */
class NdeTermsSuggest implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string The term source URI.
     */
    protected $source;

    public function __construct(Client $client, $source)
    {
        $this->client = $client;
        $this->source = $source;
    }

    /**
     * Retrieve suggestions from the Dutch Digital Heritage Network of Terms using GraphQL.
     * @see https: //termennetwerk.netwerkdigitaalerfgoed.nl/faq
     * @param string $query search phrase
     * @param string $lang language identifier, not supported by NDE Termennetwerk (yet?)
     * @return array sorted list of suggestions (see ../SuggesterInterface.php)
     * @todo implement info property using SKOS-properties from NDE
     */
    public function getSuggestions($query, $lang = null): array
    {
        // if someone tinkers with the javascript we still check the minimal query length...
        if (strlen($query) < 4) {
            return [];
        }

        $agent = "Omeka S ValueSuggest / x.x (dev-fork by xentropics.nl)"; // @todo remove latter part for production
        $endpoint = "https://termennetwerk-api.netwerkdigitaalerfgoed.nl/graphql";
        $graphqlQuery = $this->buildQuery($query, $this->source);
        $result = $this->graphqlExecute($endpoint, $agent, $graphqlQuery);
        $suggestions = $this->parseResult($result);
        return $suggestions;
        // return [['value' => var_export("Hi", true), 'data' => ['uri' => "https://hi", 'info' => null]]]; // @todo remove
    }

    /**s
     * Generate the GraphQL query
     * @param string $searchphrase search phrase we will try to find terms for
     * @param string $source URI of the terms source we are retrieving results from
     */
    private function buildQuery($searchphrase, $source): string
    {
        return "query FindTerm {
        terms(
            sources: [\"$source\"],
            query: \"$searchphrase\")
        {
            source {
                name
            }
            result {
                ... on Terms {
                    terms {
                    uri
                    prefLabel
                    altLabel}
                }
                ... on Error {
                    message
                }
            }
        }
    }";
    }

    /**
     * Execute a GraphQL query and retrieve the result as an PHP array structure or an empty array if an I/O error occured
     * @todo refactor in order to make use of the Laminas HTTP client.
     * @param string $endpoint NDE Termennetwerk GraphQL endpoint URI
     * @param string $agent agent string for the HTTP request
     * @param string $query GraphQL query to execute
     * @return array PHP array structure which is basically decoded JSON wrapped in an array
     */
    private function graphqlExecute(string $endpoint, string $agent, string $query): array
    {
        $headers = ['Content-Type: application/json', "User-Agent: $agent"];
        $data = @file_get_contents($endpoint, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => $headers,
                'content' => json_encode(['query' => $query]),
            ],
        ]));
        $result = json_decode($data, true);
        return $result ? [$result] : [];
    }

    /**
     * Parse the result form the GraphQL query and format it according to the SuggesterInterface specification
     * @param array $result GraphQL query result (i.e. JSON decoded into PHP array structure) wrapped in an array
     * @return array sorted list of suggestions (see ../SuggesterInterface.php)
     */
    private function parseResult($result): array
    {
        $suggestions = [];
        if (!isset($result[0]['errors'])) {
            $baseNode = @$result[0]["data"]["terms"][0]["result"]["terms"] ?: [];
            if (count($baseNode) > 0) {
                foreach ($baseNode as $item) {
                    $uri = @$item["uri"] ?: false;
                    $label = @$item["prefLabel"][0] ?: false;
                    if ($uri && $label) {
                        array_push($suggestions, ['value' => $label, 'data' => ['uri' => $uri, 'info' => null]]);
                    }
                }
                usort($suggestions, function ($a, $b) {
                    return strcmp($a['value'], $b['value']);
                });
            }
        }
        return $suggestions;
    }
}
