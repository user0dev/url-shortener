<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.02.17
 * Time: 21:10
 */
require_once "vendor/autoload.php";

use User0dev\UrlShortener\Utils\ConvertIntSymb;

function show($int)
{
    $symb = ConvertIntSymb::intToSymb($int);
    echo sprintf("%s - %s - %s", $int, $symb, ConvertIntSymb::symbToInt($symb)) . PHP_EOL;
}

for ($i = 0; $i < 50; $i++) {
    show(rand(0, 100000));
}

ConvertIntSymb::symbToInt("aaaa,ddd");
//$symb = ConvertIntSymb::intToSymb(100);
//echo "$symb - " . ConvertIntSymb::symbToInt($symb);