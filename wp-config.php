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
define( 'DB_NAME', 'gallery' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'UI# [Jg_)7X2hPD2vtwKl>jFiDIj.O.wW&H$O2c/bnFZ3iH6uXNC5$lG3c#C]+}b' );
define( 'SECURE_AUTH_KEY',  'la=.p5,wFVOM]ObyEY+6-L%yOwIYz0Age<8_;!j_)k8Qy+-5+S?IgkFgQ=M)b~3~' );
define( 'LOGGED_IN_KEY',    ' !<S)9GpvmaDtECD>tQHV=Q-@O)4CGMQ=i4nyW.QeOM/V I>x`HWO`q+.g9-YUL)' );
define( 'NONCE_KEY',        'EnDi8vqOp1H_(w_2z.^p4)mO(H-z*2KRcl}=t8QQw<G->|XJO@j;L,Ev!8T!CbIB' );
define( 'AUTH_SALT',        '-a&:JZlZ~@F3rG~jqpW7bs2V4>hBLe!2(2_11r]B:0d[(]EE!}OUd<4$JJM0(~9t' );
define( 'SECURE_AUTH_SALT', 'pU/wJP>XK?J9Fq~c =$9w!(@#UM9&7?Q{$/)_BFh{iOx[<ht=?iwqbw!1*@)/L{N' );
define( 'LOGGED_IN_SALT',   ')cIAy>b&elX>l`IUq{uwCR^.sxfcIIjc){PD~CdqH-GHGhp3>{Wo9>cZwA90d.#N' );
define( 'NONCE_SALT',       '4Wni$nJ9?zx6;$MQqdsj53@Q[1gGWn+/fWCb ro0wk=*%_!xwEsUVMUjpPs>#LJ?' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
