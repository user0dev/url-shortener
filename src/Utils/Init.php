<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.03.17
 * Time: 12:45
 */

namespace User0dev\UrlShortener\Utils;


class Init
{
    private $config;

    public function __construct()
    {
        include_once __DIR__ . "/../config.php";
        $this->config = CONFIG;
    }

    public function getConfig() {
        return $this->config;
    }
}