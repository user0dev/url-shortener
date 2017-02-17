<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.2017
 * Time: 8:14
 */

namespace User0dev\UrlShortener\Templating;


interface ITemplater
{
    public function Render($templateName, array $data = []);

}