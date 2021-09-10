<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Mc\Mc;
use Laminas\ServiceManager\Factory\FactoryInterface;

class McDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggestall:mc:T262' => [
            'label' => "Ministère de la Culture: Catégories techniques et domaines - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T262',
        ],
        'valuesuggestall:mc:01952848-4419-431e-8e81-419c1d46b30d' => [
            'label' => "Ministère de la Culture: Domaines archivistiques pour l'indexation des circulaires", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/01952848-4419-431e-8e81-419c1d46b30d',
        ],
        'valuesuggestall:mc:T124' => [
            'label' => "Ministère de la Culture: Etat de conservation du patrimoine mobilier - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T124',
        ],
        'valuesuggestall:mc:T529' => [
            'label' => "Ministère de la Culture: Inscriptions, marques, emblématique et poinçons - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T529',
        ],
        'valuesuggestall:mc:T2' => [
            'label' => "Ministère de la Culture: Liste d'autorité Actions pour l'indexation des archives locales", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T2',
        ],
        'valuesuggestall:mc:T4' => [
            'label' => "Ministère de la Culture: Liste d'autorité Contexte historique pour l'indexation des archives locales", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T4',
        ],
        'valuesuggestall:mc:T3' => [
            'label' => "Ministère de la Culture: Liste d'autorité Typologie documentaire pour l'indexation des archives locales", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T3',
        ],
        'valuesuggestall:mc:T513' => [
            'label' => "Ministère de la Culture: Liste d'autorités Auteurs - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T513',
        ],
        'valuesuggestall:mc:T51' => [
            'label' => "Ministère de la Culture: Liste d'autorités Domaines - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T51',
        ],
        'valuesuggestall:mc:T115' => [
            'label' => "Ministère de la Culture: Liste d'autorités Découverte - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T115',
        ],
        'valuesuggestall:mc:T505' => [
            'label' => "Ministère de la Culture: Liste d'autorités Dénomination - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T505',
        ],
        'valuesuggestall:mc:T506' => [
            'label' => "Ministère de la Culture: Liste d'autorités Genèse - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T506',
        ],
        'valuesuggestall:mc:T520' => [
            'label' => "Ministère de la Culture: Liste d'autorités Inscriptions - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T520',
        ],
        'valuesuggestall:mc:T84' => [
            'label' => "Ministère de la Culture: Liste d'autorités Lieux - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T84',
        ],
        'valuesuggestall:mc:T515' => [
            'label' => "Ministère de la Culture: Liste d'autorités Localisation - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T515',
        ],
        'valuesuggestall:mc:T521' => [
            'label' => "Ministère de la Culture: Liste d'autorités Périodes - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T521',
        ],
        'valuesuggestall:mc:T523' => [
            'label' => "Ministère de la Culture: Liste d'autorités Représentation - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T523',
        ],
        'valuesuggestall:mc:T507' => [
            'label' => "Ministère de la Culture: Liste d'autorités Sources de la représentation - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T507',
        ],
        'valuesuggestall:mc:T516' => [
            'label' => "Ministère de la Culture: Liste d'autorités Techniques – Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T516',
        ],
        'valuesuggestall:mc:T86' => [
            'label' => "Ministère de la Culture: Liste d'autorités Utilisation - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T86',
        ],
        'valuesuggestall:mc:T517' => [
            'label' => "Ministère de la Culture: Liste d'autorités Écoles - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T517',
        ],
        'valuesuggestall:mc:T93' => [
            'label' => "Ministère de la Culture: Liste d'autorités Époques - Joconde", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T93',
        ],
        // 'valuesuggestall:mc:' => [
        //     'label' => "Ministère de la Culture: ", // @translate
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
