<?php

return [
    "language" => 'ru',
    "modules" => [
        "Akademiano\\Db\\Adapter",
        "Akademiano\\Operator",
        "Akademiano\\EntityOperator",
        "Akademiano\\UserEO",
        "Akademiano\\Acl",
        "Akademiano\\UUID",
        "Akademiano\\UUID",
        "Akademiano\\EntityOperator\\Ext",
        "Datamapper\\Content\\Reception\\Meeting",
        "Akademiano\\Menu",
    ],
    "acl" => [
        "adapter" => "Akademiano\\Acl\\Adapter\\RegisteredAdapter"
    ],
    "view" => [
        'options' => [
            'cache' => true,
            'debug' => false,
        ],
        'theme' => 'apraksin_1',
        'adminTheme' => 'default',
    ]
];
