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
define('DB_NAME', 'Conselho');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'usbw');

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
define('AUTH_KEY',         'wmc^2Y3CSvi:1<$_P$)j32q${)oY?0`7$|3&}+A:Sa=`FGlABy-.[Aj<eR&FyETX');
define('SECURE_AUTH_KEY',  'CWh^gt$?.>!]%<S^1w>W5B*O-Ta|.96]s2rE5afP.CO1rQL]ljk*~34a|[^WpW-3');
define('LOGGED_IN_KEY',    'yP/1;.=iIG?[m/<XcLq[] 2LwCKFLVnm`820,/30a`2hO<n7=+aH_bMJ-q_m`8Bh');
define('NONCE_KEY',        'b4.(mq|?o8rV|!1KXA|,EcLBt)07u&rT)k:u}kH2r@q-+Z@d*<NCND?xwQqIgU*(');
define('AUTH_SALT',        '!~<tN&8&+<HwPw|3n+qnV;2%Jq<kHf zp6/3`tyJ)Ls#d~O2qWD>^#bnn {dvp+-');
define('SECURE_AUTH_SALT', '>+`&wypcD#29N-uOSzR)ule6g>A.a9X?J2NiK+~QKT@#16zD>/4NNA~se4N[FZ$j');
define('LOGGED_IN_SALT',   '?rzB2A*tK|<qO,w?W-Sf|RXhq,*3)3<JZm;16eTxIUJnT0e|sHfaLp:>YO[_ dK+');
define('NONCE_SALT',       '~XM;s^wx-s4Vp2[< 4jXd@2a,2P+C+wVD&};7v=FVIM`2*zl+Os8Blr/iQ)L!lU^');

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
