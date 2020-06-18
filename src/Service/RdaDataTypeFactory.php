<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Rda\Rda;
use Laminas\ServiceManager\Factory\FactoryInterface;

class RdaDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggestall:rda:AspectRatio' => [
            'label' => 'RDA: Aspect Ratio Designation', // @translate
            'url' => 'http://rdaregistry.info/termList/AspectRatio.jsonld',
        ],
        'valuesuggestall:rda:bookFormat' => [
            'label' => 'RDA: Bibliographic Format', // @translate
            'url' => 'http://rdaregistry.info/termList/bookFormat.jsonld',
        ],
        'valuesuggestall:rda:broadcastStand' => [
            'label' => 'RDA: Broadcast Standard', // @translate
            'url' => 'http://rdaregistry.info/termList/broadcastStand.jsonld',
        ],
        'valuesuggestall:rda:RDACarrierEU' => [
            'label' => 'RDA: Carrier Extent Unit', // @translate
            'url' => 'http://rdaregistry.info/termList/RDACarrierEU.jsonld',
        ],
        'valuesuggestall:rda:RDACarrierType' => [
            'label' => 'RDA: Carrier Type', // @translate
            'url' => 'http://rdaregistry.info/termList/RDACarrierType.jsonld',
        ],
        'valuesuggestall:rda:RDACartoDT' => [
            'label' => 'RDA: Cartographic Data Type', // @translate
            'url' => 'http://rdaregistry.info/termList/RDACartoDT.jsonld',
        ],
        'valuesuggestall:rda:RDAColourContent' => [
            'label' => 'RDA: Colour Content', // @translate
            'url' => 'http://rdaregistry.info/termList/RDAColourContent.jsonld',
        ],
        'valuesuggestall:rda:configPlayback' => [
            'label' => 'RDA: Configuration of Playback Channels', // @translate
            'url' => 'http://rdaregistry.info/termList/configPlayback.jsonld',
        ],
        'valuesuggestall:rda:RDAContentType' => [
            'label' => 'RDA: Content Type', // @translate
            'url' => 'http://rdaregistry.info/termList/RDAContentType.jsonld',
        ],
        'valuesuggestall:rda:CollTitle' => [
            'label' => 'RDA: Conventional Collective Title', // @translate
            'url' => 'http://rdaregistry.info/termList/CollTitle.jsonld',
        ],
        'valuesuggestall:rda:fileType' => [
            'label' => 'RDA: File Type', // @translate
            'url' => 'http://rdaregistry.info/termList/fileType.jsonld',
        ],
        'valuesuggestall:rda:fontSize' => [
            'label' => 'RDA: Font Size', // @translate
            'url' => 'http://rdaregistry.info/termList/fontSize.jsonld',
        ],
        'valuesuggestall:rda:MusNotation' => [
            'label' => 'RDA: Form of Musical Notation', // @translate
            'url' => 'http://rdaregistry.info/termList/MusNotation.jsonld',
        ],
        'valuesuggestall:rda:noteMove' => [
            'label' => 'RDA: Form of Notated Movement', // @translate
            'url' => 'http://rdaregistry.info/termList/noteMove.jsonld',
        ],
        'valuesuggestall:rda:TacNotation' => [
            'label' => 'RDA: Form of Tactile Notation', // @translate
            'url' => 'http://rdaregistry.info/termList/TacNotation.jsonld',
        ],
        'valuesuggestall:rda:formatNoteMus' => [
            'label' => 'RDA: Format of Notated Music', // @translate
            'url' => 'http://rdaregistry.info/termList/formatNoteMus.jsonld',
        ],
        'valuesuggestall:rda:frequency' => [
            'label' => 'RDA: Frequency', // @translate
            'url' => 'http://rdaregistry.info/termList/frequency.jsonld',
        ],
        'valuesuggestall:rda:RDAGeneration' => [
            'label' => 'RDA: Generation', // @translate
            'url' => 'http://rdaregistry.info/termList/RDAGeneration.jsonld',
        ],
        'valuesuggestall:rda:groovePitch' => [
            'label' => 'RDA: Groove Pitch of an Analog Cylinder', // @translate
            'url' => 'http://rdaregistry.info/termList/groovePitch.jsonld',
        ],
        'valuesuggestall:rda:grooveWidth' => [
            'label' => 'RDA: Groove Width of an Analog Disc', // @translate
            'url' => 'http://rdaregistry.info/termList/grooveWidth.jsonld',
        ],
        'valuesuggestall:rda:IllusContent' => [
            'label' => 'RDA: Illustrative Content', // @translate
            'url' => 'http://rdaregistry.info/termList/IllusContent.jsonld',
        ],
        'valuesuggestall:rda:layout' => [
            'label' => 'RDA:  Layout', // @translate
            'url' => 'http://rdaregistry.info/termList/layout.jsonld',
        ],
        'valuesuggestall:rda:RDAMaterial' => [
            'label' => 'RDA: Material', // @translate
            'url' => 'http://rdaregistry.info/termList/RDAMaterial.jsonld',
        ],
        'valuesuggestall:rda:RDAMediaType' => [
            'label' => 'RDA: Media Type', // @translate
            'url' => 'http://rdaregistry.info/termList/RDAMediaType.jsonld',
        ],
        'valuesuggestall:rda:ModeIssue' => [
            'label' => 'RDA: Mode of Issuance', // @translate
            'url' => 'http://rdaregistry.info/termList/ModeIssue.jsonld',
        ],
        'valuesuggestall:rda:RDAPolarity' => [
            'label' => 'RDA: Polarity', // @translate
            'url' => 'http://rdaregistry.info/termList/RDAPolarity.jsonld',
        ],
        'valuesuggestall:rda:presFormat' => [
            'label' => 'RDA: Presentation Format', // @translate
            'url' => 'http://rdaregistry.info/termList/presFormat.jsonld',
        ],
        'valuesuggestall:rda:RDAproductionMethod' => [
            'label' => 'RDA: Production Method', // @translate
            'url' => 'http://rdaregistry.info/termList/RDAproductionMethod.jsonld',
        ],
        'valuesuggestall:rda:recMedium' => [
            'label' => 'RDA: Recording Medium', // @translate
            'url' => 'http://rdaregistry.info/termList/recMedium.jsonld',
        ],
        'valuesuggestall:rda:RDAReductionRatio' => [
            'label' => 'RDA: Reduction Ratio Designation', // @translate
            'url' => 'http://rdaregistry.info/termList/RDAReductionRatio.jsonld',
        ],
        'valuesuggestall:rda:RDARegionalEncoding' => [
            'label' => 'RDA: Regional Encoding', // @translate
            'url' => 'http://rdaregistry.info/termList/RDARegionalEncoding.jsonld',
        ],
        'valuesuggestall:rda:scale' => [
            'label' => 'RDA: Scale Designation', // @translate
            'url' => 'http://rdaregistry.info/termList/scale.jsonld',
        ],
        'valuesuggestall:rda:soundCont' => [
            'label' => 'RDA: Sound Content', // @translate
            'url' => 'http://rdaregistry.info/termList/soundCont.jsonld',
        ],
        'valuesuggestall:rda:specPlayback' => [
            'label' => 'RDA: Special Playback Characteristics', // @translate
            'url' => 'http://rdaregistry.info/termList/specPlayback.jsonld',
        ],
        'valuesuggestall:rda:statIdentification' => [
            'label' => 'RDA: Status of Identification', // @translate
            'url' => 'http://rdaregistry.info/termList/statIdentification.jsonld',
        ],
        'valuesuggestall:rda:RDATerms' => [
            'label' => 'RDA: Terms', // @translate
            'url' => 'http://rdaregistry.info/termList/RDATerms.jsonld',
        ],
        'valuesuggestall:rda:trackConfig' => [
            'label' => 'RDA: Track Configuration', // @translate
            'url' => 'http://rdaregistry.info/termList/trackConfig.jsonld',
        ],
        'valuesuggestall:rda:typeRec' => [
            'label' => 'RDA: Type of Recording', // @translate
            'url' => 'http://rdaregistry.info/termList/typeRec.jsonld',
        ],
        'valuesuggestall:rda:videoFormat' => [
            'label' => 'RDA: Video Format', // @translate
            'url' => 'http://rdaregistry.info/termList/videoFormat.jsonld',
        ],
        'valuesuggestall:rda:gender' => [
            'label' => 'RDA:  Gender', // @translate
            'url' => 'http://rdaregistry.info/termList/gender.jsonld',
        ],
        'valuesuggestall:rda:rofch' => [
            'label' => 'RDA: Character', // @translate
            'url' => 'http://rdaregistry.info/termList/rofch.jsonld',
        ],
        'valuesuggestall:rda:rofem' => [
            'label' => 'RDA: Extension Mode', // @translate
            'url' => 'http://rdaregistry.info/termList/rofem.jsonld',
        ],
        'valuesuggestall:rda:rofer' => [
            'label' => 'RDA: Extension Requirement', // @translate
            'url' => 'http://rdaregistry.info/termList/rofer.jsonld',
        ],
        'valuesuggestall:rda:rofet' => [
            'label' => 'RDA: Extension Termination', // @translate
            'url' => 'http://rdaregistry.info/termList/rofet.jsonld',
        ],
        'valuesuggestall:rda:rofhf' => [
            'label' => 'RDA: Housing Format', // @translate
            'url' => 'http://rdaregistry.info/termList/rofhf.jsonld',
        ],
        'valuesuggestall:rda:rofid' => [
            'label' => 'RDA: Image Dimensionality', // @translate
            'url' => 'http://rdaregistry.info/termList/rofid.jsonld',
        ],
        'valuesuggestall:rda:rofim' => [
            'label' => 'RDA: Image Movement', // @translate
            'url' => 'http://rdaregistry.info/termList/rofim.jsonld',
        ],
        'valuesuggestall:rda:rofin' => [
            'label' => 'RDA: Interaction', // @translate
            'url' => 'http://rdaregistry.info/termList/rofin.jsonld',
        ],
        'valuesuggestall:rda:rofit' => [
            'label' => 'RDA: Intermediation Tool', // @translate
            'url' => 'http://rdaregistry.info/termList/rofit.jsonld',
        ],
        'valuesuggestall:rda:rofrm' => [
            'label' => 'RDA: Revision Mode', // @translate
            'url' => 'http://rdaregistry.info/termList/rofrm.jsonld',
        ],
        'valuesuggestall:rda:rofrr' => [
            'label' => 'RDA: Revision Requirement', // @translate
            'url' => 'http://rdaregistry.info/termList/rofrr.jsonld',
        ],
        'valuesuggestall:rda:rofrt' => [
            'label' => 'RDA: Revision Termination', // @translate
            'url' => 'http://rdaregistry.info/termList/rofrt.jsonld',
        ],
        'valuesuggestall:rda:rofsm' => [
            'label' => 'RDA: Sensory Mode', // @translate
            'url' => 'http://rdaregistry.info/termList/rofsm.jsonld',
        ],
        'valuesuggestall:rda:rofsf' => [
            'label' => 'RDA: Storage Medium Format', // @translate
            'url' => 'http://rdaregistry.info/termList/rofsf.jsonld',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Rda($services);
        $dataType->setRdaName($requestedName);
        $dataType->setRdaLabel($this->types[$requestedName]['label']);
        $dataType->setRdaUrl($this->types[$requestedName]['url']);
        return $dataType;
    }
}
