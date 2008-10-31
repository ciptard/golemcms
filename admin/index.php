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
**/

//  Constants  --------------------------------------------------------------
session_start();
define('GOLEMCMS_VERSION', '0.1');

define('GOLEMCMS_ROOT', dirname(__FILE__).'/..');
define('GOLEMCMS_CORE', GOLEMCMS_ROOT.'/core');

#define('APP_PATH',  GOLEMCMS_CORE.'/app/backend');

define('SESSION_LIFETIME', 3600);
define('REMEMBER_LOGIN_LIFETIME', 1209600); // two weeks

define('DEFAULT_CONTROLLER', 'page');
define('DEFAULT_ACTION', 'index');

define('COOKIE_PATH', '/');
define('COOKIE_DOMAIN', '');
define('COOKIE_SECURE', false);

//  Database connection  -----------------------------------------------------
require_once(GOLEMCMS_ROOT.'/config.php');
$__GOLEM_CONN__ = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($mysqli->connect_error) {
        printf("Unable to connect to the database! Tables are not loaded!\n GolemCMS had a connection issue: %s\n", mysqli_connect_error());
        file_put_contents($config_file, '');
        exit();
    }
require_once(GOLEMCMS_CORE.'/classes/GC_Template.php');
require_once(GOLEMCMS_CORE.'/classes/GC_User.php');

$usr = new User($__GOLEM_CONN__);


if (isset($_GET['page'])) {
    $PAGE = $_GET['page'];
} else {
    $PAGE = 'home';
}

switch ($PAGE) {
    case 'home':
        if($usr->isLoggedIn() === true ) {
            $BaseCMS = new Template('themes/index.tpl.php');
            $BaseCMS->set('LoginName', $usr->getRealName());
            echo $BaseCMS->fetch('themes/index.tpl.php');

        } else {
          header("Location: index.php?page=login");
        }
    break;
    
    case 'login':        
        if(isset($_POST['submit_login'])) {
            if (!$_POST['username'] || !$_POST['password'])
                echo "You Need to fill in both fields. \n";
            else
                $usr->login($_POST['username'],$_POST['password']);
                if ($_POST['username'] != $_SESSION['username'])
                    echo "Username and/or password is incorrect. \n";
                else
                    exit(header("Location: index.php?page=home"));
        }
        $LoginForm = new Template('themes/login.tpl.php');
        echo $LoginForm->fetch('themes/login.tpl.php'); 
    break;
    
    case 'logout':
        $usr->logout();
        exit(header("Location: index.php?page=login"));   
    break;

    case 'logout':
        $usr->logout();
        exit();
    break;

    case 'register':
        $RegisterForm = new Template('themes/register.tpl.php');
        $RegisterForm->set('error', $error);
        echo $RegisterForm->fetch('themes/register.tpl.php');
        exit();
    break;
    
    default:
       header("HTTP/1.0 404 Not Found");
    break;
}
?>