<?php
session_start();
session_regenerate_id(true);
require_once('config/mysql.connect.php');
require_once('classes/class.template.php');
require_once('classes/class.user.php');

$db = mysqlConnect();
$usr = new User($db);

$BaseCMS = new Template();

if (isset($_GET['page'])) {
    $PAGE = $_GET['page'];
} else {
    $PAGE = 'home';
}

switch ($PAGE) {
    case 'home':
        if(isset($_SESSION['logged_in'])) {
            $BaseCMS->set('LoginName', $usr->getRealName() );
            echo $BaseCMS->fetch('theme/index.layout.inc.php');
        } else {
          header("Location: index.php?page=login");
        }
    break;
    
    case 'login':
        if(isset($_POST['submit_login'])) {
            if (!$_POST['username'] || !$_POST['password']) {
                echo 'You Need to fill in both fields';
            } elseif($usr->login($_POST['username'],$_POST['password'])) {
                exit(header("Location: index.php?page=home"));    
            } else {
                echo 'Your username and/or password was incorrect';
            }
        }
        $LoginForm = new Template('templates/login.inc.php');
        $LoginForm->set('title', 'Login to GolemCMS');
        $LoginForm->set('action', 'index.php?page=login');
        $BaseCMS->set('content', $LoginForm);
        echo $BaseCMS->fetch('templates/index.inc.php');        
    break;
    
    case 'logout':
        $usr->logout();
        exit(header("Location: index.php?page=login"));   
    break;
    
    default:
        echo "Error: 404";
    break;
}
?>

