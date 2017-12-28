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
	public static function shortUrlValidation(string $shortUrl): bool
	{
		return ConvertIntSymb::isAllowedStr($shortUrl);
	}

	public static function longUrlValidation(string $longUrl): bool
	{
		return filter_var($longUrl, FILTER_VALIDATE_URL) != "";
	}

	public static function stringSanitize(string $string): string
	{
		return filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_BACKTICK);
	}
}