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
	static public function location($location)
	{
		header("Location: $location");
		exit();
	}

	static public function notFound($text = "Not found")
	{
		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
		exit($text);
	}

	static public function internalError($text = "Internal Server Error")
	{
		header($_SERVER["SERVER_PROTOCOL"] . "500 Internal Server Error");
		exit($text);
	}

	static public function badRequest($text = "Bad Request")
	{
		header($_SERVER["SERVER_PROTOCOL"] . "400 Bad Request");
		exit($text);
	}

	static public function addAddressPart($path) {
		return $_SERVER["HTTP_HOST"] . "/$path";
	}
}