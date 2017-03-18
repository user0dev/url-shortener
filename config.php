<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 4:12
 */
const CONFIG = array(
	"db" => [
		"type" => "mysql",
		"host" => "localhost",
		"dbname" => "url_shortener",
		"user" => "url_shortener",
		"password" => "12345",
	],
	"twig" => [
		"cacheDir" => __DIR__ . "/tmp",
		"templatesDir" => __DIR__ . "/src/Templates",
		"debug" => true,
	],

);
