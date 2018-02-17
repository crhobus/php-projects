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

-- Copiando estrutura do banco de dados para arremato
CREATE DATABASE IF NOT EXISTS `arremato` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `arremato`;


-- Copiando estrutura para tabela arremato.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo_pessoa` char(1) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `rg` varchar(50) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `estado_civil` tinyint(1) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `oferta_parceiros` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela arremato.clientes: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;


-- Copiando estrutura para tabela arremato.departamentos
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela arremato.departamentos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` (`id`, `nome`) VALUES
	(3, 'Informatica');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;


-- Copiando estrutura para tabela arremato.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_departamento` bigint(20) unsigned NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `lance_inicial` double(10,2) unsigned NOT NULL,
  `lance_atual` double(10,2) unsigned NOT NULL,
  `foto` tinyint(1) unsigned DEFAULT NULL,
  `data_encerramento` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categoria` (`id_departamento`),
  CONSTRAINT `FK_categoria` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela arremato.produtos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `id_departamento`, `nome`, `descricao`, `lance_inicial`, `lance_atual`, `foto`, `data_encerramento`) VALUES
	(1, 3, 'Placa Mãe ASUS', 'MB ASUS P/INTEL RAMPAGE III EXTREME 1366 I7 BOX PROTUDO COM AVARIAS, SEM A VERIFICAÇÃO DE DEFEITOS, AUSÊNCIA DE PEÇAS VISIVEIS OU OCULTAS, SEM GARANTIA.', 150.00, 450.00, 1, '2015-09-20 20:42:41'),
	(2, 3, 'SIII Mini Samsung', 'SAMSUNG GALAXY SIII MINI C/ ANDROID 4.1, TELA SUPER AMOLED, DUAL CORE 1GHZ, CÂM 5MP, 8GB - I8190 BRANCO. PRODUTO SEM VERIFICAÇÃO DE DEFEITOS, AUSÊNCIA DE PEÇAS VISÍVEIS OU OCULTAS, SEM GARANTIA', 50.00, 50.00, 1, '2015-09-30 21:08:29'),
	(3, 3, 'Projetor Vivitek', 'PROJETOR VIVITEK HT-8602 QU CA - H1081 - 9228 COM CONTROLE / CABO. PRODUTO COM AVARIA(S), SEM A VERIFICAÇÃO DE DEFEITOS, AUSÊNCIA DE PEÇAS VISÍVEIS OU OCULTAS, SEM GARANTIA', 1.99, 1.99, 1, '2015-09-18 21:11:06');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
