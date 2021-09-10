<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Ns\Ns;
use Laminas\ServiceManager\Factory\FactoryInterface;

class NsDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggest:ns:ThesCF5' => [
            'label' => 'Nuovo soggettario: Agenti: Organismi', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF5',
        ],
        'valuesuggest:ns:ThesCF6' => [
            'label' => 'Nuovo soggettario: Agenti: Organizzazioni', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF6',
        ],
        'valuesuggest:ns:ThesCF7' => [
            'label' => 'Nuovo soggettario: Agenti: Persone e gruppi', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF7',
        ],
        'valuesuggest:ns:ThesCF1' => [
            'label' => 'Nuovo soggettario: Azioni: Attività', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF1',
        ],
        'valuesuggest:ns:ThesCF2' => [
            'label' => 'Nuovo soggettario: Azioni: Discipline', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF2',
        ],
        'valuesuggest:ns:ThesCF8' => [
            'label' => 'Nuovo soggettario: Azioni: Processi', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF8',
        ],
        'valuesuggest:ns:ThesCF15' => [
            'label' => 'Nuovo soggettario: Cose: Forme', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF15',
        ],
        'valuesuggest:ns:ThesCF3' => [
            'label' => 'Nuovo soggettario: Cose: Materia', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF3',
        ],
        'valuesuggest:ns:ThesCF4' => [
            'label' => 'Nuovo soggettario: Cose: Oggetti', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF4',
        ],
        'valuesuggest:ns:ThesCF9' => [
            'label' => 'Nuovo soggettario: Cose: Spazio', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF9',
        ],
        'valuesuggest:ns:ThesCF12' => [
            'label' => 'Nuovo soggettario: Cose: Strumenti', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF12',
        ],
        'valuesuggest:ns:ThesCF13' => [
            'label' => 'Nuovo soggettario: Cose: Strutture', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF13',
        ],
        'valuesuggest:ns:ThesCF14' => [
            'label' => 'Nuovo soggettario: Tempo', // @translate
            'scheme' => 'http://purl.org/bncf/tid/ThesCF14',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Ns($services);
        $dataType->setNsName($requestedName);
        $dataType->setNsLabel($this->types[$requestedName]['label']);
        $dataType->setNsScheme($this->types[$requestedName]['scheme']);
        return $dataType;
    }
}
