<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>GolemCMS - Register</title>
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
            background-color: #F6F6F6;
            border: 1px solid #123;
            outline: 10px solid #246;
            margin: 10em auto 1em auto;
            width: 44em;
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
        div#main {
            border: 1px solid #FFF;
            }
        div#main a { color: #235; }
        /* =FORM */
        form {
            padding: 1em;
            padding-bottom: 0;
            }
        fieldset { width: 45%; float: left; margin-bottom: 1em;}
        fieldset + fieldset {float: right; }
        div.formbox {
            clear: both; 
            overflow: hidden;
            padding: 1px 1px 1em 1px;
            }
        div.formbox h3 { margin: 0 0 0.5em 0; padding: 0; }
        div.formbox label { 
            clear: left; 
            float: left; 
            margin-right: 0.5em; 
            width: 15em; 
            line-height: 1;
            font-weight: bold;
            color: #123;
            }
        div.formbox span {
            display: block;
            clear: both;
            font-size: 85%;
            font-style: italic;
            }
        input.textbox {
            clear: left;
            float: left;
            margin-right: 0.5em; 
            width: 15em;
            font-size: 1.2em;
            border: 1px solid #999;
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
        p.buttons {padding: 0.3em; }            
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
        #footer p { padding: 0; margin: 0; display: inline; }</style>    
</head>

<body id="installation">
<div id="container">
    <div id="header">
        <h1>GolemCMS Register</h1>
    </div>
    
<div id="main">
    <p class="error">
          <strong>Error</strong>: Form incomplete.<br>
          <strong>Error</strong>: Password fields do not match. Try again.<br>
    </p>
    <p class="info">
        <strong>Attention</strong>: All fields are required.
    </p>
        

    <form action="index.php" method="post">
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
            <input class="textbox" id="email" maxlength="255" name="email" size="255" type="text" value="">
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
            <input class="textbox" id="password" maxlength="255" name="password" size="255" type="password" value="">
            <span class='hintbox'>Must match above</span>
        </div>
        </fieldset>
        <p class="buttons">
            <input class="button" name="login" type="submit" value="Register">
        </p>        
    </form>
</div>

    <div id="footer">
        <p>This site was made with <a href="http://www.php.net" target="_blank"><acronym title="PHP: Hyper-text Preprocessor">PHP<acronym></a>.</p> <p>Powered by <a href="http://darrin.roenfanz.info/golemcms">GolemCMS</a></p>
    </div>

</div>
</body>
</html>
