<?php
namespace ValueSuggest\Suggester\Oclc;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;
use Laminas\Http\Client\Adapter\Curl;

class ViafSuggest implements SuggesterInterface
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
     * Retrieve suggestions from the VIAF auto suggest service.
     *
     * @see https://developer.api.oclc.org/viaf-api
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $params = [
            'query' => $query,
        ];

        // The VIAF API is hosted on Cloudflare. The default Socket adapter triggers
        // a Cloudflare "security service that protect itself from online attacks",
        // i.e. automated traffic. Here we use the cURL adapter, which is compatible
        // with the Cloudflare hosted VIAF API.
        $response = $this->client
            ->setAdapter(Curl::class)
            ->setUri('https://www.viaf.org/viaf/AutoSuggest')
            ->setHeaders([
                // Override some default headers set by the client ('gzip' is not supported).
                'Accept-Encoding' => 'deflate, br, identity',
                'Accept' => 'application/json',
            ])
            ->setParameterGet($params)
            ->send();

        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['result'] as $result) {
            $info = [];
            if ($result['nametype']) {
                $info[] = sprintf('Type: %s', $result['nametype']);
            }
            if ($result['viafid']) {
                $info[] = sprintf('VIAF ID: %s', $result['viafid']);
            }

            $suggestions[] = [
                'value' => $result['term'],
                'data' => [
                    'uri' => sprintf('http://viaf.org/viaf/%s', $result['viafid']),
                    'info' => implode("\n", $info),
                ],
            ];
        }

        return $suggestions;
    }
}
