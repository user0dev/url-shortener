<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 13:29
 */

namespace User0dev\UrlShortener\Utils;


class ServerHelper
{
	public static function location(string $location): void
	{
		header("Location: $location");
		exit();
	}

	public static function notFound(string $text = "Not found"): void
	{
		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
		exit($text);
	}

	public static function internalError(string $text = "Internal Server Error"): void
	{
		header($_SERVER["SERVER_PROTOCOL"] . "500 Internal Server Error");
		exit($text);
	}

	public static function badRequest(string $text = "Bad Request"): void
	{
		header($_SERVER["SERVER_PROTOCOL"] . "400 Bad Request");
		exit($text);
	}

	public static function addAddressPart(string $path): string
	{
		return $_SERVER["HTTP_HOST"] . "/$path";
	}
}