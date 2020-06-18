<?php
namespace ValueSuggest\Suggester\Homosaurus;

use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class HomosaurusSuggest implements SuggesterInterface
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
     * Retrieve suggestions from the Homosaurus web services API.
     *
     * @see http://homosaurus.org/search
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $response = $this->client
        ->setUri('http://homosaurus.org/search/v2.jsonld')
        ->setParameterGet(['q' => $query])
        ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);

        if (array_key_exists('@graph', $results)) {
            $results = $results['@graph'];
        } else {
            $results = [$results];
        }

        foreach ($results as $result) {
            $info = '';

            if (array_key_exists('skos:altLabel', $result)) {
                $altLabel = $result['skos:altLabel'];
                $info = is_array($altLabel) ? implode(', ', $altLabel) : $altLabel;
            }

            if (array_key_exists('skos:prefLabel', $result)) {
                $suggestions[] = [
                    'value' => $result['skos:prefLabel'] . ($info ? ' (' . $info . ')' : ''),
                    'data' => [
                        'uri' => $result['@id'],
                        'info' => $info,
                    ],
                ];
            }
        }

        return $suggestions;
    }
}
