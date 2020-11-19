-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Nov-2020 às 22:58
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cardroom`
--
CREATE DATABASE IF NOT EXISTS `cardroom` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cardroom`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_altenativa`
--

CREATE TABLE `tb_altenativa` (
  `cod_altenativa` int(11) NOT NULL,
  `altenativa` text NOT NULL,
  `img_representacao` text DEFAULT NULL,
  `is_correta` tinyint(1) DEFAULT NULL,
  `cod_pergunta_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_altenativa`
--

INSERT INTO `tb_altenativa` (`cod_altenativa`, `altenativa`, `img_representacao`, `is_correta`, `cod_pergunta_fk`) VALUES
(1, 'Visao 1', NULL, 0, 1),
(2, 'Visao 2', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_area`
--

CREATE TABLE `tb_area` (
  `cod_area` int(11) NOT NULL,
  `cod_usuario_fk1` int(11) NOT NULL,
  `cod_usuario_fk2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_disciplina`
--

CREATE TABLE `tb_disciplina` (
  `cod_disc` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_disciplina`
--

INSERT INTO `tb_disciplina` (`cod_disc`, `nome`) VALUES
(1, 'Computação Grafica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_jogador`
--

CREATE TABLE `tb_jogador` (
  `cod_jogador` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_jogador`
--

INSERT INTO `tb_jogador` (`cod_jogador`, `nome`, `usuario`, `senha`, `avatar`) VALUES
(1, 'Danilo Santana', 'danilosantana', 'fcea920f7412b5da7be0cf42b8c93759', NULL),
(2, 'Jose da Silva', 'jose', 'fcea920f7412b5da7be0cf42b8c93759', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pergunta`
--

CREATE TABLE `tb_pergunta` (
  `cod_pergunta` int(11) NOT NULL,
  `pergunta` text NOT NULL,
  `img_representacao` text DEFAULT NULL,
  `cod_disc_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_pergunta`
--

INSERT INTO `tb_pergunta` (`cod_pergunta`, `pergunta`, `img_representacao`, `cod_disc_fk`) VALUES
(1, 'O que Visao computacional', NULL, 1),
(2, 'O que Realidade aumentada?', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sala`
--

CREATE TABLE `tb_sala` (
  `cod_sala` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `cod_jogador_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_sala`
--

INSERT INTO `tb_sala` (`cod_sala`, `hash`, `data_criacao`, `cod_jogador_fk`) VALUES
(20, '5F8F40A71B630', '2020-10-20 16:55:19', 1),
(21, '5F92041D130C0', '2020-10-22 19:13:49', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_altenativa`
--
ALTER TABLE `tb_altenativa`
  ADD PRIMARY KEY (`cod_altenativa`),
  ADD UNIQUE KEY `altenativa` (`altenativa`) USING HASH,
  ADD KEY `cod_pergunta_fk` (`cod_pergunta_fk`);

--
-- Índices para tabela `tb_area`
--
ALTER TABLE `tb_area`
  ADD PRIMARY KEY (`cod_area`),
  ADD KEY `cod_usuario_fk1` (`cod_usuario_fk1`),
  ADD KEY `cod_usuario_fk2` (`cod_usuario_fk2`);

--
-- Índices para tabela `tb_disciplina`
--
ALTER TABLE `tb_disciplina`
  ADD PRIMARY KEY (`cod_disc`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `tb_jogador`
--
ALTER TABLE `tb_jogador`
  ADD PRIMARY KEY (`cod_jogador`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Índices para tabela `tb_pergunta`
--
ALTER TABLE `tb_pergunta`
  ADD PRIMARY KEY (`cod_pergunta`),
  ADD UNIQUE KEY `pergunta` (`pergunta`) USING HASH,
  ADD KEY `cod_disc_fk` (`cod_disc_fk`);

--
-- Índices para tabela `tb_sala`
--
ALTER TABLE `tb_sala`
  ADD PRIMARY KEY (`cod_sala`),
  ADD UNIQUE KEY `hash` (`hash`),
  ADD KEY `cod_jogador_fk` (`cod_jogador_fk`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_altenativa`
--
ALTER TABLE `tb_altenativa`
  MODIFY `cod_altenativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_area`
--
ALTER TABLE `tb_area`
  MODIFY `cod_area` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_disciplina`
--
ALTER TABLE `tb_disciplina`
  MODIFY `cod_disc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_jogador`
--
ALTER TABLE `tb_jogador`
  MODIFY `cod_jogador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_pergunta`
--
ALTER TABLE `tb_pergunta`
  MODIFY `cod_pergunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_sala`
--
ALTER TABLE `tb_sala`
  MODIFY `cod_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_altenativa`
--
ALTER TABLE `tb_altenativa`
  ADD CONSTRAINT `tb_altenativa_ibfk_1` FOREIGN KEY (`cod_pergunta_fk`) REFERENCES `tb_pergunta` (`cod_pergunta`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_area`
--
ALTER TABLE `tb_area`
  ADD CONSTRAINT `tb_area_ibfk_1` FOREIGN KEY (`cod_usuario_fk1`) REFERENCES `tb_jogador` (`cod_jogador`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_area_ibfk_2` FOREIGN KEY (`cod_usuario_fk2`) REFERENCES `tb_jogador` (`cod_jogador`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_pergunta`
--
ALTER TABLE `tb_pergunta`
  ADD CONSTRAINT `tb_pergunta_ibfk_1` FOREIGN KEY (`cod_disc_fk`) REFERENCES `tb_disciplina` (`cod_disc`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_sala`
--
ALTER TABLE `tb_sala`
  ADD CONSTRAINT `tb_sala_ibfk_1` FOREIGN KEY (`cod_jogador_fk`) REFERENCES `tb_jogador` (`cod_jogador`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
