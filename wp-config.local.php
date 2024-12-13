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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', filter_input(INPUT_ENV, 'WORDPRESS_DB_NAME'));

/** MySQL database username */
define( 'DB_USER', filter_input(INPUT_ENV, 'WORDPRESS_DB_USER'));

/** MySQL database password */
define( 'DB_PASSWORD', filter_input(INPUT_ENV, 'WORDPRESS_DB_PASSWORD'));

/** MySQL hostname */
define( 'DB_HOST', 'wp_db');

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'l`[n(V+<Vhz@|gfOgE+ypl g4mt6<{S|VgJ1$E4aN`^u>*HAW_,JfoQcT=gQCn|i');
define('SECURE_AUTH_KEY',  'h(`U)vXV/_g07zE7&D5($lEc8;|pQGln*-Kh;Lh)Vtc?l]#XlY$A_xda;|>S0:J:');
define('LOGGED_IN_KEY',    'B0i.Usk%>r2^B_Iid#{Js36hT>U!2sE om|)/-<HyddmX+O]:%GcaeVu^Iy)?JXW');
define('NONCE_KEY',        'Nhd}lVF^ujv1+O}0QxXj4&S>&+d^3~:`W`amU-nXbNcQTZxM2FK7KFwAN|PKqUV-');
define('AUTH_SALT',        'g oO-%T53-<QJ57KPt-s;c>xg]d3Tkj(R;9d}3+94ak&RdP/zw}l#O.M5x5`MEP+');
define('SECURE_AUTH_SALT', 'Q)<%PsmAA-M^oq.-c6?EoC&v|>-:N>JJh*xmY/PuO`[3}+AXzqJ%o5b2e)&3SJ]r');
define('LOGGED_IN_SALT',   'pJ[SEY@D>|B`]+J:m%LI)-`.jJ~fD!!m6Yh|3?l$~aF%TFKJ!x-J6Q2aN7E+^Jr0');
define('NONCE_SALT',       'C|O=cHc7Hb5Y<x#yUgYj%v=K:Q&ozjgu*bm(({~A/*:iq>%^aNuwT(~Qr914.q+A');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ca_wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

//  Localhost modifications
// define('WP_DEBUG', false );
// define('WP_HOME','https://national.v7');
// define('WP_SITEURL','https://national.v7');

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy

// This determines if Wordpress attempts SSL or not
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
