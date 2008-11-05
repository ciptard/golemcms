<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <title>GolemCMS - Administration</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="Language" content="English, en-us">
  	<meta name="Author" content="Darrin C. Roenfanz">
  	<meta name="Robots" content="index,follow">
  	<meta name="Description" content="Darrin's Personal Blog">
  	<meta name="Keywords" content="darrin,roenfanz">
    <link rel="stylesheet" href="stylesheets/admin.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/form.css" type="text/css">
    
<script type="text/javascript" src="../core/scripts/nicEdit/nicEdit.js"></script>

</head>
<body>

<div id="AdminHeader">
    <h1 class="content">GolemCMS</h1>
    <p>You are currently logged in as <span class="LoginName"><?php echo $LoginName; ?></span> | <a href="index.php?page=logout">Logout</a> | <a href="../index.php">View Site</a></p>
</div>
<div id="AdminWrapper" class="content">
    <div id="AdminCrumbs">
        <a href="#">Home</a> &gt; <a href="#">Pages</a> &gt; <a href="#">Add New Pages</a>
    </div>
    <div id="AdminSidebar" class="AdminPanel">
        <h4>Administration</h4>
        <ul id="AdminMenu">
            <li>Content
              <ul>
                <li><a id="articles" href="#">Articles</a></li>
                <li><a id="news" href="#">News/Blog</a></li>
                <li><a id="page" href="#">Pages</a></li>
              </ul>  
            </li>    
            <li>Layout
              <ul>
                <li><a id="css" href="#">Stylesheet</a></li>
                <li><a id="layout" href="#">Templates</a></li>
                <li><a id="sitemap" href="#">Site Structure</a></li>
                <li><a id="menu" href="#">Menu Manager</a></li>
              </ul>
            </li>
            <li>Account Management
              <ul>
                <li><a id="user" href="#">Members</a></li>
                <li><a id="group" href="#">Groups</a></li>
                <li><a id="group_jobs" href="#">Group Assignments</a></li>
                <li><a id="group_perms" href="#">Group Permissions</a></li>
              </ul>
            </li>
            <li>System
              <ul>
                <li><a id="filemanager" href="#">File Manager</a></li>
                <li><a id="logs" href="#">System Log</a></li>
                <li><a id="settings" href="#">Settings</a></li>
              </ul>  
            </li>
            <li>My Preferences
              <ul>
                <li><a href="#">Personal Data</a></li>
                <li><a href="#">User Preferences</a></li>
                <li><a href="#">Manage Shortcuts</a></li>
                <li><a href="#">Task Center</a></li>
              </ul>  
            </li>
        </ul>
    </div>

    <div id="AdminContent" class="AdminPanel">
        <h4><?php echo$AdminHeader; ?> <span><a id="help" href="#" class="normal">Help</a> (new window)</span></h4>
        <?php echo$AdminContent; ?>
    </div>   
</div>
<div id="AdminFooter">
    <p>GolemCMS v<?php echo GOLEMCMS_VERSION ;?> &ndash; The Rock Solid CMS!</p>
    <p>Default disclaimer text goes here.</p>
</div>
</body>
</html>