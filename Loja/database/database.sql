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

-- Copiando estrutura do banco de dados para loja
CREATE DATABASE IF NOT EXISTS `loja` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `loja`;


-- Copiando estrutura para tabela loja.administradores
CREATE TABLE IF NOT EXISTS `administradores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela loja.carrinhos
CREATE TABLE IF NOT EXISTS `carrinhos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `data` datetime NOT NULL,
  `ip` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `valor_frete` double(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cliente` (`id_cliente`),
  CONSTRAINT `FK_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela loja.carrinho_produtos
CREATE TABLE IF NOT EXISTS `carrinho_produtos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_carrinho` bigint(20) unsigned NOT NULL,
  `id_produto` bigint(20) unsigned NOT NULL,
  `quantidade` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_carrinho` (`id_carrinho`),
  KEY `FK_produto` (`id_produto`),
  CONSTRAINT `FK_carrinho` FOREIGN KEY (`id_carrinho`) REFERENCES `carrinhos` (`id`),
  CONSTRAINT `FK_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela loja.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela loja.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(25) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  `endereco` varchar(60) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela loja.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` bigint(20) unsigned NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `preco` double(10,2) unsigned NOT NULL,
  `foto` tinyint(1) unsigned NOT NULL,
  `qt_estoque` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categoria` (`id_categoria`),
  CONSTRAINT `FK_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
