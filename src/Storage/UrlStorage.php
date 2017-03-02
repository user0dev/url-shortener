<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 3:42
 */

namespace User0dev\UrlShortener\Storage;


use User0dev\UrlShortener\Utils\ConvertIntSymb;

class UrlStorage
{
	const STATUS_SUCCESS = 2;
	const STATUS_DOUBLE = 1;
	const STATUS_ERROR = 0;


	protected function mkValue($name, $value, $type = \PDO::PARAM_STR)
    {
        return ["name" => $name, "value" => $value, "type" => $type];
    }

	protected function runPrepare($query, array $param = [], &$result = false)
	{
        $stmt = $this->pdo->prepare($query);
        foreach($param as $value) {
            $stmt->bindValue($value["name"], $value["value"], $value["type"]);
        }
        $result = $stmt->execute();
        return $stmt;
	}

	public function __construct(array $config)
	{
		$dsn = sprintf("%s:dbname=%s;host=%s", $config["type"], $config["dbname"], $config["host"]);
		$options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC];
		$this->pdo = new \PDO($dsn, $config["user"], $config["password"], $options);
		$this->pdo->exec(Queries::CREATE_URLS);
		$this->pdo->exec(Queries::CREATE_USER_URLS);
	}



	public function addUrlGenerated($longUrl)
	{
//		$stmt = $this->pdo->prepare(Queries::GET_ID_BY_LONG_URL);
//		$stmt->bindValue(":long_url", $longUrl);
//		$stmt->execute();
//		$result = $stmt->fetchAll();
        $result = $this->runPrepare(Queries::GET_ID_BY_LONG_URL);
		if ($result) {
			return $result[0]["id"];
		}
		$stmt = $this->pdo->prepare(Queries::INSERT_URL);
		$stmt->bindValue(":long_url", $longUrl);
		if ($stmt->execute() != 1) {
			return false;
		}
		$newId = $this->pdo->lastInsertId("id");
		return $newId;
	}

	public function getUrlGenerated($id)
	{
		$id = (int) $id;
		$stmt = $this->pdo->prepare(Queries::GET_LONG_URL_BY_ID);
		$stmt->bindValue(":id", $id, \PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if ($result) {
			return $result[0]["long_url"];
		} else {
			return null;
		}
	}

//	public function addUrlUserDefined($longUrl, $shortName)
//	{
//		if ($this->getUrlUserDefined($shortName)) {
//			return self::STATUS_DOUBLE;
//		}
//		$stmt = $this->pdo->prepare(Queries::INSERT_USER_DEFINED_URL);
//		$stmt->bindValue(":short_name", $shortName);
//		$stmt->bindValue(":long_url", $longUrl);
//		return ($stmt->execute() == 1) ? self::STATUS_SUCCESS : self::STATUS_ERROR;
//	}
//
//	public function getUrlUserDefined($shortName)
//	{
//		$stmt = $this->pdo->prepare(Queries::GET_USER_DEFINED_URL);
//		$stmt->bindValue(":short_name", $shortName);
//		$stmt->execute();
//		$result = $stmt->fetchAll();
//		if ($result) {
//			return $result[0]["long_url"];
//		}
//		return null;
//	}

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