<?php
/**
   Golem CMS - The Rock Solid CMS. <http://darrin.roenfanz.info/golemcms>
   Copyright (C) 2008 Darrin Roenfanz <darrin@roenfanz.info>

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU Affero General Public License as
   published by the Free Software Foundation, either version 3 of the
   License, or (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU Affero General Public License for more details.

   You should have received a copy of the GNU Affero General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//  Constants  ---------------------------------------------------------------
define('GOLEMCMS_ROOT', dirname(__FILE__));
define('GOLEMCMS_CORE', GOLEMCMS_ROOT.'/core');

#define('APP_PATH', CORE_ROOT.'/app');

//  Init  --------------------------------------------------------------------
require GOLEMCMS_ROOT.'/config.php';

define('BASE_URL', URL_PUBLIC . (USE_MOD_REWRITE ? '': '?'));

// if you have installed frog and see this line, you can comment it or delete it :)
if ( ! defined('DEBUG')) { header('Location: install/'); exit(); }

// run everything!
#require APP_PATH.'/admin/main.php';
require_once(GOLEMCMS_CORE.'/classes/GC_Template.php');
$WebsiteBase = new Template('themes/darrin.v3/index.html');
$WebsiteBase->set('site_title', "darrin.roenfanz.info");

if (!empty($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 'home';
}

switch ($page) {
	case 'about':
		$WebsiteContent = new Template('themes/darrin.v3/about.html');
		$WebsiteBase->set('css', 'themes/darrin.v3/css/about-me.css');
		$WebsiteBase->set('content', $WebsiteContent);
		break;

	case 'blog':
		$WebsiteContent = new Template('themes/darrin.v3/blog.html');
		$WebsiteBase->set('css', 'themes/darrin.v3/css/blog.css');
		$WebsiteBase->set('content', $WebsiteContent);
		break;

	case 'contact':
		$WebsiteContent = new Template('themes/darrin.v3/contact.html');
		$WebsiteBase->set('css', 'themes/darrin.v3/css/contact.css');
		$WebsiteBase->set('content', $WebsiteContent);
		break;

	case 'home':
		$WebsiteContent = new Template('themes/darrin.v3/home.html');
		$WebsiteBase->set('content', $WebsiteContent);
		break;

	default:
		header('HTTP/1.0 404 Not Found');
}

echo $WebsiteBase->fetch('themes/darrin.v3/index.html');
?>