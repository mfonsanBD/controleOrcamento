-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.37-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando dados para a tabela gcc.empresa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.orcamento_c: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `orcamento_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `orcamento_c` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.orcamento_e: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `orcamento_e` DISABLE KEYS */;
/*!40000 ALTER TABLE `orcamento_e` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.pergunta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pergunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `pergunta` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.perguntas_frequentes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `perguntas_frequentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `perguntas_frequentes` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.resposta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `resposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `resposta` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.servico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.usuario: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
REPLACE INTO `usuario` (`id`, `nome`, `email`, `senha`, `tipo`, `foto`, `permissao`, `hash`) VALUES
	(1, 'Mike Fonseca dos Santos', 'mike@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 'usuario.jpg', 1, NULL),
	(10, 'Wigoc Shadow', 'wigoc@net1mail.com', '202cb962ac59075b964b07152d234b70', 1, 'usuario.jpg', 1, '1e5c79e39cf43e3dc5396cde93ebdf4e'),
	(11, 'Mike Robert', 'mike@j.com', 'fddebb9cdc650bb7e1efa6998e4f9b77', 1, 'usuario.jpg', 0, 'e13462fb5dc7a7e8ed216aab8e0186c2'),
	(12, 'José Carlos', 'js@s.com', '1ee9ba2625af553585bb92fca5f10f4e', 1, 'usuario.jpg', 0, '27a30944dc910cfa5d3e5720e93f2166'),
	(13, 'Romário Peixe', 'roma@g.com', 'd16fac18ab9f327f502b8d991be5de2a', 1, 'usuario.jpg', 0, '989774e4edd2bf16195b3966e11a2998'),
	(14, 'Ronaldo Fenômeno', 'rona@r.com', 'abdac627903723582c7254823e72f58f', 1, 'usuario.jpg', 0, '854703c1cb0a5e25249ac8a1cccc37a9'),
	(15, 'Ronaldinho Gaúcho', 'dinho@ro.com', 'abdac627903723582c7254823e72f58f', 1, 'usuario.jpg', 0, '5bdd30d6f94f14820ce0872db517d2fc'),
	(16, 'Robinho Pedalada', 'binho@rob.com.br', 'e8c6ac54f11b0dd2c3f9b55237e1e041', 1, 'usuario.jpg', 1, '18d5c9c7ff92469b1da8c7e4621947d5'),
	(17, 'Jubicleison Rapadura', 'jub@clei.com', '982153573889b16b07d9b7b7874a3e00', 1, 'usuario.jpg', 0, 'f98f82dffa5c73842a77f289c4252e5f'),
	(18, 'Jabiraca Veia', 'jabi@raca.com', '202cb962ac59075b964b07152d234b70', 1, 'usuario.jpg', 0, 'dad9d9cababf5019a0596f6900d970f3'),
	(19, 'Rosenilde Creusidia', 'rose@nilde.com', '1ee9ba2625af553585bb92fca5f10f4e', 1, 'usuario.jpg', 0, 'c8a5278c22ab0d436cca3f4e1938561e'),
	(20, 'Cata Vento', 'cata@vento.com', '4d1a387396e2b5d7f421a203133c5e2c', 1, 'usuario.jpg', 0, '9035a62f34f1af0f92ea2faed44b48d6');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
