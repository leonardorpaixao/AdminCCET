-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Abr-2018 às 21:18
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcomp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `ddd` int(2) DEFAULT NULL,
  `telefone` int(8) DEFAULT NULL,
  `endereço` varchar(70) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `país` varchar(20) NOT NULL,
  `login` varchar(12) NOT NULL,
  `senha` varchar(12) NOT NULL,
  `news` varchar(8) DEFAULT NULL,
  `id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`nome`, `email`, `sexo`, `ddd`, `telefone`, `endereço`, `cidade`, `estado`, `bairro`, `país`, `login`, `senha`, `news`, `id`) VALUES
('teste', 'teste@teste.com', 'Masculino', 79, 9989987, 'dsdsadasd', 'teste@teste.com', 'Se', 'teste@teste.com', 'teste@teste.com', 'teste@teste.', 'teste@teste.', 'ATIVO', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbafiliacao`
--

CREATE TABLE `tbafiliacao` (
  `idAfiliacao` int(10) UNSIGNED NOT NULL,
  `afiliacao` varchar(64) NOT NULL,
  `nivel` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbafiliacao`
--

INSERT INTO `tbafiliacao` (`idAfiliacao`, `afiliacao`, `nivel`) VALUES
(1, 'PROFESSOR', 1),
(2, 'SECRETARIA', 1),
(3, 'ALUNO', 1),
(4, 'ADMINISTRADOR', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbalocalab`
--

CREATE TABLE `tbalocalab` (
  `idLab` int(10) UNSIGNED NOT NULL,
  `patrimonio` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbalocareeq`
--

CREATE TABLE `tbalocareeq` (
  `patrimonio` int(10) UNSIGNED NOT NULL,
  `idReEq` int(10) UNSIGNED NOT NULL,
  `idData` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbalocarelab`
--

CREATE TABLE `tbalocarelab` (
  `idLab` int(10) UNSIGNED NOT NULL,
  `idReLab` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbatualizacao`
--

CREATE TABLE `tbatualizacao` (
  `idAtualizacao` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbavisos`
--

CREATE TABLE `tbavisos` (
  `idAviso` int(11) NOT NULL,
  `tituloAviso` varchar(50) NOT NULL,
  `textoAviso` text NOT NULL,
  `dataAviso` date NOT NULL,
  `statusAviso` enum('Ativo','Inativo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbblock`
--

CREATE TABLE `tbblock` (
  `idBlock` int(10) UNSIGNED NOT NULL,
  `idUserBlock` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED DEFAULT NULL,
  `motivoBlock` text NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbblockforcado`
--

CREATE TABLE `tbblockforcado` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(128) DEFAULT NULL,
  `data` int(15) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbbugs`
--

CREATE TABLE `tbbugs` (
  `idBug` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `pagina` varchar(100) NOT NULL,
  `bug` text NOT NULL,
  `data` date NOT NULL,
  `status` enum('Em análise','Resolvido','Descartado') NOT NULL DEFAULT 'Em análise',
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbchoqueeq`
--

CREATE TABLE `tbchoqueeq` (
  `idReEq` int(10) UNSIGNED NOT NULL,
  `idData` int(10) UNSIGNED NOT NULL,
  `idChoqueReEq` int(10) UNSIGNED NOT NULL,
  `idChoqueData` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbchoquelab`
--

CREATE TABLE `tbchoquelab` (
  `idReLab` int(10) UNSIGNED NOT NULL,
  `idData` int(10) UNSIGNED NOT NULL,
  `idChoqueReLab` int(10) UNSIGNED NOT NULL,
  `idChoqueData` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbchoquesala`
--

CREATE TABLE `tbchoquesala` (
  `idReSala` int(10) UNSIGNED NOT NULL,
  `idData` int(10) UNSIGNED NOT NULL,
  `idChoqueReSala` int(10) UNSIGNED NOT NULL,
  `idChoqueData` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcontatemp`
--

CREATE TABLE `tbcontatemp` (
  `idConta` int(10) UNSIGNED NOT NULL,
  `nomeConta` varchar(255) NOT NULL,
  `login` varchar(64) NOT NULL,
  `statusConta` enum('Ativo','Inativo') NOT NULL,
  `numAcesso` int(10) UNSIGNED NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `sudo` enum('Ativo','Inativo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcontroledataeq`
--

CREATE TABLE `tbcontroledataeq` (
  `idReEq` int(10) UNSIGNED NOT NULL,
  `idData` int(10) UNSIGNED NOT NULL,
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbcontroledataeq`
--

INSERT INTO `tbcontroledataeq` (`idReEq`, `idData`, `statusData`, `justificativa`) VALUES
(304, 26870, 'Pendente', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcontroledatalab`
--

CREATE TABLE `tbcontroledatalab` (
  `idReLab` int(10) UNSIGNED NOT NULL,
  `idData` int(10) UNSIGNED NOT NULL,
  `idLab` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcontroledatasala`
--

CREATE TABLE `tbcontroledatasala` (
  `idReSala` int(10) UNSIGNED NOT NULL,
  `idData` int(10) UNSIGNED NOT NULL,
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcor`
--

CREATE TABLE `tbcor` (
  `idCor` int(11) UNSIGNED NOT NULL,
  `cor` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdata`
--

CREATE TABLE `tbdata` (
  `idData` int(10) UNSIGNED NOT NULL,
  `inicio` datetime NOT NULL,
  `fim` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbdata`
--

INSERT INTO `tbdata` (`idData`, `inicio`, `fim`) VALUES
(26870, '2018-03-06 00:00:00', '2018-03-06 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdisciplinas`
--

CREATE TABLE `tbdisciplinas` (
  `idDisc` int(11) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `carga` varchar(255) NOT NULL,
  `status` enum('Ativo','Inativo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbemail`
--

CREATE TABLE `tbemail` (
  `idUser` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `criado` int(1) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbequipamento`
--

CREATE TABLE `tbequipamento` (
  `patrimonio` int(10) UNSIGNED NOT NULL,
  `idTipoEq` int(10) UNSIGNED DEFAULT NULL,
  `modelo` varchar(255) NOT NULL,
  `statusEq` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbimagem`
--

CREATE TABLE `tbimagem` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `imagem` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbinclusao`
--

CREATE TABLE `tbinclusao` (
  `idInc` int(11) NOT NULL,
  `status` enum('Em análise','Deferido','Indeferido') NOT NULL DEFAULT 'Em análise',
  `nome` varchar(255) NOT NULL,
  `matricula` varchar(15) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `disciplina` varchar(255) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `turma` varchar(10) NOT NULL,
  `periodo` varchar(10) NOT NULL,
  `motivo` text,
  `dataEnvio` int(11) NOT NULL,
  `motivo2` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblaboratorio`
--

CREATE TABLE `tblaboratorio` (
  `idLab` int(10) UNSIGNED NOT NULL,
  `nomeLab` varchar(45) NOT NULL,
  `capAluno` int(10) UNSIGNED NOT NULL,
  `numComp` int(10) UNSIGNED NOT NULL,
  `statusLab` enum('Ativo','Inativo') NOT NULL,
  `idCor` int(10) UNSIGNED DEFAULT NULL,
  `subRede` varchar(25) DEFAULT NULL,
  `filas` int(2) UNSIGNED DEFAULT NULL,
  `pcspos` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblabpasswd`
--

CREATE TABLE `tblabpasswd` (
  `id` int(11) NOT NULL,
  `passwd` varbinary(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblog`
--

CREATE TABLE `tblog` (
  `idTicket` int(10) UNSIGNED NOT NULL,
  `idLog` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED DEFAULT NULL,
  `mensagem` text NOT NULL,
  `dataLog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `tblog`
--
DELIMITER $$
CREATE TRIGGER `data` BEFORE INSERT ON `tblog` FOR EACH ROW set new.dataLog = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblogsacesso`
--

CREATE TABLE `tblogsacesso` (
  `idLogs` int(11) UNSIGNED NOT NULL,
  `ip` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblogsacoes`
--

CREATE TABLE `tblogsacoes` (
  `idLogs` int(11) UNSIGNED NOT NULL,
  `ip` varchar(20) NOT NULL,
  `idUser` int(10) DEFAULT NULL,
  `acao` varchar(50) NOT NULL,
  `data` datetime NOT NULL,
  `idRow` int(10) DEFAULT NULL,
  `nomeTabela` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblogsacoes`
--

INSERT INTO `tblogsacoes` (`idLogs`, `ip`, `idUser`, `acao`, `data`, `idRow`, `nomeTabela`) VALUES
(17294, '::1', 1, 'Deslogou', '2018-03-06 23:35:29', NULL, NULL),
(17295, '::1', 3, 'Inseriu', '2018-03-06 23:46:36', 304, 'tbreservaeq'),
(17296, '::1', 3, 'Inseriu', '2018-03-06 23:46:37', 0, 'tbcontroledataeq'),
(17297, '::1', 3, 'Deslogou', '2018-03-06 23:46:42', NULL, NULL),
(17298, '::1', 2, 'Deslogou', '2018-03-06 23:56:10', NULL, NULL),
(17299, '::1', 3, 'Deslogou', '2018-03-24 23:53:21', NULL, NULL),
(17300, '::1', 1, 'Deslogou', '2018-04-03 23:30:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblogsforcado`
--

CREATE TABLE `tblogsforcado` (
  `idLogs` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `data` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmatricula`
--

CREATE TABLE `tbmatricula` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `matricula` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnoticonexao`
--

CREATE TABLE `tbnoticonexao` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `idNoti` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnotificacao`
--

CREATE TABLE `tbnotificacao` (
  `idNoti` int(10) UNSIGNED NOT NULL,
  `notificacao` text NOT NULL,
  `statusNoti` tinyint(1) NOT NULL,
  `expiraData` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbonline`
--

CREATE TABLE `tbonline` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `tempoExpirar` datetime NOT NULL,
  `sessao` varchar(128) NOT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `typeUser` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbonline`
--

INSERT INTO `tbonline` (`idUser`, `tempoExpirar`, `sessao`, `senha`, `typeUser`) VALUES
(3, '2018-03-25 01:31:08', 'c2arhi8elhqkshskebgdhsdp56', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprazo`
--

CREATE TABLE `tbprazo` (
  `idPrazo` int(11) NOT NULL,
  `inicio` date DEFAULT NULL,
  `fim` date DEFAULT NULL,
  `logado` enum('Sim','Não') NOT NULL DEFAULT 'Sim',
  `nome` varchar(255) NOT NULL,
  `periodo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprimeiroacesso`
--

CREATE TABLE `tbprimeiroacesso` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `idAfiliacao` int(10) DEFAULT NULL,
  `siapMatricula` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprimeiroacessoccet`
--

CREATE TABLE `tbprimeiroacessoccet` (
  `nome` varchar(50) CHARACTER SET armscii8 NOT NULL,
  `email` varchar(70) CHARACTER SET armscii8 NOT NULL,
  `idAfiliacao` int(3) NOT NULL DEFAULT '1',
  `siapMatricula` int(12) DEFAULT NULL,
  `departamento` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbprimeiroacessoccet`
--

INSERT INTO `tbprimeiroacessoccet` (`nome`, `email`, `idAfiliacao`, `siapMatricula`, `departamento`) VALUES
('LEONARDO', 'LEONARDORPAIXAO@GMAIL.COM', 3, 2012100113, 'DCOMP'),
('TESTE@TESTE.COM', 'TESTE@TESTE.COM', 1, 4789987, '21654489'),
('', '', 0, 0, ''),
('leonardo2', 'leonardo2@DASDAS.COM', 3, 2147483647, 'COMP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbreqs_professor`
--

CREATE TABLE `tbreqs_professor` (
  `idReqs_professor` int(11) NOT NULL,
  `idProfessor` int(10) UNSIGNED DEFAULT NULL,
  `idReq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrequerimentos`
--

CREATE TABLE `tbrequerimentos` (
  `idReq` int(11) NOT NULL,
  `idUser` int(10) UNSIGNED DEFAULT NULL,
  `dataReq` date NOT NULL,
  `conteudoReq` text CHARACTER SET latin1 NOT NULL,
  `tipoReq` int(11) NOT NULL,
  `statusReq` enum('Pendente','Negado','Aprovado','Cancelado','PendenteProf','ConfirmadoProf','NegadoProf') CHARACTER SET latin1 NOT NULL DEFAULT 'Pendente',
  `justificativaReq` text CHARACTER SET latin1 NOT NULL,
  `idTemp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbreservaeq`
--

CREATE TABLE `tbreservaeq` (
  `idReEq` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `motivoReEq` varchar(255) NOT NULL,
  `tituloReEq` varchar(255) NOT NULL,
  `expiraReEq` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbreservaeq`
--

INSERT INTO `tbreservaeq` (`idReEq`, `idUser`, `motivoReEq`, `tituloReEq`, `expiraReEq`) VALUES
(304, 3, 'TESTE', 'TCC - tESTE', '2018-09-02');

--
-- Acionadores `tbreservaeq`
--
DELIMITER $$
CREATE TRIGGER `ExpiraReEq` BEFORE INSERT ON `tbreservaeq` FOR EACH ROW set new.expiraReEq = date_add(current_date(), interval 180 day)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbreservalab`
--

CREATE TABLE `tbreservalab` (
  `idReLab` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `motivoReLab` varchar(255) NOT NULL,
  `tituloReLab` varchar(255) NOT NULL,
  `tipoReLab` enum('Privado','Compartilhado') NOT NULL,
  `numPc` int(10) UNSIGNED DEFAULT NULL,
  `expiraReLab` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `tbreservalab`
--
DELIMITER $$
CREATE TRIGGER `ExpiraReLab` BEFORE INSERT ON `tbreservalab` FOR EACH ROW set new.expiraReLab = date_add(current_date(), interval 180 day)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbreservasala`
--

CREATE TABLE `tbreservasala` (
  `idReSala` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `idSala` int(10) UNSIGNED NOT NULL,
  `motivoReSala` varchar(255) NOT NULL,
  `tituloReSala` varchar(255) NOT NULL,
  `expirarReSala` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `tbreservasala`
--
DELIMITER $$
CREATE TRIGGER `ExpiraReSala` BEFORE INSERT ON `tbreservasala` FOR EACH ROW set new.expirarReSala = date_add(current_date(), interval 180 day)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbreservatipoeq`
--

CREATE TABLE `tbreservatipoeq` (
  `idTipoEq` int(10) UNSIGNED NOT NULL,
  `idReEq` int(10) UNSIGNED NOT NULL,
  `numReEq` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbsala`
--

CREATE TABLE `tbsala` (
  `idSala` int(10) UNSIGNED NOT NULL,
  `nomeSala` varchar(50) NOT NULL,
  `numPessoa` int(10) UNSIGNED NOT NULL,
  `statusSala` enum('Ativo','Inativo') NOT NULL,
  `idCor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefone`
--

CREATE TABLE `tbtelefone` (
  `idTelefone` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `numTelefone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtemporarios`
--

CREATE TABLE `tbtemporarios` (
  `idTemp` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `matricula` varchar(12) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `curso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtermo`
--

CREATE TABLE `tbtermo` (
  `idTermo` int(11) NOT NULL,
  `termo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Acionadores `tbtermo`
--
DELIMITER $$
CREATE TRIGGER `atualizarTermo` AFTER UPDATE ON `tbtermo` FOR EACH ROW UPDATE tbusuario SET termo = 0
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbticket`
--

CREATE TABLE `tbticket` (
  `idTicket` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `idAssunto` int(10) UNSIGNED NOT NULL,
  `tituloTicket` text NOT NULL,
  `statusTicket` enum('Em Analise','Respondido','Concluido','Em Atendimento') NOT NULL,
  `data` date NOT NULL,
  `avalicao` tinyint(3) UNSIGNED DEFAULT NULL,
  `dateStart` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `tbticket`
--
DELIMITER $$
CREATE TRIGGER `dataCriacao` BEFORE INSERT ON `tbticket` FOR EACH ROW set new.data = current_date()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtipoeq`
--

CREATE TABLE `tbtipoeq` (
  `idTipoEq` int(11) UNSIGNED NOT NULL,
  `tipoEq` varchar(15) NOT NULL,
  `numEq` smallint(6) NOT NULL,
  `idCor` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `idAfiliacao` int(10) UNSIGNED DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `senha` varchar(20) NOT NULL,
  `nomeUser` varchar(255) NOT NULL,
  `nivel` int(10) UNSIGNED NOT NULL,
  `statusUser` enum('Ativo','Inativo','Bloqueado') NOT NULL DEFAULT 'Ativo',
  `email` varchar(50) DEFAULT NULL,
  `termo` tinyint(1) NOT NULL DEFAULT '0',
  `statusLogin` int(10) UNSIGNED DEFAULT '1',
  `sudo` enum('Ativo','Inativo') NOT NULL DEFAULT 'Inativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUser`, `idAfiliacao`, `login`, `cpf`, `senha`, `nomeUser`, `nivel`, `statusUser`, `email`, `termo`, `statusLogin`, `sudo`) VALUES
(1, 1, 'professor', '1123', '123', 'Professor', 3, 'Ativo', 'abc@abc.com', 1, 1, 'Ativo'),
(2, 2, 'secretaria', '', '123', 'Secretaria', 1, 'Ativo', 'abc@abc.com', 1, 1, 'Ativo'),
(3, 3, 'aluno', '', '123', 'Aluno', 4, 'Ativo', 'abc123@xyz.com', 1, 0, 'Ativo'),
(4, 4, 'admin', '123', '123', 'Adminstrador', 0, 'Ativo', 'abc@abc.com', 1, 1, 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuariosexternos`
--

CREATE TABLE `tbusuariosexternos` (
  `idExterno` int(10) UNSIGNED NOT NULL,
  `login` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Ativo','Inativo','Bloqueado','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curso` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricula` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusLogin` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuariotemp`
--

CREATE TABLE `tbusuariotemp` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbafiliacao`
--
ALTER TABLE `tbafiliacao`
  ADD PRIMARY KEY (`idAfiliacao`);

--
-- Indexes for table `tbalocalab`
--
ALTER TABLE `tbalocalab`
  ADD PRIMARY KEY (`idLab`,`patrimonio`),
  ADD KEY `patrimonio` (`patrimonio`);

--
-- Indexes for table `tbalocareeq`
--
ALTER TABLE `tbalocareeq`
  ADD PRIMARY KEY (`patrimonio`,`idReEq`,`idData`),
  ADD KEY `idReEq` (`idReEq`),
  ADD KEY `idData` (`idData`);

--
-- Indexes for table `tbalocarelab`
--
ALTER TABLE `tbalocarelab`
  ADD PRIMARY KEY (`idLab`,`idReLab`),
  ADD KEY `idReLab` (`idReLab`);

--
-- Indexes for table `tbatualizacao`
--
ALTER TABLE `tbatualizacao`
  ADD PRIMARY KEY (`idAtualizacao`);

--
-- Indexes for table `tbavisos`
--
ALTER TABLE `tbavisos`
  ADD PRIMARY KEY (`idAviso`);

--
-- Indexes for table `tbblock`
--
ALTER TABLE `tbblock`
  ADD PRIMARY KEY (`idBlock`),
  ADD KEY `idUserBlock` (`idUserBlock`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `tbblockforcado`
--
ALTER TABLE `tbblockforcado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbbugs`
--
ALTER TABLE `tbbugs`
  ADD PRIMARY KEY (`idBug`);

--
-- Indexes for table `tbchoqueeq`
--
ALTER TABLE `tbchoqueeq`
  ADD PRIMARY KEY (`idReEq`,`idData`,`idChoqueReEq`,`idChoqueData`),
  ADD KEY `idData` (`idData`),
  ADD KEY `idChoqueReEq` (`idChoqueReEq`),
  ADD KEY `idChoqueData` (`idChoqueData`);

--
-- Indexes for table `tbchoquelab`
--
ALTER TABLE `tbchoquelab`
  ADD PRIMARY KEY (`idReLab`,`idData`,`idChoqueReLab`,`idChoqueData`),
  ADD KEY `tbchoquelab_ibfk_2` (`idData`),
  ADD KEY `tbchoquelab_ibfk_3` (`idChoqueReLab`),
  ADD KEY `tbchoquelab_ibfk_4` (`idChoqueData`);

--
-- Indexes for table `tbchoquesala`
--
ALTER TABLE `tbchoquesala`
  ADD PRIMARY KEY (`idReSala`,`idData`,`idChoqueReSala`,`idChoqueData`),
  ADD KEY `idData` (`idData`),
  ADD KEY `idChoqueSala` (`idChoqueReSala`),
  ADD KEY `idChoqueData` (`idChoqueData`);

--
-- Indexes for table `tbcontatemp`
--
ALTER TABLE `tbcontatemp`
  ADD PRIMARY KEY (`idConta`);

--
-- Indexes for table `tbcontroledataeq`
--
ALTER TABLE `tbcontroledataeq`
  ADD PRIMARY KEY (`idReEq`,`idData`),
  ADD KEY `idData` (`idData`);

--
-- Indexes for table `tbcontroledatalab`
--
ALTER TABLE `tbcontroledatalab`
  ADD PRIMARY KEY (`idReLab`,`idData`,`idLab`),
  ADD KEY `idData` (`idData`),
  ADD KEY `idLab` (`idLab`);

--
-- Indexes for table `tbcontroledatasala`
--
ALTER TABLE `tbcontroledatasala`
  ADD PRIMARY KEY (`idReSala`,`idData`),
  ADD KEY `idData` (`idData`);

--
-- Indexes for table `tbcor`
--
ALTER TABLE `tbcor`
  ADD PRIMARY KEY (`idCor`);

--
-- Indexes for table `tbdata`
--
ALTER TABLE `tbdata`
  ADD PRIMARY KEY (`idData`);

--
-- Indexes for table `tbdisciplinas`
--
ALTER TABLE `tbdisciplinas`
  ADD PRIMARY KEY (`idDisc`);

--
-- Indexes for table `tbemail`
--
ALTER TABLE `tbemail`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `tbequipamento`
--
ALTER TABLE `tbequipamento`
  ADD PRIMARY KEY (`patrimonio`),
  ADD KEY `tbequipamento_FKIndex1` (`idTipoEq`),
  ADD KEY `idTipoEqp` (`idTipoEq`);

--
-- Indexes for table `tbimagem`
--
ALTER TABLE `tbimagem`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `tbinclusao`
--
ALTER TABLE `tbinclusao`
  ADD PRIMARY KEY (`idInc`);

--
-- Indexes for table `tblaboratorio`
--
ALTER TABLE `tblaboratorio`
  ADD PRIMARY KEY (`idLab`),
  ADD KEY `idCor` (`idCor`);

--
-- Indexes for table `tblabpasswd`
--
ALTER TABLE `tblabpasswd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblog`
--
ALTER TABLE `tblog`
  ADD PRIMARY KEY (`idTicket`,`idLog`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `tblogsacesso`
--
ALTER TABLE `tblogsacesso`
  ADD PRIMARY KEY (`idLogs`);

--
-- Indexes for table `tblogsacoes`
--
ALTER TABLE `tblogsacoes`
  ADD PRIMARY KEY (`idLogs`);

--
-- Indexes for table `tblogsforcado`
--
ALTER TABLE `tblogsforcado`
  ADD PRIMARY KEY (`idLogs`);

--
-- Indexes for table `tbmatricula`
--
ALTER TABLE `tbmatricula`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `tbnoticonexao`
--
ALTER TABLE `tbnoticonexao`
  ADD PRIMARY KEY (`idUser`,`idNoti`),
  ADD KEY `idNoti` (`idNoti`);

--
-- Indexes for table `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  ADD PRIMARY KEY (`idNoti`);

--
-- Indexes for table `tbonline`
--
ALTER TABLE `tbonline`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `tbprazo`
--
ALTER TABLE `tbprazo`
  ADD PRIMARY KEY (`idPrazo`);

--
-- Indexes for table `tbprimeiroacesso`
--
ALTER TABLE `tbprimeiroacesso`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `tbreqs_professor`
--
ALTER TABLE `tbreqs_professor`
  ADD PRIMARY KEY (`idReqs_professor`),
  ADD KEY `idProfessor` (`idProfessor`),
  ADD KEY `idReq` (`idReq`);

--
-- Indexes for table `tbrequerimentos`
--
ALTER TABLE `tbrequerimentos`
  ADD PRIMARY KEY (`idReq`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idTemp` (`idTemp`);

--
-- Indexes for table `tbreservaeq`
--
ALTER TABLE `tbreservaeq`
  ADD PRIMARY KEY (`idReEq`),
  ADD KEY `idReEq` (`idReEq`),
  ADD KEY `idReserva` (`idUser`);

--
-- Indexes for table `tbreservalab`
--
ALTER TABLE `tbreservalab`
  ADD PRIMARY KEY (`idReLab`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `tbreservasala`
--
ALTER TABLE `tbreservasala`
  ADD PRIMARY KEY (`idReSala`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idSala` (`idSala`);

--
-- Indexes for table `tbreservatipoeq`
--
ALTER TABLE `tbreservatipoeq`
  ADD PRIMARY KEY (`idTipoEq`,`idReEq`),
  ADD KEY `idReEq` (`idReEq`);

--
-- Indexes for table `tbsala`
--
ALTER TABLE `tbsala`
  ADD PRIMARY KEY (`idSala`),
  ADD KEY `idSala` (`idSala`),
  ADD KEY `idCor` (`idCor`);

--
-- Indexes for table `tbtelefone`
--
ALTER TABLE `tbtelefone`
  ADD PRIMARY KEY (`idTelefone`),
  ADD KEY `tbtelefone_FKIndex1` (`idUser`);

--
-- Indexes for table `tbtemporarios`
--
ALTER TABLE `tbtemporarios`
  ADD PRIMARY KEY (`idTemp`);

--
-- Indexes for table `tbtermo`
--
ALTER TABLE `tbtermo`
  ADD PRIMARY KEY (`idTermo`);

--
-- Indexes for table `tbticket`
--
ALTER TABLE `tbticket`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `tbtipoeq`
--
ALTER TABLE `tbtipoeq`
  ADD PRIMARY KEY (`idTipoEq`),
  ADD KEY `idCor` (`idCor`);

--
-- Indexes for table `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idAfiliacao` (`idAfiliacao`);

--
-- Indexes for table `tbusuariosexternos`
--
ALTER TABLE `tbusuariosexternos`
  ADD PRIMARY KEY (`idExterno`);

--
-- Indexes for table `tbusuariotemp`
--
ALTER TABLE `tbusuariotemp`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbafiliacao`
--
ALTER TABLE `tbafiliacao`
  MODIFY `idAfiliacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbatualizacao`
--
ALTER TABLE `tbatualizacao`
  MODIFY `idAtualizacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- AUTO_INCREMENT for table `tbavisos`
--
ALTER TABLE `tbavisos`
  MODIFY `idAviso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbblock`
--
ALTER TABLE `tbblock`
  MODIFY `idBlock` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbbugs`
--
ALTER TABLE `tbbugs`
  MODIFY `idBug` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcontatemp`
--
ALTER TABLE `tbcontatemp`
  MODIFY `idConta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcor`
--
ALTER TABLE `tbcor`
  MODIFY `idCor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbdata`
--
ALTER TABLE `tbdata`
  MODIFY `idData` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26871;

--
-- AUTO_INCREMENT for table `tbdisciplinas`
--
ALTER TABLE `tbdisciplinas`
  MODIFY `idDisc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbequipamento`
--
ALTER TABLE `tbequipamento`
  MODIFY `patrimonio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbinclusao`
--
ALTER TABLE `tbinclusao`
  MODIFY `idInc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblaboratorio`
--
ALTER TABLE `tblaboratorio`
  MODIFY `idLab` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblabpasswd`
--
ALTER TABLE `tblabpasswd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblogsacesso`
--
ALTER TABLE `tblogsacesso`
  MODIFY `idLogs` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblogsacoes`
--
ALTER TABLE `tblogsacoes`
  MODIFY `idLogs` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17301;

--
-- AUTO_INCREMENT for table `tblogsforcado`
--
ALTER TABLE `tblogsforcado`
  MODIFY `idLogs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  MODIFY `idNoti` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbprazo`
--
ALTER TABLE `tbprazo`
  MODIFY `idPrazo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbreqs_professor`
--
ALTER TABLE `tbreqs_professor`
  MODIFY `idReqs_professor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbrequerimentos`
--
ALTER TABLE `tbrequerimentos`
  MODIFY `idReq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbreservaeq`
--
ALTER TABLE `tbreservaeq`
  MODIFY `idReEq` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `tbreservalab`
--
ALTER TABLE `tbreservalab`
  MODIFY `idReLab` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbreservasala`
--
ALTER TABLE `tbreservasala`
  MODIFY `idReSala` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbsala`
--
ALTER TABLE `tbsala`
  MODIFY `idSala` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbtelefone`
--
ALTER TABLE `tbtelefone`
  MODIFY `idTelefone` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbtemporarios`
--
ALTER TABLE `tbtemporarios`
  MODIFY `idTemp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbtermo`
--
ALTER TABLE `tbtermo`
  MODIFY `idTermo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbticket`
--
ALTER TABLE `tbticket`
  MODIFY `idTicket` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbtipoeq`
--
ALTER TABLE `tbtipoeq`
  MODIFY `idTipoEq` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbusuariosexternos`
--
ALTER TABLE `tbusuariosexternos`
  MODIFY `idExterno` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbusuariotemp`
--
ALTER TABLE `tbusuariotemp`
  MODIFY `idUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbalocalab`
--
ALTER TABLE `tbalocalab`
  ADD CONSTRAINT `tbalocalab_ibfk_1` FOREIGN KEY (`idLab`) REFERENCES `tblaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbalocalab_ibfk_2` FOREIGN KEY (`patrimonio`) REFERENCES `tbequipamento` (`patrimonio`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbalocareeq`
--
ALTER TABLE `tbalocareeq`
  ADD CONSTRAINT `tbalocareeq_ibfk_1` FOREIGN KEY (`patrimonio`) REFERENCES `tbequipamento` (`patrimonio`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbalocareeq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbcontroledataeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbalocareeq_ibfk_3` FOREIGN KEY (`idData`) REFERENCES `tbcontroledataeq` (`idData`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbalocarelab`
--
ALTER TABLE `tbalocarelab`
  ADD CONSTRAINT `tbalocarelab_ibfk_1` FOREIGN KEY (`idLab`) REFERENCES `tblaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbalocarelab_ibfk_2` FOREIGN KEY (`idReLab`) REFERENCES `tbreservalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbblock`
--
ALTER TABLE `tbblock`
  ADD CONSTRAINT `tbblock_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbblock_ibfk_2` FOREIGN KEY (`idUserBlock`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbchoqueeq`
--
ALTER TABLE `tbchoqueeq`
  ADD CONSTRAINT `tbchoqueeq_ibfk_1` FOREIGN KEY (`idReEq`,`idData`) REFERENCES `tbcontroledataeq` (`idReEq`, `idData`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbchoqueeq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbchoqueeq_ibfk_3` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`),
  ADD CONSTRAINT `tbchoqueeq_ibfk_4` FOREIGN KEY (`idChoqueReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbchoqueeq_ibfk_5` FOREIGN KEY (`idChoqueData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbchoquelab`
--
ALTER TABLE `tbchoquelab`
  ADD CONSTRAINT `tbchoquelab_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbcontroledatalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbchoquelab_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbcontroledatalab` (`idData`),
  ADD CONSTRAINT `tbchoquelab_ibfk_3` FOREIGN KEY (`idChoqueReLab`) REFERENCES `tbcontroledatalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbchoquelab_ibfk_4` FOREIGN KEY (`idChoqueData`) REFERENCES `tbcontroledatalab` (`idData`);

--
-- Limitadores para a tabela `tbchoquesala`
--
ALTER TABLE `tbchoquesala`
  ADD CONSTRAINT `tbchoquesala_ibfk_1` FOREIGN KEY (`idReSala`) REFERENCES `tbreservasala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbchoquesala_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`),
  ADD CONSTRAINT `tbchoquesala_ibfk_4` FOREIGN KEY (`idChoqueData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbcontroledataeq`
--
ALTER TABLE `tbcontroledataeq`
  ADD CONSTRAINT `tbcontroledataeq_ibfk_1` FOREIGN KEY (`idReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbcontroledataeq_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbcontroledatalab`
--
ALTER TABLE `tbcontroledatalab`
  ADD CONSTRAINT `tbcontroledatalab_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbreservalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbcontroledatalab_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbcontroledatasala`
--
ALTER TABLE `tbcontroledatasala`
  ADD CONSTRAINT `tbcontroledatasala_ibfk_1` FOREIGN KEY (`idReSala`) REFERENCES `tbreservasala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbcontroledatasala_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbequipamento`
--
ALTER TABLE `tbequipamento`
  ADD CONSTRAINT `tbequipamento_ibfk_1` FOREIGN KEY (`idTipoEq`) REFERENCES `tbtipoeq` (`idTipoEq`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbimagem`
--
ALTER TABLE `tbimagem`
  ADD CONSTRAINT `tbimagem_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tblaboratorio`
--
ALTER TABLE `tblaboratorio`
  ADD CONSTRAINT `tblaboratorio_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbcor` (`idCor`) ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbmatricula`
--
ALTER TABLE `tbmatricula`
  ADD CONSTRAINT `tbmatricula_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbnoticonexao`
--
ALTER TABLE `tbnoticonexao`
  ADD CONSTRAINT `tbnoticonexao_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbnoticonexao_ibfk_2` FOREIGN KEY (`idNoti`) REFERENCES `tbnotificacao` (`idNoti`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbonline`
--
ALTER TABLE `tbonline`
  ADD CONSTRAINT `tbonline_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbprimeiroacesso`
--
ALTER TABLE `tbprimeiroacesso`
  ADD CONSTRAINT `tbprimeiroacesso_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbreqs_professor`
--
ALTER TABLE `tbreqs_professor`
  ADD CONSTRAINT `tbreqs_professor_ibfk_2` FOREIGN KEY (`idReq`) REFERENCES `tbrequerimentos` (`idReq`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbrequerimentos`
--
ALTER TABLE `tbrequerimentos`
  ADD CONSTRAINT `tbrequerimentos_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbrequerimentos_ibfk_2` FOREIGN KEY (`idTemp`) REFERENCES `tbtemporarios` (`idTemp`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbreservaeq`
--
ALTER TABLE `tbreservaeq`
  ADD CONSTRAINT `tbreservaeq_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbreservalab`
--
ALTER TABLE `tbreservalab`
  ADD CONSTRAINT `tbreservalab_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbreservasala`
--
ALTER TABLE `tbreservasala`
  ADD CONSTRAINT `tbreservasala_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbreservasala_ibfk_2` FOREIGN KEY (`idSala`) REFERENCES `tbsala` (`idSala`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbreservatipoeq`
--
ALTER TABLE `tbreservatipoeq`
  ADD CONSTRAINT `tbreservatipoeq_ibfk_1` FOREIGN KEY (`idTipoEq`) REFERENCES `tbtipoeq` (`idTipoEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbreservatipoeq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbsala`
--
ALTER TABLE `tbsala`
  ADD CONSTRAINT `tbsala_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbcor` (`idCor`) ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbtelefone`
--
ALTER TABLE `tbtelefone`
  ADD CONSTRAINT `tbtelefone_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbtipoeq`
--
ALTER TABLE `tbtipoeq`
  ADD CONSTRAINT `tbtipoeq_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbcor` (`idCor`) ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`idAfiliacao`) REFERENCES `tbafiliacao` (`idAfiliacao`) ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbusuariotemp`
--
ALTER TABLE `tbusuariotemp`
  ADD CONSTRAINT `tbusuarioTemp_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
