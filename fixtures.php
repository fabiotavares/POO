<?php

require_once("src/FT/Cliente/Util/parametros.php");
require_once('Dados.php');

define('CLASS_DIR', 'src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register();

function execSQL($sql, \PDO $conn)
{
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();
}

try {
    //------------------------ BANCO DE DADOS -------------------------------
    //conecta ao servidor mysql
    $conn = new \PDO($driver.":host=".$host, $dbUser, $dbPass);

    //cria o banco de dados se ainda não existir
    $sql = "CREATE DATABASE IF NOT EXISTS `".$dbName."` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
    execSQL($sql, $conn);

    //conecta ao banco de dados
    $conn = new \PDO($driver.":host=".$host.";dbname=".$dbName, $dbUser, $dbPass);

    //----------------------- TABELAS --------------------------------
    //crie a tabela CLIENTES se ela ainda não existir
    $sql = "CREATE TABLE `{$dbName}`.`clientes` (
            `id` int(5) NOT NULL AUTO_INCREMENT,
            `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
            `razao_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
            `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
            `cpf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
            `cnpj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
            `nascimento` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
            `sexo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
            `end_principal` int(5) DEFAULT NULL,
            `end_cobranca` int(5) DEFAULT NULL,
            `end_iguais` int(1) DEFAULT NULL,
            `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
            `classe` int(1) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `end_p_idx` (`end_principal`),
            KEY `end_c_idx` (`end_cobranca`),
            CONSTRAINT `end_p` FOREIGN KEY (`end_principal`) REFERENCES `enderecos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
            CONSTRAINT `end_c` FOREIGN KEY (`end_cobranca`) REFERENCES `enderecos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    execSQL($sql, $conn);

    //apague qualquer conteúdo existente
    $sql = "TRUNCATE TABLE `{$dbName}`.`clientes`;";
    execSQL($sql, $conn);

    //crie a tabela ENDERECOS se ela ainda não existir
    $sql = "CREATE TABLE IF NOT EXISTS `{$dbName}`.`enderecos` (
      `id` int(5) NOT NULL AUTO_INCREMENT,
      `tipo` int(1) NOT NULL DEFAULT '1',
      `logradouro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
      `numero` int(5) NOT NULL,
      `bairro` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
      `cep` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
      `cidade` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
      `estado` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    execSQL($sql, $conn);

    //apague qualquer conteúdo existente e volte o contador autoincrement para 1
    $sql = "DELETE FROM `{$dbName}`.`enderecos` WHERE id>0;
            ALTER TABLE `{$dbName}`.`enderecos` AUTO_INCREMENT = 1;";
    execSQL($sql, $conn);

    //----------------------------------------------------------

    //instanciando um objeto Dados injetando uma conexão PDO
    $dados = new Dados($conn);
    //alimentando o banco de dados com 10 clientes
    $dados->flush();

    echo "\nFixtures executadas com sucesso.\n";

} catch (\PDOException $ex) {
    die("Erro de conexão<br />Código: ".$ex->getCode()."<br />Mensagem: ".$ex->getMessage());
}
