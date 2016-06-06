CREATE DATABASE IF NOT EXISTS `eventos_ingressos`;
USE `eventos_ingressos`;

CREATE TABLE IF NOT EXISTS `consumidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(50) DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `data_realizacao` date DEFAULT NULL,
  `organizador` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `lotacao_maxima` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `publicado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tipos` (`id`, `nome`) VALUES
	(1, 'Show'),
	(2, 'Balada'),
	(3, 'Teatro'),
	(4, 'Esporte');