<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'lm' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'wnlr__Br!lID:hu.c{:=fbT4PUS+~[0SrZ,S;!!kOUy2>0d%EY}(1*%|J!7nY4%v' );
define( 'SECURE_AUTH_KEY',  '9-9ex~1B.ui(:k^ng7B4KAr`G2]&ZiSBsWL]KLC,tu~($K]wHlpC6F,C#jv(s*4$' );
define( 'LOGGED_IN_KEY',    '/Jh.1F}?ZY!$5Twxh]RW3$..gcFoXWTM71{B=Z@$aiTl )wVfcL9)TsGjw*wM`2K' );
define( 'NONCE_KEY',        'kn9Kt<[x$($>k^6-I](y1^dIF$SmgZgrJ6fiQ@#:G]xH@ s-qf(vUjkb,T8yS}Q%' );
define( 'AUTH_SALT',        'g LKh?yG+}$Ak%9-ng+R9p`Y6F^BGDJu%-23S$G(pSo[-G69uQN^*PWFQ{O}l$uT' );
define( 'SECURE_AUTH_SALT', 'Bj&Ce`4&}H,a!JvssK)k[5AIg(XIK*jy1`](k(t(|Yeyjd^VeM#u?K0L$:bW/W7.' );
define( 'LOGGED_IN_SALT',   'D:A#NBnW2VE2/xozh,{}})zjwgh5t+NZv)6x%q(7ckiVgrIG<G73~t!:xc+d@d:/' );
define( 'NONCE_SALT',       '/+R5Jz(@fSS+x_wQOlc@{nw%+-(OAKTl6kAt/.*j_D`09/P``|_4M7;b|V+V.jW1' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
