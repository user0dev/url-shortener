<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 6:34
 */

require __DIR__ . '/../vendor/autoload.php';

use \User0dev\UrlShortener\Storage\UrlStorage;

$config = include __DIR__ . "/../config.php";

$store = new UrlStorage($config["db"]);

$longUrl = $_POST["long-url"];

$firstPartUrl = $_SERVER["HTTP_HOST"] . "/?u=";

$shortUrl =  $firstPartUrl . $store->genShortUrl($longUrl);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>Исходный URL: <i><?= $longUrl ?></i></div>
    <div><label>Сокращенный URL: <input type="text" readonly value="<?= $shortUrl ?>"></label></div>
</body>
</html>
