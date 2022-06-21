<?php
/** CONSTATES COM AS INFORMAÇÕES PARA ACESSO AO BANCO MYSQL */
define('DB_HOST','localhost');
define('DB_NAME','banco_sistema_agenda');
define('DB_USER','root');
define('DB_PASS','');
/** HABILITA MENSAGENS DE ERRO */
ini_set('display_errors','true');
error_reporting(E_ALL);
/**INCLUI O ARQUIVO DE FUNÇÕES */
require_once 'funcoes.php';
?>