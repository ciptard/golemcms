<?php
session_start();
session_regenerate_id(true);
require_once('config/mysql.connect.php');
require_once('classes/class.template.php');
require_once('classes/class.user.php');

$db = mysqlConnect();
if(isset($_POST['submit_login']))
{

    $usr =&new User($db);
    $usr->login($_POST['username'],$_POST['password']);
		// Username and password correct, register session variables
		exit(header("Location: ./index.php"));   
}
$LoginForm =& new Template();
$phpself = $_SERVER['PHP_SELF'];
$LoginForm->set('title', "Login to GolemCMS");
$LoginForm->set('action', $phpself );
echo $LoginForm->fetch('templates/login.inc.php');
?>