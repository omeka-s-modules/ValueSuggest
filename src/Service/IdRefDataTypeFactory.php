<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\IdRef\IdRef;
use Zend\ServiceManager\Factory\FactoryInterface;

class IdRefDataTypeFactory implements FactoryInterface
{
    // @url http://documentation.abes.fr/aideidrefdeveloppeur/index.html#presentation
    // Tri par pertinence par défaut.
    protected $types = [
        'valuesuggest:idref:all' => [
            'label' => 'IdRef: All', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=0&rows=50&indent=on&fl=id,ppn_z,affcourt_r&q=all:',
        ],
        'valuesuggest:idref:person' => [
            'label' => 'IdRef: Person names', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=persname_t:',
        ],
        'valuesuggest:idref:corporation' => [
            'label' => 'IdRef: Collectivities', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=corpname_t:',
        ],
        'valuesuggest:idref:conference' => [
            'label' => 'IdRef: Conferences', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=conference_t:',
        ],
        'valuesuggest:idref:subject' => [
            'label' => 'IdRef: Subjects', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=subjectheading_t:',
        ],
        'valuesuggest:idref:rameau' => [
            'label' => 'IdRef: Subjects Rameau', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=recordtype_z:r AND subjectheading_t:',
        ],
        'valuesuggest:idref:fmesh' => [
            'label' => 'IdRef: Subjects F-MeSH', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=recordtype_z:t AND subjectheading_t:',
        ],
        'valuesuggest:idref:geo' => [
            'label' => 'IdRef: Geography', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=geogname_t:',
        ],
        'valuesuggest:idref:family' => [
            'label' => 'IdRef: Family names', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=famname_t:',
        ],
        'valuesuggest:idref:title' => [
            'label' => 'IdRef: Uniform titles', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=uniformtitle_t:',
        ],
        'valuesuggest:idref:authorTitle' => [
            'label' => 'IdRef: Authors-Titles', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=nametitle_t:',
        ],
        'valuesuggest:idref:trademark' => [
            'label' => 'IdRef: Trademarks', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=trademark_t:',
        ],
        'valuesuggest:idref:ppn' => [
            'label' => 'IdRef: PPN id', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=ppn_z:',
        ],
        'valuesuggest:idref:library' => [
            'label' => 'IdRef: Library registry (RCR)', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_r&q=rcr_t:',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new IdRef($services);
        return $dataType
            ->setIdrefName($requestedName)
            ->setIdrefLabel($this->types[$requestedName]['label'])
            ->setIdrefUrl($this->types[$requestedName]['url']);
    }
}
