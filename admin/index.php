<?php
session_start();
session_regenerate_id(true);
require_once('config/mysql.connect.php');
require_once('classes/class.template.php');
require_once('classes/class.user.php');

$db = mysqlConnect();
$usr =&new User($db);

$BaseCMS = new Template('templates/index.inc.html');
$BaseCMS->set('title', 'BaseCMS Title');
$BaseCMS->set('username', 'BaseCMS Title');

if (isset($_GET['page'])) {
    $PAGE = $_GET['page'];
} else {
    $PAGE = 'home';
}

switch ($PAGE) {
    case 'home':
        if(isset($_SESSION['logged_in'])) {
            // do something here
        } else {
          header("Location: index.php?page=login");
        }
    break;
    
    case 'login':
        if(isset($_POST['submit_login'])) {
            if (!$_POST['username'] && !$_POST['password']) {
                $error['blank_form'];
            } else {            
                $usr->login($_POST['username'],$_POST['password']);
                exit(header("Location: index.php?page=home"));   
            }
        }
        $LoginForm = new Template('templates/login.inc.php');
        $LoginForm->set('title', 'Login to GolemCMS');
        $LoginForm->set('action', 'index.php?page=login');
        $BaseCMS->set('content', $LoginForm);        
    break;
    
    case 'logout':
        $SESSION['logged_in'] = false;
        exit(header("Location: index.php?page=login"));   
    break;
    
    default:
        echo "Error: 404";
    break;
}
echo $BaseCMS->fetch('templates/index.inc.php');
?>

