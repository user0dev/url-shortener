<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.2017
 * Time: 8:22
 */

namespace User0dev\UrlShortener\Templating;


class TwigTemplateEngine implements ITemplateEngine
{
	protected $loader;
	protected $twig;

	public function __construct(array $config)
	{
		if (!isset($config["templatesDir"])) {
			throw new \InvalidArgumentException("Missing parameter 'templateDir'");
		}
		$this->loader = new \Twig_Loader_Filesystem($config["templatesDir"]);
		if (!isset($config["cacheDir"])) {
			throw new \InvalidArgumentException("Missing parameter 'cacheDir");
		}
		$options = ["cache" => $config["cacheDir"]];
		if (isset($config["debug"]) && is_bool($config["debug"])) {
			$options["debug"] = $config["debug"];
		}

		$this->twig = new \Twig_Environment($this->loader, $options);
	}

	public function render($templateName, array $data = [])
	{
		return $this->twig->render($templateName, $data);
	}


}