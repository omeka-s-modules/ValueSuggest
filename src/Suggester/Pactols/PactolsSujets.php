<?php
namespace ValueSuggest\Suggester\Pactols;

use ValueSuggest\Suggester\PrimaryLanguageTrait;
use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class PactolsSujets implements SuggesterInterface
{
    use PrimaryLanguageTrait;

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve suggestions from the Opentheso
     *
     * @param string $query
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $lang = $this->getPrimaryLanguage($lang, 'fr');
        $params = ['q' => $query, 'lang' => $lang, 'theso' => 'TH_1',  'group' => '6', 'format' => 'jsonld'];

        $response = $this->client
            ->setUri('https://pactols.frantiq.fr/api/search')
            ->setParameterGet($params)
            ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results ?? [] as $result) {
            if (!isset($result['http://www.w3.org/2004/02/skos/core#prefLabel'])) {
                continue;
            }
            foreach ($result['http://www.w3.org/2004/02/skos/core#prefLabel'] as $prefLabel) {
                if ($lang === $prefLabel['@language']) {
                    $info = null;
                    if (isset($result['http://www.w3.org/2004/02/skos/core#definition'])) {
                        // Each concept seems to have only one definition.
                        $info = $result['http://www.w3.org/2004/02/skos/core#definition'][0]['@value'];
                    }
                    $suggestions[] = [
                        'value' => $prefLabel['@value'],
                        'data' => [
                            'uri' => $result['@id'],
                            'info' => $info,
                        ],
                    ];
                }
            }
        }

        return $suggestions;
    }
}
