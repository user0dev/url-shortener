<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 13:29
 */

namespace User0dev\UrlShortener\Utils;


abstract class ServerHelper
{
	public static function location($location)
	{
		header("Location: $location");
		exit();
	}

	public static function notFound($text = "Not found")
	{
		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
		exit($text);
	}

	public static function internalError($text = "Internal Server Error")
	{
		header($_SERVER["SERVER_PROTOCOL"] . "500 Internal Server Error");
		exit($text);
	}

	public static function badRequest($text = "Bad Request")
	{
		header($_SERVER["SERVER_PROTOCOL"] . "400 Bad Request");
		exit($text);
	}

	public static function addAddressPart($path) {
		return $_SERVER["HTTP_HOST"] . "/$path";
	}
}