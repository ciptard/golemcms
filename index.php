<?php
session_start();
require_once('admin/classes/class.template.php');

$ThemeBase =& new Template('themes/darrin.v3/index.html');
$ThemeBase->set('site_title', "darrin.roenfanz.info");

if (isset($_GET['page'])) {
    $PAGE = $_GET['page'];
} else {
    $PAGE = 'home';
}

switch ($PAGE) {
    case 'about':
        $ThemeContent =& new Template('themes/darrin.v3/about.html');
        $ThemeBase->set('css', "themes/darrin.v3/css/about-me.css" );        
        $ThemeBase->set('content', $ThemeContent );
    break;
    
    case 'blog':
        $ThemeContent =& new Template('themes/darrin.v3/blog.html');
        $ThemeBase->set('css', "themes/darrin.v3/css/blog.css" );
        $ThemeBase->set('content', $ThemeContent );
    break;
    
    case 'contact':
        $ThemeContent = new Template('themes/darrin.v3/contact.html');
        $ThemeBase->set('css', "themes/darrin.v3/css/contact.css" );
        $ThemeBase->set('content', $ThemeContent );
    break;
    
    case 'home':
        $ThemeContent = new Template('themes/darrin.v3/home.html');
        $ThemeBase->set('content', $ThemeContent );
    break;
    
    default:
    
        $ThemeBase->set('content', 'Error 404: Page Not Found' );
    break;
}
echo $ThemeBase->fetch('themes/darrin.v3/index.html');
