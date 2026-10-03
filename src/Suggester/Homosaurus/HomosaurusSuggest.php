<?php
namespace ValueSuggest\Suggester\Homosaurus;

use ValueSuggest\Suggester\SortSuggestionsTrait;
use ValueSuggest\Suggester\SuggesterInterface;
use Laminas\Http\Client;

class HomosaurusSuggest implements SuggesterInterface
{
    use SortSuggestionsTrait;

    const ENDPOINT = 'https://homosaurus.org/search/v5.jsonld';

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
     * @see https://homosaurus.org/search/v5
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $response = $this->client
        ->setUri(self::ENDPOINT)
        ->setParameterGet(['q' => $query])
        ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        if (!is_array($results)) {
            return [];
        }

        if (array_key_exists('@graph', $results)) {
            $results = $results['@graph'];
        } else {
            $results = [$results];
        }

        // The API returns at most 50 results, unranked. Among those, rank exact
        // matches on any label (preferred or alternate, in any language) first,
        // then displayed labels that start with the query, then the rest.
        $normalizedQuery = mb_strtolower(trim($query));
        $ranked = [];
        foreach ($results as $result) {
            if (!isset($result['skos:prefLabel'], $result['@id'])) {
                continue;
            }
            $prefLabels = $this->getValuesByLanguage($result['skos:prefLabel']);
            if (!$prefLabels) {
                continue;
            }
            $labelLang = $this->selectLanguage($prefLabels, $lang);
            $label = trim($prefLabels[$labelLang][0]);

            // Show alternate labels only in the language of the preferred
            // label. Fall back on any language for the description.
            $info = [];
            $comments = $this->getValuesByLanguage($result['rdfs:comment'] ?? []);
            if ($comments) {
                $info[] = $comments[$this->selectLanguage($comments, $labelLang)][0];
            }
            $altLabels = $this->getValuesByLanguage($result['skos:altLabel'] ?? []);
            if (isset($altLabels[$labelLang])) {
                $info[] = sprintf('Alternate labels: %s', implode(', ', $altLabels[$labelLang]));
            }

            $allLabels = array_map(function ($value) {
                return mb_strtolower(trim($value));
            }, array_merge(...array_values($prefLabels), ...array_values($altLabels)));
            if (in_array($normalizedQuery, $allLabels, true)) {
                $rank = 0;
            } elseif (0 === mb_strpos(mb_strtolower($label), $normalizedQuery)) {
                $rank = 1;
            } else {
                $rank = 2;
            }

            $ranked[] = [
                'rank' => $rank,
                'sortKey' => $this->getSortKey($label),
                'suggestion' => [
                    'value' => $label,
                    'data' => [
                        'uri' => $result['@id'],
                        'info' => implode("\n", $info),
                    ],
                ],
            ];
        }
        usort($ranked, function ($a, $b) {
            return $a['rank'] <=> $b['rank'] ?: strcmp($a['sortKey'], $b['sortKey']);
        });

        return array_column($ranked, 'suggestion');
    }

    /**
     * Group the values of a JSON-LD property by language tag.
     *
     * A property may be a plain string, a single language-tagged object, or a
     * list of either. Untagged values are grouped under an empty tag. Anything
     * else, such as an @id node, is ignored.
     *
     * @param mixed $property
     * @return array
     */
    protected function getValuesByLanguage($property)
    {
        if (!is_array($property) || !array_key_exists(0, $property)) {
            $property = [$property];
        }
        $values = [];
        foreach ($property as $value) {
            if (is_array($value) && isset($value['@value']) && is_string($value['@value'])) {
                $values[strtolower($value['@language'] ?? '')][] = $value['@value'];
            } elseif (is_string($value)) {
                $values[''][] = $value;
            }
        }
        return $values;
    }

    /**
     * Select the language tag that best matches the requested language.
     *
     * Tries the requested tag, then its primary subtag ("en" for "en-US" or
     * "en_US"), then English, matching regional variants of each ("en-gb" for
     * "en"). Falls back on the first language available.
     *
     * @param array $values Values grouped by language tag
     * @param string|null $lang
     * @return string
     */
    protected function selectLanguage(array $values, $lang)
    {
        $lang = str_replace('_', '-', strtolower((string) $lang));
        $candidates = array_filter([$lang, explode('-', $lang)[0], 'en']);
        foreach ($candidates as $candidate) {
            if (isset($values[$candidate])) {
                return $candidate;
            }
            foreach (array_keys($values) as $tag) {
                if (0 === strpos($tag, $candidate . '-')) {
                    return $tag;
                }
            }
        }
        return array_key_first($values);
    }
}
