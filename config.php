<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 4:12
 */
return array(
    "db" => [
        "type" => "mysql",
        "host" => "localhost",
        "dbname" => "url_shortener",
        "user" => "root",
        "password" => "1234512345",
    ],
    "twig" => [
        "cacheDir" => __DIR__ . "/tmp",
        "templatesDir" => __DIR__ . "/src/Templates",
        "debug" => true,
    ],

);