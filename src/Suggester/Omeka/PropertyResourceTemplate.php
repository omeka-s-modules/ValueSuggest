<?php
namespace ValueSuggest\Suggester\Omeka;

use ValueSuggest\Suggester\SuggesterWithOptionsInterface;

class PropertyResourceTemplate implements SuggesterWithOptionsInterface
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function getSuggestions($query, $lang = null, array $options = [])
    {
        $propertyId = $options['property_id'] ?? null;
        $resourceTemplateId = $options['resource_template_id'] ?? null;
        if (!is_numeric($propertyId)) {
            return [];
        }
        if (!is_numeric($resourceTemplateId)) {
            return [];
        }

        $em = $this->services->get('Omeka\EntityManager');
        $qb = $em->createQueryBuilder()
            ->select('v.value value, COUNT(v.value) has_count')
            ->from('Omeka\Entity\Value', 'v')
            ->join('v.resource', 'r')
            ->andWhere('v.property = :propertyId')
                ->setParameter('propertyId', $propertyId)
            ->andWhere('r.resourceTemplate = :resourceTemplateId')
                ->setParameter('resourceTemplateId', $resourceTemplateId)
            ->andWhere('LOCATE(:query, v.value) > 0')
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
