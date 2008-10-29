<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>GolemCMS - Install</title>
    <style type="text/css">
        /* =GENERIC */

        html, body { padding: 0; margin: 0; }
        body {
            background-color: #123;
        	font-size: 14px;
        	font-style: normal;
            font-family: Verdana, Arial, sans-serif;
        	line-height: 1.5;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: Georgia, "Times New Roman", serif;
        	line-height: 1.2;
        	margin: .5em 0 .3em 0;
        }

        h1 { font-size: 2.0em; }
        h2 { font-size: 1.6em; }
        h3 { font-size: 1.4em; }
        h4 { font-size: 1.2em; }
        h5 { font-size: 1.1em; }
        h6 { font-size: 1.0em; }
        form label {
        	cursor: pointer;
        	margin: 0;
        	padding: .3em;
        }        
        code { padding: 2px; background-color: #EEE; border: 1px dashed #AAA; }
        /* =MAIN */

        div#container {
            color: #123;
            background-color: #F5F5F5;
            border: 1px solid #123;
            outline: 10px solid #246;
            margin: 5em auto;
            width: 700px;
            }
        div#header h1 {
            background-color: #262626;
            border: 1px solid #9cf;
            border-width: 1px 1px 0 1px;
            color: #FFF;
            margin: 0;
            padding: 0.25em;
            text-align: center;
            }
        p.error, p.info {
            padding: 0.5em 1em;
            margin: 1em;
            }
        p.error {
            background-color: #FDD;
            border: 1px solid #F00;
            color: #FD0000;
            }
        p.info {
            background-color: #ADF;
            border: 1px solid #204A87;
            color: #204A87;
            }
        p.success {
            padding: 0.5em 1em;
            margin: 1em;
            }
        /* =FORM */
        form {
            padding: 1em;
            padding-bottom: 0;
            }
        div.formbox {
            border-bottom: 1px dashed #BBB;
            clear: both; 
            overflow: hidden;
            padding: 1px 1px 1em 1px;
            padding-bottom: 1em;
            margin-bottom: 0.5em;
            }
        div.formbox h3 { margin: 0 0 0.5em 0; padding: 0; }
        div.formbox label { 
            clear: left; 
            float: left; 
            margin-right: 0.5em; 
            text-align: right; 
            width: 10em; 
            line-height: 1;
            }
        input.textbox {
            float: left; 
            margin-right: 0.5em; 
            width: 15em;
            }
        span.helpbox {
            display: block;
            margin-left: 26.5em;
            border-left: 1px solid #CCC;
            padding-left: 1em; 
            }
        input.button {
            background-color: #BBB;
            border: 1px solid #DDD;
            border-right-color: #888;
            border-bottom-color: #888;
            outline: 1px solid #666;
            padding: 0.25em 1em;
            }
        input.button:active {
            border: 1px solid #888;
            border-right-color: #DDD;
            border-bottom-color: #DDD;
            }
        /* =FORM */
        div#footer {
            background-color: #262626;
            border: 1px solid #9cf;            
            border-width: 0 1px 1px 1px;
            color: #FFF;
            padding: 0.5em 1em;
            }
        div#footer a { color: #FFF; }
        #footer p { padding: 0; margin: 0; text-align: center;}
    </style>    
</head>

<body id="installation">

<div id="container">
    <div id="header">
        <h1>GolemCMS Installation</h1>
    </div>
        <?php if (!empty($error)): ?>
            <p class="error"> 
                <?php foreach($error as $err): echo $err; ?><br><?php endforeach; ?>
            </p>
        <?php endif; ?>

    <div id="main">
    <?php if ( ! defined('DEBUG')): ?>
        <form action="index.php" method="post">
            <div class="formbox">
                <label for="config_db_host">Database server</label>
                <input class="textbox" id="config_db_host" maxlength="100" name="config[db_host]" size="100" type="text" value="localhost">
                <span class="helpbox">Required. Usually is "localhost"</span>
            </div>

            <div class="formbox">
                <label for="config_db_user">Database user</label>
                <input class="textbox" id="config_db_user" maxlength="255" name="config[db_user]" size="255" type="text" value="root">
                <span class="helpbox">Required.</span>
            </div>

            <div class="formbox">
                <label class="optional" for="config_db_pass">Database password</label>
                <input class="textbox" id="config_db_pass" maxlength="40" name="config[db_pass]" size="40" type="password" value="">
                <span class="helpbox">Optional. If there is no database password, leave it blank.</span>
            </div>

            <div class="formbox">
                <label for="config_db_name">Database name</label>
                <input class="textbox" id="config_db_name" maxlength="40" name="config[db_name]" size="40" type="text" value="golem">
                <span class="helpbox">Required. You have to create a database manually and enter its name here.</span>
            </div>

            <div class="formbox">
                <label class="optional" for="config_table_prefix">Table prefix</label>
                <input class="textbox" id="config_table_prefix" maxlength="40" name="config[table_prefix]" size="40" type="text" value="">
                <span class="helpbox">Optional. Prevents conflicts of multiple GolemCMS installations with a single database.</span>
            </div>

            <h3>Other information</h3>
            <div class="formbox">
                <label class="optional" for="config_url_suffix">URL suffix</label>
                <input class="textbox" id="config_url_suffix" maxlength="40" name="config[url_suffix]" size="40" type="text" value=".html">
                <span class="helpbox">Optional. Add a suffix to simulate static <abbr title="Hyper Text Mark-up Language">HTML</abbr> files.</span>
            </div>

            <p class="buttons">
                <input class="button" name="commit" type="submit" value="Install now!">
            </p>
        </form>
    <?php else: ?>   
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?><br>
            <a href="index.php">Click here and try again</a></p>
        <?php endif; ?>
        <?php if (!empty($msg)): ?>
            <p class="info"> 
                <?php foreach($msg as $message): echo $message; ?><br><?php endforeach; ?>
            </p>
        <?php endif; ?>
            <p class="success"><strong>GolemCMS</strong> is installed, you <b>must</b> delete the <code>install/</code> folder now!
            <br>Click <a href="../">here</a> to see your site, or <a href="../admin">here</a> to access the backend</p>        
    <?php endif; ?>

    </div>
    <div id="footer">
        <p>This site was made with <a href="http://www.php.net" target="_blank">PHP</a> and is powered by <a href="http://darrin.roenfanz.info/golemcms">GolemCMS</a></p>
    </div>

</div>
</body>
</html>
