<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 3:20
 */

require __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ . "/../config.php";

use \User0dev\UrlShortener\Storage\UrlStorage;
use \User0dev\UrlShortener\Templating\TwigTemplateEngine;
use \User0dev\UrlShortener\Utils\Validator;
use \User0dev\UrlShortener\Utils\ServerHelper;
use \User0dev\UrlShortener\Utils\ConvertIntSymb;


$store = new UrlStorage($config["db"]);

$url = Validator::stringSanitize(substr($_SERVER["REQUEST_URI"], 1));
if ($url == "" || $url == "index.php") {
	$templateEngine = new TwigTemplateEngine($config["twig"]);

	echo $templateEngine->render("main.twig");

} elseif (Validator::shortUrlValidation($url)) {
	$longUrl = $store->getUrlGenerated(ConvertIntSymb::symbToInt($url));
	if ($longUrl) {
		ServerHelper::location($longUrl);
	} else {
		ServerHelper::notFound();
	}
} else {
	ServerHelper::badRequest();
}

