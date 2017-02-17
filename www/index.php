<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 3:20
 */

require __DIR__ . '/../vendor/autoload.php';

use \User0dev\UrlShortener\Storage\UrlStorage;
use \User0dev\UrlShortener\Templating\TwigTemplateEngine;

$config = include __DIR__ . "/../config.php";

$store = new UrlStorage($config["db"]);

$templateEngine = new TwigTemplateEngine($config["twig"]);

echo $templateEngine->render("main.twig");

//
//if (isset($_GET["u"])) {
//    $shortUrl = $_GET["u"];
//    $longUrl = $store->getLongUrl($shortUrl);
//    if ($longUrl) {
//        header("Location: $longUrl");
//        exit();
//    } else {
//        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
//        exit();
//    }
//}
//
