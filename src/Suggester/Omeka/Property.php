<?php
namespace ValueSuggest\Suggester\Omeka;

use ValueSuggest\Suggester\SuggesterWithOptionsInterface;

class Property implements SuggesterWithOptionsInterface
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function getSuggestions($query, $lang = null, array $options = [])
    {
        $propertyId = $options['property_id'] ?? null;
        if (!is_numeric($propertyId)) {
            return [];
        }

        $em = $this->services->get('Omeka\EntityManager');
        $qb = $em->createQueryBuilder()
            ->select('v.value value, v.uri uri, COUNT(v.value) has_count')
            ->from('Omeka\Entity\Value', 'v')
            ->andWhere('v.property = :propertyId')
                ->setParameter('propertyId', $propertyId)
            ->andWhere('LOCATE(:query, v.value) > 0')
                ->setParameter('query', $query)
            ->groupBy('value', 'uri')
            ->orderBy('has_count', 'DESC')
            ->addOrderBy('value', 'ASC');

        $suggestions = [];
        foreach ($qb->getQuery()->getResult() as $result) {
            $suggestions[] = [
                'value' => $result['value'],
                'data' => [
                    'uri' => $result['uri'],
                    'info' => $result['uri'] ? sprintf('%s %s', $result['value'], $result['uri']) : null,
                ],
            ];
        }
        return $suggestions;
    }
}
