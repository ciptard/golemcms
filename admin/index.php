<?php
/**
 * Golem CMS - The Rock Solid CMS. <http://darrin.roenfanz.info/golemcms>
 * Copyright (C) 2008 Darrin Roenfanz <darrin@roenfanz.info>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


//  Constants  --------------------------------------------------------------
define('GOLEMCMS_VERSION', '0.0.1');

define('GOLEMCMS_ROOT', dirname(__FILE__).'/..');
define('GOLEMCMS_CORE', GOLEMCMS_ROOT.'/core');

define('SESSION_LIFETIME', 3600);
define('REMEMBER_LOGIN_LIFETIME', 1209600); // two weeks

define('COOKIE_PATH', '/');
define('COOKIE_DOMAIN', '');
define('COOKIE_SECURE', false);

//  Database connection  -----------------------------------------------------
require_once GOLEMCMS_ROOT.'/config.php';
require_once GOLEMCMS_CORE.'/classes/GC_Template.php';
require_once GOLEMCMS_CORE.'/classes/GC_User.php';

if ( ! defined('DEBUG')) { header('Location: '.GOLEMCMS_ROOT.'/install/'); exit(); }

$__GOLEM_CONN__ = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($__GOLEM_CONN__->connect_error) {
    printf("Unable to connect to the database! Tables are not loaded!\n GolemCMS had a connection issue: %s\n", mysqli_connect_error());
    exit();
}
$usr = new GC_User($__GOLEM_CONN__);
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'admin';
}

switch ($page) {
    case 'admin':
        if ($usr->isLoggedIn() === true ) {
            $BaseCMS = new Template('themes/index.tpl.php');
            $BaseCMS->set('LoginName', $usr->getRealName());
            
            $AdminContent = new Template('themes/news.form.html');
            $AdminContent->set('title_text', 'Article Title');            
            $AdminContent->set('list_text', 'Category');
            $AdminContent->set('author_text', $_SESSION['username']);
            $AdminContent->set('content_area_text', 'Article Content');
            
            $BaseCMS->set('AdminHeader', 'Create Article');            
            $BaseCMS->set('AdminContent', $AdminContent);            
            echo $BaseCMS->fetch('themes/index.tpl.php');
          
        } else {
            exit(header("Location: index.php?page=login"));
        }
    break;

    case 'login':
        if(isset($_POST['login'])) {
            if (empty($_POST['username'])) {
                    $error[0] = "Username field empty";
            }
            if (empty($_POST['password'])) {
                    $error[1] = "Password field empty";
            }
            if (empty($error)) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $usr->login($username, $password);
                if ($username != $_SESSION['username']) {
                    $error[2] = "Username and/or password is incorrect";
                } else {
                    if ($usr->isLoggedIn() === true ) {
                        exit(header("Location: index.php?page=admin"));
                    }
                }
            }
        }
        $LoginForm = new Template('themes/login.tpl.php');
        $LoginForm->set('error', $error);
        echo $LoginForm->fetch('themes/login.tpl.php'); 
    break;

    case 'logout':
        $usr->logout();
        exit(header("Location: index.php?page=login"));
    break;

    case 'register':
        if (isset($_POST['register']) ) {
            if (empty($_POST['username']) || empty($_POST['realname'])) {
                if (empty($_POST['username']))
                    $error[0] = "Username field empty";
                if (empty($_POST['realname']))
                    $error[1] = "Name field empty";
            } else {                
                $realname = $_POST['realname'];
                $username = $_POST['username'];
            }
            if ($_POST['email2'] != $_POST['email']) {
                $error[2] = 'Email fields do not match. Try again.';                
            } elseif ($_POST['password2'] != $_POST['password']) {
                $error[3] = 'Password fields do not match. Try again.';
            } else {
                $email = $_POST['email'];
                $password = $_POST['password'];
            }
            if (empty($error)) {            
                $conn = $__GOLEM_CONN__;

                if ($conn->connect_error) {
                    printf("GolemCMS was unable to connect to the database:\n%s\n", mysqli_connect_error());
                    exit();
                }
               
                $query = 'INSERT INTO users(username,password,realname,email,activated,permission_level)'
                        .'VALUES( ?, ?, ?, ?, 0, 0)';
                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param('ssss', $username,md5($password), $realname, $email);
                    $stmt->execute();
                    printf("Error: %s.\n", $stmt->error);
                    $stmt->close();
                    $msg[0] = "Account created! Congratulations! You may now proceed to site administration.";
                }
            }
        }
        $RegisterForm = new Template('themes/register.tpl.php');
        $RegisterForm->set('error', $error);
        $RegisterForm->set('msg', $msg);
        echo $RegisterForm->fetch('themes/register.tpl.php');
    break;

    default:
       header("HTTP/1.0 404 Not Found");
    break;
}
?>