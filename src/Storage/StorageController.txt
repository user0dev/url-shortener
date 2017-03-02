<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.02.17
 * Time: 17:35
 */

namespace User0dev\UrlShortener\Storage;


use User0dev\UrlShortener\Utils\ConvertIntSymb;
use User0dev\UrlShortener\Utils\ServerHelper;

class StorageController
{
	protected $storage;

	const USER_SYMBOL = "_";

	public function __construct(array $config)
	{
		$this->storage = new UrlStorage($config);
	}

	public function addUrl($longUrl, $shortName = "", &$isDouble = false)
	{
		$isDouble = false;
		if ($shortName) {
			$result = $this->storage->addUrlUserDefined($longUrl, $shortName);
			if ($result === UrlStorage::STATUS_SUCCESS) {
				return ServerHelper::addAddressPart(self::USER_SYMBOL . $shortName);
			} elseif ($result === UrlStorage::STATUS_DOUBLE) {
				$isDouble = true;
			}
			return "";
		} else {
			$id = $this->storage->addUrlGenerated($longUrl);
			if ($id) {
				return ServerHelper::addAddressPart(ConvertIntSymb::intToSymb($id));
			} else {
				return "";
			}
		}
	}

	public function getUrl($shortName)
	{
		$shortName = (string) $shortName;
		if ($shortName[0] == self::USER_SYMBOL) {
			$shortName = substr($shortName, 1);
			$longUrl = $this->storage->getUrlUserDefined($shortName);
			return $longUrl ?: "";
		} else {
			$longUrl = $this->storage->getUrlGenerated(ConvertIntSymb::symbToInt($shortName));
			return $longUrl ?: "";
		}
	}
	public function testUserUrl($shortName)
	{
		$shortName = (string) $shortName;
		return (bool) $this->storage->getUrlUserDefined($shortName);
	}
}