<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 4:42
 */

namespace User0dev\UrlShortener\Utils;


class ConvertIntSymb
{
	const GENERATED_SYMBOLS = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	public static function intToSymb(integer $int): string
	{
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

	public static function symbToInt(string $val) : integer
	{
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

	public static function getPermitCharacters() : string
	{
		return self::GENERATED_SYMBOLS;
	}

	public static function isAllowedStr(string $str) : boolean
	{
		return preg_match("/^[^" . self::GENERATED_SYMBOLS . "]+$/", $str) === 0;
	}

}