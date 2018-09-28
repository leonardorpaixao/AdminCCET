-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Set-2018 às 06:54
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
(1, 'PROFESSOR', 3),
(2, 'SECRETARIA', 1),
(3, 'ALUNO', 4),
(4, 'ADMINISTRADOR', 0);

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

--
-- Extraindo dados da tabela `tbalocareeq`
--

INSERT INTO `tbalocareeq` (`patrimonio`, `idReEq`, `idData`) VALUES
(12345, 1, 26876),
(4294967295, 2, 26881);

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

--
-- Extraindo dados da tabela `tbavisos`
--

INSERT INTO `tbavisos` (`idAviso`, `tituloAviso`, `textoAviso`, `dataAviso`, `statusAviso`) VALUES
(1, 'AVISO', 'Este campo serve para divulgação de avisos do CCET<br>&nbsp;', '2018-04-19', 'Ativo');

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
(1, 26876, 'Entregue', NULL),
(2, 26881, 'Recebido', NULL);

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

--
-- Extraindo dados da tabela `tbcontroledatasala`
--

INSERT INTO `tbcontroledatasala` (`idReSala`, `idData`, `statusData`, `justificativa`) VALUES
(8, 26882, 'Aprovado', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcor`
--

CREATE TABLE `tbcor` (
  `idCor` int(11) UNSIGNED NOT NULL,
  `cor` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbcor`
--

INSERT INTO `tbcor` (`idCor`, `cor`) VALUES
(1, '#ff2121');

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
(26870, '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(26871, '2018-04-18 15:00:00', '2018-04-18 16:00:00'),
(26872, '2018-04-18 12:00:00', '2018-04-18 13:00:00'),
(26873, '2018-06-07 13:00:00', '2018-06-07 14:00:00'),
(26874, '2018-06-28 19:00:00', '2018-06-28 20:00:00'),
(26875, '2018-06-27 16:00:00', '2018-06-27 17:00:00'),
(26876, '2018-06-27 15:00:00', '2018-06-27 17:00:00'),
(26877, '2018-06-26 10:00:00', '2018-06-26 12:00:00'),
(26878, '2018-06-28 19:00:00', '2018-06-28 22:00:00'),
(26879, '2018-06-27 19:00:00', '2018-06-27 20:00:00'),
(26880, '2018-07-10 15:00:00', '2018-07-10 17:00:00'),
(26881, '2018-09-03 17:00:00', '2018-09-03 19:00:00'),
(26882, '2018-07-09 00:00:00', '2018-07-09 00:00:00');

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

--
-- Extraindo dados da tabela `tbdisciplinas`
--

INSERT INTO `tbdisciplinas` (`idDisc`, `codigo`, `nome`, `carga`, `status`) VALUES
(1, ' COMP0308 ', ' ATIVIDADES COMPLEMENTARES ', ' 	120h ', 'Ativo'),
(2, ' COMP0291 ', ' ATIVIDADES COMPLEMENTARES ', ' 	30h ', 'Ativo'),
(3, ' COMP0292 ', ' ATIVIDADES COMPLEMENTARES ', ' 	60h ', 'Ativo'),
(4, ' COMP0307 ', ' ATIVIDADES COMPLEMENTARES ', ' 	90h ', 'Ativo'),
(5, ' COMP0317 ', ' ATIVIDADES COMPLEMENTARES ', ' 	60h ', 'Ativo'),
(6, ' COMP0316 ', ' ATIVIDADES COMPLEMENTARES ', ' 	15h ', 'Ativo'),
(7, ' COMP0190 ', ' ESTAGIO SUPERVISIONADO EM CIENCIA DA COMPUTACAO ', ' 	180h ', 'Ativo'),
(8, ' COMP0340 ', ' ESTÁGIO SUPERVISIONADO EM ENGENHARIA DE COMPUTAÇÃO ', ' 	180h ', 'Ativo'),
(9, ' COMP0344 ', ' ESTÁGIO SUPERVISIONADO EM SISTEMAS DE INFORMAÇÃO ', ' 	180h ', 'Ativo'),
(10, ' COMP0345 ', ' TRABALHO DE CONCLUSÃO CURSO EM SISTEMA DE INFORMAÇÃO I ', ' 	90h ', 'Ativo'),
(11, ' COMP0186 ', ' TRABALHO DE CONCLUSAO DE CURSO ', ' 	150h ', 'Ativo'),
(12, ' COMP0338 ', ' TRABALHO DE CONCLUSÃO DE CURSO DE CIÊNCIA DA COMPUTAÇÃO I ', ' 	75h ', 'Ativo'),
(13, ' COMP0339 ', ' TRABALHO DE CONCLUSÃO DE CURSO DE CIÊNCIA DA COMPUTAÇÃO II ', ' 	75h ', 'Ativo'),
(14, ' COMP0341 ', ' TRABALHO DE CONCLUSÃO DE CURSO E ENGENHARIA DE COMPUTAÇÃO I ', ' 	75h ', 'Ativo'),
(15, ' COMP0342 ', ' TRABALHO DE CONCLUSÃO DE CURSO EM ENGENHARIA DE COMPUTAÇÃO II ', ' 	75h ', 'Ativo'),
(16, ' COMP0346 ', ' TRABALHO DE CONCLUSÂO DE CURSO E SISTEMA DE INFORMAÇÃO II ', ' 	90h ', 'Ativo'),
(17, ' COMP0248 ', ' ALGORITMOS ', ' 	60h ', 'Ativo'),
(18, ' COMP0244 ', ' ALGORITMOS APROXIMADOS ', ' 	60h ', 'Ativo'),
(19, ' COMP0331 ', ' ALGORITMOS PARALELOS E DISTRIBUÍDOS ', ' 	60h ', 'Ativo'),
(20, ' COMP0266 ', ' APRENDIZAGEM COLABORATIVA SUPORTADA POR COMPUTADORES ( CSCL) ', ' 	60h ', 'Ativo'),
(21, ' COMP0223 ', ' ARQUITETURA DE COMPUTADORES I ', ' 	90h ', 'Ativo'),
(22, ' COMP0224 ', ' ARQUITETURA DE COMPUTADORES II ', ' 	60h ', 'Ativo'),
(23, ' COMP0304 ', ' AVALIAÇÃO DE DESEMPENHO DE SISTEMAS ', ' 	60h ', 'Ativo'),
(24, ' COMP0311 ', ' BANCO DE DADOS ', ' 	60h ', 'Ativo'),
(25, ' COMP0147 ', ' BANCO DE DADOS ', ' 	60h ', 'Ativo'),
(26, ' COMP0314 ', ' BANCO DE DADOS DISTRIBUIDOS ', ' 	60h ', 'Ativo'),
(27, ' COMP0238 ', ' CATEGORIAIS COMPUTACIONAIS ', ' 	60h ', 'Ativo'),
(28, ' COMP0221 ', ' CIRCUITO DIGITAIS II ', ' 	60h ', 'Ativo'),
(29, ' COMP0219 ', ' CIRCUITOS DIGITAIS I ', ' 	60h ', 'Ativo'),
(30, ' COMP0203 ', ' COMPILADORES ', ' 	60h ', 'Ativo'),
(31, ' COMP0276 ', ' COMPUTAÇÃO EVOLUTIVA ', ' 	60h ', 'Ativo'),
(32, ' COMP0167 ', ' COMPUTACAO GRAFICA ', ' 	60h ', 'Ativo'),
(33, ' COMP0325 ', ' COMPUTAÇÃO GRÁFICA ', ' 	60h ', 'Ativo'),
(34, ' COMP0093 ', ' CONTROLE ESTATISTICO DE QUALIDADE ', ' 	60h ', 'Ativo'),
(35, ' COMP0150 ', ' DATAWAREHOUSE E DATA MINING ', ' 	60h ', 'Ativo'),
(36, ' COMP0245 ', ' DESAFIOS DE PROGRAMAÇÃO ', ' 	60h ', 'Ativo'),
(37, ' COMP0290 ', ' DESENVOLVIMENTO BASEADO EM COMPONENTES ', ' 	60h ', 'Ativo'),
(38, ' COMP0279 ', ' DESENVOLVIMENTO DE SOFTWARE I ', ' 	60h ', 'Ativo'),
(39, ' COMP0280 ', ' DESENVOLVIMENTO DE SOFTWARE II ', ' 	90h ', 'Ativo'),
(40, ' COMP0281 ', ' DESENVOLVIMENTO DE SOFTWARE III ', ' 	60h ', 'Ativo'),
(41, ' COMP0252 ', ' EMPREENDEDORISMO E INFORMÁTICA ', ' 	60h ', 'Ativo'),
(42, ' COMP0267 ', ' ENGENHARIA DE SOFTWARE EDUCACIONAL ', ' 	60h ', 'Ativo'),
(43, ' COMP0293 ', ' ENGENHARIA DE SOFTWARE I ', ' 	60h ', 'Ativo'),
(44, ' COMP0294 ', ' ENGENHARIA DE SOFTWARE II ', ' 	90h ', 'Ativo'),
(45, ' COMP0347 ', ' ENGENHARIA DE SOFTWARE PARA SISTEMA DE INFORMAÇÃO I ', ' 	90h ', 'Ativo'),
(46, ' COMP0348 ', ' ENGENHARIA DE SOFTWARE PARA SISTEMA DE INFORMAÇÃO II ', ' 	90h ', 'Ativo'),
(47, ' COMP0287 ', ' ESPECIFICAÇÃO FORMAL ', ' 	60h ', 'Ativo'),
(48, ' COMP0009 ', ' ESTATISTICA APLICADA ', ' 	60h ', 'Ativo'),
(49, ' COMP0212 ', ' ESTRUTURA DE DADOS I ', ' 	60h ', 'Ativo'),
(50, ' COMP0213 ', ' ESTRUTURA DE DADOS II ', ' 	60h ', 'Ativo'),
(51, ' COMP0216 ', ' ESTRUTURA DE DADOS PARA ENGENHARIA DE COMPUTAÇÃO ', ' 	90h ', 'Ativo'),
(52, ' COMP0217 ', ' ESTRUTURA DE DADOS PARA SISTEMAS DE INFORMAÇÃO I ', ' 	60h ', 'Ativo'),
(53, ' COMP0218 ', ' ESTRUTURA DE DADOS PARA SISTEMAS DE INFORMAÇÃO II ', ' 	90h ', 'Ativo'),
(54, ' COMP0102 ', ' FUNDAMENTOS DA COMPUTACAO ', ' 	60h ', 'Ativo'),
(55, ' COMP0196 ', ' FUNDAMENTOS DA COMPUTAÇÃO ', ' 	30h ', 'Ativo'),
(56, ' COMP0210 ', ' FUNDAMENTOS DA COMPUTAÇÃO PARA SISTEMAS DE INFORMAÇÃO ', ' 	60h ', 'Ativo'),
(57, ' COMP0206 ', ' FUNDAMENTOS DE ENGENHARIA DE COMPUTAÇÃO ', ' 	30h ', 'Ativo'),
(58, ' COMP0241 ', ' GEOMETRIA COMPUTACIONAL ', ' 	60h ', 'Ativo'),
(59, ' COMP0283 ', ' GERÊNCIA DE PROJETO DE SOFTWARE ', ' 	60h ', 'Ativo'),
(60, ' COMP0295 ', ' GERÊNCIA DE PROJETOS ', ' 	60h ', 'Ativo'),
(61, ' COMP0299 ', ' GERÊNCIA DE REDES DE COMPUTADORES ', ' 	60h ', 'Ativo'),
(62, ' COMP0260 ', ' GESTÃO DA INFORMAÇÃO ', ' 	60h ', 'Ativo'),
(63, ' COMP0235 ', ' GRAFOS E ALGORITMOS COMPUTACIONAIS ', ' 	60h ', 'Ativo'),
(64, ' COMP0229 ', ' HARDWARE E SOFTWARE CO-DESIGN ', ' 	60h ', 'Ativo'),
(65, ' COMP0268 ', ' HIPERMÍDIAS EDUCATIVAS ', ' 	60h ', 'Ativo'),
(66, ' COMP0003 ', ' INFERENCIA ', ' 	60h ', 'Ativo'),
(67, ' COMP0265 ', ' INFORMÁTICA EDUCATIVA ', ' 	60h ', 'Ativo'),
(68, ' COMP0250 ', ' INFORMÁTICA ÉTICA E SOCIEDADE ', ' 	60h ', 'Ativo'),
(69, ' COMP0335 ', ' INFORMATICA INSTRUMENTAL ', ' 	60h ', 'Ativo'),
(70, ' COMP0313 ', ' INTEGRAÇÃO DE DADOS WEB E WAREHOUSING ', ' 	60h ', 'Ativo'),
(71, ' COMP0163 ', ' INTELIGENCIA ARTIFICIAL ', ' 	60h ', 'Ativo'),
(72, ' COMP0271 ', ' INTELIGÊNCIA ARTIFICIAL ', ' 	60h ', 'Ativo'),
(73, ' COMP0274 ', ' INTELIGÊNCIA ARTIFICIAL PARA JOGOS ', ' 	60h ', 'Ativo'),
(74, ' COMP0161 ', ' INTERFACE HOMEM-MAQUINA ', ' 	60h ', 'Ativo'),
(75, ' COMP0282 ', ' INTERFACE HUMANO - COMPUTADOR ', ' 	60h ', 'Ativo'),
(76, ' COMP0226 ', ' INTRODUÇÃO A AUTOMAÇÃO INDUSTRIAL ', ' 	60h ', 'Ativo'),
(77, ' COMP0100 ', ' INTRODUCAO A CIENCIA DA COMPUTACAO ', ' 	60h ', 'Ativo'),
(78, ' COMP0208 ', ' INTRODUÇÃO A CIÊNCIA DA COMPUTAÇÃO ', ' 	60h ', 'Ativo'),
(79, ' COMP0225 ', ' INTRODUÇÃO À CIRCUITOS INTEGRADOS ', ' 	60h ', 'Ativo'),
(80, ' COMP0001 ', ' INTRODUÇÃO Á ESTATÍSTICA ', ' 	60h ', 'Ativo'),
(81, ' COMP0240 ', ' INTRODUÇÃO À PROGRAMAÇÃO LINEAR E INTEIRA ', ' 	60h ', 'Ativo'),
(82, ' COMP0333 ', ' INTRODUÇÃO À PROGRAMAÇÃO PARARELA E DISTRIBUÍDA ', ' 	60h ', 'Ativo'),
(83, ' COMP0220 ', ' LABORATÓRIO DE CIRCUITOS DIGITAIS I ', ' 	30h ', 'Ativo'),
(84, ' COMP0222 ', ' LABORATÓRIO DE CIRCUITOS DIGITAIS II ', ' 	30h ', 'Ativo'),
(85, ' COMP0243 ', ' LAMBDA CÁLCULO E TEORIA DOS TIPOS ', ' 	60h ', 'Ativo'),
(86, ' COMP0209 ', ' LINGUAGEM DE PROGRAMAÇÃO PARA SISTEMAS DE INFORMAÇÃO ', ' 	90h ', 'Ativo'),
(87, ' COMP0207 ', ' LINGUAGEM FORMAIS E COMPILADORES ', ' 	90h ', 'Ativo'),
(88, ' COMP0236 ', ' LINGUAGENS FORMAIS E COMPUTABILIDADE ', ' 	90h ', 'Ativo'),
(89, ' COMP0211 ', ' LINGUAGENS FORMAIS E TRADUTORES ', ' 	90h ', 'Ativo'),
(90, ' COMP0285 ', ' LINHAS DE PRODUTO DE SOFTWARE ', ' 	60h ', 'Ativo'),
(91, ' COMP0233 ', ' LÓGICA PARA COMPUTAÇÃO ', ' 	60h ', 'Ativo'),
(92, ' COMP0288 ', ' METODOLOGIAS DE DESENVOLVIMENTO DE SOFTWARE ', ' 	60h ', 'Ativo'),
(93, ' COMP0337 ', ' MÉTODOS E TÉCNICAS DE PESQUISA ', ' 	60h ', 'Ativo'),
(94, ' COMP0349 ', ' MICROCOMPUTADORES ', ' 	60h ', 'Ativo'),
(95, ' COMP0101 ', ' MICROCOMPUTADORES ', ' 	60h ', 'Ativo'),
(96, ' COMP0312 ', ' MINERAÇÃO DE DADOS ', ' 	60h ', 'Ativo'),
(97, ' COMP0315 ', ' MINERAÇÃO DE TEXTOS ', ' 	60h ', 'Ativo'),
(98, ' COMP0232 ', ' ORGANIZAÇÃO E ARQUITETURA DE COMPUTADORES ', ' 	60h ', 'Ativo'),
(99, ' COMP0254 ', ' ORGANIZAÇÕES DE APRENDIZAGEM ', ' 	60h ', 'Ativo'),
(100, ' COMP0239 ', ' OTIMIZAÇÃO ', ' 	60h ', 'Ativo'),
(101, ' COMP0286 ', ' PADRÕES DE SOFTWARE E REFATORAÇÃO ', ' 	60h ', 'Ativo'),
(102, ' COMP0201 ', ' PARADIGMAS DE PROGRAMAÇÃO ', ' 	30h ', 'Ativo'),
(103, ' COMP0017 ', ' PESQUISA OPERACIONAL ', ' 	60h ', 'Ativo'),
(104, ' COMP0088 ', ' PLANEJAMENTO E PESQUISA EM ESTATISTICA ', ' 	45h ', 'Ativo'),
(105, ' COMP0051 ', ' PROCESSAMENTO DE DADOS ', ' 	60h ', 'Ativo'),
(106, ' COMP0166 ', ' PROCESSAMENTO DE IMAGENS ', ' 	60h ', 'Ativo'),
(107, ' COMP0324 ', ' PROCESSAMENTO DE IMAGENS ', ' 	60h ', 'Ativo'),
(108, ' COMP0319 ', ' PROCESSAMENTO DE IMAGENS E COMPUTAÇÃO GRÁFICA ', ' 	90h ', 'Ativo'),
(109, ' COMP0131 ', ' PROGRAMACAO CONCORRENTE ', ' 	60h ', 'Ativo'),
(110, ' COMP0332 ', ' PROGRAMAÇÃO CONCORRENTE ', ' 	60h ', 'Ativo'),
(111, ' COMP0199 ', ' PROGRAMAÇÃO DECLARATIVA ', ' 	60h ', 'Ativo'),
(112, ' COMP0103 ', ' PROGRAMACAO I ', ' 	90h ', 'Ativo'),
(113, ' COMP0104 ', ' PROGRAMACAO II ', ' 	60h ', 'Ativo'),
(114, ' COMP0334 ', ' PROGRAMAÇÃO IMPERATIVA ', ' 	60h ', 'Ativo'),
(115, ' COMP0197 ', ' PROGRAMAÇÃO IMPERATIVA ', ' 	90h ', 'Ativo'),
(116, ' COMP0202 ', ' PROGRAMAÇÃO ORIENTADA A ASPECTOS ', ' 	30h ', 'Ativo'),
(117, ' COMP0198 ', ' PROGRAMAÇÃO ORIENTADA A OBJETOS ', ' 	60h ', 'Ativo'),
(118, ' COMP0200 ', ' PROGRAMAÇÃO PARA WEB ', ' 	30h ', 'Ativo'),
(119, ' COMP0234 ', ' PROJETO E ANÁLISE DE ALGORITMOS ', ' 	60h ', 'Ativo'),
(120, ' COMP0305 ', ' QUALIDADE DE SERVIÇOS DE REDES ', ' 	60h ', 'Ativo'),
(121, ' COMP0152 ', ' QUALIDADE DE SOFTWARE ', ' 	60h ', 'Ativo'),
(122, ' COMP0284 ', ' QUALIDADE DE SOFTWARE ', ' 	60h ', 'Ativo'),
(123, ' COMP0255 ', ' QUALIDADE TOTAL ', ' 	60h ', 'Ativo'),
(124, ' COMP0169 ', ' REALIDADE VIRTUAL ', ' 	60h ', 'Ativo'),
(125, ' COMP0302 ', ' REDES CONVERGENTES ', ' 	60h ', 'Ativo'),
(126, ' COMP0303 ', ' REDES DE ALTA VELOCIDADE ', ' 	60h ', 'Ativo'),
(127, ' COMP0136 ', ' REDES DE COMPUTADORES ', ' 	60h ', 'Ativo'),
(128, ' COMP0297 ', ' REDES DE COMPUTADORES I ', ' 	60h ', 'Ativo'),
(129, ' COMP0298 ', ' REDES DE COMPUTADORES II ', ' 	60h ', 'Ativo'),
(130, ' COMP0301 ', ' REDES DE COMPUTADORES SEM FIO ', ' 	60h ', 'Ativo'),
(131, ' COMP0272 ', ' REDES NEURAIS ', ' 	60h ', 'Ativo'),
(132, ' COMP0171 ', ' SEGURANCA, CONTROLE E AUDITORIA DE DADOS ', ' 	60h ', 'Ativo'),
(133, ' COMP0264 ', ' SEGURANÇA CONTROLE E AUDITORIA DE DADOS ', ' 	60h ', 'Ativo'),
(134, ' COMP0300 ', ' SEGURANÇA DE REDES DE COMPUTADORES ', ' 	60h ', 'Ativo'),
(135, ' COMP0289 ', ' SEGURANÇA E AUDITOTIA DE SISTEMAS ', ' 	60h ', 'Ativo'),
(136, ' COMP0309 ', ' SEGURANÇA E GERÊNCIA DE REDE DE COMPUTADORES ', ' 	60h ', 'Ativo'),
(137, ' COMP0237 ', ' SEMÂNTICA FORMAL ', ' 	60h ', 'Ativo'),
(138, ' COMP0327 ', ' SISTEMAS CRITICOS ', ' 	60h ', 'Ativo'),
(139, ' COMP0172 ', ' SISTEMAS DE APOIO A DECISAO ', ' 	60h ', 'Ativo'),
(140, ' COMP0257 ', ' SISTEMAS DE APOIO À DECISÃO ', ' 	60h ', 'Ativo'),
(141, ' COMP0262 ', ' SISTEMAS DE INFORMAÇÃO ', ' 	60h ', 'Ativo'),
(142, ' COMP0256 ', ' SISTEMAS DE INFORMAÇÃO EMPRESARIAL ', ' 	60h ', 'Ativo'),
(143, ' COMP0330 ', ' SISTEMAS DE TEMPO REAL ', ' 	60h ', 'Ativo'),
(144, ' COMP0228 ', ' SISTEMAS DIGITAIS DEDICADOS ', ' 	60h ', 'Ativo'),
(145, ' COMP0128 ', ' SISTEMAS DISTRIBUIDOS ', ' 	60h ', 'Ativo'),
(146, ' COMP0326 ', ' SISTEMAS DISTRIBUIDOS ', ' 	60h ', 'Ativo'),
(147, ' COMP0273 ', ' SISTEMAS MULTIAGENTES ', ' 	60h ', 'Ativo'),
(148, ' COMP0329 ', ' SISTEMAS MULTIMÍDIA DISTRIBUIDOS ', ' 	60h ', 'Ativo'),
(149, ' COMP0306 ', ' SISTEMAS OPERACIONAIS ', ' 	90h ', 'Ativo'),
(150, ' COMP0092 ', ' TECNICAS DE AMOSTRAGEM ', ' 	60h ', 'Ativo'),
(151, ' COMP0296 ', ' TECNOLOGIA DE DESENVOLVIMENTO PARA INTERNET ', ' 	60h ', 'Ativo'),
(152, ' COMP0249 ', ' TEORIA DA COMPUTAÇÃO ', ' 	60h ', 'Ativo'),
(153, ' COMP0242 ', ' TEORIA DA RECURSÃO ', ' 	60h ', 'Ativo'),
(154, ' COMP0261 ', ' TEORIA GERAL DOS SISTEMAS ', ' 	60h ', 'Ativo'),
(155, ' COMP0132 ', ' TOLERANCIA A FALHAS ', ' 	60h ', 'Ativo'),
(156, ' COMP0328 ', ' TOLERÂNCIA A FALHAS ', ' 	60h ', 'Ativo'),
(157, ' COMP0168 ', ' TOPICOS ESPECIAIS COMP GRAFICA E PROC DE IMAGENS ', ' 	60h ', 'Ativo'),
(158, ' COMP0383 ', ' TOPICOS ESPECIAIS EM BANCO DE DADOS I ', ' 	60h ', 'Ativo'),
(159, ' COMP0384 ', ' TOPICOS ESPECIAIS EM BANCO DE DADOS II ', ' 	60h ', 'Ativo'),
(160, ' COMP0388 ', ' TOPICOS ESPECIAIS EM COMPUTACAO DISTRIBUIDA I ', ' 	60h ', 'Ativo'),
(161, ' COMP0389 ', ' TOPICOS ESPECIAIS EM COMPUTACAO DISTRIBUIDA II ', ' 	60h ', 'Ativo'),
(162, ' COMP0215 ', ' TÓPICOS ESPECIAIS EM COMPUTAÇÃO DISTRIBUÍDA III ', ' 	30h ', 'Ativo'),
(163, ' COMP0371 ', ' TOPICOS ESPECIAIS EM COMPUTACAO E ALGORITMOS I ', ' 	90h ', 'Ativo'),
(164, ' COMP0258 ', ' TÓPICOS ESPECIAIS EM COMPUTAÇÃO E ALGORITMOS I ', ' 	30h ', 'Ativo'),
(165, ' COMP0390 ', ' TÓPICOS ESPECIAIS EM COMPUTAÇÃO E ALGORITMOS I ', ' 	60h ', 'Ativo'),
(166, ' COMP0372 ', ' TOPICOS ESPECIAIS EM COMPUTACAO E ALGORITMOS II ', ' 	60h ', 'Ativo'),
(167, ' COMP0386 ', ' TOPICOS ESPECIAIS EM COMPUTACAO GRAFICA I ', ' 	60h ', 'Ativo'),
(168, ' COMP0387 ', ' TOPICOS ESPECIAIS EM COMPUTACAO GRAFICA II ', ' 	60h ', 'Ativo'),
(169, ' COMP0320 ', ' TÓPICOS ESPECIAIS EM COMPUTAÇÃO GRÁFICA III ', ' 	30h ', 'Ativo'),
(170, ' COMP0377 ', ' TOPICOS ESPECIAIS EM COMPUTACAO INTELIGENTE I ', ' 	60h ', 'Ativo'),
(171, ' COMP0205 ', ' TÓPICOS ESPECIAIS EM COMPUTAÇÃO INTELIGENTE I ', ' 	30h ', 'Ativo'),
(172, ' COMP0378 ', ' TOPICOS ESPECIAIS EM COMPUTACAO INTELIGENTE II ', ' 	60h ', 'Ativo'),
(173, ' COMP0247 ', ' TÓPICOS ESPECIAIS EM COMPUTAÇÃO INTELIGENTE III ', ' 	60h ', 'Ativo'),
(174, ' COMP0154 ', ' TOPICOS ESPECIAIS EM ENGENHARIA DE SOFTWARE ', ' 	60h ', 'Ativo'),
(175, ' COMP0379 ', ' TOPICOS ESPECIAIS EM ENGENHARIA DE SOFTWARE I ', ' 	60h ', 'Ativo'),
(176, ' COMP0380 ', ' TOPICOS ESPECIAIS EM ENGENHARIA DE SOFTWARE II ', ' 	30h ', 'Ativo'),
(177, ' COMP0362 ', ' TOPICOS ESPECIAIS EM ENGENHARIA DE SOFTWARE II ', ' 	60h ', 'Ativo'),
(178, ' COMP0259 ', ' TÓPICOS ESPECIAIS EM ENGENHARIA DE SOFTWARE II ', ' 	30h ', 'Ativo'),
(179, ' COMP0214 ', ' TÓPICOS ESPECIAIS EM ENGENHARIA DE SOFTWARE III ', ' 	60h ', 'Ativo'),
(180, ' COMP0322 ', ' TÓPICOS ESPECIAIS EM ENGENHARIA DE SOFTWARE IV ', ' 	60h ', 'Ativo'),
(181, ' COMP0370 ', ' TOPICOS ESPECIAIS EM HARDWARE I ', ' 	60h ', 'Ativo'),
(182, ' COMP0204 ', ' TÓPICOS ESPECIAIS EM HARDWARE I ', ' 	30h ', 'Ativo'),
(183, ' COMP0270 ', ' TÓPICOS ESPECIAIS EM HARDWARE I ', ' 	60h ', 'Ativo'),
(184, ' COMP0363 ', ' TOPICOS ESPECIAIS EM HARDWARE II ', ' 	60h ', 'Ativo'),
(185, ' COMP0231 ', ' TOPICOS ESPECIAIS EM HARDWARE II ', ' 	30h ', 'Ativo'),
(186, ' COMP0277 ', ' TÓPICOS ESPECIAIS EM HARDWARE II ', ' 	90h ', 'Ativo'),
(187, ' COMP0323 ', ' TÓPICOS ESPECIAIS EM HARDWARE III ', ' 	60h ', 'Ativo'),
(188, ' COMP0183 ', ' TOPICOS ESPECIAIS EM INFORMATICA E CONTEXTO SOCIAL ', ' 	60h ', 'Ativo'),
(189, ' COMP0375 ', ' TOPICOS ESPECIAIS EM INFORMATICA E EDUCACAO I ', ' 	60h ', 'Ativo'),
(190, ' COMP0364 ', ' TOPICOS ESPECIAIS EM INFORMATICA E EDUCACAO II ', ' 	60h ', 'Ativo'),
(191, ' COMP0376 ', ' TOPICOS ESPECIAIS EM INFORMATICA E EDUCACAO II ', ' 	30h ', 'Ativo'),
(192, ' COMP0107 ', ' TOPICOS ESPECIAIS EM LINGUA DE PROGRAMACAO ', ' 	60h ', 'Ativo'),
(193, ' COMP0366 ', ' TÓPICOS ESPECIAIS EM LINGUAGEM DE PROGRAMAÇÃO I ', ' 	60h ', 'Ativo'),
(194, ' COMP0367 ', ' TOPICOS ESPECIAIS EM LINGUAGEM DE PROGRAMACAO II ', ' 	30h ', 'Ativo'),
(195, ' COMP0365 ', ' TOPICOS ESPECIAIS EM LINGUAGEM DE PROGRAMACAO II ', ' 	60h ', 'Ativo'),
(196, ' COMP0246 ', ' TÓPICOS ESPECIAIS EM LINGUAGEM DE PROGRAMAÇÃO III ', ' 	60h ', 'Ativo'),
(197, ' COMP0385 ', ' TOPICOS ESPECIAIS EM PROCESSAMENTO DE IMAGENS I ', ' 	60h ', 'Ativo'),
(198, ' COMP0321 ', ' TÓPICOS ESPECIAIS EM PROCESSAMENTO DE IMAGENS II ', ' 	30h ', 'Ativo'),
(199, ' COMP0278 ', ' TÓPICOS ESPECIAIS EM PROCESSAMENTO DE IMAGENS III ', ' 	30h ', 'Ativo'),
(200, ' COMP0381 ', ' TOPICOS ESPECIAIS EM REDE D COMPUTADORES I ', ' 	60h ', 'Ativo'),
(201, ' COMP0382 ', ' TOPICOS ESPECIAIS EM REDE DE COMPUTADORES II ', ' 	60h ', 'Ativo'),
(202, ' COMP0230 ', ' TÓPICOS ESPECIAIS EM REDES DE COMPUTADORES III ', ' 	30h ', 'Ativo'),
(203, ' COMP0373 ', ' TOPICOS ESPECIAIS EM SISTEMAS DE INFORMACAO I ', ' 	60h ', 'Ativo'),
(204, ' COMP0374 ', ' TOPICOS ESPECIAIS EM SISTEMAS DE INFORMACAO II ', ' 	60h ', 'Ativo'),
(205, ' COMP0269 ', ' TÓPICOS ESPECIAIS EM TÉCNICAS DE PROGRAMAÇÃO I ', ' 	60h ', 'Ativo'),
(206, ' COMP0369 ', ' TOPICOS ESPECIAIS EM TECNICAS DE PROGRAMACAO II ', ' 	60h ', 'Ativo'),
(207, ' COMP0368 ', ' TOPICOS ESPECIAIS EM TECNICAS DE PROGRAMACAO III ', ' 	30h ', 'Ativo'),
(208, ' COMP0133 ', ' TOPICOS ESP SIST OPERACIONAIS SIST DISTRIBUIDOS ', ' 	60h ', 'Ativo'),
(209, ' COMP0194 ', ' TRABALHO COOPERATIVO APOIADO POR COMPUTADOR ', ' 	60h ', 'Ativo'),
(210, ' COMP0227 ', ' VERIFICAÇÃO FUNCIONAL ', ' 	60h ', 'Ativo'),
(211, ' COMP0275 ', ' VISÃO COMPUTACIONAL E RECONHECIMENTO DE PADRÕES ', ' 	60h ', 'Ativo');

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

--
-- Extraindo dados da tabela `tbequipamento`
--

INSERT INTO `tbequipamento` (`patrimonio`, `idTipoEq`, `modelo`, `statusEq`) VALUES
(12345, NULL, 'LG - 2500', 'Ativo'),
(4294967295, 2, 'Projetor LG', 'Ativo');

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
(17295, '::1', 3, 'Inseriu', '2018-03-06 23:46:36', 304, 'tbReservaEq'),
(17296, '::1', 3, 'Inseriu', '2018-03-06 23:46:37', 0, 'tbControleDataEq'),
(17297, '::1', 3, 'Deslogou', '2018-03-06 23:46:42', NULL, NULL),
(17298, '::1', 2, 'Deslogou', '2018-03-06 23:56:10', NULL, NULL),
(17299, '::1', 3, 'Deslogou', '2018-03-24 23:53:21', NULL, NULL),
(17300, '::1', 1, 'Deslogou', '2018-04-03 23:30:18', NULL, NULL),
(17301, '::1', 1, 'Deslogou', '2018-04-17 21:09:23', NULL, NULL),
(17302, '::1', 4, 'Deslogou', '2018-04-17 21:13:26', NULL, NULL),
(17303, '::1', 4, 'Inseriu', '2018-04-17 21:14:35', 0, 'tbReservaSala'),
(17304, '::1', 4, 'Deslogou', '2018-04-17 21:15:41', NULL, NULL),
(17305, '::1', 4, 'Deslogou', '2018-04-17 21:16:33', NULL, NULL),
(17306, '::1', 4, 'Deslogou', '2018-04-17 21:19:05', NULL, NULL),
(17307, '::1', 1, 'Deslogou', '2018-04-17 21:21:51', NULL, NULL),
(17308, '::1', 4, 'Deslogou', '2018-04-17 21:22:33', NULL, NULL),
(17309, '::1', 4, 'Deslogou', '2018-04-17 21:23:03', NULL, NULL),
(17310, '::1', 3, 'Deslogou', '2018-04-17 21:23:33', NULL, NULL),
(17311, '::1', 4, 'Deslogou', '2018-04-17 21:27:35', NULL, NULL),
(17312, '::1', 2, 'Deslogou', '2018-04-17 21:28:42', NULL, NULL),
(17313, '::1', 4, 'Atualizou disciplinas.', '2018-04-17 21:29:27', NULL, NULL),
(17314, '::1', 4, 'Deslogou', '2018-04-17 21:34:10', NULL, NULL),
(17315, '::1', 4, 'Modificou', '2018-04-17 21:39:57', 304, 'tbControleDataEq'),
(17316, '::1', 4, 'Inseriu', '2018-04-17 21:41:28', 305, 'tbReservaEq'),
(17317, '::1', 4, 'Inseriu', '2018-04-17 21:41:28', 0, 'tbControleDataEq'),
(17318, '::1', 4, 'Excluiu', '2018-04-17 21:46:34', 305, 'tbReservaEq'),
(17319, '::1', 4, 'Excluiu', '2018-04-17 21:46:37', 304, 'tbReservaEq'),
(17320, '::1', 4, 'Atualizou disciplinas.', '2018-04-19 16:04:16', NULL, NULL),
(17321, '::1', 4, 'Inseriu', '2018-04-19 16:10:36', 0, 'tbEquipamento'),
(17322, '::1', 4, 'Inseriu', '2018-04-19 16:11:14', 1, 'tbAvisos'),
(17323, '::1', 4, 'Deslogou', '2018-04-19 16:26:30', NULL, NULL),
(17324, '::1', 4, 'Deslogou', '2018-04-19 16:33:22', NULL, NULL),
(17325, '::1', 4, 'Inseriu', '2018-04-19 16:35:05', NULL, 'tbEquipamento'),
(17326, '::1', 4, 'Deslogou', '2018-05-24 12:58:01', NULL, NULL),
(17327, '::1', 1, 'Deslogou', '2018-05-24 13:04:55', NULL, NULL),
(17328, '::1', 2, 'Deslogou', '2018-05-24 13:05:22', NULL, NULL),
(17329, '::1', 4, 'Inseriu', '2018-05-24 13:06:01', 1, 'tbSala'),
(17330, '::1', 4, 'Deslogou', '2018-05-24 13:06:16', NULL, NULL),
(17331, '::1', 2, 'Deslogou', '2018-06-05 17:06:20', NULL, NULL),
(17332, '::1', 1, 'Inseriu', '2018-06-05 17:11:53', 1, 'tbReservaSala'),
(17333, '::1', 1, 'Deslogou', '2018-06-05 17:12:50', NULL, NULL),
(17334, '::1', 2, 'Modificou', '2018-06-05 17:13:20', 1, 'tbControleDataSala'),
(17335, '::1', 2, 'Modificou', '2018-06-05 17:13:32', 1, 'tbControleDataSala'),
(17336, '::1', 2, 'Deslogou', '2018-06-05 17:14:14', NULL, NULL),
(17337, '::1', 1, 'Deslogou', '2018-06-05 17:19:58', NULL, NULL),
(17338, '::1', 4, 'Excluiu', '2018-06-18 00:15:05', 0, 'tbSala'),
(17339, '::1', 4, 'Excluiu', '2018-06-18 00:17:28', 0, 'tbSala'),
(17340, '::1', 4, 'Excluiu', '2018-06-18 00:50:19', 0, 'tbSala'),
(17341, '::1', 4, 'Deslogou', '2018-06-18 00:55:42', NULL, NULL),
(17342, '::1', 4, 'Deslogou', '2018-06-18 01:24:10', NULL, NULL),
(17343, '::1', 4, 'Excluiu', '2018-06-18 02:03:27', 0, 'tbSala'),
(17344, '::1', 4, 'Excluiu', '2018-06-18 02:24:08', 0, 'tbSala'),
(17345, '::1', 2, 'Deslogou', '2018-06-20 23:07:00', NULL, NULL),
(17346, '::1', 2, 'Deslogou', '2018-06-20 23:37:02', NULL, NULL),
(17347, '::1', 5, 'Confirmou termo', '2018-06-20 23:37:43', NULL, NULL),
(17348, '::1', 5, 'Deslogou', '2018-06-20 23:38:14', NULL, NULL),
(17349, '::1', 6, 'Confirmou termo', '2018-06-21 00:11:07', NULL, NULL),
(17350, '::1', 6, 'Deslogou', '2018-06-21 00:12:50', NULL, NULL),
(17351, '::1', 7, 'Confirmou termo', '2018-06-21 00:16:13', NULL, NULL),
(17352, '::1', 7, 'Deslogou', '2018-06-21 00:18:24', NULL, NULL),
(17353, '::1', 8, 'Confirmou termo', '2018-06-21 00:20:35', NULL, NULL),
(17354, '::1', 8, 'Deslogou', '2018-06-21 00:24:52', NULL, NULL),
(17355, '::1', 9, 'Confirmou termo', '2018-06-21 00:25:00', NULL, NULL),
(17356, '::1', 9, 'Deslogou', '2018-06-21 00:25:59', NULL, NULL),
(17357, '::1', 11, 'Confirmou termo', '2018-06-21 00:26:06', NULL, NULL),
(17358, '::1', 11, 'Deslogou', '2018-06-21 00:29:00', NULL, NULL),
(17359, '::1', 2, 'Deslogou', '2018-06-21 00:40:34', NULL, NULL),
(17360, '::1', 2, 'Deslogou', '2018-06-21 00:40:39', NULL, NULL),
(17361, '::1', 12, 'Confirmou termo', '2018-06-21 02:36:51', NULL, NULL),
(17362, '::1', 12, 'Deslogou', '2018-06-21 02:37:04', NULL, NULL),
(17363, '::1', 12, 'Confirmou termo', '2018-06-21 02:38:00', NULL, NULL),
(17364, '::1', 12, 'Deslogou', '2018-06-21 02:39:34', NULL, NULL),
(17365, '::1', 2, 'Deslogou', '2018-06-21 02:39:51', NULL, NULL),
(17366, '::1', 12, 'Confirmou termo', '2018-06-21 02:40:10', NULL, NULL),
(17367, '::1', 12, 'Deslogou', '2018-06-21 02:41:01', NULL, NULL),
(17368, '::1', 12, 'Confirmou termo', '2018-06-21 02:41:05', NULL, NULL),
(17369, '::1', 12, 'Deslogou', '2018-06-21 02:44:20', NULL, NULL),
(17370, '::1', 2, 'Deslogou', '2018-06-21 02:48:08', NULL, NULL),
(17371, '::1', 12, 'Deslogou', '2018-06-21 02:50:42', NULL, NULL),
(17372, '::1', 12, 'Confirmou termo', '2018-06-21 02:50:46', NULL, NULL),
(17373, '::1', 12, 'Deslogou', '2018-06-21 02:51:44', NULL, NULL),
(17374, '::1', 12, 'Confirmou termo', '2018-06-21 02:52:03', NULL, NULL),
(17375, '::1', 12, 'Deslogou', '2018-06-21 02:53:17', NULL, NULL),
(17376, '::1', 12, 'Confirmou termo', '2018-06-21 02:53:21', NULL, NULL),
(17377, '::1', 12, 'Deslogou', '2018-06-21 02:57:28', NULL, NULL),
(17378, '::1', 12, 'Confirmou termo', '2018-06-21 02:57:32', NULL, NULL),
(17379, '::1', 12, 'Deslogou', '2018-06-21 02:58:27', NULL, NULL),
(17380, '::1', 12, 'Deslogou', '2018-06-21 03:00:57', NULL, NULL),
(17381, '::1', 12, 'Deslogou', '2018-06-21 03:02:18', NULL, NULL),
(17382, '::1', 12, 'Deslogou', '2018-06-21 03:03:13', NULL, NULL),
(17383, '::1', 12, 'Confirmou termo', '2018-06-21 03:05:23', NULL, NULL),
(17384, '::1', 2, 'Deslogou', '2018-06-23 00:18:26', NULL, NULL),
(17385, '::1', 5, 'Deslogou', '2018-06-23 00:20:40', NULL, NULL),
(17386, '::1', 5, 'Deslogou', '2018-06-23 00:20:43', NULL, NULL),
(17387, '::1', 12, 'Deslogou', '2018-06-23 00:28:00', NULL, NULL),
(17388, '::1', 5, 'Deslogou', '2018-06-23 00:32:02', NULL, NULL),
(17389, '::1', 5, 'Deslogou', '2018-06-23 00:42:43', NULL, NULL),
(17390, '::1', 5, 'Confirmou termo', '2018-06-25 20:34:28', NULL, NULL),
(17391, '::1', 5, 'Deslogou', '2018-06-25 20:34:58', NULL, NULL),
(17392, '::1', 5, 'Deslogou', '2018-06-25 21:46:07', NULL, NULL),
(17393, '::1', 12, 'Confirmou termo', '2018-06-25 21:46:13', NULL, NULL),
(17394, '::1', 12, 'Deslogou', '2018-06-25 21:47:30', NULL, NULL),
(17395, '::1', 12, 'Deslogou', '2018-06-25 21:48:46', NULL, NULL),
(17396, '::1', 12, 'Confirmou termo', '2018-06-25 21:48:52', NULL, NULL),
(17397, '::1', 12, 'Deslogou', '2018-06-25 21:50:28', NULL, NULL),
(17398, '::1', 12, 'Confirmou termo', '2018-06-25 21:50:34', NULL, NULL),
(17399, '::1', 12, 'Deslogou', '2018-06-25 21:52:07', NULL, NULL),
(17400, '::1', 12, 'Confirmou termo', '2018-06-25 21:52:15', NULL, NULL),
(17401, '::1', 12, 'Deslogou', '2018-06-25 21:53:18', NULL, NULL),
(17402, '::1', 12, 'Confirmou termo', '2018-06-25 21:54:53', NULL, NULL),
(17403, '::1', 12, 'Deslogou', '2018-06-25 21:55:59', NULL, NULL),
(17404, '::1', 12, 'Confirmou termo', '2018-06-25 21:56:02', NULL, NULL),
(17405, '::1', 12, 'Deslogou', '2018-06-25 21:56:48', NULL, NULL),
(17406, '::1', 12, 'Confirmou termo', '2018-06-25 21:56:52', NULL, NULL),
(17407, '::1', 12, 'Deslogou', '2018-06-25 21:57:12', NULL, NULL),
(17408, '::1', 12, 'Confirmou termo', '2018-06-25 21:58:36', NULL, NULL),
(17409, '::1', 12, 'Deslogou', '2018-06-25 22:02:16', NULL, NULL),
(17410, '::1', 12, 'Confirmou termo', '2018-06-25 22:02:22', NULL, NULL),
(17411, '::1', 12, 'Deslogou', '2018-06-25 22:03:55', NULL, NULL),
(17412, '::1', 12, 'Confirmou termo', '2018-06-25 22:05:25', NULL, NULL),
(17413, '::1', 12, 'Deslogou', '2018-06-25 22:05:36', NULL, NULL),
(17414, '::1', 2, 'Deslogou', '2018-06-25 22:32:37', NULL, NULL),
(17415, '::1', 3, 'Deslogou', '2018-06-25 22:37:05', NULL, NULL),
(17416, '::1', 2, 'Deslogou', '2018-06-25 22:39:33', NULL, NULL),
(17417, '::1', 14, 'Confirmou termo', '2018-06-25 22:39:46', NULL, NULL),
(17418, '::1', 14, 'Deslogou', '2018-06-25 22:43:45', NULL, NULL),
(17419, '::1', 14, 'Confirmou termo', '2018-06-25 22:43:50', NULL, NULL),
(17420, '::1', 14, 'Deslogou', '2018-06-25 22:48:01', NULL, NULL),
(17421, '::1', 14, 'Confirmou termo', '2018-06-25 22:48:10', NULL, NULL),
(17422, '::1', 14, 'Deslogou', '2018-06-25 22:50:47', NULL, NULL),
(17423, '::1', 14, 'Confirmou termo', '2018-06-25 22:50:49', NULL, NULL),
(17424, '::1', 14, 'Deslogou', '2018-06-25 22:53:30', NULL, NULL),
(17425, '::1', 4, 'Deslogou', '2018-06-25 22:55:23', NULL, NULL),
(17426, '::1', 4, 'Deslogou', '2018-06-25 22:55:44', NULL, NULL),
(17427, '::1', 2, 'Deslogou', '2018-06-25 22:56:16', NULL, NULL),
(17428, '::1', 2, 'Deslogou', '2018-06-25 23:03:48', NULL, NULL),
(17429, '::1', 4, 'Deslogou', '2018-06-25 23:04:22', NULL, NULL),
(17430, '::1', 2, 'Deslogou', '2018-06-25 23:05:50', NULL, NULL),
(17431, '::1', 2, 'Deslogou', '2018-06-25 23:05:55', NULL, NULL),
(17432, '::1', 3, 'Deslogou', '2018-06-25 23:07:06', NULL, NULL),
(17433, '::1', 3, 'Deslogou', '2018-06-25 23:07:46', NULL, NULL),
(17434, '::1', 1, 'Deslogou', '2018-06-25 23:08:17', NULL, NULL),
(17435, '::1', 2, 'Deslogou', '2018-06-25 23:08:39', NULL, NULL),
(17436, '::1', 4, 'Deslogou', '2018-06-25 23:10:14', NULL, NULL),
(17437, '::1', 2, 'Deslogou', '2018-06-25 23:10:25', NULL, NULL),
(17438, '::1', 4, 'Inseriu', '2018-06-25 23:12:02', 2, 'tbReservaSala'),
(17439, '::1', 4, 'Deslogou', '2018-06-25 23:12:32', NULL, NULL),
(17440, '::1', 2, 'Deslogou', '2018-06-25 23:13:59', NULL, NULL),
(17441, '::1', 1, 'Deslogou', '2018-06-25 23:16:13', NULL, NULL),
(17442, '::1', 1, 'Deslogou', '2018-06-25 23:20:28', NULL, NULL),
(17443, '::1', 1, 'Deslogou', '2018-06-25 23:21:10', NULL, NULL),
(17444, '::1', 2, 'Deslogou', '2018-06-25 23:22:42', NULL, NULL),
(17445, '::1', 2, 'Deslogou', '2018-06-25 23:24:23', NULL, NULL),
(17446, '::1', 2, 'Deslogou', '2018-06-25 23:25:22', NULL, NULL),
(17447, '::1', 2, 'Deslogou', '2018-06-25 23:26:14', NULL, NULL),
(17448, '::1', 4, 'Deslogou', '2018-06-25 23:26:51', NULL, NULL),
(17449, '::1', NULL, 'Deslogou', '2018-06-25 23:30:36', NULL, NULL),
(17450, '::1', 4, 'Deslogou', '2018-06-25 23:31:32', NULL, NULL),
(17451, '::1', 2, 'Deslogou', '2018-06-25 23:31:58', NULL, NULL),
(17452, '::1', 2, 'Deslogou', '2018-06-25 23:33:24', NULL, NULL),
(17453, '::1', 4, 'Deslogou', '2018-06-25 23:33:43', NULL, NULL),
(17454, '::1', 3, 'Deslogou', '2018-06-25 23:33:48', NULL, NULL),
(17455, '::1', 3, 'Deslogou', '2018-06-25 23:37:40', NULL, NULL),
(17456, '::1', 3, 'Deslogou', '2018-06-25 23:37:47', NULL, NULL),
(17457, '::1', 1, 'Deslogou', '2018-06-25 23:38:48', NULL, NULL),
(17458, '::1', 3, 'Deslogou', '2018-06-25 23:39:54', NULL, NULL),
(17459, '::1', 1, 'Deslogou', '2018-06-25 23:40:04', NULL, NULL),
(17460, '::1', 1, 'Deslogou', '2018-06-25 23:41:28', NULL, NULL),
(17461, '::1', 14, 'Confirmou termo', '2018-06-26 00:16:40', NULL, NULL),
(17462, '::1', 14, 'Deslogou', '2018-06-26 00:22:52', NULL, NULL),
(17463, '::1', 14, 'Confirmou termo', '2018-06-26 00:22:59', NULL, NULL),
(17464, '::1', 14, 'Deslogou', '2018-06-26 00:28:19', NULL, NULL),
(17465, '::1', 13, 'Confirmou termo', '2018-06-26 00:32:30', NULL, NULL),
(17466, '::1', 13, 'Deslogou', '2018-06-26 00:34:06', NULL, NULL),
(17467, '::1', 1, 'Inseriu', '2018-06-26 00:37:16', 3, 'tbReservaSala'),
(17468, '::1', 1, 'Inseriu', '2018-06-26 00:38:47', 1, 'tbReservaEq'),
(17469, '::1', 1, 'Inseriu', '2018-06-26 00:38:47', 0, 'tbControleDataEq'),
(17470, '::1', 1, 'Deslogou', '2018-06-26 00:38:58', NULL, NULL),
(17471, '::1', 4, 'Deslogou', '2018-06-26 00:40:29', NULL, NULL),
(17472, '::1', 4, 'Deslogou', '2018-06-26 00:41:40', NULL, NULL),
(17473, '::1', 2, 'Modificou', '2018-06-26 00:42:15', 1, 'tbControleDataEq'),
(17474, '::1', 2, 'Excluiu', '2018-06-26 00:43:02', 1, 'tbEquipamento'),
(17475, '::1', 2, 'Inseriu', '2018-06-26 00:44:01', NULL, 'tbEquipamento'),
(17476, '::1', 2, 'Deslogou', '2018-06-26 00:50:44', NULL, NULL),
(17477, '::1', 4, 'Deslogou', '2018-06-26 00:55:04', NULL, NULL),
(17478, '::1', 1, 'Deslogou', '2018-06-26 00:55:17', NULL, NULL),
(17479, '::1', 3, 'Deslogou', '2018-06-26 00:56:31', NULL, NULL),
(17480, '::1', 2, 'Deslogou', '2018-06-26 01:01:54', NULL, NULL),
(17481, '::1', 4, 'Deslogou', '2018-06-26 01:03:41', NULL, NULL),
(17482, '::1', 2, 'Deslogou', '2018-06-26 01:04:44', NULL, NULL),
(17483, '::1', 1, 'Deslogou', '2018-06-26 01:04:54', NULL, NULL),
(17484, '::1', 4, 'Deslogou', '2018-06-26 01:05:33', NULL, NULL),
(17485, '::1', 3, 'Deslogou', '2018-06-26 01:05:40', NULL, NULL),
(17486, '::1', 2, 'Inseriu', '2018-06-26 02:12:32', 4, 'tbReservaSala'),
(17487, '::1', 2, 'Inseriu', '2018-06-26 03:16:53', 5, 'tbReservaSala'),
(17488, '::1', 2, 'Inseriu', '2018-06-26 03:17:26', 6, 'tbReservaSala'),
(17489, '::1', 2, 'Deslogou', '2018-06-26 12:47:04', NULL, NULL),
(17490, '::1', 2, 'Deslogou', '2018-06-26 13:41:31', NULL, NULL),
(17491, '::1', 2, 'Deslogou', '2018-06-26 14:06:38', NULL, NULL),
(17492, '::1', 2, 'Deslogou', '2018-06-29 23:54:35', NULL, NULL),
(17493, '::1', 17, 'Confirmou termo', '2018-06-29 23:54:50', NULL, NULL),
(17494, '::1', 17, 'Deslogou', '2018-06-29 23:56:26', NULL, NULL),
(17495, '::1', 17, 'Deslogou', '2018-06-29 23:56:38', NULL, NULL),
(17496, '::1', 1, 'Deslogou', '2018-06-30 00:02:12', NULL, NULL),
(17497, '::1', 17, 'Confirmou termo', '2018-06-30 00:29:22', NULL, NULL),
(17498, '::1', 17, 'Deslogou', '2018-06-30 00:55:41', NULL, NULL),
(17499, '::1', 17, 'Confirmou termo', '2018-06-30 00:56:03', NULL, NULL),
(17500, '::1', 17, 'Deslogou', '2018-06-30 03:03:51', NULL, NULL),
(17501, '::1', 17, 'Confirmou termo', '2018-06-30 03:04:10', NULL, NULL),
(17502, '::1', 17, 'Deslogou', '2018-06-30 03:20:20', NULL, NULL),
(17503, '::1', 17, 'Confirmou termo', '2018-06-30 03:20:25', NULL, NULL),
(17504, '::1', 2, 'Modificou', '2018-07-09 09:09:26', 3, 'tbControleDataSala'),
(17505, '::1', 2, 'Inseriu', '2018-07-09 09:10:08', 7, 'tbReservaSala'),
(17506, '::1', 2, 'Modificou', '2018-07-09 18:16:23', 1, 'tbAvisos'),
(17507, '::1', 2, 'Deletou', '2018-07-09 18:16:44', 7, 'tbReservaSala'),
(17508, '::1', 2, 'Deletou', '2018-07-09 18:16:47', 3, 'tbReservaSala'),
(17509, '::1', 2, 'Deletou', '2018-07-09 18:16:51', 4, 'tbReservaSala'),
(17510, '::1', 2, 'Deletou', '2018-07-09 18:16:53', 5, 'tbReservaSala'),
(17511, '::1', 2, 'Deletou', '2018-07-09 18:16:57', 6, 'tbReservaSala'),
(17512, '::1', 2, 'Deletou', '2018-07-09 18:17:01', 2, 'tbReservaSala'),
(17513, '::1', 2, 'Deletou', '2018-07-09 18:17:04', 1, 'tbReservaSala'),
(17514, '::1', 2, 'Deslogou', '2018-07-09 18:17:17', NULL, NULL),
(17515, '::1', 2, 'Modificou', '2018-07-09 18:27:30', 1, 'tbAvisos'),
(17516, '::1', 2, 'Modificou', '2018-07-09 18:28:26', 1, 'tbAvisos'),
(17517, '::1', 2, 'Deslogou', '2018-07-09 18:28:36', NULL, NULL),
(17518, '::1', 2, 'Deslogou', '2018-07-09 18:42:27', NULL, NULL),
(17519, '::1', 4, 'Deslogou', '2018-07-09 18:44:39', NULL, NULL),
(17520, '::1', 2, 'Deslogou', '2018-07-09 18:46:37', NULL, NULL),
(17521, '::1', 4, 'Deslogou', '2018-07-09 18:56:21', NULL, NULL),
(17522, '::1', 2, 'Deslogou', '2018-07-09 19:03:43', NULL, NULL),
(17523, '::1', 23, 'Confirmou termo', '2018-07-09 19:04:30', NULL, NULL),
(17524, '::1', 23, 'Deslogou', '2018-07-09 19:08:10', NULL, NULL),
(17525, '::1', 1, 'Deslogou', '2018-07-09 19:09:34', NULL, NULL),
(17526, '::1', 23, 'Inseriu', '2018-07-09 19:11:01', 2, 'tbReservaEq'),
(17527, '::1', 23, 'Inseriu', '2018-07-09 19:11:01', 0, 'tbControleDataEq'),
(17528, '::1', 23, 'Deslogou', '2018-07-09 19:11:15', NULL, NULL),
(17529, '::1', 23, 'Inseriu', '2018-07-09 19:12:18', 8, 'tbReservaSala'),
(17530, '::1', 23, 'Deslogou', '2018-07-09 19:12:31', NULL, NULL),
(17531, '::1', 2, 'Modificou', '2018-07-09 19:14:11', 2, 'tbControleDataEq'),
(17532, '::1', 2, 'Modificou', '2018-07-09 19:18:29', 2, 'tbControleDataEq'),
(17533, '::1', 2, 'Modificou', '2018-07-09 19:18:54', 8, 'tbControleDataSala'),
(17534, '::1', 1, 'Deslogou', '2018-07-17 21:19:10', NULL, NULL),
(17535, '::1', 1, 'Deslogou', '2018-07-30 01:37:00', NULL, NULL),
(17536, '::1', 2, 'Deslogou', '2018-07-30 02:19:54', NULL, NULL),
(17537, '::1', 4, 'Deslogou', '2018-07-30 02:20:54', NULL, NULL),
(17538, '::1', 2, 'Deslogou', '2018-07-30 02:21:57', NULL, NULL),
(17539, '::1', 4, 'Deslogou', '2018-09-28 01:38:41', NULL, NULL);

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

--
-- Extraindo dados da tabela `tbnotificacao`
--

INSERT INTO `tbnotificacao` (`idNoti`, `notificacao`, `statusNoti`, `expiraData`) VALUES
(1, '<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>', 0, NULL),
(2, '<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>', 0, NULL),
(3, '<li>\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \n                      </a>\n                    </li>', 0, NULL),
(4, '<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>', 0, NULL),
(5, '<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>', 0, NULL),
(6, '<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>', 0, NULL);

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
(1, '2018-09-28 03:09:24', 'jm0tlnt7pg7gqn87mh6a26luhr', NULL, NULL),
(2, '2018-07-30 04:45:17', '6b3s2m68ul4oliqmsghjue85tc', NULL, NULL),
(17, '2018-06-30 04:50:25', 'utqiocp3k7d983ek8lfq028dq3', NULL, NULL);

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
(1, 1, 'teste2', 'TCC - teste2', '2018-12-23'),
(2, 23, 'Apresentaçao TCC - UBER INTERMUNICIPAL', 'TCC - Apresentacao TCC - LEONARDO', '2019-01-05');

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
-- Extraindo dados da tabela `tbreservasala`
--

INSERT INTO `tbreservasala` (`idReSala`, `idUser`, `idSala`, `motivoReSala`, `tituloReSala`, `expirarReSala`) VALUES
(8, 23, 1, 'TCC - Apresentacao\r\nTCC - LEONARDO', 'TCC - TCC - Apresentacao TCC - LEONARDO', '2019-01-05');

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

--
-- Extraindo dados da tabela `tbreservatipoeq`
--

INSERT INTO `tbreservatipoeq` (`idTipoEq`, `idReEq`, `numReEq`) VALUES
(2, 1, 1),
(2, 2, 1);

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

--
-- Extraindo dados da tabela `tbsala`
--

INSERT INTO `tbsala` (`idSala`, `nomeSala`, `numPessoa`, `statusSala`, `idCor`) VALUES
(1, 'SALA DE ESTUDOS 1', 50, 'Ativo', 1);

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
CREATE TRIGGER `atualizarTermo` AFTER UPDATE ON `tbtermo` FOR EACH ROW UPDATE tbUsuario SET termo = 0
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

--
-- Extraindo dados da tabela `tbtipoeq`
--

INSERT INTO `tbtipoeq` (`idTipoEq`, `tipoEq`, `numEq`, `idCor`) VALUES
(2, 'PROJETOR', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `siapMatricula` varchar(12) DEFAULT NULL,
  `idAfiliacao` int(10) UNSIGNED DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `departamento` varchar(15) NOT NULL,
  `nomeUser` varchar(255) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `dtnascimento` date NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `nivel` int(10) UNSIGNED NOT NULL,
  `statusUser` enum('Ativo','Inativo','Bloqueado','Aguardando Solicitante') NOT NULL DEFAULT 'Inativo',
  `termo` tinyint(1) NOT NULL DEFAULT '0',
  `statusLogin` int(10) UNSIGNED DEFAULT '1',
  `sudo` enum('Ativo','Inativo') NOT NULL DEFAULT 'Inativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUser`, `siapMatricula`, `idAfiliacao`, `login`, `senha`, `email`, `departamento`, `nomeUser`, `cpf`, `dtnascimento`, `telefone`, `nivel`, `statusUser`, `termo`, `statusLogin`, `sudo`) VALUES
(2, '', 2, 'secretaria.ccet', 'sec270918', 'secretaria.ccet@ufs.br', '', 'Secretaria', '', '0000-00-00', '', 1, 'Ativo', 1, 1, 'Ativo'),
(4, '', 4, 'admin.ccet', 'adm270918', 'secretaria.ccet@ufs.br', '', 'Adminstrador', '123', '0000-00-00', '', 0, 'Ativo', 1, 1, 'Ativo'),
(20, '1692341', 3, 'edwdavid@gmail.com', '123456', 'edwdavid@gmail.com', 'DCOMP', 'Edward David Moreno', '', '0000-00-00', '', 1, 'Ativo', 0, 1, 'Ativo'),
(21, NULL, 2, 'direcao.ccet', 'dir270918', 'direcao.ccet@ufs.br', 'CCET', '', NULL, '0000-00-00', '', 1, 'Inativo', 0, 1, 'Ativo'),
(23, '1692341', 1, 'edward@dcomp.ufs.br', '123456', 'edward@dcomp.ufs.br', 'DCOMP', 'EDWARD DAVID MORENO', '17332180847', '1968-07-03', '79991984939', 3, 'Ativo', 1, 1, 'Ativo');

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
  ADD KEY `tbChoqueLab_ibfk_2` (`idData`),
  ADD KEY `tbChoqueLab_ibfk_3` (`idChoqueReLab`),
  ADD KEY `tbChoqueLab_ibfk_4` (`idChoqueData`);

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
  ADD KEY `tbEquipamento_FKIndex1` (`idTipoEq`),
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
  ADD KEY `tbTelefone_FKIndex1` (`idUser`);

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
  MODIFY `idAviso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `idCor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbdata`
--
ALTER TABLE `tbdata`
  MODIFY `idData` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26883;

--
-- AUTO_INCREMENT for table `tbdisciplinas`
--
ALTER TABLE `tbdisciplinas`
  MODIFY `idDisc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `tbequipamento`
--
ALTER TABLE `tbequipamento`
  MODIFY `patrimonio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

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
  MODIFY `idLogs` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17540;

--
-- AUTO_INCREMENT for table `tblogsforcado`
--
ALTER TABLE `tblogsforcado`
  MODIFY `idLogs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  MODIFY `idNoti` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `idReEq` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbreservalab`
--
ALTER TABLE `tbreservalab`
  MODIFY `idReLab` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbreservasala`
--
ALTER TABLE `tbreservasala`
  MODIFY `idReSala` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbsala`
--
ALTER TABLE `tbsala`
  MODIFY `idSala` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `idTipoEq` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  ADD CONSTRAINT `tbAlocaLab_ibfk_1` FOREIGN KEY (`idLab`) REFERENCES `tblaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbAlocaLab_ibfk_2` FOREIGN KEY (`patrimonio`) REFERENCES `tbequipamento` (`patrimonio`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbalocareeq`
--
ALTER TABLE `tbalocareeq`
  ADD CONSTRAINT `tbAlocaReEq_ibfk_1` FOREIGN KEY (`patrimonio`) REFERENCES `tbequipamento` (`patrimonio`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbAlocaReEq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbcontroledataeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbAlocaReEq_ibfk_3` FOREIGN KEY (`idData`) REFERENCES `tbcontroledataeq` (`idData`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbalocarelab`
--
ALTER TABLE `tbalocarelab`
  ADD CONSTRAINT `tbAlocaReLab_ibfk_1` FOREIGN KEY (`idLab`) REFERENCES `tblaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbAlocaReLab_ibfk_2` FOREIGN KEY (`idReLab`) REFERENCES `tbreservalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbblock`
--
ALTER TABLE `tbblock`
  ADD CONSTRAINT `tbBlock_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbBlock_ibfk_2` FOREIGN KEY (`idUserBlock`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbchoqueeq`
--
ALTER TABLE `tbchoqueeq`
  ADD CONSTRAINT `tbChoqueEq_ibfk_1` FOREIGN KEY (`idReEq`,`idData`) REFERENCES `tbcontroledataeq` (`idReEq`, `idData`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbChoqueEq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbChoqueEq_ibfk_3` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`),
  ADD CONSTRAINT `tbChoqueEq_ibfk_4` FOREIGN KEY (`idChoqueReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbChoqueEq_ibfk_5` FOREIGN KEY (`idChoqueData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbchoquelab`
--
ALTER TABLE `tbchoquelab`
  ADD CONSTRAINT `tbChoqueLab_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbcontroledatalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbChoqueLab_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbcontroledatalab` (`idData`),
  ADD CONSTRAINT `tbChoqueLab_ibfk_3` FOREIGN KEY (`idChoqueReLab`) REFERENCES `tbcontroledatalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbChoqueLab_ibfk_4` FOREIGN KEY (`idChoqueData`) REFERENCES `tbcontroledatalab` (`idData`);

--
-- Limitadores para a tabela `tbchoquesala`
--
ALTER TABLE `tbchoquesala`
  ADD CONSTRAINT `tbChoqueSala_ibfk_1` FOREIGN KEY (`idReSala`) REFERENCES `tbreservasala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbChoqueSala_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`),
  ADD CONSTRAINT `tbChoqueSala_ibfk_4` FOREIGN KEY (`idChoqueData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbcontroledataeq`
--
ALTER TABLE `tbcontroledataeq`
  ADD CONSTRAINT `tbControleDataEq_ibfk_1` FOREIGN KEY (`idReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbControleDataEq_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbcontroledatalab`
--
ALTER TABLE `tbcontroledatalab`
  ADD CONSTRAINT `tbControleDataLab_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbreservalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbControleDataLab_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbcontroledatasala`
--
ALTER TABLE `tbcontroledatasala`
  ADD CONSTRAINT `tbControleDataSala_ibfk_1` FOREIGN KEY (`idReSala`) REFERENCES `tbreservasala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbControleDataSala_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`);

--
-- Limitadores para a tabela `tbequipamento`
--
ALTER TABLE `tbequipamento`
  ADD CONSTRAINT `tbEquipamento_ibfk_1` FOREIGN KEY (`idTipoEq`) REFERENCES `tbtipoeq` (`idTipoEq`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbimagem`
--
ALTER TABLE `tbimagem`
  ADD CONSTRAINT `tbImagem_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tblaboratorio`
--
ALTER TABLE `tblaboratorio`
  ADD CONSTRAINT `tbLaboratorio_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbcor` (`idCor`) ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbmatricula`
--
ALTER TABLE `tbmatricula`
  ADD CONSTRAINT `tbMatricula_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbnoticonexao`
--
ALTER TABLE `tbnoticonexao`
  ADD CONSTRAINT `tbNotiConexao_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbNotiConexao_ibfk_2` FOREIGN KEY (`idNoti`) REFERENCES `tbnotificacao` (`idNoti`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbprimeiroacesso`
--
ALTER TABLE `tbprimeiroacesso`
  ADD CONSTRAINT `tbPrimeiroAcesso_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
