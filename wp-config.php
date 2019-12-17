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
define( 'DB_NAME', 'arte-tech_cmsdev' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         ':+#gXQnW`YP{+$pSlY856A7bH%1)zlnvuVAWsTxEUDf<gh<-Q{TqP[mgxc1oA6!^' );
define( 'SECURE_AUTH_KEY',  '0]0|bzFzxUrrE}$Rt9JvcO/MGwA;$Vtr,E!iI1,mLTAQ=sfj9OKUelG1TSEoI0EK' );
define( 'LOGGED_IN_KEY',    'TI^bc)L?e[*j)Z#}VCa@n2x{jB?w~dB^.F!]~U*dY)HVugq:b9]UjCIL,.TR=+@}' );
define( 'NONCE_KEY',        'j{plL-i:tmwNz%Bp?.4%tA6Sz7/aSd6:LmUrkDyi}/VQA|P|I%Kj*8Gn]|@,HXqy' );
define( 'AUTH_SALT',        '}L9Z[=I&lFbk_gG(%l[LjxLkvl;XVENROT28zJUb9)mS p^<>dx+TV] iGEwzR4G' );
define( 'SECURE_AUTH_SALT', '=+sN!WgmRi7=LS7:w;7y&1VUjKlLCOI[;a)>biYg3&{o~VW{^hTi! Qu/N[bvtq;' );
define( 'LOGGED_IN_SALT',   'T6&y?Qs1~aIwV${C|CbS74^YvE}HdZ%C|f{NIj=-.!;gy]bsm<ly$_=0[jy1b$Vb' );
define( 'NONCE_SALT',       '}Ir2X<cA4/xf}Q[O}NO2FB@}ik<<kcz`db.?3H#<4,PH}gf~e6}c]:}< !7ffZHs' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
