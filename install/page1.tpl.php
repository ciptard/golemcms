<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>GolemCMS - Install</title>
    <link rel="stylesheet" href="install.css" type="text/css">
</head>

<body id="installation">

<div id="container">
    <div id="header">
        <h1>GolemCMS Installation</h1>
    </div>
    
    <?php if(!empty($error)): ?>
    <div class="error"><p>
        <?php foreach($error as $err):?>
            <strong>Error</strong>:<?php echo $err; ?>
        <?php endforeach; ?>
    </p></div>
    <?php endif; ?>
    
    <div id="main">
    <?php if (!defined('DEBUG')): ?>
        <form action="index.php" method="post">
        <fieldset><legend>Database Information</legend>
            <div class="formbox">
                <label for="config_db_host">Database server</label>
                <input class="textbox" id="config_db_host" maxlength="100" name="config[db_host]" size="100" type="text" value="localhost">
                <span class="hintbox">Required. Usually is "localhost"</span>
            </div>

            <div class="formbox">
                <label for="config_db_user">Database user</label>
                <input class="textbox" id="config_db_user" maxlength="255" name="config[db_user]" size="255" type="text" value="root">
                <span class="hintbox">Required.</span>
            </div>

            <div class="formbox">
                <label class="optional" for="config_db_pass">Database password</label>
                <input class="textbox" id="config_db_pass" maxlength="40" name="config[db_pass]" size="40" type="password" value="">
                <span class="hintbox">Optional. If there is no database password, leave it blank.</span>
            </div>

            <div class="formbox">
                <label for="config_db_name">Database name</label>
                <input class="textbox" id="config_db_name" maxlength="40" name="config[db_name]" size="40" type="text" value="golem">
                <span class="hintbox">Required. You have to create a database manually and enter its name here.</span>
            </div>

            <div class="formbox">
                <label class="optional" for="config_table_prefix">Table prefix</label>
                <input class="textbox" id="config_table_prefix" maxlength="40" name="config[table_prefix]" size="40" type="text" value="">
                <span class="hintbox">Optional. Prevents conflicts of multiple GolemCMS installations with a single database.</span>
            </div>
        </fieldset>
        <fieldset><legend>Other information</legend>
            <div class="formbox">
                <label class="optional" for="config_url_suffix">URL suffix</label>
                <input class="textbox" id="config_url_suffix" maxlength="40" name="config[url_suffix]" size="40" type="text" value=".html">
                <span class="hintbox">Optional. Add a suffix to simulate static <abbr title="Hyper Text Mark-up Language">HTML</abbr> files.</span>
            </div>
        </fieldset>
            <p class="buttons">
                <input class="button" name="commit" type="submit" value="Install GolemCMS">
            </p>
        </form>    
    <?php else: ?>
        <?php if(!empty($msg)): ?>
        <div class="info"><p><?php foreach($msg as $message): echo $message; ?><br><?php endforeach; ?></p></div>
        <?php endif;?>
     
        <div class="continue"><p><a href='index.php?page=2'>Proceed to Step 2</a></p></div>
    <?php endif; ?>

    </div>
    <div id="footer">
        <p>This site was made with <a href="http://www.php.net" >PHP</a> and is powered by <a href="http://darrin.roenfanz.info/golemcms">GolemCMS</a></p>
    </div>

</div>
</body>
</html>
