-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Jun-2022 às 16:13
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco_sistema_agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `numeros`
--

CREATE TABLE `numeros` (
  `NumeroID` int(11) NOT NULL,
  `Numero` varchar(255) NOT NULL,
  `UsuarioID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuarioID` int(11) NOT NULL,
  `NomeUsuario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `numeros`
--
ALTER TABLE `numeros`
  ADD PRIMARY KEY (`NumeroID`),
  ADD KEY `numeros_ibfk_1` (`UsuarioID`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuarioID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `numeros`
--
ALTER TABLE `numeros`
  MODIFY `NumeroID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UsuarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `numeros`
--
ALTER TABLE `numeros`
  ADD CONSTRAINT `numeros_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`UsuarioID`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
