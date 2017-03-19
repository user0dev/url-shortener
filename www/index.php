<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 3:20
 */

require __DIR__ . '/../vendor/autoload.php';


use \User0dev\UrlShortener\Templating\TwigTemplateEngine;
use \User0dev\UrlShortener\Utils\Validator;
use \User0dev\UrlShortener\Utils\ServerHelper;
use \User0dev\UrlShortener\Utils\ConvertIntSymb;
use \User0dev\UrlShortener\Utils\Init;
use User0dev\UrlShortener\Storage\UrlStorage;

$init = new Init();

$store = new UrlStorage($init->getConfig()["db"]);

$url = Validator::stringSanitize(substr($_SERVER["REQUEST_URI"], 1));
if ($url == "" || $url == "index.php") {
	$templateEngine = new TwigTemplateEngine($init->getConfig()["twig"]);

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

