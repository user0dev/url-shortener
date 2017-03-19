<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 21:57
 */

require __DIR__ . '/../vendor/autoload.php';


use User0dev\UrlShortener\Utils\Validator;
use \User0dev\UrlShortener\Storage\UrlStorage;
use \User0dev\UrlShortener\Utils\ServerHelper;
use User0dev\UrlShortener\Utils\ConvertIntSymb;

$init = new \User0dev\UrlShortener\Utils\Init();

//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
//    ServerHelper::badRequest();
//}

if (!isset($_REQUEST["long-url"])) {

	ServerHelper::badRequest();
}
$longUrl = trim(Validator::stringSanitize($_REQUEST['long-url']));
if (!Validator::longUrlValidation($longUrl)) {
	ServerHelper::badRequest();
}

$shortName = "";
if (isset($_REQUEST["short-name"])) {
	$shortName = trim(Validator::stringSanitize($_REQUEST["short-name"]));

}

$store = new UrlStorage($init->getConfig()["db"]);


$shortUrl = ConvertIntSymb::intToSymb($store->addUrlGenerated($longUrl));
if (!$shortUrl) {
	ServerHelper::internalError();
}

$result = ["shortUrl" => ""];

if ($shortUrl) {
	$result["shortUrl"] = ServerHelper::addAddressPart($shortUrl);
}

echo json_encode($result);