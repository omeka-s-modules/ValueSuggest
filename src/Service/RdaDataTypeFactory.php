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
            'url' => 'https://www.rdaregistry.info/jsonld/termList/AspectRatio.jsonld',
        ],
        'valuesuggestall:rda:bookFormat' => [
            'label' => 'RDA: Bibliographic Format', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/bookFormat.jsonld',
        ],
        'valuesuggestall:rda:broadcastStand' => [
            'label' => 'RDA: Broadcast Standard', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/broadcastStand.jsonld',
        ],
        'valuesuggestall:rda:RDACarrierEU' => [
            'label' => 'RDA: Carrier Extent Unit', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDACarrierEU.jsonld',
        ],
        'valuesuggestall:rda:RDACarrierType' => [
            'label' => 'RDA: Carrier Type', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDACarrierType.jsonld',
        ],
        'valuesuggestall:rda:RDACartoDT' => [
            'label' => 'RDA: Cartographic Data Type', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDACartoDT.jsonld',
        ],
        'valuesuggestall:rda:RDACollectionAccrualMethod' => [
            'label' => 'RDA: Collection Accrual Method', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDACollectionAccrualMethod.jsonld',
        ],
        'valuesuggestall:rda:RDACollectionAccrualPolicy' => [
            'label' => 'RDA: Collection Accrual Policy', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDACollectionAccrualPolicy.jsonld',
        ],
        'valuesuggestall:rda:RDAColourContent' => [
            'label' => 'RDA: Colour Content', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAColourContent.jsonld',
        ],
        'valuesuggestall:rda:configPlayback' => [
            'label' => 'RDA: Configuration of Playback Channels', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/configPlayback.jsonld',
        ],
        'valuesuggestall:rda:RDAContentType' => [
            'label' => 'RDA: Content Type', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAContentType.jsonld',
        ],
        'valuesuggestall:rda:RDAExtensionPlan' => [
            'label' => 'RDA: Extension Plan', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAExtensionPlan.jsonld',
        ],
        'valuesuggestall:rda:CollTitle' => [
            'label' => 'RDA: Conventional Collective Title', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/CollTitle.jsonld',
        ],
        'valuesuggestall:rda:fileType' => [
            'label' => 'RDA: File Type', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/fileType.jsonld',
        ],
        'valuesuggestall:rda:fontSize' => [
            'label' => 'RDA: Font Size', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/fontSize.jsonld',
        ],
        'valuesuggestall:rda:MusNotation' => [
            'label' => 'RDA: Form of Musical Notation', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/MusNotation.jsonld',
        ],
        'valuesuggestall:rda:noteMove' => [
            'label' => 'RDA: Form of Notated Movement', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/noteMove.jsonld',
        ],
        'valuesuggestall:rda:TacNotation' => [
            'label' => 'RDA: Form of Tactile Notation', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/TacNotation.jsonld',
        ],
        'valuesuggestall:rda:formatNoteMus' => [
            'label' => 'RDA: Format of Notated Music', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/formatNoteMus.jsonld',
        ],
        'valuesuggestall:rda:frequency' => [
            'label' => 'RDA: Frequency', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/frequency.jsonld',
        ],
        'valuesuggestall:rda:RDAGeneration' => [
            'label' => 'RDA: Generation', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAGeneration.jsonld',
        ],
        'valuesuggestall:rda:groovePitch' => [
            'label' => 'RDA: Groove Pitch of an Analog Cylinder', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/groovePitch.jsonld',
        ],
        'valuesuggestall:rda:grooveWidth' => [
            'label' => 'RDA: Groove Width of an Analog Disc', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/grooveWidth.jsonld',
        ],
        'valuesuggestall:rda:IllusContent' => [
            'label' => 'RDA: Illustrative Content', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/IllusContent.jsonld',
        ],
        'valuesuggestall:rda:RDAInteractivityMode' => [
            'label' => 'RDA: Interactivity Mode', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAInteractivityMode.jsonld',
        ],
        'valuesuggestall:rda:layout' => [
            'label' => 'RDA: Layout', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/layout.jsonld',
        ],
        'valuesuggestall:rda:RDALinkedDataWork' => [
            'label' => 'RDA: Linked Data Work', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDALinkedDataWork.jsonld',
        ],
        'valuesuggestall:rda:RDAMaterial' => [
            'label' => 'RDA: Material', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAMaterial.jsonld',
        ],
        'valuesuggestall:rda:RDAMediaType' => [
            'label' => 'RDA: Media Type', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAMediaType.jsonld',
        ],
        'valuesuggestall:rda:ModeIssue' => [
            'label' => 'RDA: Mode of Issuance', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/ModeIssue.jsonld',
        ],
        'valuesuggestall:rda:RDAPolarity' => [
            'label' => 'RDA: Polarity', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAPolarity.jsonld',
        ],
        'valuesuggestall:rda:presFormat' => [
            'label' => 'RDA: Presentation Format', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/presFormat.jsonld',
        ],
        'valuesuggestall:rda:RDAproductionMethod' => [
            'label' => 'RDA: Production Method', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAproductionMethod.jsonld',
        ],
        'valuesuggestall:rda:recMedium' => [
            'label' => 'RDA: Recording Medium', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/recMedium.jsonld',
        ],
        'valuesuggestall:rda:RDARecordingMethods' => [
            'label' => 'RDA: Recording Methods', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDARecordingMethods.jsonld',
        ],
        'valuesuggestall:rda:RDARecordingSources' => [
            'label' => 'RDA: Recording Sources', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDARecordingSources.jsonld',
        ],
        'valuesuggestall:rda:RDAReductionRatio' => [
            'label' => 'RDA: Reduction Ratio Designation', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAReductionRatio.jsonld',
        ],
        'valuesuggestall:rda:RDARegionalEncoding' => [
            'label' => 'RDA: Regional Encoding', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDARegionalEncoding.jsonld',
        ],
        'valuesuggestall:rda:scale' => [
            'label' => 'RDA: Scale Designation', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/scale.jsonld',
        ],
        'valuesuggestall:rda:soundCont' => [
            'label' => 'RDA: Sound Content', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/soundCont.jsonld',
        ],
        'valuesuggestall:rda:specPlayback' => [
            'label' => 'RDA: Special Playback Characteristics', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/specPlayback.jsonld',
        ],
        'valuesuggestall:rda:statIdentification' => [
            'label' => 'RDA: Status of Identification', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/statIdentification.jsonld',
        ],
        'valuesuggestall:rda:RDATerms' => [
            'label' => 'RDA: Terms', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDATerms.jsonld',
        ],
        'valuesuggestall:rda:trackConfig' => [
            'label' => 'RDA: Track Configuration', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/trackConfig.jsonld',
        ],
        'valuesuggestall:rda:RDATypeOfBinding' => [
            'label' => 'RDA: Type Of Binding', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDATypeOfBinding.jsonld',
        ],
        'valuesuggestall:rda:typeRec' => [
            'label' => 'RDA: Type of Recording', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/typeRec.jsonld',
        ],
        'valuesuggestall:rda:RDAUnitOfTime' => [
            'label' => 'RDA: Unit of Time', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDAUnitOfTime.jsonld',
        ],
        'valuesuggestall:rda:RDATasks' => [
            'label' => 'RDA: User Tasks', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/RDATasks.jsonld',
        ],
        'valuesuggestall:rda:videoFormat' => [
            'label' => 'RDA: Video Format', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/videoFormat.jsonld',
        ],
        'valuesuggestall:rda:gender' => [
            'label' => 'RDA:  Gender', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/gender.jsonld',
        ],
        'valuesuggestall:rda:rofch' => [
            'label' => 'RDA: Character', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofch.jsonld',
        ],
        'valuesuggestall:rda:rofem' => [
            'label' => 'RDA: Extension Mode', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofem.jsonld',
        ],
        'valuesuggestall:rda:rofer' => [
            'label' => 'RDA: Extension Requirement', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofer.jsonld',
        ],
        'valuesuggestall:rda:rofet' => [
            'label' => 'RDA: Extension Termination', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofet.jsonld',
        ],
        'valuesuggestall:rda:rofhf' => [
            'label' => 'RDA: Housing Format', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofhf.jsonld',
        ],
        'valuesuggestall:rda:rofid' => [
            'label' => 'RDA: Image Dimensionality', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofid.jsonld',
        ],
        'valuesuggestall:rda:rofim' => [
            'label' => 'RDA: Image Movement', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofim.jsonld',
        ],
        'valuesuggestall:rda:rofin' => [
            'label' => 'RDA: Interaction', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofin.jsonld',
        ],
        'valuesuggestall:rda:rofit' => [
            'label' => 'RDA: Intermediation Tool', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofit.jsonld',
        ],
        'valuesuggestall:rda:rofrm' => [
            'label' => 'RDA: Revision Mode', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofrm.jsonld',
        ],
        'valuesuggestall:rda:rofrr' => [
            'label' => 'RDA: Revision Requirement', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofrr.jsonld',
        ],
        'valuesuggestall:rda:rofrt' => [
            'label' => 'RDA: Revision Termination', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofrt.jsonld',
        ],
        'valuesuggestall:rda:rofsm' => [
            'label' => 'RDA: Sensory Mode', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofsm.jsonld',
        ],
        'valuesuggestall:rda:rofsf' => [
            'label' => 'RDA: Storage Medium Format', // @translate
            'url' => 'https://www.rdaregistry.info/jsonld/termList/rofsf.jsonld',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, ?array $options = null)
    {
        $dataType = new Rda($services);
        $dataType->setRdaName($requestedName);
        $dataType->setRdaLabel($this->types[$requestedName]['label']);
        $dataType->setRdaUrl($this->types[$requestedName]['url']);
        return $dataType;
    }
}
