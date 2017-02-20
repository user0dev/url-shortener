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
	const STATUS_SUCCESS = 0;
	const STATUS_DOUBLE = 1;
	const STATUS_ERROR = 2;

	protected $pdo;

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
		$stmt = $this->pdo->prepare(Queries::GET_ID_BY_LONG_URL);
		$stmt->bindValue(":long_url", $longUrl);
		$stmt->execute();
		$result = $stmt->fetchAll();
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

	public function addUrlUserDefined($longUrl, $shortName)
	{
		if ($this->getUrlUserDefined($shortName)) {
			return self::STATUS_DOUBLE;
		}
		$stmt = $this->pdo->prepare(Queries::INSERT_USER_DEFINED_URL);
		$stmt->bindValue(":short_name", $shortName);
		$stmt->bindValue(":long_url", $longUrl);
		return ($stmt->execute() == 1) ? self::STATUS_SUCCESS : self::STATUS_ERROR;
	}

	public function getUrlUserDefined($shortName)
	{
		$stmt = $this->pdo->prepare(Queries::GET_USER_DEFINED_URL);
		$stmt->bindValue(":short_name", $shortName);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if ($result) {
			return $result[0]["long_url"];
		}
		return null;
	}
}