<?php
namespace ValueSuggest\Suggester\Omeka;

use ValueSuggest\Suggester\SuggesterWithOptionsInterface;

class Omeka implements SuggesterWithOptionsInterface
{
    protected $services;

    public function __construct($services, $name)
    {
        $this->services = $services;
        $this->name = $name;
    }

    public function getSuggestions($query, $lang = null, array $options = [])
    {
        $propertyId = $options['property_id'] ?? null;
        $resourceTemplateId = $options['resource_template_id'] ?? null;
        $resourceClassId = $options['resource_class_id'] ?? null;

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

        switch ($this->name) {
            case 'valuesuggest:omeka:propertyResourceTemplate':
                $qb->join('v.resource', 'r')
                    ->andWhere('r.resourceTemplate = :resourceTemplateId')
                    ->setParameter('resourceTemplateId', $resourceTemplateId);
                break;
            case 'valuesuggest:omeka:propertyResourceClass':
                $qb->join('v.resource', 'r')
                    ->andWhere('r.resourceClass = :resourceClassId')
                    ->setParameter('resourceClassId', $resourceClassId);
                break;
            case 'valuesuggest:omeka:property':
            default:
                // Do nothing
                break;
        }

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
