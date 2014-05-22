<?php

// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );

// error_reporting(E_ERROR | E_WARNING | E_PARSE);

// define('LOG_REQUEST', true);

// define('IS_LOCAL', true);

define( 'WPLANG', 'fr_FR' );
setlocale(LC_ALL, 'fr_FR.utf8');

define('WP_POST_REVISIONS', false );
define('EMPTY_TRASH_DAYS', 0 );

define( 'WP_LOCAL_DEV', false );
define( 'DB_NAME', 'mahimahi' );
define( 'DB_USER', 'mahimahi' );
define( 'DB_PASSWORD', 'IequueX6' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'


if ( ! isset($_SERVER['SERVER_NAME']) )
	$_SERVER['SERVER_NAME'] = 'mahimahi.web-staging.com';

define('WP_SITEURL',    'http://'.$_SERVER['SERVER_NAME'].'/wp/' );
define('WP_HOME',    'http://'.$_SERVER['SERVER_NAME'].''  );

define('MAHI_THUMBNAILS', true);

define('ADMIN_USER_ID', 1);

define('AUTH_KEY',         's+D?j)kE=Y(9:%!IWMz~$(iMGL)56~+ (G+B*UnC(fP-X2eUAj/Ea+6HdC]gOb6z');
define('SECURE_AUTH_KEY',  '/A~^Qpal1>p5K%4VA`@gUg8|5K%zO5.}+R8QR1v6}]`=Po[}OR/n>7r$YL67t(GX');
define('LOGGED_IN_KEY',    'jc:|>5&0kGLX.!oY.D+-Dd]8&se,1z)PJhTxqJWhSYa|*a7[Ng^Q-Zb-f`HB+,{X');
define('NONCE_KEY',        'F#%3fT4ysd;=4|-BQxXS-H9q|6KK5SMaD~KJKoQ8n^]C5ewCuiOfHBkIS|x-0S!o');
define('AUTH_SALT',        ',|-|@Pad8zcJ#%tVw3PQZdSUo-P.pv<!|%H|?@!c}g7WaOfZ0Z>q(}g[c+U$X+IJ');
define('SECURE_AUTH_SALT', 'h-~oKGR4k^2l*9%==O|HOUpHa+[^>XXq;vs7 @aOmnFd!R2py@8QzidPjt]piGQ]');
define('LOGGED_IN_SALT',   'Lo`wD^M<y]Z~{>+3z9n{I8A<IC^f^^d6HmL*TLYr:CBbd9|&Rl-,a^5sb-AIP)6R');
define('NONCE_SALT',       ')A0!|$A+UZ.x ?j]QQ*q{6*RPnD~]F~_,=|%}=!G(SSBheK?N`/i=N2$q2+pA#26');

