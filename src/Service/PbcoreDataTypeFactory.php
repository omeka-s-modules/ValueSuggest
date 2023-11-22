<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Pbcore\Pbcore;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PbcoreDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggestall:pbcore:pbcoreAssetType' => [
            'label' => 'PBCore: pbcoreAssetType', // @translate
            'filename' => 'pbcoreAssetType.json',
        ],
        'valuesuggestall:pbcore:dateType' => [
            'label' => 'PBCore: @dateType', // @translate
            'filename' => 'dateType.json',
        ],
        'valuesuggestall:pbcore:titleType' => [
            'label' => 'PBCore: @titleType', // @translate
            'filename' => 'titleType.json',
        ],
        'valuesuggestall:pbcore:descriptionType' => [
            'label' => 'PBCore: @descriptionType', // @translate
            'filename' => 'descriptionType.json',
        ],
        'valuesuggestall:pbcore:pbcoreRelationType' => [
            'label' => 'PBCore: pbcoreRelationType', // @translate
            'filename' => 'pbcoreRelationType.json',
        ],
        'valuesuggestall:pbcore:instantiationRelationType' => [
            'label' => 'PBCore: instantiationRelationType', // @translate
            'filename' => 'instantiationRelationType.json',
        ],
        'valuesuggestall:pbcore:creatorRoleContributorRole' => [
            'label' => 'PBCore: creatorRole and contributorRole', // @translate
            'filename' => 'creatorRoleContributorRole.json',
        ],
        'valuesuggestall:pbcore:publisherRole' => [
            'label' => 'PBCore: publisherRole', // @translate
            'filename' => 'publisherRole.json',
        ],
        'valuesuggestall:pbcore:instantiationPhysicalAudio' => [
            'label' => 'PBCore: instantiationPhysical: Audio', // @translate
            'filename' => 'instantiationPhysicalAudio.json',
        ],
        'valuesuggestall:pbcore:instantiationPhysicalFilm' => [
            'label' => 'PBCore: instantiationPhysical: Film', // @translate
            'filename' => 'instantiationPhysicalFilm.json',
        ],
        'valuesuggestall:pbcore:instantiationPhysicalVideo' => [
            'label' => 'PBCore: instantiationPhysical: Video', // @translate
            'filename' => 'instantiationPhysicalVideo.json',
        ],
        'valuesuggestall:pbcore:instantiationMediaType' => [
            'label' => 'PBCore: instantiationMediaType', // @translate
            'filename' => 'instantiationMediaType.json',
        ],
        'valuesuggestall:pbcore:instantiationGenerations' => [
            'label' => 'PBCore: instantiationGenerations', // @translate
            'filename' => 'instantiationGenerations.json',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Pbcore($services);
        $dataType->setPbcoreName($requestedName);
        $dataType->setPbcoreLabel($this->types[$requestedName]['label']);
        $dataType->setPbcoreFilename($this->types[$requestedName]['filename']);
        return $dataType;
    }
}
