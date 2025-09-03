-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/08/2025 às 15:16
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12
-- Modifiquei um pouco aqui para criar uma tabela caso não haja uma e adicionar alguns exemplos
-- Importe este arquivo para seu phpMyAdmin por gentileza, ele irá criar o banco e a tabela
--


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS `acqa_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `acqa_db`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `acqa_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `produtos`;

INSERT INTO `produtos` (`nome`, `descricao`, `preco`) VALUES 
('Bananas', 'Banana maçã, chegada em 18/08/2025', 2.99 ),
('Pão de Forma', 'Pão de Forma Seven Boys, chegada em 10/07/2025', 8.99),
('Arroz', 'Arroz do Padre, chegada em 20/08/2025', 15.99);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
