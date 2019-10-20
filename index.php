<?php
	include 'php/Post.php';
	$POSTS = Post::get_posts();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP-Blog!</title>
		<link rel="stylesheet" type="text/css" href="/css/flat-remix.css">
		<link rel="stylesheet" type="text/css" href="/css/blog.css">
	</head>
	<body>
		<?php foreach ($POSTS as $post) { ?>
			<article>
				<a href="/blog/<?php echo $post->title ?>"><h1><?php echo $post->title ?></h1></a>
				<time datetime="<?php echo $post->date_time ?>"><?php echo $post->date_string ?></time>
				<br>
				<?php echo $post->preview; ?>
				<a class="read-more-button" href="/blog/<?php echo $post->title ?>">Read more ↦</a>
			</article>
			<hr/>
		<?php } ?>
	</body>
</html>
