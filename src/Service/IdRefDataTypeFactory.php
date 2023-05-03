<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\IdRef\IdRef;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IdRefDataTypeFactory implements FactoryInterface
{
    // @url http://documentation.abes.fr/aideidrefdeveloppeur/index.html#presentation
    // Tri par pertinence par défaut.
    protected $types = [
        'valuesuggest:idref:all' => [
            'label' => 'IdRef: All', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=0&rows=30&indent=on&fl=id,ppn_z,affcourt_r&q=all%3A',
        ],
        'valuesuggest:idref:person' => [
            'label' => 'IdRef: Person names', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=persname_t%3A',
        ],
        'valuesuggest:idref:corporation' => [
            'label' => 'IdRef: Collectivities', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=corpname_t%3A',
        ],
        'valuesuggest:idref:conference' => [
            'label' => 'IdRef: Conferences', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=conference_t%3A',
        ],
        'valuesuggest:idref:subject' => [
            'label' => 'IdRef: Subjects', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=subjectheading_t%3A',
        ],
        'valuesuggest:idref:rameau' => [
            'label' => 'IdRef: Subjects Rameau', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=recordtype_z%3Ar%20AND%20subjectheading_t%3A',
        ],
        'valuesuggest:idref:fmesh' => [
            'label' => 'IdRef: Subjects F-MeSH', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=recordtype_z%3At%20AND%20subjectheading_t%3A',
        ],
        'valuesuggest:idref:geo' => [
            'label' => 'IdRef: Geography', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=geogname_t%3A',
        ],
        'valuesuggest:idref:family' => [
            'label' => 'IdRef: Family names', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=famname_t%3A',
        ],
        'valuesuggest:idref:title' => [
            'label' => 'IdRef: Uniform titles', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=uniformtitle_t%3A',
        ],
        'valuesuggest:idref:authorTitle' => [
            'label' => 'IdRef: Authors-Titles', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=nametitle_t%3A',
        ],
        'valuesuggest:idref:trademark' => [
            'label' => 'IdRef: Trademarks', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=trademark_t%3A',
        ],
        'valuesuggest:idref:ppn' => [
            'label' => 'IdRef: PPN id', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_z&q=ppn_z%3A',
        ],
        'valuesuggest:idref:library' => [
            'label' => 'IdRef: Library registry (RCR)', // @translate
            'url' => 'https://www.idref.fr/Sru/Solr?wt=json&version=2.2&start=&rows=30&indent=on&fl=id,ppn_z,affcourt_r&q=rcr_t%3A',
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
