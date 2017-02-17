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
    const allowedSymbols = '-.ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz~';
    const generateSymbols = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    static public function intToSymb($int) {
        return base_convert($int, 10, 36);
    }

    static public function SymbToInt($val) {
        return (int) base_convert($val, 36, 10);
    }

    static public function getPermitCharacters()
    {
        return allowedSymbols;
    }

    static public function isAllowedStr($str)
    {
        return preg_match("[^\\" . self::allowedSymbols . "]+", $str) === 0;
    }

}