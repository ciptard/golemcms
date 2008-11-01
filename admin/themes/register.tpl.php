<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>GolemCMS - Register</title>
    <link rel="stylesheet" href="stylesheets/register.css" type="text/css">
</head>

<body id="installation">
<div id="container">
    <div id="header">
        <h1>GolemCMS Register</h1>
    </div>
    
<div id="main">
    <?php if(!empty($error) && isset($_POST['register'])): ?>
        <div class="error"><p>
        <?php foreach($error as $err):?>
            <strong>Error</strong>: <?php echo $err; ?><br>
        <?php endforeach; ?>
        </p></div>
    <?php endif; ?>
    
    <?php if(empty($msg)): ?>
    <p class="info">
        <strong>Attention</strong>: All fields are required.
    </p>
        
    <form action="index.php?page=register" method="post">
        <fieldset><legend>Personal Information</legend>
        <div class="formbox">
            <label for="realname">Name:</label>
            <input class="textbox" id="realname" maxlength="100" name="realname" size="100" type="text" value="">
            <span class='hintbox'>Please put your real name</span>
        </div>

        <div class="formbox">
            <label for="email">Email:</label>
            <input class="textbox" id="email" maxlength="255" name="email" size="255" type="text" value="">
            <span class='hintbox'>Must be a valid email address</span>
        </div>

        <div class="formbox">
            <label for="email">Confirm Email:</label>
            <input class="textbox" id="email2" maxlength="255" name="email2" size="255" type="text" value="">
            <span class='hintbox'>Must match above</span>
        </div>
        
        </fieldset>
        
        <fieldset><legend>Account Information</legend>
        <div class="formbox">
            <label for="username">Username:</label>
            <input class="textbox" id="username" maxlength="255" name="username" size="255" type="text" value="">
            <span class='hintbox'>Your screen name</span>
        </div>
        
        <div class="formbox">
            <label for="password">Password:</label>
            <input class="textbox" id="password" maxlength="255" name="password" size="255" type="password" value="">
            <span class='hintbox'>At least 4 characters</span>
        </div>
        
        <div class="formbox">
            <label for="password">Confirm Password:</label>
            <input class="textbox" id="password2" maxlength="255" name="password2" size="255" type="password" value="">
            <span class='hintbox'>Must match above</span>
        </div>
        </fieldset>
        <p class="buttons">
            <input class="button" name="register" type="submit" value="Register">
        </p>        
    </form>
        <?php else: ?>
            <div class="success">
            <h3>Congratulations!</h3>       
                <p><Your registration was a success.<br>
                Click <a href='../admin/index.php?page=login'>here to login</a>, or <a href='../index.php'>go directly to your site</a>.</p></div>
        <?php endif; ?>
</div>

    <div id="footer">
        <p>This site was made with <a href="http://www.php.net" target="_blank"><acronym title="PHP: Hyper-text Preprocessor">PHP<acronym></a>.</p> <p>Powered by <a href="http://darrin.roenfanz.info/golemcms">GolemCMS</a></p>
    </div>

</div>
</body>
</html>
