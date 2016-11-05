<?php
return [
    'controllers' => [
        'factories' => [
            'ValueSuggest\Controller\Index' => 'ValueSuggest\Service\IndexControllerFactory',
        ],
    ],
    'data_types' => [
        'factories' => [
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

            /* Getty */
            'valuesuggest:getty:aat' => 'ValueSuggest\Service\GettyDataTypeFactory',
            'valuesuggest:getty:tgn' => 'ValueSuggest\Service\GettyDataTypeFactory',
            'valuesuggest:getty:ulan' => 'ValueSuggest\Service\GettyDataTypeFactory',
            // @todo Add "The Cultural Objects Name Authority (CONA)" once it's
            // published (past due, fall 2015)
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
