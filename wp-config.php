<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'addweb_wp' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'GmsbelzR}$TxFu__kut.5DJOt<!3;1,,3*H5sA^hyHXh_pkPidPTi^7++1?_@$hF' );
define( 'SECURE_AUTH_KEY',  'Vnw:/7Fc1v=Uz{K@3ws:m->=W-VLoBLE1S7=GKP`,@aLB4.kdHlUgv=s6HH:Yt3F' );
define( 'LOGGED_IN_KEY',    '6DyHM|>n>je{S,$:*/:1+jro+2GEc,I?xMb%q^(S0.85|qLm{7irz8& UJwPr|<b' );
define( 'NONCE_KEY',        ']=` n[k>1NjL&p-<;*MZ:K{YJbfXX+b$4rEpFb92z7}QvmSH}L}Rh9<C^UgVhXT7' );
define( 'AUTH_SALT',        'S[u9SKz~:-<&}++hW -(#<Pt(F=y$vA5kzR mPhctyxsGYNK>6c[_.K@Qyfs8z}S' );
define( 'SECURE_AUTH_SALT', 'ZRAemxfCnj*Tj!mo~XW=X0c8Wu$;8rd(%7=CTt#&E;uMiea)C0caD5.BRvm^^{$4' );
define( 'LOGGED_IN_SALT',   '+A.;SEX&o[^S8bhp~m02KC`Ae5HFDGN?Xn|oYrMSCD^1is>o bZq C!WPY+BIx%`' );
define( 'NONCE_SALT',       'c{+t<qlUm}bw&%nsM2%EKr_jtBd4Ig?]:&Wa:/LMbwT_fo^V}%iXE*D<:d>_VuMI' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
