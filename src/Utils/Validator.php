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
        return ConvertIntSymb::isAllowedStr($shortUrl);
    }

    static public function longUrlValidation($longUrl)
    {
        return filter_var($longUrl, FILTER_VALIDATE_URL) != "";
    }

    static public function stringSanitize($string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_BACKTICK);
    }
}