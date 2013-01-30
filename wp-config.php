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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'moswua_wp516');

/** MySQL database username */
define('DB_USER', 'moswua_wp516');

/** MySQL database password */
define('DB_PASSWORD', 'g45w5SP2hj');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'hc0q3dqvzoyzmlo6ktihzuhshblhu1whakz9yiqtwfxmyuwnxojd2zzxmqoscjzt');
define('SECURE_AUTH_KEY',  'b2arzmd86bvswnfadokqmbis875jcw6jz9bgsh1386qquhvcr89uzv2yq8ipltzz');
define('LOGGED_IN_KEY',    'fmwr3vkx97h4awrjmnicimoeadkliiaztnhqq70iisqrg0am4hribkoinao8uwgo');
define('NONCE_KEY',        'rwsyet2tamnrso5ucns7z4hrqruhnlmomyoc7b3hvwh8vf9wn43le3str7i1m5si');
define('AUTH_SALT',        'cwlja6gax5lehvpusdb4ebht6wsgq3bey41nr7srcrg4pzclqn1b0fx1hyega77i');
define('SECURE_AUTH_SALT', '4e1p71eccu3ew8dp2wfh2ncom2wujeo1dvlqamypimeqok4gkdr2nqhpc49smhrf');
define('LOGGED_IN_SALT',   'ebbeddpqtt4hbmpctyc3iu57sulchfb7lv9kbfzv57tjaduyjedu8u8jfsed9ovv');
define('NONCE_SALT',       'arxxbboc1pt4v7lkp6qrcbwwuax7vwcrxqepn2cxa91epir25x882htfykyenhwb');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define ('WPLANG', '');

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
