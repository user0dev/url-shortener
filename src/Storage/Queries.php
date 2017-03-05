<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.17
 * Time: 3:46
 */

namespace User0dev\UrlShortener\Storage;


class Queries
{
    const CREATE_URLS = "CREATE TABLE IF NOT EXISTS urls (id INT(11) NOT NULL AUTO_INCREMENT, short_name VARCHAR(50) NULL, long_url VARCHAR(512) NOT NULL, PRIMARY KEY (id), UNIQUE (long_url), INDEX (short_name))";
    const CREATE_USER_URLS = "CREATE TABLE IF NOT EXISTS user_urls (id INT(11) NOT NULL AUTO_INCREMENT, short_name VARCHAR(50) NOT NULL, long_url VARCHAR(512) NOT NULL, PRIMARY KEY (id), INDEX (long_url), UNIQUE (short_name))";
    const INSERT_URL = "INSERT INTO urls (long_url) VALUES (:long_url)";
    const GET_LONG_URL_BY_ID = "SELECT long_url FROM urls WHERE id = :id";
    const GET_ID_BY_LONG_URL = "SELECT id FROM urls WHERE long_url = :long_url";
    const INSERT_USER_DEFINED_URL = "INSERT INTO user_urls (short_name, long_url) VALUES (:short_name, :long_url)";
    const GET_USER_DEFINED_URL = "SELECT long_url FROM user_urls WHERE short_name = :short_name";
	const UPDATE_SHORT_NAME = "UPDATE urls SET short_name = :short_name WHERE id = :id";
}