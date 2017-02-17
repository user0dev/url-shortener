<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 3:20
 */

require __DIR__ . '/../vendor/autoload.php';

use \User0dev\UrlShortener\Storage\UrlStorage;

$config = include __DIR__ . "/../config.php";

$store = new UrlStorage($config["db"]);



if (isset($_GET["u"])) {
    $shortUrl = $_GET["u"];
    $longUrl = $store->getLongUrl($shortUrl);
    if ($longUrl) {
        header("Location: $longUrl");
        exit();
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        exit();
    }
}

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
    <form action="shorturl.php" method="post">
        <input type="url" name="long-url" value="https://www.youtube.com/watch?v=26AuV9bwHCw"><br>
        <input type="submit">
    </form>
</body>
</html>
