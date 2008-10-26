<?php
session_start();
session_regenerate_id(true);
require_once('config/mysql.connect.php');
require_once('classes/class.template.php');
require_once('classes/class.user.php');

$db = mysqlConnect();
$usr = new User($db);


if (isset($_GET['page'])) {
    $PAGE = $_GET['page'];
} else {
    $PAGE = 'home';
}

switch ($PAGE) {
    case 'home':
        if($usr->isLoggedIn()) {
            $BaseCMS = new Template();
            $BaseCMS->set('LoginName', $usr->getRealName() );
            echo $BaseCMS->fetch('theme/index.layout.inc.php');
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
        $LoginForm = new Template('templates/login.inc.php');
        $LoginForm->set('title', 'Login to GolemCMS');
        $LoginForm->set('action', 'index.php?page=login');
        echo $LoginForm->fetch('templates/login.inc.php');        
    break;
    
    case 'logout':
        $usr->logout();
        exit(header("Location: index.php?page=login"));   
    break;
    
    default:
       header("HTTP/1.0 404 Not Found");
    break;
}
?>

