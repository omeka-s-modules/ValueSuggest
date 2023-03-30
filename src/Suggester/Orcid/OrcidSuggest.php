<?php
namespace ValueSuggest\Suggester\Orcid;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class OrcidSuggest implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve suggestions from the ORCID public API.
     *
     * @see https://info.orcid.org/documentation/api-tutorials/api-tutorial-searching-the-orcid-registry/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $params = [
            'q' => $query,
            'rows' => 100,
        ];
        $headers = $this->client->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');
        $response = $this->client
            ->setUri('https://pub.orcid.org/v3.0/expanded-search/')
            ->setParameterGet($params)
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }
        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['expanded-result'] as $result) {
            // Match how ORCID itself prioritizes and formats names.
            $value = $result['credit-name'] ?: sprintf('%s %s', $result['given-names'], $result['family-names']);
            $info = [];
            if ($result['credit-name']) {
                $info[] = sprintf('credit-name: %s', $result['credit-name']);
            }
            if ($result['given-names']) {
                $info[] = sprintf('given-names: %s', $result['given-names']);
            }
            if ($result['family-names']) {
                $info[] = sprintf('family-names: %s', $result['family-names']);
            }
            foreach ($result['other-name'] as $otherName) {
                $info[] = sprintf('other-name: %s', $otherName);
            }
            foreach ($result['institution-name'] as $institutionName) {
                $info[] = sprintf('institution-name: %s', $institutionName);
            }
            $suggestions[] = [
                'value' => $value,
                'data' => [
                    'uri' => sprintf('https://orcid.org/%s', $result['orcid-id']),
                    'info' => implode("\n", $info),
                ],
            ];
        }
        return $suggestions;
    }
}
