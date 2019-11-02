-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando dados para a tabela gcc.empresa: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`id_empresa`, `nome_empresa`, `email_empresa`, `site_empresa`, `telefone_empresa`, `whatsapp_empresa`, `foto_empresa`, `permissao_empresa`, `id_usuario`) VALUES
	(1, 'Grupo HR Segurança', 'contato@grupohrseguranca.com.br', 'https://grupohrseguranca.com.br', '(22) 99929-5067', '(22) 99929-5067', 'imagem-de-apresentacao.jpg', 0, 22),
	(2, 'Clean Lagos', 'contato@cleanlagos.com', 'https://cleanlagos.com', '(22) 99929-5067', '(22) 99929-5067', 'imagem-de-apresentacao.jpg', 1, 22),
	(3, 'Grupo HR Segurança', 'contato@grupohrseguranca.com.br', 'https://grupohrseguranca.com.br', '(22) 99929-5067', '(22) 99929-5067', 'imagem-de-apresentacao.jpg', 0, 22),
	(4, 'Grupo HR Segurança', 'contato@grupohrseguranca.com.br', 'https://grupohrseguranca.com.br', '(22) 99929-5067', '(22) 99929-5067', 'imagem-de-apresentacao.jpg', 0, 22),
	(5, 'Clean Lagos', 'contato@cleanlagos.com', 'https://cleanlagos.com', '(22) 99929-5067', '(22) 99929-5067', 'imagem-de-apresentacao.jpg', 1, 22);
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

-- Copiando dados para a tabela gcc.perguntas_frequentes: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `perguntas_frequentes` DISABLE KEYS */;
INSERT INTO `perguntas_frequentes` (`id_pf`, `pergunta_pf`, `resposta_pf`) VALUES
	(1, 'Qual?', 'Essa'),
	(2, 'Foi você?', 'Claro que sim!'),
	(3, 'Tudo bem?', 'Sim!');
/*!40000 ALTER TABLE `perguntas_frequentes` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.resposta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `resposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `resposta` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.servico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;

-- Copiando dados para a tabela gcc.usuario: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `tipo`, `foto`, `permissao`, `hash`) VALUES
	(1, 'Mike Fonseca dos Santos', 'mike@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'usuario.jpg', 1, NULL),
	(21, 'André Luis Castro', 'andreluis.castro@hotmail.com', 'd2e66a2f1c7aff96cee5470dbaa59e8e', 0, 'usuario.jpg', 1, 'b91f1a7d6ed9e097c174844687ee480f'),
	(22, 'Vladmir Rijo', 'ceo@grupohrseguranca.com.br', '6fd671f8824a60d924bee98f5bdcaf86', 1, 'usuario.jpg', 1, '64105d5d58da0e4446022b0e4017fb34');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
