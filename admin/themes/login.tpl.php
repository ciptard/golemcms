<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>GolemCMS - Login</title>
    <link rel="stylesheet" href="stylesheets/login.css" type="text/css">
</head>

<body id="installation">
<div id="container">
    <div id="header">
        <h1>GolemCMS Login</h1>
    </div>
    
<div id="main">
    <?php if (!empty($error) && isset($_POST['login'])):?>
    <p class="error">
        <?php foreach($error as $err):?>
          <strong>Error</strong>: <?php echo $err ;?>.<br>
        <?php endforeach; ?>  
    </p>
    <?php endif;?>
        
    <form action="index.php?page=login" method="post">
        <div class="formbox">
            <label for="username">Username</label>
            <input class="textbox" id="username" maxlength="100" name="username" size="100" type="text" value="">
        </div>

        <div class="formbox">
            <label for="password">Password</label>
            <input class="textbox" id="password" maxlength="255" name="password" size="255" type="password" value="">
        </div>

        <p class="buttons">
            <input class="button" name="login" type="submit" value="Log me in!">
            <span><input class="checkbox" name="remember" id="config_remember" type="checkbox">
            <label for="config_remember">Remember me</label></span>
        </p>
        <p class="links">
            <a href=''>Request password</a> | <a href='index.php?page=register'>Create an account</a>
        </p>      
    </form>
</div>

    <div id="footer">
        <p>This site was made with <a href="http://www.php.net" target="_blank"><acronym title="PHP: Hyper-text Preprocessor">PHP<acronym></a>.</p> <p>Powered by <a href="http://darrin.roenfanz.info/golemcms">GolemCMS</a></p>
    </div>

</div>
</body>
</html>