<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


include "../panel/config/config.php";
include "../panel/config/dbdir.php";
$_d=$host[$config['userid']];
$db_host=$_d['db_host'];
$db_user=$_d['db_user'];
$db_pass=$_d['db_pass'];
$db_name=$_d['db_name'];
define('DB_NAME', $db_name);


define('DB_USER', $db_user);

define('DB_PASSWORD', $db_pass);

define('DB_HOST', $db_host);

 
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'websuka_quiz');

/** MySQL database username */
//define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', 'mromli');

/** MySQL hostname */
//define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'lk4znzec7ju3pluixmiazrg1oemw0ncblsybu5bmhradt2k6owvyicylufvvakwv');
define('SECURE_AUTH_KEY',  'odzqz9fhhtdr1xleojza2x3enjqcevqhygjezwrbyiw10u3brq6bboygafhydrvz');
define('LOGGED_IN_KEY',    'bff6le1wtjbpiywscwi55vd1kfgxwavqxwraaskyhuc0jqa5mu3o915lq4nfgaoq');
define('NONCE_KEY',        'zdd2skfemj8ji1pkzwizrc53vdkpdugty4xxx7meyqey7pv69cef9ihrp9jyrrpf');
define('AUTH_SALT',        'xezcxej2zswztxahdesqrogajilei4wildcj856sv71xsgaruaujm2brkxnectaf');
define('SECURE_AUTH_SALT', 'etlnpuspdb01vjtrwzkdtv84vhwhgp9zi0i2zxrljcmrzdklokqpbq0lx0dpyuta');
define('LOGGED_IN_SALT',   'q0rktkadvoffje0zukl9fkcemn6zblwuijstt2o043pblikwpxwfvgc1cruncaqu');
define('NONCE_SALT',       'qaqwyyxrbfgr1phewht0dohsxk6efmu8vpxjjbvw2pndrxhk3snmt1iamvjaxnwy');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp9s_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
