<?php declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;

class Swagger
{
	public static function api (Silex\Application $app, Request $request) {
		$openapi = \OpenApi\scan('index.php');
		header('Content-Type: application/json');
		return $openapi->toJson();
	}
}
