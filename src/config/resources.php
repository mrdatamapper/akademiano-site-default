<?php
return [
    'logger' => function (\Akademiano\DI\Container $c) {
        $logger = new \Monolog\Logger('registroid');
        $logger->pushHandler(new \Monolog\Handler\StreamHandler('php://stderr', \Monolog\Logger::ERROR));
        return $logger;
    }
];

