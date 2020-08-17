<?php


    return [
        'dbname' => $app['name'],
        'user' => $app['username'],
        'password' => $app['password'],
        'host' => $app['host'],
        'port' => $app['port'],
        'driver' => $app['driver'],
        'path' => __DIR__ . '/db.mysql',
    ];
