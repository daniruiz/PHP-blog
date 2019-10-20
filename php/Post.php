<?php

class Post {
	const POSTS_CONTENT_DIR = 'posts/';
	const NUM_PREVIEW_PARAGRAPHS = 4;

	public $title;
	public $content;
	public $preview;
	public $date_time;
	public $date_string;

	private function __construct ($file) {
		preg_match('/^(\d{8})-(.+)\.html$/', $file, $matches);
		$this->content = mb_convert_encoding(
				file_get_contents(self::POSTS_CONTENT_DIR . $file),
				'HTML-ENTITIES', 'UTF-8');
		$document = new DOMDocument();
		$document->loadHTML("<body>{$this->content}</body>");
		$children = $document->getElementsByTagName('body')->item(0)->childNodes;

		$paragraphs = 0;
		foreach ($children as $child) {
			$this->preview .= $document->saveHTML($child);
			if (get_class($child) !== 'DOMText') $paragraphs++;
			if ($paragraphs === self::NUM_PREVIEW_PARAGRAPHS) break;
		}
		list(, $rawDate, $this->title) = $matches;
		$date = new DateTime($rawDate);
		$this->date_time = $date->format('Y-m-d');
		$this->date_string = $date->format('F j, Y');
	}

	public static function from_url ($url) {
		$title_pattern = urldecode(basename($url));
		$post_files = glob(self::POSTS_CONTENT_DIR . '????????-*.html');
		$file = array_pop($post_files);
		foreach ($post_files as $post_file)
			if (preg_match("/\d{8}-.*$title_pattern.*.html/i", $post_file))
				$file = $post_file;
		return new self(basename($file));
	}

	public static function get_posts () {
		return array_map(function ($post_file) {
			return new self(basename($post_file));
		}, array_reverse(glob(self::POSTS_CONTENT_DIR . '????????-*.html')));
	}
}
