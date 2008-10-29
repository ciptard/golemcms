<?php echo '<?php'; ?> 

define('DB_HOST', '<?php echo $db_host; ?>');
define('DB_USER', '<?php echo $db_user; ?>');
define('DB_PASS', '<?php echo $db_pass; ?>');
define('DB_NAME', '<?php echo $db_name; ?>');

define('TABLE_PREFIX', '<?php echo $table_prefix; ?>');

define('DEBUG', false);

// The full URL of your GolemCMS install
define('URL_PUBLIC', 'http://<?php echo substr(dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']), 0, strrpos(dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']), '/')); ?>/');

// The directory name of your GolemCMS administration (you will need to change it manually)
define('ADMIN_DIR', 'admin');

// Change this setting to enable mod_rewrite. Set to "true" to remove the "?" in the URL.
// To enable mod_rewrite, you must also change the name of "_.htaccess" in your
// GolemCMS root directory to ".htaccess"
define('USE_MOD_REWRITE', false);

// add a suffix to pages (simluating static pages '.html')
define('URL_SUFFIX', '<?php echo $url_suffix; ?>');

// Set the timezone of your choice
// go here for more information of the available timezone:
// http://php.net/timezones
define('DEFAULT_TIMEZONE', '<?php $timezone = date('e'); echo $timezone != 'e' ? $timezone: 'GMT'; ?>');

<?php echo '?>'; ?> 