<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Mc\Mc;
use Laminas\ServiceManager\Factory\FactoryInterface;

class McDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggestall:mc:T262' => [
            'label' => 'Ministère de la Culture: Catégories techniques et domaines', // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T262',
        ],
        'valuesuggestall:mc:01952848-4419-431e-8e81-419c1d46b30d' => [
            'label' => 'Ministère de la Culture: Domaines archivistiques pour l\'indexation des circulaires', // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/01952848-4419-431e-8e81-419c1d46b30d',
        ],
        'valuesuggestall:mc:T124' => [
            'label' => 'Ministère de la Culture: Etat de conservation du patrimoine mobilier', // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T124',
        ],
        'valuesuggestall:mc:T529' => [
            'label' => 'Ministère de la Culture: Inscriptions, marques, emblématique et poinçons', // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T529',
        ],
        // 'valuesuggestall:mc:' => [
        //     'label' => '', // @translate
        //     'scheme' => '',
        // ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Mc($services);
        $dataType->setMcName($requestedName);
        $dataType->setMcLabel($this->types[$requestedName]['label']);
        $dataType->setMcScheme($this->types[$requestedName]['scheme']);
        return $dataType;
    }
}
