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
	protected $pdo;
	public function __construct(array $config)
	{
		$dsn = sprintf("%s:dbname=%s;host=%s", $config["type"], $config["dbname"], $config["host"]);
		$options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC];
		$this->pdo = new \PDO($dsn, $config["user"], $config["password"], $options);
		$this->pdo->exec(Queries::CREATE_TABLE);
	}

	public function addLongUrl($longUrl)
	{
		$stmt = $this->pdo->prepare(Queries::INSERT_URL);
		$stmt->bindValue(":long_url", $longUrl);
		$stmt->execute();
		$newId = $this->pdo->lastInsertId("id");
		return ConvertIntSymb::intToSymb($newId);
	}

	public function getLongUrl($shortUrl)
	{
		$id = ConvertIntSymb::SymbToInt($shortUrl);
		$stmt = $this->pdo->prepare(Queries::GET_LONG_URL);
		$stmt->bindValue(":id", $id, \PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		var_dump($result);
		if ($result) {
			return $result[0]["long_url"];
		} else {
			return null;
		}
	}
}