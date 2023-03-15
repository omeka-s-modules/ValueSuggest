<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use ValueSuggest\DataType\NdeTerms\NdeTerms;

/*
* @todo implement or remove @translate tags
*/

class NdeTermsDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggest:ndeterms:aatm' => [
            'label' => 'NDE: Art & Architecture Thesaurus - materialen', // @translate
            'source' => 'http://vocab.getty.edu/aat/sparql/materials',
        ],
        'valuesuggest:ndeterms:aatpt' => [
            'label' => 'NDE: Art & Architecture Thesaurus - processen en technieken', // @translate
            'source' => 'http://vocab.getty.edu/aat/sparql/processes-and-techniques',
        ],
        'valuesuggest:ndeterms:aatsp' => [
            'label' => 'NDE: Art & Architecture Thesaurus - stijlen en periodes', // @translate
            'source' => 'http://vocab.getty.edu/aat/sparql/styles-and-periods',
        ],
        'valuesuggest:ndeterms:abr' => [
            'label' => 'NDE: Archeologisch Basisregister', // @translate
            'source' => 'https://data.cultureelerfgoed.nl/PoolParty/sparql/term/id/abr',
        ],
        'valuesuggest:ndeterms:adamlink' => [
            'label' => 'NDE: Adamlink: straten in Amsterdam', // @translate
            'source' => 'https://druid.datalegend.net/AdamNet/Geography/sparql#streets',
        ],
        'valuesuggest:ndeterms:btt' => [
            'label' => 'NDE: Brinkman trefwoordenthesaurus', // @translate
            'source' => 'http://data.bibliotheken.nl/thes/brinkman/sparql',
        ],
        'valuesuggest:ndeterms:cht' => [
            'label' => 'NDE: Cultuurhistorische Thesaurus', // @translate
            'source' => 'https://data.cultureelerfgoed.nl/PoolParty/sparql/term/id/cht',
        ],
        'valuesuggest:ndeterms:chtm' => [
            'label' => 'NDE: Cultuurhistorische Thesaurus - Materialen', // @translate
            'source' => 'https://data.cultureelerfgoed.nl/PoolParty/sparql/term/id/cht/materials',
        ],
        'valuesuggest:ndeterms:chtsp' => [
            'label' => 'NDE: Cultuurhistorische Thesaurus - Stijlen en periodes', // @translate
            'source' => 'https://data.cultureelerfgoed.nl/PoolParty/sparql/term/id/cht/styles-and-periods',
        ],
        'valuesuggest:ndeterms:eurovoc' => [
            'label' => 'NDE: EuroVoc - thesaurus van de Europese Unie', // @translate
            'source' => 'http://publications.europa.eu/webapi/rdf/sparql#eurovoc',
        ],
        'valuesuggest:ndeterms:geonames' => [
            'label' => 'NDE: GeoNames: geografische namen in Nederland, België en Duitsland', // @translate
            'source' => 'https://demo.netwerkdigitaalerfgoed.nl/geonames',
        ],
        'valuesuggest:ndeterms:gtm' => [
            'label' => 'NDE: Goudse straten', // @translate
            'source' => 'https://www.goudatijdmachine.nl/id/straten#streets',
        ],
        'valuesuggest:ndeterms:gtaagen' => [
            'label' => 'NDE: GTAA: genres', // @translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0028',
        ],
        'valuesuggest:ndeterms:gtaaond' => [
            'label' => 'NDE: GTAA: onderwerpen', // @translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0031',
        ],
        'valuesuggest:ndeterms:homosaurus' => [
            'label' => 'NDE: Homosaurus', // @translate
            'source' => 'https://data.ihlia.nl/PoolParty/sparql/homosaurus',
        ],
        'valuesuggest:ndeterms:iconclass' => [
            'label' => 'NDE: Iconclass', // @translate
            'source' => 'https://iconclass.org/sparql',
        ],
        'valuesuggest:ndeterms:ied' => [
            'label' => 'NDE: Indisch Erfgoed Thesaurus', // @translate
            'source' => 'https://digitaalerfgoed.poolparty.biz/PoolParty/sparql/ied',
        ],
        'valuesuggest:ndeterms:muzgs' => [
            'label' => 'NDE: Muziek: genres en stijlen', // @translate
            'source' => 'https://data.muziekweb.nl/MuziekwebOrganization/Muziekweb/sparql/Muziekweb#mw-genresstijlen',
        ],
        'valuesuggest:ndeterms:muzpp' => [
            'label' => 'NDE: Muziek: personen en groepen', // @translate
            'source' => 'https://data.muziekweb.nl/MuziekwebOrganization/Muziekweb/sparql/Muziekweb#mw-personengroepen',
        ],
        'valuesuggest:ndeterms:muzsch' => [
            'label' => 'NDE: Muziekschatten: onderwerpen', // @translate
            'source' => 'https://data.muziekschatten.nl/sparql/#onderwerpen',
        ],
        'valuesuggest:ndeterms:nta' => [
            'label' => 'NDE: Nederlandse Thesaurus van Auteursnamen', // @translate
            'source' => 'http://data.bibliotheken.nl/thesp/sparql',
        ],
        'valuesuggest:ndeterms:rkdartists' => [
            'label' => 'NDE: RKDartists', // @translate
            'source' => 'https://data.netwerkdigitaalerfgoed.nl/rkd/rkdartists/sparql',
        ],
        'valuesuggest:ndeterms:stcn' => [
            'label' => 'NDE: STCN: drukkers', // @translate
            'source' => 'http://data.bibliotheken.nl/thes/drukkers/sparql',
        ],
        'valuesuggest:ndeterms:tnmw' => [
            'label' => 'NDE: Thesaurus Nationaal Museum van Wereldculturen', // @translate
            'source' => 'https://data.netwerkdigitaalerfgoed.nl/NMVW/thesaurus/sparql',
        ],
        'valuesuggest:ndeterms:ttwn' => [
            'label' => 'NDE: Thesaurus Tweede Wereldoorlog Nederland', // @translate
            'source' => 'https://data.niod.nl/PoolParty/sparql/WO2_Thesaurus',
        ],
        'valuesuggest:ndeterms:wikiall' => [
            'label' => 'NDE: Wikidata: alle entiteiten', // @translate
            'source' => 'https://query.wikidata.org/sparql#entities-all',
        ],
        'valuesuggest:ndeterms:wikipers' => [
            'label' => 'NDE: Wikidata: personen', // @translate
            'source' => 'https://query.wikidata.org/sparql#entities-persons',
        ],
        'valuesuggest:ndeterms:wikiplacenlbe' => [
            'label' => 'NDE: Wikidata: plaatsen in Nederland en België', // @translate
            'source' => 'https://query.wikidata.org/sparql#entities-places',
        ],
        'valuesuggest:ndeterms:wikistrnl' => [
            'label' => 'NDE: Wikidata: straten in Nederland', // @translate
            'source' => 'https://query.wikidata.org/sparql#entities-streets',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new NdeTerms($services);
        $dataType->setNdeTermsName($requestedName);
        $dataType->setNdeTermsLabel($this->types[$requestedName]['label']);
        $dataType->setNdeTermsSource($this->types[$requestedName]['source']);
        return $dataType;
    }
}
