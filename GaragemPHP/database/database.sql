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

-- Copiando estrutura do banco de dados para cadascarrosdb
CREATE DATABASE IF NOT EXISTS `cadascarrosdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cadascarrosdb`;


-- Copiando estrutura para tabela cadascarrosdb.carros
CREATE TABLE IF NOT EXISTS `carros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `ano` int(10) unsigned DEFAULT '0',
  `dt_entrada` date DEFAULT NULL,
  `valor` double(7,2) unsigned DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela cadascarrosdb.carros: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `carros` DISABLE KEYS */;
INSERT INTO `carros` (`id`, `marca`, `nome`, `ano`, `dt_entrada`, `valor`) VALUES
	(1, 'Honda', 'Civic', 2009, '2009-01-01', 41000.90);
/*!40000 ALTER TABLE `carros` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
