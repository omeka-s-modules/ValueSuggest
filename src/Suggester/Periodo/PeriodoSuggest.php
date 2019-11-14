<?php
namespace ValueSuggest\Suggester\Periodo;

use ValueSuggest\Suggester\SuggesterInterface;

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
                $text = $this->getPeriodDefinitionText($definition);
                if (stristr($text, $query)) {
                    $info = [];
                    $info[] = sprintf('Period start: %s', $definition['start']['label']);
                    $info[] = sprintf('Period stop: %s', $definition['stop']['label']);
                    if (isset($definition['spatialCoverageDescription'])) {
                        $info[] = sprintf(
                            'Spatial description: %s',
                            $definition['spatialCoverageDescription']
                        );
                    }
                    if (isset($definition['spatialCoverage'])) {
                        $locations = [];
                        foreach ($definition['spatialCoverage'] as $location) {
                            $locations[] = $location['label'];
                        }
                        $info[] = sprintf('Spatial coverage: %s', implode('; ', $locations));
                    }
                    if ($sourceInfo) {
                        $info[] = $sourceInfo;
                    }
                    if (isset($definition['note'])) {
                        $info[] = sprintf('Note: %s', $definition['note']);
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
     * Get the searchable text of a period definition.
     *
     * @param array A period definition
     * @return string
     */
    public function getPeriodDefinitionText(array $definition)
    {
        $text = [];
        $text[] = $definition['label'];
        if (isset($definition['spatialCoverageDescription'])) {
            $text[] = $definition['spatialCoverageDescription'];
        }
        if (isset($definition['spatialCoverage'])) {
            foreach ($definition['spatialCoverage'] as $coverage) {
                $text[] = $coverage['label'];
            }
        }
        if (isset($definition['note'])) {
            $text[] = $definition['note'];
        }
        return implode(' ', $text);
    }
}
