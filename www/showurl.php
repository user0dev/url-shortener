<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.02.17
 * Time: 17:58
 */

use User0dev\UrlShortener\Utils\Validator;
use User0dev\UrlShortener\Utils\ServerHelper;
use User0dev\UrlShortener\Storage\UrlStorage;
use User0dev\UrlShortener\Templating\TwigTemplateEngine;
use User0dev\UrlShortener\Utils\ConvertIntSymb;

require __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ . "/../config.php";

$longUrl = "";

if (isset($_POST["long-url"])) {
	$longUrl = Validator::stringSanitize($_POST["long-url"]);
	if (!Validator::longUrlValidation($longUrl)) {
		$longUrl = "";
	}
}

if (!$longUrl) {
	ServerHelper::badRequest();
}

$store = new UrlStorage($config["db"]);
$symbNumber = ConvertIntSymb::intToSymb($store->addUrlGenerated($longUrl));
if (!$symbNumber) {
	ServerHelper::internalError();
}

$shortUrl = ServerHelper::addAddressPart($symbNumber);

$templateEngine = new TwigTemplateEngine($config["twig"]);

echo $templateEngine->render("showShortUrlPage.twig", ["shortUrl" => $shortUrl, "longUrl" => $longUrl]);