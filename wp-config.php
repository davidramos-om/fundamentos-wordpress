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
define( 'DB_NAME', 'platzigift' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'Y}WiaPzKc($D*rqNo bI?R4BEG(*AZZc/Uj6)=`~Y`xhF_[JCcCq+)#<VgNo&N=L');
define('SECURE_AUTH_KEY',  'YsSb?1s=b}qIOb)hmb`a.s9 _^%9WMl4|>YkbJC9?{5^|1}I.cd3oDp$rXyT@#0S');
define('LOGGED_IN_KEY',    '~S,d>!RE9V}Q|QD#~2NCd!{e*ik^d &A;@U=ev|(Gs]u{-%={Sf}hVU7ha-) 23{');
define('NONCE_KEY',        'b+N)oZych!ja9*^#b#56bPFTY-un(~iSbMa$7))P|2<uz/qvD};-= QJ|P6+PdcN');
define('AUTH_SALT',        '%V9+Oe`-C-<ssa(@3+bWMj[B8x UAq:^Fc3LO+wE8tZFz<sfRT8l+nZ-K)u?tQZ]');
define('SECURE_AUTH_SALT', 'M.F;c2+>di;]DT3F}ka||hWkNdR-==sAX+I:mWb2x@ZJ)~y.!af^+h7Ka[MM-T:H');
define('LOGGED_IN_SALT',   'B|_#%6b%9A6]Z~sr:(|F(c[N<?c1@4jSoeb`~qN@KSfy&&wE6EjV_yc.6`3,]5!V');
define('NONCE_SALT',       'R+wHjch6aXr`k}HonR-N-iB-uFKRn@O=Ghl]LhRI*3mHX=5qefv:Q^AooH:bzCXo');

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
define( 'WP_DEBUG', true );

define( 'UPLOADS', 'wp-content/uploads');

define('FS_METHOD','direct');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

define('CONCATENATE_SCRIPTS', false);

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
