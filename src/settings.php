<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        
        // BBDD Slave
        'slave' => [
            'host'   => '172.30.1.104',
            'user'   => 'motogp_2015',
            'pass'   => 'm0t0gp2015_',
            'dbname' => 'motogp_2015'
        ]
    ],
];