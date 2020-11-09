<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'ypyfranquia' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'admin' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '123456789' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'T!pN7I_xo(l*s;NJh?mEWPr9_7frJ?@o_Q$aN^V%[HxBvb&Q^V{Lpcyt 0+y|rN#' );
define( 'SECURE_AUTH_KEY',  '7yGz)F_&:.5$)(l_?Nv= :SH38n]49[a%5P;)!xP(?rW*Wo,H+g/|OWDZP7&F/n=' );
define( 'LOGGED_IN_KEY',    'G<NLffZB@>f`}5ZeZ&bTq:Cz~&VLe&3:BHW]QeQFv [osMTK]2+xb8{A}gd<^JKV' );
define( 'NONCE_KEY',        '?;=mE^D~aQsAw?h+$.CJ~crpGs<Did)em bB@h{Q^Yk4-7n[i9E[-{tt547G*vX|' );
define( 'AUTH_SALT',        '<4{.YQ7%#W=/7hQDP _DmnR@Kgi<yJ~]Ua+s*C@RJ%%3EPgr._oUw&lr[k>QpQ@J' );
define( 'SECURE_AUTH_SALT', ':~ =8z(ccR_2/Nv=(zfC#r]4 (~-Q$c%f?auoTMISb=_^B@L%gT7b[wC0{#yM8}%' );
define( 'LOGGED_IN_SALT',   '`s~4kBQ):q)3ldOoFU|g{n/T$b:M!VQ3<mxe$S;7S>fpip,i {iD6.WG{Qw_WbWK' );
define( 'NONCE_SALT',       '-[3[r=Th{X^&;B<`xy,)M<[d5vPg9a?.::Tm;h}x4},@H_4|tEui|nb.hGw}q2Eu' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
define('FS_METHOD','direct');
