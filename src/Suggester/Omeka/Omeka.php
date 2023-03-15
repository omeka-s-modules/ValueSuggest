<?php
namespace ValueSuggest\Suggester\Omeka;

use ValueSuggest\Suggester\SuggesterWithContextInterface;

class Omeka implements SuggesterWithContextInterface
{
    protected $services;

    public function __construct($services, $name)
    {
        $this->services = $services;
        $this->name = $name;
    }

    public function getSuggestions($query, $lang = null, array $context = [])
    {
        $propertyId = (int) ($context['property_id'] ?? 0);
        $resourceTemplateId = (int) ($context['resource_template_id'] ?? 0);
        $resourceClassId = (int) ($context['resource_class_id'] ?? 0);

        $em = $this->services->get('Omeka\EntityManager');
        $qb = $em->createQueryBuilder()
            // Trim spaces and tabs from the values.
            ->select("TRIM('\t' FROM TRIM(v.value)) value, v.uri uri")
            ->from('Omeka\Entity\Value', 'v')
            ->andWhere('v.property = :propertyId')
            // Use LOCATE instead of LIKE %...% so we don't have to escape
            // wildcards. There's no discernable difference in speed.
            ->andWhere('LOCATE(:query, v.value) > 0')
            ->groupBy('value', 'uri')
            ->orderBy('value', 'ASC')
            ->setMaxResults(1000)
            ->setParameter('propertyId', $propertyId)
            ->setParameter('query', $query);

        if ($lang) {
            $qb->andWhere('v.lang = :lang')->setParameter('lang', $lang);
        }

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
