<?php
	include 'php/Post.php';
	$POST = Post::from_url($_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $POST->title ?></title>
		<link rel="stylesheet" type="text/css" href="/css/flat-remix.css">
		<link rel="stylesheet" type="text/css" href="/css/blog.css">
	</head>
	<body>
		<nav class="with-shadow">
			<a href="/" title="↤ Go back">↤ Back</a>
		</nav>

		<article>
			<h1><?php echo $POST->title ?></h1>
			<time datetime="<?php echo $POST->date_time ?>"><?php echo $POST->date_string ?></time>
			<br>
			<?php echo $POST->content ?>
		</article>
	</body>
</html>
