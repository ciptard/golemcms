<?php
session_start();
require_once('admin/classes/class.template.php');

$themeBase = new Template('themes/darrin.v3/index.html');
$themeBase->set('site_title', "darrin.roenfanz.info");

if (!empty($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 'home';
}

switch ($page) {
	case 'about':
		$themeContent = new Template('themes/darrin.v3/about.html');
		$themeBase->set('css', 'themes/darrin.v3/css/about-me.css');
		$themeBase->set('content', $themeContent);
		break;

	case 'blog':
		$themeContent = new Template('themes/darrin.v3/blog.html');
		$themeBase->set('css', 'themes/darrin.v3/css/blog.css');
		$themeBase->set('content', $themeContent);
		break;

	case 'contact':
		$themeContent = new Template('themes/darrin.v3/contact.html');
		$themeBase->set('css', 'themes/darrin.v3/css/contact.css');
		$themeBase->set('content', $themeContent);
		break;

	case 'home':
		$themeContent = new Template('themes/darrin.v3/home.html');
		$themeBase->set('content', $themeContent);
		break;

	default:
		header('HTTP/1.0 404 Not Found');
}

echo $themeBase->fetch('themes/darrin.v3/index.html');
?>