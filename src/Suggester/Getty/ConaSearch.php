<?php
namespace ValueSuggest\Suggester\Getty;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class ConaSearch implements SuggesterInterface
{
    const ENDPOINT = 'http://vocabsservices.getty.edu/CONAService.asmx/CONAGetTermMatch';

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve CONA search results from the Getty CONAService endpoint.
     *
     * @see https://www.getty.edu/research/tools/vocabularies/cona/index.html
     * @see http://vocabsservices.getty.edu/CONAService.asmx?op=CONAGetTermMatch
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
            'facet' => '',
            'wtype' => '',
            'creator' => '',
            'material' => '',
            'location' => '',
            'number' => '',
            'geographic' => '',
            'creation_start' => '',
            'creation_end' => '',
            'general_subject' => '',
            'specific_subject' => '',
        ];
        $client = $this->client->setUri(self::ENDPOINT)->setParameterGet($params);
        $response = $client->send();
        if (!$response->isSuccess()) {
            return [];
        }
        // Convert XML to JSON.
        $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOERROR | LIBXML_NOWARNING);
        if (false === $xml) {
            return [];
        }
        $results = json_decode(json_encode($xml), true);

        if (empty($results['Subject'])) {
            // Response returned no results. Return no suggestions.
            return [];
        }
        // A single match converts to one associative array instead of a list.
        if (!isset($results['Subject'][0])) {
            $results['Subject'] = [$results['Subject']];
        }

        $suggestions = [];
        foreach ($results['Subject'] as $result) {
            $info = [];
            if ($result['Term']) {
                $info[] = sprintf('Term: %s', is_array($result['Term']) ? implode('; ', $result['Term']) : $result['Term']);
            }
            if ($result['Display_Label']) {
                $info[] = sprintf('Display_Label: %s', $result['Display_Label']);
            }
            if ($result['Cona_Label']) {
                $info[] = sprintf('Cona_Label: %s', $result['Cona_Label']);
            }
            if ($result['Preferred_Parent']) {
                $info[] = sprintf('Preferred_Parent: %s', $result['Preferred_Parent']);
            }
            $suggestions[] = [
                'value' => $result['Preferred_Term'],
                'data' => [
                    'uri' => sprintf('http://vocab.getty.edu/page/cona/%s', $result['Subject_ID']),
                    'info' => implode("\n\n", $info),
                ],
            ];
        }
        return $suggestions;
    }
}
