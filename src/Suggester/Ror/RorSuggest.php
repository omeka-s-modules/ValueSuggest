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
     * Retrieve suggestions from the ROR public API.
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
            ->setUri('https://api.ror.org/organizations')
            ->setParameterGet($params)
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }
        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        // echo '<pre>';print_r($results);exit;
        foreach ($results['items'] as $result) {
            $info = [];
            if ($result['aliases']) {
                foreach ($result['aliases'] as $alias) {
                    $info[] = sprintf('alias: %s', $alias);
                }
            }
            if ($result['acronyms']) {
                foreach ($result['acronyms'] as $acronym) {
                    $info[] = sprintf('acronym: %s', $acronym);
                }
            }
            if ($result['types']) {
                foreach ($result['types'] as $type) {
                    $info[] = sprintf('type: %s', $type);
                }
            }
            if ($result['links']) {
                foreach ($result['links'] as $link) {
                    $info[] = sprintf('link: %s', $link);
                }
            }
            if ($result['country']) {
                $info[] = sprintf('country: %s', $result['country']['country_name']);
            }
            if ($result['addresses']) {
                foreach ($result['addresses'] as $address) {
                    $info[] = sprintf('address: %s', $address['city']);
                }
            }
            $suggestions[] = [
                'value' => $result['name'],
                'data' => [
                    'uri' => $result['id'],
                    'info' => implode("\n", $info),
                ],
            ];
        }
        return $suggestions;
    }
}
