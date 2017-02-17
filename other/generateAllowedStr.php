<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 17:13
 */

$str = "-_.~";

for ($i = "a"; $i <= "z" && strlen($i) == 1; $i++)
{
    $str .= $i;
    $str .= strtoupper($i);
}

$arr = str_split($str);
sort($arr);
$str = implode("", $arr);

echo $str . PHP_EOL;