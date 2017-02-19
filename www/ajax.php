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

if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    exit;
}

if (!isset($_GET["long-url"])) {
    exit;
}
$longUrl = Validator::stringSanitize($_GET['long-url']);
if (!Validator::longUrlValidation($longUrl)) {
    exit;
}

$store = new UrlStorage($config["db"]);

$shortUrl = $store->addLongUrl($longUrl);

$result = ["shortUrl" => ""];

if ($shortUrl) {
    $result["shortUrl"] = ServerHelper::symbNumberToURL($shortUrl);
}

echo json_encode($result);