<?php
return [
    'entityOperator' => [
        'workers' => [
            'tablesIdsWorker' => [
                'configStorage' => [
                    'Akademiano\\Config\\Permanent\\PermanentStorageFile' => [
                        'file' => '/var/www/reception.test/src/config/auto.config.php',
                    ],
                ],
            ],
            'entitiesWorker' => [
                'tableId' => 1,
            ],
            'namedEntitiesWorker' => [
                'tableId' => 2,
            ],
            'contentEntitiesWorker' => [
                'tableId' => 3,
            ],
            'groupsWorker' => [
                'tableId' => 4,
            ],
            'usersWorker' => [
                'tableId' => 5,
            ],
            'relationsWorker' => [
                'tableId' => 6,
            ],
            'receptionMeetingTypeWorker' => [
                'tableId' => 7,
            ],
            'receptionMeetingWorker' => [
                'tableId' => 8,
            ],
            'receptionMeetingCapasityWorker' => [
                'tableId' => 9,
            ],
        ],
    ],
];
