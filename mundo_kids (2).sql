-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/08/2025 às 13:39
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mundo_kids`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `fk_faixa_etaria` int(11) NOT NULL,
  `nome_da_categoria` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`ID`, `fk_faixa_etaria`, `nome_da_categoria`, `tipo`) VALUES
(1, 1, '515', 'hehar');

-- --------------------------------------------------------

--
-- Estrutura para tabela `codigos`
--

CREATE TABLE `codigos` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `faixa_etaria`
--

CREATE TABLE `faixa_etaria` (
  `ID` int(11) NOT NULL,
  `limitacao` int(11) NOT NULL,
  `idade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `faixa_etaria`
--

INSERT INTO `faixa_etaria` (`ID`, `limitacao`, `idade`) VALUES
(1, 120, 0),
(2, 11, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `id_videos_id_playlist`
--

CREATE TABLE `id_videos_id_playlist` (
  `ID` int(11) NOT NULL,
  `fk_videos` int(11) NOT NULL,
  `fk_playlist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL,
  `nome_pai` varchar(100) NOT NULL,
  `nome_mae` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `data_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome_pai`, `nome_mae`, `telefone`, `data_nascimento`) VALUES
(32, 'Guilherme Moura', 'Guilherme Moura', 'guigatomoura@gmail.c', '0000-00-00'),
(35, 'sg', 'gd', '(00) 05205-5050', '0000-00-00'),
(36, 'sg', 'gd', '(00) 05205-5050', '5050-06-05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `playlist`
--

CREATE TABLE `playlist` (
  `ID` int(11) NOT NULL,
  `fk_videos` int(11) NOT NULL,
  `nome_playlist` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `fk_pessoa` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(110) NOT NULL,
  `is_adm` tinyint(1) DEFAULT 0,
  `nome` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`fk_pessoa`, `ID`, `email`, `senha`, `is_adm`, `nome`) VALUES
(NULL, 6, 'guigatomoura@gmail.com', '$2y$10$yUSdMp8fIVQdjjCCQ1dL6O9sq1lD2B9MlnZDnllk0faN2BzFgy6B.', 1, ''),
(NULL, 9, '31@gmail', '$2y$10$3v2A7kVhqcJOnlnNOJH7R.cWuSgsANQSyF29.TzAf3TMBonrzunj.', 0, 'gui'),
(NULL, 10, '310@gmail', '$2y$10$PY.mBuDGv1rLh.r9L.QEtuERP5aP6Tw3e4gmZ8LJlQGh1w1IU3ugq', 0, 'gui');

-- --------------------------------------------------------

--
-- Estrutura para tabela `videos`
--

CREATE TABLE `videos` (
  `ID` int(11) NOT NULL,
  `fk_categoria` int(11) NOT NULL,
  `fk_playlist` int(11) NOT NULL,
  `nome_video` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `curtir` tinyint(4) NOT NULL DEFAULT 0,
  `salvar` tinyint(4) NOT NULL DEFAULT 0,
  `assistir_mais_tarde` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_faixa_etaria` (`fk_faixa_etaria`);

--
-- Índices de tabela `codigos`
--
ALTER TABLE `codigos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `faixa_etaria`
--
ALTER TABLE `faixa_etaria`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `id_videos_id_playlist`
--
ALTER TABLE `id_videos_id_playlist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_videos` (`fk_videos`),
  ADD KEY `fk_playlist` (`fk_playlist`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_videos2` (`fk_videos`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_pessoa` (`fk_pessoa`);

--
-- Índices de tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_categoria_ID_videos` (`fk_categoria`),
  ADD KEY `fk_playlist2` (`fk_playlist`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `codigos`
--
ALTER TABLE `codigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `faixa_etaria`
--
ALTER TABLE `faixa_etaria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `id_videos_id_playlist`
--
ALTER TABLE `id_videos_id_playlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `playlist`
--
ALTER TABLE `playlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_faixa_etaria` FOREIGN KEY (`fk_faixa_etaria`) REFERENCES `faixa_etaria` (`ID`);

--
-- Restrições para tabelas `id_videos_id_playlist`
--
ALTER TABLE `id_videos_id_playlist`
  ADD CONSTRAINT `id_videos_id_playlist_ibfk_1` FOREIGN KEY (`fk_videos`) REFERENCES `playlist` (`fk_videos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_videos_id_playlist_ibfk_2` FOREIGN KEY (`fk_playlist`) REFERENCES `videos` (`fk_playlist`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_pessoa` FOREIGN KEY (`fk_pessoa`) REFERENCES `pessoa` (`id`);

--
-- Restrições para tabelas `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`fk_categoria`) REFERENCES `categoria` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
