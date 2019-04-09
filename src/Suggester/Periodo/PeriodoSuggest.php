<?php
namespace ValueSuggest\Suggester\Periodo;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class PeriodoSuggest implements SuggesterInterface
{
    /**
     * Retrieve suggestions from the PeriodO dataset.
     *
     * @see http://perio.do/technical-overview/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $suggestions = [];
        $json = file_get_contents(sprintf('%s/periodo.json', __DIR__));
        $results = json_decode($json, true);
        foreach ($results['periodCollections'] as $collectionId => $collection) {
            $sourceInfo = $this->getSourceInfo($collection);
            foreach ($collection['definitions'] as $definitionId => $definition) {
                if (!$this->search($query, $this->getSearchAgainst($definition))) {
                    continue;
                }
                $info = [];
                $info[] = sprintf('Period start: %s', $definition['start']['label']);
                $info[] = sprintf('Period stop: %s', $definition['stop']['label']);
                if (isset($definition['spatialCoverageDescription'])) {
                    $info[] = sprintf(
                        'Spatial extent: %s',
                        $definition['spatialCoverageDescription']
                    );
                }
                if ($sourceInfo) {
                    $info[] = $sourceInfo;
                }
                $suggestions[] = [
                    'value' => $definition['label'],
                    'data' => [
                        'uri' => sprintf('http://n2t.net/ark:/99152/%s', $definitionId),
                        'info' => implode("\n", $info),
                    ],
                ];
            }
        }
        usort($suggestions, function ($a, $b) {
            return strcmp($a['value'], $b['value']);
        });
        return $suggestions;
    }

    /**
     * Get the source info.
     *
     * @param array $collection A period collection
     * @return string
     */
    public function getSourceInfo(array $collection)
    {
        $source = $collection['source'];
        $title = null;
        if (isset($source['title'])) {
            $title = $source['title'];
        } elseif (isset($source['partOf']['title'])) {
            $title = $source['partOf']['title'];
        }
        $yearPublished = null;
        if (isset($source['yearPublished'])) {
            $yearPublished = $source['yearPublished'];
        } elseif (isset($source['partOf']['yearPublished'])) {
            $yearPublished = $source['partOf']['yearPublished'];
        }
        $sourceInfo = null;
        if ($title && $yearPublished) {
            $sourceInfo = sprintf('Source: %s (%s)', $title, $yearPublished);
        } elseif ($title) {
            $sourceInfo = sprintf('Source: %s', $title);
        }
        return $sourceInfo;
    }

    /**
     * Get the string for the query to search against.
     *
     * @param array A period definition
     * @return string
     */
    public function getSearchAgainst(array $definition)
    {
        $searchAgainst = [];
        $searchAgainst[] = $definition['label'];
        if (isset($definition['spatialCoverageDescription'])) {
            $searchAgainst[] = $definition['spatialCoverageDescription'];
        }
        if (isset($definition['spatialCoverage'])) {
            foreach ($definition['spatialCoverage'] as $coverage) {
                $searchAgainst[] = $coverage['label'];
            }
        }
        return implode(' ', $searchAgainst);
    }

    /**
     * Search the query against the string.
     *
     * @param string $query
     * @param string $string
     * @return bool
     */
    public function search($query, $string)
    {
        return stristr($string, $query);
    }
}
