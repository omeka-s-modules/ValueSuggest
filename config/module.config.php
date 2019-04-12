<?php
return [
    'controllers' => [
        'factories' => [
            'ValueSuggest\Controller\Index' => 'ValueSuggest\Service\IndexControllerFactory',
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => OMEKA_PATH . '/modules/ValueSuggest/language',
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            OMEKA_PATH . '/modules/ValueSuggest/view',
        ],
    ],
    'data_types' => [
        'factories' => [
            /* Geonames */
            'valuesuggest:geonames:geonames' => 'ValueSuggest\Service\GeonamesDataTypeFactory',

            /* Getty */
            'valuesuggest:getty:aat' => 'ValueSuggest\Service\GettyDataTypeFactory',
            'valuesuggest:getty:tgn' => 'ValueSuggest\Service\GettyDataTypeFactory',
            'valuesuggest:getty:ulan' => 'ValueSuggest\Service\GettyDataTypeFactory',
            // @todo Add "The Cultural Objects Name Authority (CONA)" once it's
            // published (past due, fall 2015)

            /* Homosaurus */
            'valuesuggest:homosaurus:homosaurus' => 'ValueSuggest\Service\HomosaurusDataTypeFactory',

            /* Library of Congress */
            'valuesuggest:lc:all' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:subjects' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:names' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:classification' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:childrensSubjects' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:genreForms' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:performanceMediums' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:demographicTerms' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:graphicMaterials' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:ethnographicTerms' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:organizations' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:relators' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:countries' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:geographicAreas' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:languages' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:iso6391' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:iso6392' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:iso6395' => 'ValueSuggest\Service\LcDataTypeFactory',
            // @todo Add more LC data types

            /* OCLC */
            'valuesuggest:oclc:viaf' => 'ValueSuggest\Service\OclcDataTypeFactory',
            'valuesuggest:oclc:fast' => 'ValueSuggest\Service\OclcDataTypeFactory',

            /* PeriodO */
            'valuesuggest:periodo:periodo' => 'ValueSuggest\Service\PeriodoDataTypeFactory',

            /* RDA */
            'valuesuggestall:rda:AspectRatio' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:bookFormat' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:broadcastStand' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDACarrierEU' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDACarrierType' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDACartoDT' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDAColourContent' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:configPlayback' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDAContentType' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:CollTitle' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:fileType' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:fontSize' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:MusNotation' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:noteMove' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:TacNotation' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:formatNoteMus' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:frequency' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDAGeneration' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:groovePitch' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:grooveWidth' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:IllusContent' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:layout' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDAMaterial' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDAMediaType' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:ModeIssue' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDAPolarity' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:presFormat' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDAproductionMethod' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:recMedium' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDAReductionRatio' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDARegionalEncoding' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:scale' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:soundCont' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:specPlayback' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:statIdentification' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:RDATerms' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:trackConfig' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:typeRec' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:videoFormat' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:gender' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofch' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofem' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofer' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofet' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofhf' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofid' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofim' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofin' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofit' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofrm' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofrr' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofrt' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofsm' => 'ValueSuggest\Service\RdaDataTypeFactory',
            'valuesuggestall:rda:rofsf' => 'ValueSuggest\Service\RdaDataTypeFactory',

            /* Tesauros-Diccionarios del patrimonio cultural de España */
            'valuesuggest:tesauros:bienesculturales' => 'ValueSuggest\Service\TesaurosDataTypeFactory',
            'valuesuggest:tesauros:ceramica' => 'ValueSuggest\Service\TesaurosDataTypeFactory',
            'valuesuggest:tesauros:contextosculturales' => 'ValueSuggest\Service\TesaurosDataTypeFactory',
            'valuesuggest:tesauros:geografico' => 'ValueSuggest\Service\TesaurosDataTypeFactory',
            'valuesuggest:tesauros:materias' => 'ValueSuggest\Service\TesaurosDataTypeFactory',
            'valuesuggest:tesauros:mobiliario' => 'ValueSuggest\Service\TesaurosDataTypeFactory',
            'valuesuggest:tesauros:numismatica' => 'ValueSuggest\Service\TesaurosDataTypeFactory',
            'valuesuggest:tesauros:tecnicas' => 'ValueSuggest\Service\TesaurosDataTypeFactory',
            'valuesuggest:tesauros:toponimiahistorica' => 'ValueSuggest\Service\TesaurosDataTypeFactory',

            /* UNESCO vocabularios */
            'valuesuggest:unesco:unescothes' => 'ValueSuggest\Service\UnescoDataTypeFactory',
            'valuesuggest:unesco:unesco6' => 'ValueSuggest\Service\UnescoDataTypeFactory',
            'valuesuggest:unesco:floridablanca' => 'ValueSuggest\Service\UnescoDataTypeFactory',
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
