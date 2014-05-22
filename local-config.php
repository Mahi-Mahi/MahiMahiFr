<?php

// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );

// error_reporting(E_ERROR | E_WARNING | E_PARSE);

// define('LOG_REQUEST', true);

define( 'WPLANG', 'fr_FR' );
setlocale(LC_ALL, 'fr_FR.UTF-8');


define('IS_LOCAL', true);

define('WP_POST_REVISIONS', false );
define('EMPTY_TRASH_DAYS', 0 );

define( 'WP_LOCAL_DEV', false );
define( 'DB_NAME', 'mahimahifr' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

if ( ! isset($_SERVER['SERVER_NAME']) )
	$_SERVER['SERVER_NAME'] = 'mahimahifr.localhost';

define('WP_SITEURL',    'http://'.$_SERVER['SERVER_NAME'].'/wp/' );
define('WP_HOME',    'http://'.$_SERVER['SERVER_NAME'].''  );

define('THUMBNAILS_GD_FIRST', true);

define('ADMIN_USER_ID', 1);
