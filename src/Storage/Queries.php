<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 3:46
 */

namespace User0dev\Storage\UrlShorting;


abstract class Queries
{
    const CREATE_TABLE = "CREATE TABLE IF NOT EXSISTS urls (id INT(11) NOT NULL AUTO_INCREMENT, long_url VARCHAR(255), PRIMARY KEY (id))";
    const INSERT_URL = "INSERT INTO urls (long_url) VALUES (?)";

}