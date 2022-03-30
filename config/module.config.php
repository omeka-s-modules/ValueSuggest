<?php
namespace ValueSuggest;

return [
    'controllers' => [
        'factories' => [
            'ValueSuggest\Controller\Index' => Service\IndexControllerFactory::class,
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => sprintf('%s/../language', __DIR__),
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            sprintf('%s/../view', __DIR__),
        ],
    ],
    'data_types' => [
        'factories' => [

            /* Dublin Core */
            'valuesuggestall:dc:classes' => Service\DcDataTypeFactory::class,
            'valuesuggestall:dc:elements' => Service\DcDataTypeFactory::class,
            'valuesuggestall:dc:terms' => Service\DcDataTypeFactory::class,
            'valuesuggestall:dc:types' => Service\DcDataTypeFactory::class,

            /* Gemeinsame Normdatei (GND) */
            'valuesuggest:gnd:gnd' => Service\GndDataTypeFactory::class,

            /* Geonames */
            'valuesuggest:geonames:geonames' => Service\GeonamesDataTypeFactory::class,

            /* Getty */
            'valuesuggest:getty:aat' => Service\GettyDataTypeFactory::class,
            'valuesuggest:getty:tgn' => Service\GettyDataTypeFactory::class,
            'valuesuggest:getty:ulan' => Service\GettyDataTypeFactory::class,
            // @todo Add "The Cultural Objects Name Authority (CONA)" once it's
            // published (past due, fall 2015)

            /* Homosaurus */
            'valuesuggest:homosaurus:homosaurus' => Service\HomosaurusDataTypeFactory::class,

            /* IdRef */
            'valuesuggest:idref:all' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:person' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:corporation' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:conference' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:subject' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:rameau' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:fmesh' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:geo' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:family' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:title' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:authorTitle' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:trademark' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:ppn' => Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:library' => Service\IdRefDataTypeFactory::class,

            /* Library of Congress */
            'valuesuggest:lc:all' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:subjects' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:names' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:classification' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:childrensSubjects' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:genreForms' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:performanceMediums' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:demographicTerms' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:graphicMaterials' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:ethnographicTerms' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:organizations' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:relators' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:countries' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:geographicAreas' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:languages' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:iso6391' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:iso6392' => Service\LcDataTypeFactory::class,
            'valuesuggest:lc:iso6395' => Service\LcDataTypeFactory::class,
            // @todo Add more LC data types

            /* Network of Terms of the Dutch National Network for Digital Heritage */
            'valuesuggest:ndeterms:abr' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:btt' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:cht' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:gtaagen' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:gtaaond' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:muzgs' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:muzpp' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:muzsch' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:nta' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:rkdartists' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:tnmw' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:ttwn' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:wikiall' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:wikipers' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:wikiplacenlbe' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,
            'valuesuggest:ndeterms:wikistrnl' => \ValueSuggest\Service\NdeTermsDataTypeFactory::class,

            /* Nuovo Soggettario */
            'valuesuggest:ns:ThesCF5' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF6' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF7' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF1' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF2' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF8' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF15' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF3' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF4' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF9' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF12' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF13' => Service\NsDataTypeFactory::class,
            'valuesuggest:ns:ThesCF14' => Service\NsDataTypeFactory::class,

            /* OCLC */
            'valuesuggest:oclc:viaf' => Service\OclcDataTypeFactory::class,
            'valuesuggest:oclc:fast' => Service\OclcDataTypeFactory::class,

            /* Opentheso / Pactols */
            'valuesuggest:pactols:all' => Service\PactolsDataTypeFactory::class,
            'valuesuggest:pactols:sujets' => Service\PactolsDataTypeFactory::class,

            /* PeriodO */
            'valuesuggest:periodo:periodo' => Service\PeriodoDataTypeFactory::class,

            /* RDA */
            'valuesuggestall:rda:AspectRatio' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:bookFormat' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:broadcastStand' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDACarrierEU' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDACarrierType' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDACartoDT' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAColourContent' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:configPlayback' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAContentType' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:CollTitle' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:fileType' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:fontSize' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:MusNotation' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:noteMove' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:TacNotation' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:formatNoteMus' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:frequency' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAGeneration' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:groovePitch' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:grooveWidth' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:IllusContent' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:layout' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAMaterial' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAMediaType' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:ModeIssue' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAPolarity' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:presFormat' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAproductionMethod' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:recMedium' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAReductionRatio' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDARegionalEncoding' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:scale' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:soundCont' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:specPlayback' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:statIdentification' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDATerms' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:trackConfig' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:typeRec' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:videoFormat' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:gender' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofch' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofem' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofer' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofet' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofhf' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofid' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofim' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofin' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofit' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofrm' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofrr' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofrt' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofsm' => Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofsf' => Service\RdaDataTypeFactory::class,

            /* RightsStatements.org */
            'valuesuggestall:rightsstatements:rightsstatements' => Service\RightsStatementsDataTypeFactory::class,

            /* Tesauros-Diccionarios del patrimonio cultural de España */
            'valuesuggest:tesauros:bienesculturales' => Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:ceramica' => Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:contextosculturales' => Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:geografico' => Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:materias' => Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:mobiliario' => Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:numismatica' => Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:tecnicas' => Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:toponimiahistorica' => Service\TesaurosDataTypeFactory::class,

            /* UNESCO vocabularios */
            'valuesuggest:unesco:unescothes' => Service\UnescoDataTypeFactory::class,
            'valuesuggest:unesco:unesco6' => Service\UnescoDataTypeFactory::class,
            'valuesuggest:unesco:floridablanca' => Service\UnescoDataTypeFactory::class,

            /* Les vocabulaires du Ministère de la Culture */
            'valuesuggestall:mc:T262' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:01952848-4419-431e-8e81-419c1d46b30d' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T124' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T529' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T2' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T4' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T3' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T513' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T51' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T115' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T505' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T506' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T520' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T84' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T515' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T521' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T523' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T507' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T516' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T86' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T517' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T93' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T20' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T57' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T94' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:0404efce-2024-4694-bf80-eba4fc2b336c' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:98b3feb3-744b-4ba3-8381-18ca4a555a4c' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T532' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T59' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T61' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T69' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T96' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:Matiere' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T26' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:T10' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:51232822-adac-4a33-aa14-29e2c701a5ee' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:37684874-0820-402d-b53e-f8ab6b9ed8ba' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:f14e8183-5885-46d6-8fc9-17ebd8f3c27e' => Service\McDataTypeFactory::class,
            'valuesuggestall:mc:2012b973-ddb2-4540-a775-9157c3c1d7fd' => Service\McDataTypeFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'value-suggest' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/value-suggest',
                            'defaults' => [
                                '__NAMESPACE__' => 'ValueSuggest\Controller',
                                'controller' => 'Index',
                            ],
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'proxy' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/proxy',
                                    'defaults' => [
                                        'action' => 'proxy',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
