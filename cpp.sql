-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jan-2017 às 16:16
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cpp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fkpaciente` int(11) NOT NULL,
  `data` date NOT NULL,
  `situacao` varchar(40) NOT NULL,
  `fkremetente` int(11) NOT NULL,
  `fkmedicamento` int(11) NOT NULL,
  `manha` int(2) NOT NULL,
  `tarde` int(2) NOT NULL,
  `noite` int(2) NOT NULL,
  `quantidadedeDias` int(3) NOT NULL,
  `fkmedico` int(11) NOT NULL,
  `informacoesAdicionais` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `consultas`
--

INSERT INTO `consultas` (`id`, `fkpaciente`, `data`, `situacao`, `fkremetente`, `fkmedicamento`, `manha`, `tarde`, `noite`, `quantidadedeDias`, `fkmedico`, `informacoesAdicionais`) VALUES
(26, 0, '2017-01-15', 'nenhum', 1, 5, 1, 1, 1, 1, 2, ''),
(25, 0, '0000-00-00', 'nenhum', 4, 2, 1, 1, 1, 1, 2, ''),
(23, 10, '2016-11-15', 'Demanda Espontânea', 7, 3, 0, 0, 1, 30, 1, 'O paciente estava tranquilo!'),
(24, 10, '2016-11-19', 'Demanda Espontânea', 7, 8, 1, 0, 0, 30, 2, 'Teste'),
(19, 10, '2016-12-09', 'Acolhido e Encaminhado', 1, 2, 0, 0, 1, 30, 1, 'O paciente apresentava estado agressivo e de abstinência de drogas.'),
(27, 0, '2017-01-15', 'nenhum', 1, 5, 1, 1, 1, 1, 2, ''),
(28, 11, '2017-01-15', 'nenhum', 1, 5, 1, 1, 1, 1, 2, ''),
(29, 11, '2017-01-15', 'nenhum', 1, 5, 1, 1, 1, 1, 2, ''),
(30, 11, '2017-01-15', 'nenhum', 1, 5, 1, 1, 1, 1, 2, ''),
(31, 10, '2017-01-15', 'Acolhido e Encaminhado', 1, 11, 1, 1, 1, 30, 1, ''),
(32, 17, '2017-01-15', 'nenhum', 1, 0, 1, 1, 1, 1, 2, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `dosagem` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nome`, `dosagem`) VALUES
(2, 'Clonazepam', '2mg'),
(3, 'Diazepam', '10mg'),
(4, 'Dipirona', '500mg'),
(5, 'Alprazolam', '10mg'),
(9, 'Risperidona', '3mg'),
(8, 'Fluxetina', '20mg'),
(10, 'Tylenol', '200mg'),
(11, 'Gardenal', '200mg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE IF NOT EXISTS `medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `crm` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`id`, `nome`, `crm`) VALUES
(1, 'Flávio Mussa', 443663636),
(2, 'Antônio Carlos Pereira Reid', 436346346);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `prontuario` varchar(10) DEFAULT NULL,
  `sus` varchar(18) DEFAULT NULL,
  `RG` varchar(30) DEFAULT NULL,
  `cnh` varchar(30) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `genero` enum('M','F') NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `logradouro` varchar(300) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `cpf`, `prontuario`, `sus`, `RG`, `cnh`, `data_nascimento`, `genero`, `telefone`, `email`, `logradouro`, `numero`, `bairro`, `cidade`, `uf`) VALUES
(11, 'Ana Carolina Côre Dutra', '111.111.111-11', '23435', '3246246636', '54346634', '4646464', '1993-02-10', 'F', '(22)992344543', 'carolsjrj@hotmail.com', 'Rua Professor Antônio Álvares Parada', '508', 'Parque Aeroporto', 'Macaé', 'RJ'),
(10, 'João Ricardo Côre Dutra', '116.666.837-10', '23434', '3572575757575', '4636326236', '433453434', '1989-09-26', 'M', '(22)997634093', 'jrdutra_@msn.com', 'Rua Professor Antônio Álvares Parada', '508', 'Parque Aeroporto', 'Macaé', 'RJ'),
(17, 'ib drumond', '555.555.555-55', '', '', '', '', '1991-01-01', 'M', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `remetentes`
--

CREATE TABLE IF NOT EXISTS `remetentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `remetentes`
--

INSERT INTO `remetentes` (`id`, `nome`) VALUES
(1, 'CAPS-AD'),
(2, 'SIT'),
(3, 'Centro de Saúde Mental'),
(4, 'Hospital João Viana'),
(5, 'Hospital Henrique Roxo'),
(7, 'Demanda Espontânea');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
