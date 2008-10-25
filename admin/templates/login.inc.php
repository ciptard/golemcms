<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang='en'>
<head>
  <title><?=$title;?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="Language" content="English, en_us">
	<meta name="Author" content="Darrin C. Roenfanz">
	<meta name="Robots" content="index,follow">
	<meta name="Description" content="Darrin's Personal Blog">
	<meta name="Keywords" content="darrin,roenfanz">
  
  <style type="text/css">
    form {
      margin: 100px auto;
      width: 20em;
      padding: 1em;
      border: 2px solid #EEE;
      }
    .break { margin: 1em 0; }  
    label.txt { margin-right: 1em; width: 150px; display: block; }
    input.submit { margin-left: 0px; }
    input.text { width: 200px; }
    
  </style>
</head>

<body>
    <div id="container">
        <form id='login' action='<?= $action; ?>' method='post'>
            <div class='break'>
                <label for='username' class='txt'>Username:</label>
                <input id='username'
                     name='username' 
                     type='text' 
                     class='text'>
            </div>
            
            <div class='break'>
                <label for='password' class='txt'>Password:</label>
                <input id='password' 
                     name='password'
                     type='password' 
                     class='text'>
            </div>
        
            <div class='break'>
                <input id='remember' 
                     name='remember'
                     type='checkbox' 
                     class='chkbox'>
                <label for='remember'>Remember you?</label>                 
            </div>
            
            <input name='submit_login'
                 type='submit' 
                 value='Login' 
                 class='submit'>
        </form>
    </div>
</body>
</html>