<?php
session_start();
require_once('../index.php');
require_once('classes/class.template.php');
require_once('classes/class.user.php');

$usr = new User($conn);


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}
$error = array();
switch ($page) {
    case 'home':
        if(!$usr->isLoggedIn()) {
            exit(header("Location: index.php?page=login"));
        } else {
            $BaseCMS = new Template();
            $BaseCMS->set('LoginName', $usr->getRealName() );
            echo $BaseCMS->fetch('templates/index.tpl.php');
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
                $username = $_POST['username'];
                $password = $_POST['password'];
            }    
            if ($usr->login( $username, $password )) {
                if ($username != $_SESSION['username']) {
                    $error[2] = "Username and/or is incorrect";
                } else {
                    $msg[0] = "Login Successful.";
                }
            }
        }
        $LoginForm = new Template('templates/login.tpl.php');
        $LoginForm->set('error', $error);
        $LoginForm->set('msg', $msg);
        echo $LoginForm->fetch('templates/login.tpl.php');        
    break;
    
    case 'logout':
        $usr->logout();
        exit(header("Location: index.php?page=login"));   
    break;
    
    case 'register':
        $RegisterForm = new Template('templates/login.tpl.php');
        $RegisterForm->set('error', $error);
        echo $RegisterForm->fetch('templates/login.tpl.php');            
    break;
    default:
       exit(header("HTTP/1.0 404 Not Found"));
    break;
}
?>

