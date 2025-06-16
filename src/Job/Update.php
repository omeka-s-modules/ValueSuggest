<?php

namespace ValueSuggest\Job;

use Omeka\Job\AbstractJob;
use ValueSuggest\DataType\UpdatableDataTypeInterface;

class Update extends AbstractJob
{
    const BATCH_SIZE = 100;

    public function perform()
    {
        $serviceLocator = $this->getServiceLocator();
        $logger = $serviceLocator->get('Omeka\Logger');
        $em = $serviceLocator->get('Omeka\EntityManager');

        $logger->info('Job started');
        $em->flush();

        $updatableDataTypes = $this->getUpdatableDataTypes();
        $updatableDataTypeNames = array_keys($updatableDataTypes);

        $dataTypeNames = $this->getArg('data_types', []);
        if (empty($dataTypeNames)) {
            $dataTypeNames = $updatableDataTypeNames;
        } else {
            $dataTypeNames = array_intersect($dataTypeNames, $updatableDataTypeNames);
        }

        $originalIdentityMap = $this->getEntityManager()->getUnitOfWork()->getIdentityMap();

        $updatedCounts = [];
        $updatedResourceIds = [];

        foreach ($dataTypeNames as $dataTypeName) {
            $dataType = $updatableDataTypes[$dataTypeName];
            $logger->info(sprintf('Processing data type "%s"', $dataTypeName));
            $em->flush();

            $updatedCounts[$dataTypeName] = 0;

            $updater = $dataType->getUpdater();
            $lastId = 0;
            $query = $em->createQuery('select v from Omeka\Entity\Value v where v.type = :type and v.id > :lastId order by v.id asc');
            $query->setMaxResults(self::BATCH_SIZE);
            $query->setParameter('type', $dataTypeName);
            $query->setParameter('lastId', $lastId);
            $values = $query->getResult();
            $processedCount = 0;
            while (!empty($values)) {
                foreach ($values as $value) {
                    $lastId = $value->getId();

                    if ($updater->update($value)) {
                        $updatedCounts[$dataTypeName]++;

                        $resourceId = $value->getResource()->getId();
                        $updatedResourceIds[$resourceId] = $resourceId;
                    }

                    $processedCount++;
                }

                $em->flush();
                $this->detachAllNewEntities($originalIdentityMap);

                $query->setParameter('lastId', $lastId);
                $values = $query->getResult();
            }

            $logger->info(sprintf('Processed %d values (%d were updated)', $processedCount, $updatedCounts[$dataTypeName]));
            $em->flush();
        }

        $logger->info(sprintf('Total values updated: %d (in %d resources)', array_sum($updatedCounts), count($updatedResourceIds)));

        $logger->info('Job ended normally');
    }

    protected function getUpdatableDataTypes(): array
    {
        $serviceLocator = $this->getServiceLocator();
        $dataTypeManager = $serviceLocator->get('Omeka\DataTypeManager');

        $updatableDataTypes = [];

        foreach ($dataTypeManager->getRegisteredNames(true) as $name) {
            $dataType = $dataTypeManager->get($name);
            if ($dataType instanceof UpdatableDataTypeInterface) {
                $updatableDataTypes[$name] = $dataType;
            }
        }

        return $updatableDataTypes;
    }

    protected function detachAllNewEntities(array $oldIdentityMap)
    {
        $entityManager = $this->getEntityManager();
        $identityMap = $entityManager->getUnitOfWork()->getIdentityMap();
        foreach ($identityMap as $entityClass => $entities) {
            foreach ($entities as $idHash => $entity) {
                if (!isset($oldIdentityMap[$entityClass][$idHash])) {
                    $entityManager->detach($entity);
                }
            }
        }
    }

    protected function getEntityManager()
    {
        return $this->getServiceLocator()->get('Omeka\EntityManager');
    }
}
