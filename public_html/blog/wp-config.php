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
define('DB_NAME', 'laundryb_ldb');

/** MySQL database username */
define('DB_USER', 'laundryb_lusr');

/** MySQL database password */
//define('DB_PASSWORD', '.aPdAa9hkt%@');
define('DB_PASSWORD', 'x~[i#[96J;Sq');
/** MySQL hostname */
define('DB_HOST', '132.148.21.135');

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
define('AUTH_KEY',         'BI;2[oMn2Ukdr+=% TPvw/nX sQl oq%GTT-p},N8C?%k|fJgC@rzXs7!dxm*/zU');
define('SECURE_AUTH_KEY',  ';SNcGOk5U1^T,oQFIn)K&6Wz7^_nZBJO_z^fc;V7|GDqM;~)cl}+n4%kpj)c/d^b');
define('LOGGED_IN_KEY',    'ki9Aste}2Oe(pwlEh(FQZms`kQvz{PAvdB(jeq*sCwLQKV09X:3wLS0-+jzXtKb<');
define('NONCE_KEY',        '&SC<@M/fRjFEogRK)]K~&>+e&f6u/ly9Ow|wp~e59E[e4~MFUIDVS^biW(,+.q0B');
define('AUTH_SALT',        'mFav@F,UQ7Gkb_eEKM6ihc>:E$W45hX~NSn+E;=0J9v.RZOW>{,?1OfgKBofZL]#');
define('SECURE_AUTH_SALT', 'DSEb r8N#[YN@$BwxVU-x$s*+a~8Gvf+wGiaBIipgX1i#G4~=Q-0mS6t+>)fS]`Z');
define('LOGGED_IN_SALT',   'eY)4^#E(JHy3)e!QDb6ZPTdl^/zL`U4TH^)_unRgp:Wm;Dz*)^SR^[pzL~xq*DV%');
define('NONCE_SALT',       '5f:ZF`lHC`zwU.Zb82P_G^TBD7o[%t526PKaf8,R($v*NEfkHne=-!%{a@LecR:*');

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
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
