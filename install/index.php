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

define('GOLEMCMS_CORE', dirname(__FILE__).'/../core');

$config_file = '../config.php';

include 'Template.php';


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '1';
}
$error = array();
$msg = array();
switch ($page) 
{
    case '1':
        if (!file_exists($config_file))
            $error[0] = "config.php doesn't exist.";
        if(!is_writeable($config_file))
            $error[1] = "config.php must be writable.";
        if (!is_writeable('../themes/'))
            $error[2] = "themes/ must be writable.";
            
        if ( !defined('DEBUG') && empty($error) && isset($_POST['commit']))
        {
            $config_tmpl = new Template('config.tpl.php');
            $config_tmpl->assign($_POST['config']);
            $config_content = $config_tmpl->fetch();

            file_put_contents($config_file, $config_content);
            $msg[0] = "Config file successfully written!";

            include $config_file;
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($mysqli->connect_error) {
                printf("Unable to connect to the database! Tables are not loaded!\n GolemCMS had a connection issue: %s\n", mysqli_connect_error());
                file_put_contents($config_file, '');
            exit();
            }
            
            $sql_file = file_get_contents('install.sql');
            $sql_array = explode(';',$sql_file);
            foreach ($sql_array as $query) {
                if ($stmt = $mysqli->prepare($query)) {
                    $stmt->execute();
                    $stmt->close();
                }
            }
            $msg[1] = "Tables loaded successfully!";
        }
        include 'page1.tpl.php';
    break;
    
    case '2':
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
                include $config_file;
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                if ($mysqli->connect_error) {
                    printf("GolemCMS was unable to connect to the database:\n%s\n", mysqli_connect_error());
                    exit();
                }
               
                $query = 'INSERT INTO users(username,password,realname,email,activated,permission_level)'
                        .'VALUES( ?, ?, ?, ?, 1, 1)';
                if ($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_param('ssss', $username,md5($password), $realname, $email);
                    $stmt->execute();
                    printf("Error: %s.\n", $stmt->error);
                    $stmt->close();
                    $msg[0] = "Account created! Congratulations! You may now proceed to site administration.";
                }
            }
        }
        include 'page2.tpl.php';
    break;
    
    default:
            header('Location: ../install/');
    break;
}
?>