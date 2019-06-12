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
define('DB_NAME', 'quinnstheprinters');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'welcome');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=P/sjLz3TTI!vR4-#G@! A~Pqgza-$NGOV|*ra%mt[LZ7<rWOcXldpbvkuRXP_T2');
define('SECURE_AUTH_KEY',  'Zn(ags.o9G1p@Jl0](Xu%W0eG`dChD-NW@5oI[F>![J)O/Nzlb|<`@1eGH.188]<');
define('LOGGED_IN_KEY',    'PmA$UJm<KcUH6x T@w<)X/PX*)9a:|>oQmWWE86+^;&#r,4Pz[ShMV^q.$Haaj[f');
define('NONCE_KEY',        '#B>!huP#uut;`]*|:6V*kN(_va;cj wI-A][9nD]Gu/E{/xtP2gODXBN f45(esW');
define('AUTH_SALT',        '{<?J1YH+hw3vu9aA{/GEKAmlyijPQ)^@Ril$7}RcPkL8nSQvC=&F8V}~kPQ}xj7G');
define('SECURE_AUTH_SALT', '*BSTxiIET}cE<$sk_]tzi_@(YsLvQ9>zJUL@+:>LAFH>jOsHOzIh+W(-v|CnD&z@');
define('LOGGED_IN_SALT',   'MdTYk8/*Np=9NpHMlY^F)&Jkg[2&#|F}!3=;wUq|7.&fTu*~)K#_LGo)LUK[=}h2');
define('NONCE_SALT',       'Hs2,4ur!5Kh]b%Hr4%eHIFqOs}R%s:bo #,AlxjcoX(G}*tc8z19K;y>^|!3pV!1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'blog_';

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
