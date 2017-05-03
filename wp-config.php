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
define('DB_NAME', 'parcours-bijoux');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '<?tpAmqlr`MSjDkfS/c|3}g,l#{P6*TkJhk=3eXc0N(Bns#Q;bOoyB0 SetpZ%}0');
define('SECURE_AUTH_KEY',  '#b`=L/P*palONl;4m}3J?UFvrOZbbP.3#8!c0wjz{GHvr7V7~)/s6oR>5D.W;BYi');
define('LOGGED_IN_KEY',    'uLN#zCIKU5jPKD@gIWAI-E-y:[qrd:,M`x=*{AR/ZW)ocf8,gqn?uSB 3:F1D1R9');
define('NONCE_KEY',        '28R,G7#9Kn>+):dv&Rkj!~_p$#_Vq6(=*d=g_B@} P9!<&Wua{p|y)!&D1n: IO~');
define('AUTH_SALT',        '~-9bFue&gItc(eKF?%Q:C=?6z^Q,<wj}6[_.qafqHNF9~p3LFw c5T0$6(:7mqN_');
define('SECURE_AUTH_SALT', '@#94v5HgdGR<Mbu!oKFmJ~em|1ft}[G5U[dT~%4a^ylfLe+KQK$D+)IQbG.P[@ha');
define('LOGGED_IN_SALT',   ')|JLhba^8*9lyHc&35kuvgT}FzwN>89OZgyU8$@!)c1a@wm=WYYymo#no]2Xf B3');
define('NONCE_SALT',       ',HQGc+zfnHETgXNBi}]L%<$u>+1%<~-*`f>ZSK`md)~WYR(&~91l&yJDKG~&~#_@');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

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

/* Empêche la MAJ automatique du wordpress */
define( 'WP_AUTO_UPDATE_CORE', false );

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');