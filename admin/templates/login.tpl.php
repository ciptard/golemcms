<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>GolemCMS - Login</title>
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
        	padding: .3em 0;
        }        
        /* =container */

        div#container {
            color: #123;
            background-color: #F5F5F5;
            border: 1px solid #123;
            outline: 10px solid #246;
            margin: 10em auto 1em auto;
            width: 22em;
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
        p.error {
            background-color: #FDD;
            border: 1px solid #F00;
            color: #FD0000;
            padding: 0.5em 1em;
            margin: 1em;
            }
        div#main {
            border: 1px solid #FFF;
            }
        div#main a { color: #235; }
        /* =FORM */
        form {
            padding: 1em;
            padding-bottom: 0;
            }
        div.formbox {
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
            width: 10em; 
            line-height: 1;
            }
        input.textbox {
            clear: left;
            float: left;
            margin-right: 0.5em; 
            width: 15em;
            font-size: 1.2em;
            border: 2px solid #999;
            }
        input.textbox:focus { border-color: #246; }
        input.button {
            background-color: #BBB;
            border: 1px solid #DDD;
            border-right-color: #888;
            border-bottom-color: #888;
            outline: 1px solid #666;
            padding: 0.25em 1em;
            }
        p.buttons span { float: right; padding: 0.3em; margin-right: 1em;}
        input.button:active {
            border: 1px solid #888;
            border-right-color: #DDD;
            border-bottom-color: #DDD;
            }
        /* =FOOTER */
        div#footer {
            background-color: #262626;
            border: 1px solid #9cf;            
            border-width: 0 1px 1px 1px;
            color: #FFF;
            padding: 0.5em 1em;
            }
        div#footer a { color: #FFF; }
        #footer p { padding: 0; margin: 0; text-align: center;}</style>    
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
            <a href=''>Request password</a> | <a href=''>Create an account</a>
        </p>      
    </form>
</div>

    <div id="footer">
        <p>This site was made with <a href="http://www.php.net" target="_blank"><acronym title="PHP: Hyper-text Preprocessor">PHP<acronym></a>.</p> <p>Powered by <a href="http://darrin.roenfanz.info/golemcms">GolemCMS</a></p>
    </div>

</div>
</body>
</html>
