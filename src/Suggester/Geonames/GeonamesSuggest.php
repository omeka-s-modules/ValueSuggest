<?php
namespace ValueSuggest\Suggester\Geonames;

use ValueSuggest\Suggester\PrimaryLanguageTrait;
use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class GeonamesSuggest implements SuggesterInterface
{
    use PrimaryLanguageTrait;

    /**
     * The username used when none is configured.
     */
    private const DEFAULT_USERNAME = 'kdlinfo';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    private $username;

    /**
     * @param Client $client
     * @param string|null $username A GeoNames username; when blank, a default
     *   is used
     */
    public function __construct(Client $client, $username = null)
    {
        $this->client = $client;
        $this->username = (is_string($username) && '' !== trim($username))
            ? trim($username)
            : self::DEFAULT_USERNAME;
    }

    /**
     * Retrieve suggestions from the Geonames web services API.
     *
     * @see http://www.geonames.org/export/geonames-search.html
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $params = ['q' => $query, 'maxRows' => 100, 'username' => $this->username];
        // Geonames requires an ISO-639 2-letter language code, so use the
        // primary subtag ("zh" for "zh_CN" or "zh-CN").
        $lang = $this->getPrimaryLanguage($lang, '');
        if ($lang) {
            $params['lang'] = $lang;
        }
        $response = $this->client
        ->setUri('https://secure.geonames.org/searchJSON')
        ->setParameterGet($params)
        ->send();

        // GeoNames reports errors, such as a used-up limit or an invalid
        // username, as a status object, sometimes with HTTP 200. The proxy
        // logs the message.
        $results = json_decode($response->getBody(), true);
        if (isset($results['status']['message'])) {
            throw new \RuntimeException(sprintf(
                'GeoNames error %s: %s',
                $results['status']['value'] ?? '?',
                $results['status']['message']
            ));
        }
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        foreach ($results['geonames'] ?? [] as $result) {
            $info = [];
            if (isset($result['fcodeName']) && $result['fcodeName']) {
                $info[] = sprintf('Feature: %s', $result['fcodeName']);
            }
            if (isset($result['countryName']) && $result['countryName']) {
                $info[] = sprintf('Country: %s', $result['countryName']);
            }
            if (isset($result['adminName1']) && $result['adminName1']) {
                $info[] = sprintf('Admin name: %s', $result['adminName1']);
            }
            if (isset($result['population']) && $result['population']) {
                $info[] = sprintf('Population: %s', number_format($result['population']));
            }
            $suggestions[] = [
                'value' => $result['name'],
                'data' => [
                    'uri' => sprintf('http://www.geonames.org/%s', $result['geonameId']),
                    'info' => implode("\n", $info),
                ],
            ];
        }

        return $suggestions;
    }
}
