<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 4:42
 */

namespace User0dev\UrlShortener\Utils;


abstract class ConvertIntSymb
{
    //const ABC = "abcdefghijklmnopqastuvwxyzABCDEFGHIJKLMNOPQASTUVWXYZ1234567890-_.~";
//    const allowedSymbols = '-ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz~';
    const GENERATED_SYMBOLS = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    const ALLOWED_SYMBOLS = self::GENERATED_SYMBOLS;

    static public function intToSymb($int)
    {
        $int = (int) $int;
        if ($int < 0) {
            throw new \InvalidArgumentException("Parameter '$int' must be greater or equal to 0");
        }
        if ($int == 0) {
            return "0";
        }
        $base = strlen(self::GENERATED_SYMBOLS);
        $result = "";
        for (; $int > 0; $int = ((int) floor($int / $base))) {
            $result .= self::GENERATED_SYMBOLS[$int % $base];
        }
        return $result;
    }

    static public function symbToInt($val)
    {
        $var = (string) $val;
        if (!self::isAllowedStr($val)) {
            throw new \InvalidArgumentException("Parameter '$val' contained wrong symbols");
        }
        $length = strlen($val);
        $base = strlen(self::GENERATED_SYMBOLS);
        $result = 0;
        for ($i = 0, $mul = 1; $i < $length; $i++, $mul *= $base) {
            $result += strpos(self::GENERATED_SYMBOLS, $val[$i]) * $mul;
        }
        return $result;
    }

    static public function getPermitCharacters()
    {
        return self::ALLOWED_SYMBOLS;
    }

    static public function isAllowedStr($str)
    {
        $str = (string) $str;
        return preg_match("/[^" . self::ALLOWED_SYMBOLS . "]+/", $str) === 0;
    }

}