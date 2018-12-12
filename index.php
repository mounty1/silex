<?php declare(strict_types=1);

/**
 * @OA\Info(title="Silex sample exercise", version="1.0")
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once 'blog.php';
require_once 'swagger.php';

error_reporting(E_ALL);

function our_error_handler(int $errno, string $errstr, string $errfile, string $errline)
{
	if ($errno == E_NOTICE)
		die ("$errstr in $errfile line $errline");

	return false; // Let the PHP error handler handle all the rest  
}

$old_error_handler = set_error_handler("our_error_handler"); 

$app = new Silex\Application();


/** @OA\Get(path="/", @OA\Response(response="200", description="front page")) */
$app->get('/', 'Blog::homepage');

/** @OA\Get(path="/query", @OA\Response(response="200", description="JS querying code")) */
$app->get('/query', 'Blog::queryer');

/** @OA\Get(path="/swagger", @OA\Response(response="200", description="SWAGGER API")) */
$app->get('/swagger', 'Swagger::api');

/** @OA\Get(path="/blog", @OA\Response(response="200", description="All blog entries in HTML")) */
$app->get('/blog', 'Blog::blogList');

/** @OA\Get(path="/blog/{id}", @OA\Response(response="200", description="Specified blog entry in HTML")) */
$app->get('/blog/{id}', 'Blog::blogOne');

/** @OA\Get(path="/blogData", @OA\Response(response="200", description="All blog entries in JSON")) */
$app->get('/blogData', 'Blog::blogData');

/** @OA\Get(path="/blogData/{id}", @OA\Response(response="200", description="Specified blog entry in JSON")) */
$app->get('/blogData/{id}', 'Blog::blogDataOne');

/** @OA\Post(path="/feedback", @OA\Response(response="200", description="Send feedback email")) */
$app->post('/feedback', 'Blog::feedback');

$app->run();
?>
