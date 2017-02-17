<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 15:05
 */

namespace User0dev\UrlShortener\Utils;


abstract class Validator
{
    static public function shortUrlValidation($shortUrl)
    {
        return true;
    }
    static public function longUrlSanitize($longUrl)
    {
        return $longUrl;
    }
}