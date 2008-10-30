<?php
session_start();
session_regenerate_id(true);
require_once('config/mysql.connect.php');
require_once('classes/class.template.php');
require_once('classes/class.user.php');

$db = mysqlConnect();
$usr = new User($db);


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}
$error = array();
switch ($page) {
    case 'home':
        if($usr->isLoggedIn()) {
            $BaseCMS = new Template();
            $BaseCMS->set('LoginName', $usr->getRealName() );
            echo $BaseCMS->fetch('templates/index.tpl.php');
        } else {
          header("Location: index.php?page=login");
        }
    break;
    
    case 'login':
        if(isset($_POST['login'])) {
            if (empty($_POST['username']) || empty($_POST['password'])) {
                if (empty($_POST['username']))
                    $error[0] = "Username field empty";
                if (empty($_POST['password']))
                    $error[1] = "Password field empty";
            } else {
                    $usr->login($_POST['username'],$_POST['password']);
                    if ($_POST['username'] != $_SESSION['username'])
                        $error[2] = "Username and/or password is incorrect";
                    else
                        exit(header("Location: index.php?page=home"));
            }
        }
        $LoginForm = new Template('templates/login.tpl.php');
        $LoginForm->set('error', $error);
        echo $LoginForm->fetch('templates/login.tpl.php');        
    break;
    
    case 'logout':
        $usr->logout();
        exit(header("Location: index.php?page=login"));   
    break;
    
    case 'register':
    
    break;
    default:
       header("HTTP/1.0 404 Not Found");
    break;
}
?>

