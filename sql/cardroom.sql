-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Dez-2020 às 01:11
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

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_acumular_ponto` (`tot` INT, `id` INT)  begin
	update tb_jogador set tot_ponto = tot_ponto + tot where cod_jogador = id;
    select tot_ponto from tb_jogador where cod_jogador = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_associar_jogadores` (`cod_usuario` INT, `hash_sala` VARCHAR(255))  begin
	declare id_sala int;
	select cod_sala from tb_sala where hash = hash_sala into id_sala;
	insert into tb_area values (default, cod_usuario, id_sala);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_ranking` (`hash_sala` VARCHAR(255))  begin
	select A.cod_area, J.*, S.hash  from tb_area  A join tb_jogador J join tb_sala S on S.cod_sala = A.cod_sala and J.cod_jogador = A.cod_usuario_fk1 and S.hash = hash_sala order by J.tot_ponto, J.nome ;
end$$

DELIMITER ;

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
(1, '“Computação Gráfica é um conjunto de desenhos e técnicas para converter dados para (ou de) um dispositivo gráfico através do computador”', NULL, 0, 1),
(2, '“Computação Gráfica é somente desenhos feitos nos computadores”', NULL, 0, 1),
(3, '“Computação Gráfica é um conjunto de ferramentas e técnicas para converter dados para (ou de) um dispositivo gráfico através do computador”.', NULL, 1, 1),
(4, 'Síntese de Imagens, Processamento de Imagens e Análise de Imagens', NULL, 1, 2),
(5, 'Conclusão de Imagens, Processamento de Imagens e Análise de Imagens', NULL, 0, 2),
(6, 'Síntese de Imagens, Processamento de Imagens e repação de Imagens', NULL, 0, 2),
(7, 'Informação da posição relativa dos objetos', NULL, 1, 3),
(8, 'Distorção da posição relativa dos objetos', NULL, 0, 3),
(9, 'Movimentação da posição relativa dos objetos', NULL, 0, 3),
(10, 'Imagem, gráfico', NULL, 0, 4),
(11, 'Imagem, físico', NULL, 1, 4),
(12, 'Imagem, digital', NULL, 0, 4),
(13, 'Dispositivos visuais e dispositivos matriciais.', NULL, 0, 5),
(14, 'Dispositivos vetoriais e dispositivos de matrizes.', NULL, 0, 5),
(15, 'Dispositivos vetoriais e dispositivos matriciais.', NULL, 1, 5),
(16, 'Plotters, Scanners Tridimensionais e Roupa de RV', NULL, 0, 6),
(17, 'Mesa Digitalizadora, Scanners Tridimensionais e Roupa de RV', NULL, 1, 6),
(18, 'Mesa Digitalizadora, Head Mounted Displays e Roupa de RV', NULL, 0, 6),
(19, 'Cave, LCD, monitores', NULL, 1, 7),
(20, 'Roupa de RV, LCD, monitores', NULL, 0, 7),
(21, 'Cave, Scanners Tridimensionais, monitores', NULL, 0, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_area`
--

CREATE TABLE `tb_area` (
  `cod_area` int(11) NOT NULL,
  `cod_usuario_fk1` int(11) NOT NULL,
  `cod_sala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_area`
--

INSERT INTO `tb_area` (`cod_area`, `cod_usuario_fk1`, `cod_sala`) VALUES
(2, 1, NULL),
(3, 1, NULL),
(4, 1, NULL),
(5, 1, NULL),
(6, 1, NULL),
(7, 1, NULL);

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
  `avatar` text DEFAULT NULL,
  `tot_ponto` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_jogador`
--

INSERT INTO `tb_jogador` (`cod_jogador`, `nome`, `usuario`, `senha`, `avatar`, `tot_ponto`) VALUES
(1, 'Danilo Santana', 'danilosantana', 'fcea920f7412b5da7be0cf42b8c93759', NULL, 1530),
(2, 'Jose da Silva', 'jose', 'fcea920f7412b5da7be0cf42b8c93759', NULL, 20);

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
(1, 'o que é computação gráfica?', NULL, 1),
(2, 'quais são os tipos de computação gráficas?', NULL, 1),
(3, 'o que é oclusão?', NULL, 1),
(4, 'complete com as palavras que faltam “ toda _____ criada através de recursos computacionais deve ser representada em algum dispositivo _____ que permita a sua visualização', NULL, 1),
(5, 'E possível classificar os dispositivos de exibição (traçadores,impressoras e terminais de vídeo) em duas principais categorias quais são?', NULL, 1),
(6, 'quais desses são dispositivos de entradas?', NULL, 1),
(7, 'Quais desses são dispositivos de saídas?', NULL, 1);

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
(21, '5F92041D130C0', '2020-10-22 19:13:49', 1),
(23, '5FB6F50D8FF87', '2020-11-19 19:43:25', 1),
(24, '5FB6FFFC78433', '2020-11-19 20:30:04', 1),
(32, '5FB879B4A7807', '2020-11-20 23:21:40', 1),
(36, '5FB882402036F', '2020-11-20 23:58:08', 1),
(37, '5FB9754B3BD5B', '2020-11-21 17:15:07', 1),
(41, '5FC0147713FB2', '2020-11-26 17:47:51', 1),
(46, '5FC033C171FC4', '2020-11-26 20:01:21', 1),
(48, '5FC1668072F65', '2020-11-27 17:50:08', 1);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `v_pergunta_alternativas`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `v_pergunta_alternativas` (
`cod_altenativa` int(11)
,`altenativa` text
,`img_representacao` text
,`pergunta` text
,`cod_pergunta` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `v_pergunta_alternativas`
--
DROP TABLE IF EXISTS `v_pergunta_alternativas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pergunta_alternativas`  AS  select `q`.`cod_altenativa` AS `cod_altenativa`,`q`.`altenativa` AS `altenativa`,`q`.`img_representacao` AS `img_representacao`,`p`.`pergunta` AS `pergunta`,`p`.`cod_pergunta` AS `cod_pergunta` from (`tb_altenativa` `q` join `tb_pergunta` `p` on(`p`.`cod_pergunta` = `q`.`cod_pergunta_fk`)) ;

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
  ADD KEY `cod_sala` (`cod_sala`);

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
  MODIFY `cod_altenativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tb_area`
--
ALTER TABLE `tb_area`
  MODIFY `cod_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `cod_pergunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_sala`
--
ALTER TABLE `tb_sala`
  MODIFY `cod_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
  ADD CONSTRAINT `tb_area_ibfk_3` FOREIGN KEY (`cod_sala`) REFERENCES `tb_sala` (`cod_sala`) ON DELETE CASCADE;

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
