-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.25-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para bancodb
CREATE DATABASE IF NOT EXISTS `bancodb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bancodb`;


-- Copiando estrutura para tabela bancodb.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `nr_conta` int(10) unsigned NOT NULL,
  `agencia` int(4) unsigned NOT NULL,
  `senha` varchar(32) NOT NULL,
  `letras_seguranca` varchar(32) NOT NULL,
  `saldo` double(10,2) NOT NULL,
  `nr_tentativas` tinyint(1) unsigned NOT NULL,
  `saldo_especial` double(10,2) unsigned NOT NULL,
  `foto` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela bancodb.extrato
CREATE TABLE IF NOT EXISTS `extrato` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `data` datetime NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` double(10,2) unsigned NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `operacao` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ext_cliente` (`id_cliente`),
  CONSTRAINT `FK_ext_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela bancodb.funcionarios
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela bancodb.ib_log
CREATE TABLE IF NOT EXISTS `ib_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ib_log_cliente` (`id_cliente`),
  CONSTRAINT `FK_ib_log_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
