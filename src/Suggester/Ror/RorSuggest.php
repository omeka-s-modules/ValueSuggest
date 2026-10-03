<?php
namespace ValueSuggest\Suggester\Ror;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class RorSuggest implements SuggesterInterface
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
     * Retrieve suggestions from the ROR public API (v2).
     *
     * @see https://ror.readme.io/docs/rest-api
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $params = [
            'query' => $query,
        ];
        $headers = $this->client->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');
        $response = $this->client
            ->setUri('https://api.ror.org/v2/organizations')
            ->setParameterGet($params)
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }
        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['items'] ?? [] as $result) {
            // Each name is typed: ror_display (the display name), label,
            // alias, or acronym. A name may have more than one type.
            $name = null;
            $info = [];
            foreach ($result['names'] ?? [] as $resultName) {
                $types = $resultName['types'] ?? [];
                if (in_array('ror_display', $types)) {
                    $name = $resultName['value'];
                }
                if (in_array('alias', $types)) {
                    $info[] = sprintf('alias: %s', $resultName['value']);
                }
                if (in_array('acronym', $types)) {
                    $info[] = sprintf('acronym: %s', $resultName['value']);
                }
            }
            if (null === $name) {
                continue;
            }
            foreach ($result['types'] ?? [] as $type) {
                $info[] = sprintf('type: %s', $type);
            }
            foreach ($result['links'] ?? [] as $link) {
                if (isset($link['value'])) {
                    $info[] = sprintf('link: %s', $link['value']);
                }
            }
            foreach ($result['locations'] ?? [] as $location) {
                $place = array_filter([
                    $location['geonames_details']['name'] ?? null,
                    $location['geonames_details']['country_name'] ?? null,
                ]);
                if ($place) {
                    $info[] = sprintf('location: %s', implode(', ', $place));
                }
            }
            $suggestions[] = [
                'value' => $name,
                'data' => [
                    'uri' => $result['id'],
                    'info' => implode("\n", $info),
                ],
            ];
        }
        return $suggestions;
    }
}
