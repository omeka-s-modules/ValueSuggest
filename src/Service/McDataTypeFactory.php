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
        'valuesuggestall:mc:T20' => [
            'label' => "Ministère de la Culture: Matériau de la couverture - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T20',
        ],
        'valuesuggestall:mc:T57' => [
            'label' => "Ministère de la Culture: Matériau du gros-oeuvre et mise en oeuvre - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T57',
        ],
        'valuesuggestall:mc:T94' => [
            'label' => "Ministère de la Culture: Matériaux et techniques du patrimoine mobilier - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T94',
        ],
        'valuesuggestall:mc:0404efce-2024-4694-bf80-eba4fc2b336c' => [
            'label' => "Ministère de la Culture: Nomenclatures HADOC", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/0404efce-2024-4694-bf80-eba4fc2b336c',
        ],
        'valuesuggestall:mc:98b3feb3-744b-4ba3-8381-18ca4a555a4c' => [
            'label' => "Ministère de la Culture: Référentiel de communicabilité des archives publiques", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/98b3feb3-744b-4ba3-8381-18ca4a555a4c',
        ],
        'valuesuggestall:mc:T532' => [
            'label' => "Ministère de la Culture: Stade de la création des objets mobiliers - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T532',
        ],
        'valuesuggestall:mc:T59' => [
            'label' => "Ministère de la Culture: Statut de la propriété des Biens culturels - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T59',
        ],
        'valuesuggestall:mc:T61' => [
            'label' => "Ministère de la Culture: Techniques photographiques", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T61',
        ],
        'valuesuggestall:mc:T69' => [
            'label' => "Ministère de la Culture: Thésaurus de la désignation des objets mobiliers", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T69',
        ],
        'valuesuggestall:mc:T96' => [
            'label' => "Ministère de la Culture: Thésaurus de la désignation des œuvres architecturales et des espaces aménagés", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T96',
        ],
        'valuesuggestall:mc:Matiere' => [
            'label' => "Ministère de la Culture: Thésaurus-matières pour l'indexation des archives locales", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/Matiere',
        ],
        'valuesuggestall:mc:T26' => [
            'label' => "Ministère de la Culture: Type de la couverture - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T26',
        ],
        'valuesuggestall:mc:T10' => [
            'label' => "Ministère de la Culture: Type de protection MH - Inventaire/MH", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/T10',
        ],
        'valuesuggestall:mc:51232822-adac-4a33-aa14-29e2c701a5ee' => [
            'label' => "Ministère de la Culture: Vocabulaire des activités des entités productrices d'archives", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/51232822-adac-4a33-aa14-29e2c701a5ee',
        ],
        'valuesuggestall:mc:37684874-0820-402d-b53e-f8ab6b9ed8ba' => [
            'label' => "Ministère de la Culture: Vocabulaire des altérations", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/37684874-0820-402d-b53e-f8ab6b9ed8ba',
        ],
        'valuesuggestall:mc:f14e8183-5885-46d6-8fc9-17ebd8f3c27e' => [
            'label' => "Ministère de la Culture: Vocabulaire des domaines d'action ou objets des entités productrices d'archives", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/f14e8183-5885-46d6-8fc9-17ebd8f3c27e',
        ],
        'valuesuggestall:mc:2012b973-ddb2-4540-a775-9157c3c1d7fd' => [
            'label' => "Ministère de la Culture: Vocabulaire pour les techniques photographiques", // @translate
            'scheme' => 'http://data.culture.fr/thesaurus/resource/ark:/67717/2012b973-ddb2-4540-a775-9157c3c1d7fd',
        ],
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
