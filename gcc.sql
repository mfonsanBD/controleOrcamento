-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Out-2019 às 15:10
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `site` varchar(100) NOT NULL,
  `telefone` int(11) NOT NULL,
  `whatsapp` int(11) NOT NULL,
  `permissao` int(1) NOT NULL DEFAULT '0',
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_c`
--

CREATE TABLE `orcamento_c` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` int(11) NOT NULL,
  `whatsapp` int(11) NOT NULL,
  `cep` int(8) NOT NULL,
  `data` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `id_empresa` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `id_resposta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_e`
--

CREATE TABLE `orcamento_e` (
  `id` int(11) NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

CREATE TABLE `pergunta` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(100) NOT NULL,
  `id_servico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas_frequentes`
--

CREATE TABLE `perguntas_frequentes` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(100) NOT NULL,
  `resposta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

CREATE TABLE `resposta` (
  `id` int(11) NOT NULL,
  `resposta` varchar(200) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `foto` varchar(32) NOT NULL,
  `metro` decimal(2,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `tipo` int(1) NOT NULL,
  `foto` varchar(32) DEFAULT NULL,
  `permissao` int(1) NOT NULL,
  `hash` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `tipo`, `foto`, `permissao`, `hash`) VALUES
(1, 'Mike Fonseca dos Santos', 'mike@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'usuario.jpg', 1, NULL),
(10, 'Wigoc Shadow', 'wigoc@net1mail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 0, '1e5c79e39cf43e3dc5396cde93ebdf4e'),
(11, 'Mike', 'mike@j.com', 'fddebb9cdc650bb7e1efa6998e4f9b77', 1, NULL, 0, 'e13462fb5dc7a7e8ed216aab8e0186c2'),
(12, 'José', 'js@s.com', '1ee9ba2625af553585bb92fca5f10f4e', 1, NULL, 0, '27a30944dc910cfa5d3e5720e93f2166'),
(13, 'Romário', 'roma@g.com', 'd16fac18ab9f327f502b8d991be5de2a', 1, NULL, 0, '989774e4edd2bf16195b3966e11a2998'),
(14, 'Ronaldo', 'rona@r.com', 'abdac627903723582c7254823e72f58f', 1, NULL, 0, '854703c1cb0a5e25249ac8a1cccc37a9'),
(15, 'Ronaldinho', 'dinho@ro.com', 'abdac627903723582c7254823e72f58f', 1, NULL, 0, '5bdd30d6f94f14820ce0872db517d2fc'),
(16, 'Robinho', 'binho@rob.com.br', 'e8c6ac54f11b0dd2c3f9b55237e1e041', 1, NULL, 1, '18d5c9c7ff92469b1da8c7e4621947d5'),
(17, 'Jubicleison', 'jub@clei.com', '982153573889b16b07d9b7b7874a3e00', 1, NULL, 0, 'f98f82dffa5c73842a77f289c4252e5f'),
(18, 'Jabiraca', 'jabi@raca.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 1, 'dad9d9cababf5019a0596f6900d970f3'),
(19, 'Rosenilde', 'rose@nilde.com', '1ee9ba2625af553585bb92fca5f10f4e', 1, NULL, 0, 'c8a5278c22ab0d436cca3f4e1938561e'),
(20, 'Cata Vento', 'cata@vento.com', '4d1a387396e2b5d7f421a203133c5e2c', 1, NULL, 0, '9035a62f34f1af0f92ea2faed44b48d6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orcamento_c`
--
ALTER TABLE `orcamento_c`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orcamento_e`
--
ALTER TABLE `orcamento_e`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perguntas_frequentes`
--
ALTER TABLE `perguntas_frequentes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orcamento_c`
--
ALTER TABLE `orcamento_c`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orcamento_e`
--
ALTER TABLE `orcamento_e`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perguntas_frequentes`
--
ALTER TABLE `perguntas_frequentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resposta`
--
ALTER TABLE `resposta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
