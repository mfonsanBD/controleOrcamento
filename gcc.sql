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

-- Copiando estrutura para tabela gcc.empresa
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(100) NOT NULL,
  `email_empresa` varchar(100) NOT NULL,
  `site_empresa` varchar(100) NOT NULL,
  `telefone_empresa` varchar(15) NOT NULL,
  `whatsapp_empresa` varchar(15) NOT NULL,
  `foto_empresa` varchar(36) NOT NULL DEFAULT 'empresa.jpg',
  `permissao_empresa` int(1) NOT NULL DEFAULT '0',
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gcc.empresa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando estrutura para tabela gcc.orcamento_c
DROP TABLE IF EXISTS `orcamento_c`;
CREATE TABLE IF NOT EXISTS `orcamento_c` (
  `id_oc` int(11) NOT NULL AUTO_INCREMENT,
  `nome_oc` varchar(100) NOT NULL,
  `email_oc` varchar(100) NOT NULL,
  `telefone_oc` int(11) NOT NULL,
  `whatsapp_oc` int(11) NOT NULL,
  `cep_oc` int(8) NOT NULL,
  `data_oc` datetime NOT NULL,
  `status_oc` int(1) NOT NULL DEFAULT '0',
  `id_empresa` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `id_resposta` int(11) NOT NULL,
  PRIMARY KEY (`id_oc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gcc.orcamento_c: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `orcamento_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `orcamento_c` ENABLE KEYS */;

-- Copiando estrutura para tabela gcc.orcamento_e
DROP TABLE IF EXISTS `orcamento_e`;
CREATE TABLE IF NOT EXISTS `orcamento_e` (
  `id_oe` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_oe` varchar(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  PRIMARY KEY (`id_oe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gcc.orcamento_e: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `orcamento_e` DISABLE KEYS */;
/*!40000 ALTER TABLE `orcamento_e` ENABLE KEYS */;

-- Copiando estrutura para tabela gcc.pergunta
DROP TABLE IF EXISTS `pergunta`;
CREATE TABLE IF NOT EXISTS `pergunta` (
  `id_p` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta_p` varchar(100) NOT NULL,
  `id_servico` int(11) NOT NULL,
  PRIMARY KEY (`id_p`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gcc.pergunta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pergunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `pergunta` ENABLE KEYS */;

-- Copiando estrutura para tabela gcc.perguntas_frequentes
DROP TABLE IF EXISTS `perguntas_frequentes`;
CREATE TABLE IF NOT EXISTS `perguntas_frequentes` (
  `id_pf` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta_pf` varchar(100) NOT NULL,
  `resposta_pf` text NOT NULL,
  PRIMARY KEY (`id_pf`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gcc.perguntas_frequentes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `perguntas_frequentes` DISABLE KEYS */;
INSERT INTO `perguntas_frequentes` (`id_pf`, `pergunta_pf`, `resposta_pf`) VALUES
	(14, 'Eu posso entrar em contato diretamente com meus futuros clientes?', 'Sim. Basta acessar sua conta e sua lista de leads será exibida e ali estará as informações de contato dos mesmos. Então você pode clicar no botão de ligar ou mandar mensagem pelo whatsapp.');
/*!40000 ALTER TABLE `perguntas_frequentes` ENABLE KEYS */;

-- Copiando estrutura para tabela gcc.resposta
DROP TABLE IF EXISTS `resposta`;
CREATE TABLE IF NOT EXISTS `resposta` (
  `id_r` int(11) NOT NULL AUTO_INCREMENT,
  `resposta_r` varchar(200) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  PRIMARY KEY (`id_r`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gcc.resposta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `resposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `resposta` ENABLE KEYS */;

-- Copiando estrutura para tabela gcc.servico
DROP TABLE IF EXISTS `servico`;
CREATE TABLE IF NOT EXISTS `servico` (
  `id_s` int(11) NOT NULL AUTO_INCREMENT,
  `nome_s` varchar(100) NOT NULL,
  `foto_s` varchar(32) NOT NULL,
  `metro_s` decimal(2,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  PRIMARY KEY (`id_s`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gcc.servico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;

-- Copiando estrutura para tabela gcc.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `tipo` int(1) NOT NULL,
  `foto` varchar(36) NOT NULL DEFAULT 'usuario.jpg',
  `permissao` int(1) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `codigo_redefinicao` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gcc.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `sobrenome`, `email`, `senha`, `tipo`, `foto`, `permissao`, `hash`, `codigo_redefinicao`) VALUES
	(1, 'Mike', 'Santos', 'mike.santos@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'c4ca4238a0b923820dcc509a6f75849b.jpg', 1, '', NULL),
	(21, 'André', 'Luis', 'andreluis.castro@hotmail.com', 'd2e66a2f1c7aff96cee5470dbaa59e8e', 0, '3c59dc048e8850243be8079a5c74d079.jpg', 1, 'b91f1a7d6ed9e097c174844687ee480f', NULL),
	(56, 'Juliete', 'Oliveira', 'juju@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'usuario.jpg', 1, '0d82d6baa31cbd3336d56fe6c7a48e2d', 'b5zlwq'),
	(57, 'Izis', 'Chaves', 'izis.chaves@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'usuario.jpg', 1, 'd3fac12e505810f248d8480608be8283', NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
