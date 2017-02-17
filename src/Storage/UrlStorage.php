<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 3:42
 */

namespace User0dev\UrlShortener\Storage;


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

    public function addLongUrl($longUrl, $shortUrl = "")
    {
        try {
            $this->pdo->beginTransaction();

            if (!shortUrl) {
                $stmt = $this->pdo->prepare(Queries::INSERT_URL);
                $stmt->bindValue(":long_url", $longUrl);
                $stmt->bindValue(":short_url", "null", \PDO::PARAM_NULL);
                $stmt->execute();
                $newId = $this->pdo->lastInsertId("id");
                $stmt = $this->pdo->prepare(Queries::UPDATE_SHORT_URL);
                $stmt->bindValue(":id", $newId, \PDO::PARAM_INT);
                $shortUrl = ConvertIntSymb::intToSymb($newId);
                $stmt->bindValue(":short_url", $shortUrl);
                $stmt->execute();
            } else {
                
            }

            $this->pdo->commit();
        } catch (\Exception $e) {
            $shortUrl = null;
            $this->pdo->rollBack();
        }
        return $shortUrl;
    }

    public function getLongUrl($shortUrl)
    {
        $id = ConvertIntSymb::SymbToInt($shortUrl);
        $stmt = $this->pdo->prepare(Queries::GET_LONG_URL);

        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
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