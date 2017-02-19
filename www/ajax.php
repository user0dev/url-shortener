<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 21:57
 */

require __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ . "/../config.php";

use User0dev\UrlShortener\Utils\Validator;
use \User0dev\UrlShortener\Storage\UrlStorage;
use \User0dev\UrlShortener\Utils\ServerHelper;

//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH' != 'XMLHttpRequest') {
//    exit;
//}

if (!isset($_POST["long-url"])) {
    var_dump("")
    ServerHelper::badRequest();
}
$longUrl = Validator::stringSanitize($_GET['long-url']);
if (!Validator::longUrlValidation($longUrl)) {
    ServerHelper::badRequest();
}

$store = new UrlStorage($config["db"]);


$shortUrl = $store->addLongUrl($longUrl);
if (!$shortUrl) {
    ServerHelper::internalError();
}

$result = ["shortUrl" => ""];

if ($shortUrl) {
    $result["shortUrl"] = ServerHelper::addAddressPart($shortUrl);
}

var_dump($result);

echo json_encode($result);