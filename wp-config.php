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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'portalivantoro');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'tz;zh#| 2LP/cZeEL/<RC[R/L&8!ISP3j%R,;x^b [qQ4VUDtg2|dM-O+;(vj)n/');
define('SECURE_AUTH_KEY',  'U5~itRo%HhDfXW0j0Jym~1-C~WXRMmk84@lS02aA+rq[GSZ#B-.YM>Xf!<ql`%*L');
define('LOGGED_IN_KEY',    '}[{?2$n8{e_:u9[.f ,K^5EjU4J3LWM9!~,pQ-Fw0ab`()g%Kb|^)5yPC2fs&B_S');
define('NONCE_KEY',        'RFEXG4B{g+dMHFu|i0-p1.(t(X,v2B/vUpjE6=!|__DQzU &9=]VYK;l0ydq=wK/');
define('AUTH_SALT',        'L|J*az-7j@1Z,>Y&G2H7T!ZKM%;nD#Qi>YlPKh&/&x6VwyJN+{GthFlmE)Nn+VX6');
define('SECURE_AUTH_SALT', 'iEE{>;)|)R8XD DkPsmgk`}H?Why(F+J d^=[:pidFiao^s!xq{z{@q=uqu4D2sT');
define('LOGGED_IN_SALT',   'vH^~Tvr4vRo9_IYqIKyFm(4ULIn7{d+S5=M@G2KSZH|B+xmh]fRg. Wd1(pH;drk');
define('NONCE_SALT',       '_Qr{#/.?vDa){Smv+xCCg:$u;1]AA1J05_zs1l|&t5h w=p{+|Uc!KhI7(g5E@n5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
