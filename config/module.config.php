<?php
return [
    'controllers' => [
        'factories' => [
            'ValueSuggest\Controller\Index' => 'ValueSuggest\Service\IndexControllerFactory',
        ],
    ],
    'data_types' => [
        'factories' => [
            'valuesuggest:lc:all' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:subjects' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:names' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:classification' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:childrensSubjects' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:genreForms' => 'ValueSuggest\Service\LcDataTypeFactory',
            'valuesuggest:lc:performanceMediums' => 'ValueSuggest\Service\LcDataTypeFactory',
            // @todo Add more LC data types
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
