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
        'valuesuggest:ndeterms:aHR0cHM6Ly9kcnVpZC5kYXRhbGVnZW5kLm5ldC9BZGFtTmV0L0dlb2dyYXBoeS9zcGFycWwjc3RyZWV0cw==' => [
            'label' => 'NDE: Adamlink: straten in Amsterdam', //@translate
            'source' => 'https://druid.datalegend.net/AdamNet/Geography/sparql#streets',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmN1bHR1cmVlbGVyZmdvZWQubmwvUG9vbFBhcnR5L3NwYXJxbC90ZXJtL2lkL2Ficg==' => [
            'label' => 'NDE: Archeologisch Basisregister', //@translate
            'source' => 'https://data.cultureelerfgoed.nl/PoolParty/sparql/term/id/abr',
        ],
        'valuesuggest:ndeterms:aHR0cDovL3ZvY2FiLmdldHR5LmVkdS9hYXQvc3BhcnFs' => [
            'label' => 'NDE: Art & Architecture Thesaurus', //@translate
            'source' => 'http://vocab.getty.edu/aat/sparql',
        ],
        'valuesuggest:ndeterms:aHR0cDovL2RhdGEuYmlibGlvdGhla2VuLm5sL3RoZXMvYnJpbmttYW4vc3BhcnFs' => [
            'label' => 'NDE: Brinkman trefwoordenthesaurus', //@translate
            'source' => 'http://data.bibliotheken.nl/thes/brinkman/sparql',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmN1bHR1cmVlbGVyZmdvZWQubmwvUG9vbFBhcnR5L3NwYXJxbC90ZXJtL2lkL2NodA==' => [
            'label' => 'NDE: Cultuurhistorische Thesaurus', //@translate
            'source' => 'https://data.cultureelerfgoed.nl/PoolParty/sparql/term/id/cht',
        ],
        'valuesuggest:ndeterms:aHR0cDovL3B1YmxpY2F0aW9ucy5ldXJvcGEuZXUvd2ViYXBpL3JkZi9zcGFycWwjZXVyb3ZvYw==' => [
            'label' => 'NDE: EuroVoc - thesaurus van de Europese Unie', //@translate
            'source' => 'http://publications.europa.eu/webapi/rdf/sparql#eurovoc',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmJlZWxkZW5nZWx1aWQubmwvaWQvZGF0YWRvd25sb2FkLzAwMjc=' => [
            'label' => 'NDE: GTAA: classificatie', //@translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0027',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmJlZWxkZW5nZWx1aWQubmwvaWQvZGF0YWRvd25sb2FkLzAwMjg=' => [
            'label' => 'NDE: GTAA: genres', //@translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0028',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmJlZWxkZW5nZWx1aWQubmwvaWQvZGF0YWRvd25sb2FkLzAwMjk=' => [
            'label' => 'NDE: GTAA: geografische namen', //@translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0029',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmJlZWxkZW5nZWx1aWQubmwvaWQvZGF0YWRvd25sb2FkLzAwMzA=' => [
            'label' => 'NDE: GTAA: namen', //@translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0030',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmJlZWxkZW5nZWx1aWQubmwvaWQvZGF0YWRvd25sb2FkLzAwMzE=' => [
            'label' => 'NDE: GTAA: onderwerpen', //@translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0031',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmJlZWxkZW5nZWx1aWQubmwvaWQvZGF0YWRvd25sb2FkLzAwMzI=' => [
            'label' => 'NDE: GTAA: onderwerpen beeld-geluid', //@translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0032',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLmJlZWxkZW5nZWx1aWQubmwvaWQvZGF0YWRvd25sb2FkLzAwMjY=' => [
            'label' => 'NDE: GTAA: persoonsnamen', //@translate
            'source' => 'https://data.beeldengeluid.nl/id/datadownload/0026',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLm11emlla3dlYi5ubC9NdXppZWt3ZWJPcmdhbml6YXRpb24vTXV6aWVrd2ViL3NwYXJxbC9NdXppZWt3ZWIjbXctZ2VucmVzc3Rpamxlbg==' => [
            'label' => 'NDE: Muziek: genres en stijlen', //@translate
            'source' => 'https://data.muziekweb.nl/MuziekwebOrganization/Muziekweb/sparql/Muziekweb#mw-genresstijlen',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLm11emlla3dlYi5ubC9NdXppZWt3ZWJPcmdhbml6YXRpb24vTXV6aWVrd2ViL3NwYXJxbC9NdXppZWt3ZWIjbXctcGVyc29uZW5ncm9lcGVu' => [
            'label' => 'NDE: Muziek: personen en groepen', //@translate
            'source' => 'https://data.muziekweb.nl/MuziekwebOrganization/Muziekweb/sparql/Muziekweb#mw-personengroepen',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLm11emlla3NjaGF0dGVuLm5sL3NwYXJxbC8jb25kZXJ3ZXJwZW4=' => [
            'label' => 'NDE: Muziekschatten: onderwerpen', //@translate
            'source' => 'https://data.muziekschatten.nl/sparql/#onderwerpen',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLm11emlla3NjaGF0dGVuLm5sL3NwYXJxbC8jcGVyc29uZW4=' => [
            'label' => 'NDE: Muziekschatten: personen', //@translate
            'source' => 'https://data.muziekschatten.nl/sparql/#personen',
        ],
        'valuesuggest:ndeterms:aHR0cDovL2RhdGEuYmlibGlvdGhla2VuLm5sL3RoZXNwL3NwYXJxbA==' => [
            'label' => 'NDE: Nederlandse Thesaurus van Auteursnamen', //@translate
            'source' => 'http://data.bibliotheken.nl/thesp/sparql',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLm5ldHdlcmtkaWdpdGFhbGVyZmdvZWQubmwvcmtkL3JrZGFydGlzdHMvc3BhcnFs' => [
            'label' => 'NDE: RKDartists', //@translate
            'source' => 'https://data.netwerkdigitaalerfgoed.nl/rkd/rkdartists/sparql',
        ],
        'valuesuggest:ndeterms:aHR0cDovL2RhdGEuYmlibGlvdGhla2VuLm5sL3RoZXMvZHJ1a2tlcnMvc3BhcnFs' => [
            'label' => 'NDE: STCN: drukkers', //@translate
            'source' => 'http://data.bibliotheken.nl/thes/drukkers/sparql',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLm5ldHdlcmtkaWdpdGFhbGVyZmdvZWQubmwvTk1WVy90aGVzYXVydXMvc3BhcnFs' => [
            'label' => 'NDE: Thesaurus Nationaal Museum van Wereldculturen', //@translate
            'source' => 'https://data.netwerkdigitaalerfgoed.nl/NMVW/thesaurus/sparql',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9xdWVyeS53aWtpZGF0YS5vcmcvc3BhcnFsI2VudGl0aWVzLWFsbA==' => [
            'label' => 'NDE: Wikidata: alle entiteiten', //@translate
            'source' => 'https://query.wikidata.org/sparql#entities-all',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9xdWVyeS53aWtpZGF0YS5vcmcvc3BhcnFsI2VudGl0aWVzLXBlcnNvbnM=' => [
            'label' => 'NDE: Wikidata: personen', //@translate
            'source' => 'https://query.wikidata.org/sparql#entities-persons',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9xdWVyeS53aWtpZGF0YS5vcmcvc3BhcnFsI2VudGl0aWVzLXBsYWNlcw==' => [
            'label' => 'NDE: Wikidata: plaatsen in Nederland en België', //@translate
            'source' => 'https://query.wikidata.org/sparql#entities-places',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9xdWVyeS53aWtpZGF0YS5vcmcvc3BhcnFsI2VudGl0aWVzLXN0cmVldHM=' => [
            'label' => 'NDE: Wikidata: straten in Nederland', //@translate
            'source' => 'https://query.wikidata.org/sparql#entities-streets',
        ],
        'valuesuggest:ndeterms:aHR0cHM6Ly9kYXRhLm5pb2QubmwvUG9vbFBhcnR5L3NwYXJxbC9XTzJfVGhlc2F1cnVz' => [
            'label' => 'NDE: WO2-thesaurus', //@translate
            'source' => 'https://data.niod.nl/PoolParty/sparql/WO2_Thesaurus',
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
