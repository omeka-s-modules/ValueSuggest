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
            ->select('v.value value, COUNT(v.value) has_count')
            ->from('Omeka\Entity\Value', 'v')
            ->andWhere('v.property = :propertyId')
                ->setParameter('propertyId', $propertyId)
            ->andWhere('LOCATE(:query, v.value) > 0')
                // Prevent wildcard injection using addcslashes.
                ->setParameter('query', $query)
            ->groupBy('value')
            ->orderBy('has_count', 'DESC')
            ->addOrderBy('value', 'ASC');

        $suggestions = [];
        foreach ($qb->getQuery()->getResult() as $result) {
            $suggestions[] = [
                'value' => $result['value'],
                'data' => [
                    'uri' => null,
                    'info' => null,
                ],
            ];
        }
        return $suggestions;
    }
}
