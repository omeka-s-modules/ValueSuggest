<?php
return [
    'controllers' => [
        'factories' => [
            'ValueSuggest\Controller\Index' => \ValueSuggest\Service\IndexControllerFactory::class,
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
            'valuesuggest:geonames:geonames' => \ValueSuggest\Service\GeonamesDataTypeFactory::class,

            /* Getty */
            'valuesuggest:getty:aat' => \ValueSuggest\Service\GettyDataTypeFactory::class,
            'valuesuggest:getty:tgn' => \ValueSuggest\Service\GettyDataTypeFactory::class,
            'valuesuggest:getty:ulan' => \ValueSuggest\Service\GettyDataTypeFactory::class,
            // @todo Add "The Cultural Objects Name Authority (CONA)" once it's
            // published (past due, fall 2015)

            /* Homosaurus */
            'valuesuggest:homosaurus:homosaurus' => \ValueSuggest\Service\HomosaurusDataTypeFactory::class,

            /* IdRef */
            'valuesuggest:idref:all' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:person' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:corporation' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:conference' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:subject' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:rameau' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:fmesh' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:geo' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:family' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:title' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:authorTitle' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:trademark' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:ppn' => \ValueSuggest\Service\IdRefDataTypeFactory::class,
            'valuesuggest:idref:library' => \ValueSuggest\Service\IdRefDataTypeFactory::class,

            /* Library of Congress */
            'valuesuggest:lc:all' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:subjects' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:names' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:classification' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:childrensSubjects' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:genreForms' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:performanceMediums' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:demographicTerms' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:graphicMaterials' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:ethnographicTerms' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:organizations' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:relators' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:countries' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:geographicAreas' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:languages' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:iso6391' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:iso6392' => \ValueSuggest\Service\LcDataTypeFactory::class,
            'valuesuggest:lc:iso6395' => \ValueSuggest\Service\LcDataTypeFactory::class,
            // @todo Add more LC data types

            /* OCLC */
            'valuesuggest:oclc:viaf' => \ValueSuggest\Service\OclcDataTypeFactory::class,
            'valuesuggest:oclc:fast' => \ValueSuggest\Service\OclcDataTypeFactory::class,

            /* Opentheso / Pactols */
            'valuesuggest:pactols:all' => \ValueSuggest\Service\PactolsDataTypeFactory::class,
            'valuesuggest:pactols:sujets' => \ValueSuggest\Service\PactolsDataTypeFactory::class,

            /* PeriodO */
            'valuesuggest:periodo:periodo' => \ValueSuggest\Service\PeriodoDataTypeFactory::class,

            /* RDA */
            'valuesuggestall:rda:AspectRatio' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:bookFormat' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:broadcastStand' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDACarrierEU' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDACarrierType' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDACartoDT' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAColourContent' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:configPlayback' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAContentType' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:CollTitle' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:fileType' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:fontSize' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:MusNotation' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:noteMove' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:TacNotation' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:formatNoteMus' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:frequency' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAGeneration' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:groovePitch' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:grooveWidth' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:IllusContent' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:layout' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAMaterial' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAMediaType' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:ModeIssue' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAPolarity' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:presFormat' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAproductionMethod' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:recMedium' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDAReductionRatio' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDARegionalEncoding' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:scale' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:soundCont' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:specPlayback' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:statIdentification' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:RDATerms' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:trackConfig' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:typeRec' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:videoFormat' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:gender' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofch' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofem' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofer' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofet' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofhf' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofid' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofim' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofin' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofit' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofrm' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofrr' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofrt' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofsm' => \ValueSuggest\Service\RdaDataTypeFactory::class,
            'valuesuggestall:rda:rofsf' => \ValueSuggest\Service\RdaDataTypeFactory::class,

            /* Tesauros-Diccionarios del patrimonio cultural de España */
            'valuesuggest:tesauros:bienesculturales' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:ceramica' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:contextosculturales' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:geografico' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:materias' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:mobiliario' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:numismatica' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:tecnicas' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,
            'valuesuggest:tesauros:toponimiahistorica' => \ValueSuggest\Service\TesaurosDataTypeFactory::class,

            /* UNESCO vocabularios */
            'valuesuggest:unesco:unescothes' => \ValueSuggest\Service\UnescoDataTypeFactory::class,
            'valuesuggest:unesco:unesco6' => \ValueSuggest\Service\UnescoDataTypeFactory::class,
            'valuesuggest:unesco:floridablanca' => \ValueSuggest\Service\UnescoDataTypeFactory::class,
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
