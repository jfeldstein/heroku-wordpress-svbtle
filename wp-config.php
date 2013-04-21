<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Heroku Postgres settings - from Heroku Environment ** //
$db = parse_url($_ENV["DATABASE_URL"]);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', trim($db["path"],"/"));

/** MySQL database username */
define('DB_USER', $db["user"]);

/** MySQL database password */
define('DB_PASSWORD', $db["pass"]);

/** MySQL hostname */
define('DB_HOST', $db["host"]);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'PyV/}-)-w8v,@j(=8#2e`NwIDR)D@{ES|:hvV+CJ3JRgy+6/;-u}G;9(+k3Snwv]');
define('SECURE_AUTH_KEY',  '~I.(ci+ >To#</PCAv4UM+OO%kqBt3H-%z3H%r-Do9?y.QD&+A*@Tdt3B|;]|;Rj');
define('LOGGED_IN_KEY',    'e?TKaUHFEN,(Pf!gaweP? 3Swz4YD7Y[86-%0m}!~S<F1R/jo&Jg@0,l#`y&8Kgf');
define('NONCE_KEY',        'cL*{oJr7y3Y,.BT:] <GR4&d^C}h-kg?Z.h.I,{Vl|2wy&_,Gx6O+lS^o19cU&$3');
define('AUTH_SALT',        '|ucQ<LogzGmU3#,[8OKU&W8!1EZ2dFE]pW72`^3I0n}k+@|7bKxZ1-2oGZN`dspu');
define('SECURE_AUTH_SALT', 'zsf&c7$M]O,*Fe|l%Yts#hv|{#VMcRi:Mt,D-u0tY.3+Mj<|d_l_VKCK,A7Idc3K');
define('LOGGED_IN_SALT',   'UPR87`Ml6feR &p<XLP(n1GB(+8g[7$.kj5<|~<e-CKm?LQVH6+kYx|?~+d-G-~z');
define('NONCE_SALT',       '^Jh?%<o5Fy Vz[JSn`4{4Q?&oa^xg5U8G9jd;?A~aMF%i[Q<-{h5<qSh5qeyao8)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
