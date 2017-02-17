<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 13:29
 */

namespace User0dev\UrlShortener\Utils;


abstract class SendHeader
{
    static public function location($location)
    {
        header("Location: $location");
        exit();
    }
    static public function pageNotFound($text = "") {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        if (!$text) {
            $text = "Page not found";
        }
        exit($text);
    }
}