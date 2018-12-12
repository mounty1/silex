<?php declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Blog
{
	private static $blogPosts = array(
		array(
			'date'	=> '2018-12-01',
			'author'	=> 'igorw',
			'title'	=> 'Using Silex',
			'body'	=> 'Silex is the one',
		),
		array(
			'date'	=> '2018-12-04',
			'author'	=> 'mounty',
			'title'	=> 'Using Silex More',
			'body'	=> 'We should be using symfony/flex',
		),
	);

	private static $queryer = 'query.js';
	private static $leader = '<html><head><title>Silex demonstration</title></head><body>';
	private static $trailer = '</body></html>';
	private static $homeBody = <<<BODY
<script src="./query"></script>
<div>
	<span for="request">Request:</span>
	<input id="request"></input>
	<button onclick="jsend('GET')">Get</button>
	<button onclick="jsend('POST')">Post</button>
</div>
<div id="response"/>
BODY;

	public static function homepage (Silex\Application $app, Request $request) {
		return Blog::$leader . Blog::$homeBody . Blog::$trailer;
	}

	public static function queryer (Silex\Application $app, Request $request) {
		if (!file_exists(Blog::$queryer)) {
			return $app->abort(404, 'The image was not found.');
		}

		$stream = function () {
			readfile(Blog::$queryer);
		};

		return $app->stream($stream, 200, array('Content-Type' => 'application/javascript'));
	}

	public static function blogList (Silex\Application $app, Request $request)
	{
		$content = join(array_map(function ($post) { return '<tr><td>' . $post['title'] . '</td><td>' . $post['body'] . '</td></tr>'; }, Blog::$blogPosts));
		return Blog::$leader . '<table>' . $content . '</table>' . Blog::$trailer;
	}

	public static function blogData (Silex\Application $app, Request $request)
	{
		return $app->json(Blog::$blogPosts);
	}

	public static function blogOne (Silex\Application $app, Request $request, string $id)
	{
		$ix = (int) $id - 1;
		if (isset(Blog::$blogPosts[$ix])) {
			$post = Blog::$blogPosts[$ix];
			$result = "<h1>" . $post['title'] . "</h1><p>" . $post['body'] . "</p>";
		} else {
			$app->abort(404, "Post " . $id . " does not exist.");
			$result = "";
		}
		return Blog::$leader . $result . Blog::$trailer;
	}

	public static function blogDataOne (Silex\Application $app, Request $request, string $id)
	{
		$ix = (int) $id - 1;
		$result = isset(Blog::$blogPosts[$ix])
			? Blog::$blogPosts[$ix]
			: array();
		return $app->json($result);
	}

	public static function feedback (Silex\Application $app, Request $request) {
		$message = $request->get('message');
		mail('gate03@landcroft.com', '[YourSite] Feedback', $message);

		return new Response(Blog::$leader . 'Thank you for your feedback!' . Blog::$trailer, 201);
	}
}
