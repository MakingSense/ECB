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
define('DB_NAME', 'ecb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'satelite');

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
define('AUTH_KEY',         'vu7bse-X{e4iHRKZeN%+P0AEv<fg*YXIB(]t*#*S[(e+q+55@#/{4o,hf,Ml<gLf');
define('SECURE_AUTH_KEY',  'K8d8Q/Y3m:adj+Wfih}1jX$PYcZN{>`L|<k%2=#Z?17wp8CS(#9P2Q$N$5JPIY;z');
define('LOGGED_IN_KEY',    'T*A=P2p8+BD&(*<QquO p&I8<ZdY;-Cv~1_4ciUd|7$5YL {9 0Eap=14t~KCsWY');
define('NONCE_KEY',        'ZL_HI=v^Y47E$/`bBx/Ua2=ezXSb;]/.!mtdQPbYRAAFsJwxH<~^^O-Bo!F)7wJ2');
define('AUTH_SALT',        '@@)W><w2J%HcYus3/Bw-I`z-Ms>4=:P Um[hE+DeoRqaJ;:Kyw@G;%jUq5&MQTdK');
define('SECURE_AUTH_SALT', ']ceB6W1UV}/rG{@q/7JxA-4Ip5JBWkj9Shqev{_oOqy=Fxt 226,`$zX<ensJbiE');
define('LOGGED_IN_SALT',   'B~zI7u:62m8r2de-lg</*Cf!%vS.-&X:XBuu;lh`jZha~=PG{b`RdRPke]A||gV~');
define('NONCE_SALT',       'X2#xYobcd|glRQH%|o_>pEG%a[es1;e?<PzEz?.31<S^K*J[^SU%zV<g.RE^3>@`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ecb_';

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
