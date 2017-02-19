<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.02.17
 * Time: 7:59
 */

namespace User0dev\UrlShortener\Error;


use Exception;

class UrlShortenerException extends \Exception
{
	public function __construct($message, $code, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}