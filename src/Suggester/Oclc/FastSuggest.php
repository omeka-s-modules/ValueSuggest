<?php
namespace ValueSuggest\Suggester\Oclc;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class FastSuggest implements SuggesterInterface
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
     * Retrieve suggestions from the assignFAST suggest service.
     *
     * @see http://www.oclc.org/developer/develop/web-services/fast-api/assign-fast.en.html
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $response = $this->client
            ->setUri('http://fast.oclc.org/searchfast/fastsuggest')
            ->setParameterGet([
                'query' => $query,
                'queryIndex' => 'suggestall',
                'suggest' => 'autoSubject',
                'queryReturn' => 'suggestall idroot',
                'rows' => '20',
            ])
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['response']['docs'] as $result) {
            $suggestions[] = [
                'value' => $result['suggestall'][0],
                'data' => [
                    'uri' => sprintf('http://id.worldcat.org/fast/%s', substr($result['idroot'], 3)),
                    'info' => null,
                ],
            ];
        }

        return $suggestions;
    }
}
