<?php 

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'hawk84290');
define('DB_NAME', 'golemcms');

define('TABLE_PREFIX', '');

define('DEBUG', false);

// The full URL of your GolemCMS install
define('URL_PUBLIC', 'http://localhost/golemcms/');

// The directory name of your GolemCMS administration (you will need to change it manually)
define('ADMIN_DIR', 'admin');

// Change this setting to enable mod_rewrite. Set to "true" to remove the "?" in the URL.
// To enable mod_rewrite, you must also change the name of "_.htaccess" in your
// GolemCMS root directory to ".htaccess"
define('USE_MOD_REWRITE', false);

// add a suffix to pages (simluating static pages '.html')
define('URL_SUFFIX', '.html');

// Set the timezone of your choice
// go here for more information of the available timezone:
// http://php.net/timezones
define('DEFAULT_TIMEZONE', 'America/Los_Angeles');

?> 