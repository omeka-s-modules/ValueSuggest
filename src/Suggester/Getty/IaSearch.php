<?php
namespace ValueSuggest\Suggester\Getty;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class IaSearch implements SuggesterInterface
{
    const ENDPOINT = 'http://vocabsservices.getty.edu/CONAService.asmx/CONAIconographyMatch';

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve IA search results from the Getty CONAService endpoint.
     *
     * @see https://www.getty.edu/research/tools/vocabularies/cona/index.html
     * @see http://vocabsservices.getty.edu/CONAService.asmx?op=CONAIconographyMatch
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        // Make the request.
        $params = [
            'term' => $query,
            'logop' => '',
            'notes' => '',
        ];
        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet($params);
        $response = $client->send();
        if (!$response->isSuccess()) {
            return [];
        }
        // Convert XML to JSON.
        $xml = simplexml_load_string($response->getBody());
        $results = json_decode(json_encode($xml), true);

        if ('0' === $results['Count']) {
            // Response returned no results. Return no suggestions.
            return [];
        }

        $suggestions = [];
        foreach ($results['Iconography'] as $result) {
            $info = [];
            if ($result['Matching_Term']) {
                $info[] = sprintf('Matching_Term: %s', is_array($result['Matching_Term']) ? implode('; ', $result['Matching_Term']) : $result['Matching_Term']);
            }
            if ($result['Iconography_Type']) {
                $info[] = sprintf('Iconography_Type: %s', $result['Iconography_Type']);
            }
            if ($result['Parent_String']) {
                $info[] = sprintf('Parent_String: %s', $result['Parent_String']);
            }
            $suggestions[] = [
                'value' => $result['Preferred_Name'],
                'data' => [
                    'uri' => sprintf('http://vocab.getty.edu/page/ia/%s', $result['Iconography_Id']),
                    'info' => implode("\n\n", $info),
                ],
            ];
        }
        return $suggestions;
    }
}
