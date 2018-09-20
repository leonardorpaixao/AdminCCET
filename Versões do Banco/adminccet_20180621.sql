-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jun-2018 às 15:51
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

--
-- Extraindo dados da tabela `tbavisos`
--

INSERT INTO `tbavisos` (`idAviso`, `tituloAviso`, `textoAviso`, `dataAviso`, `statusAviso`) VALUES
(1, 'ANUNCIO 1', 'ANUNCIO 1', '2018-04-19', 'Ativo');

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
(1, 26873, 'Entregue', '');

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
(26873, '2018-06-07 13:00:00', '2018-06-07 14:00:00');

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
(1, 3, 'teste', 'Ativo'),
(12345, 1, 'LG - 2500', 'Ativo');

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
(17300, '::1', 1, 'Deslogou', '2018-04-03 23:30:18', NULL, NULL),
(17301, '::1', 1, 'Deslogou', '2018-04-17 21:09:23', NULL, NULL),
(17302, '::1', 4, 'Deslogou', '2018-04-17 21:13:26', NULL, NULL),
(17303, '::1', 4, 'Inseriu', '2018-04-17 21:14:35', 0, 'tbreservasala'),
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
(17315, '::1', 4, 'Modificou', '2018-04-17 21:39:57', 304, 'tbcontroledataeq'),
(17316, '::1', 4, 'Inseriu', '2018-04-17 21:41:28', 305, 'tbreservaeq'),
(17317, '::1', 4, 'Inseriu', '2018-04-17 21:41:28', 0, 'tbcontroledataeq'),
(17318, '::1', 4, 'Excluiu', '2018-04-17 21:46:34', 305, 'tbreservaeq'),
(17319, '::1', 4, 'Excluiu', '2018-04-17 21:46:37', 304, 'tbreservaeq'),
(17320, '::1', 4, 'Atualizou disciplinas.', '2018-04-19 16:04:16', NULL, NULL),
(17321, '::1', 4, 'Inseriu', '2018-04-19 16:10:36', 0, 'tbequipamento'),
(17322, '::1', 4, 'Inseriu', '2018-04-19 16:11:14', 1, 'tbavisos'),
(17323, '::1', 4, 'Deslogou', '2018-04-19 16:26:30', NULL, NULL),
(17324, '::1', 4, 'Deslogou', '2018-04-19 16:33:22', NULL, NULL),
(17325, '::1', 4, 'Inseriu', '2018-04-19 16:35:05', NULL, 'tbequipamento'),
(17326, '::1', 4, 'Deslogou', '2018-05-24 12:58:01', NULL, NULL),
(17327, '::1', 1, 'Deslogou', '2018-05-24 13:04:55', NULL, NULL),
(17328, '::1', 2, 'Deslogou', '2018-05-24 13:05:22', NULL, NULL),
(17329, '::1', 4, 'Inseriu', '2018-05-24 13:06:01', 1, 'tbsala'),
(17330, '::1', 4, 'Deslogou', '2018-05-24 13:06:16', NULL, NULL),
(17331, '::1', 2, 'Deslogou', '2018-06-05 17:06:20', NULL, NULL),
(17332, '::1', 1, 'Inseriu', '2018-06-05 17:11:53', 1, 'tbreservasala'),
(17333, '::1', 1, 'Deslogou', '2018-06-05 17:12:50', NULL, NULL),
(17334, '::1', 2, 'Modificou', '2018-06-05 17:13:20', 1, 'tbcontroledatasala'),
(17335, '::1', 2, 'Modificou', '2018-06-05 17:13:32', 1, 'tbcontroledatasala'),
(17336, '::1', 2, 'Deslogou', '2018-06-05 17:14:14', NULL, NULL),
(17337, '::1', 1, 'Deslogou', '2018-06-05 17:19:58', NULL, NULL),
(17338, '::1', 4, 'Excluiu', '2018-06-18 00:15:05', 0, 'tbsala'),
(17339, '::1', 4, 'Excluiu', '2018-06-18 00:17:28', 0, 'tbsala'),
(17340, '::1', 4, 'Excluiu', '2018-06-18 00:50:19', 0, 'tbsala'),
(17341, '::1', 4, 'Deslogou', '2018-06-18 00:55:42', NULL, NULL),
(17342, '::1', 4, 'Deslogou', '2018-06-18 01:24:10', NULL, NULL),
(17343, '::1', 4, 'Excluiu', '2018-06-18 02:03:27', 0, 'tbsala'),
(17344, '::1', 4, 'Excluiu', '2018-06-18 02:24:08', 0, 'tbsala'),
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
(17383, '::1', 12, 'Confirmou termo', '2018-06-21 03:05:23', NULL, NULL);

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
(2, '<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>', 0, NULL);

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
(4, '2018-06-19 02:48:05', 'isqns1c6drnb3o8nhs1ah4avnj', NULL, NULL),
(12, '2018-06-21 04:35:24', '0qpg8nec7r06k16l38j38vc308', NULL, NULL);

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
  `idtbprimeiroacessoccet` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET armscii8 NOT NULL,
  `email` varchar(70) CHARACTER SET armscii8 NOT NULL,
  `idAfiliacao` int(3) NOT NULL DEFAULT '1',
  `siapMatricula` int(12) DEFAULT NULL,
  `departamento` varchar(15) NOT NULL,
  `status` enum('Ativo','Inativo','Aguardando solicitante') NOT NULL DEFAULT 'Inativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbprimeiroacessoccet`
--

INSERT INTO `tbprimeiroacessoccet` (`idtbprimeiroacessoccet`, `nome`, `email`, `idAfiliacao`, `siapMatricula`, `departamento`, `status`) VALUES
(1, 'LEONARDO', 'LEONARDORPAIXAO@GMAIL.COM', 3, 2012100113, 'DCOMP', 'Inativo'),
(2, 'TESTE@TESTE.COM', 'TESTE@TESTE.COM', 1, 4789987, '21654489', 'Inativo'),
(3, 'leonardo2', 'leonardo2@DASDAS.COM', 3, 2147483647, 'COMP', 'Inativo'),
(4, 'Leonardo Rodrigues Paixao', 'leonardorpaixao@gmail.com', 2, 20121001, 'DCOMP', 'Inativo'),
(5, 'EDWARD MOREMO', 'leonardorpaixao@gmail.com', 2, 20121001, 'DCOMP', 'Inativo'),
(6, 'teste5@teste5.com', 'teste5@teste5.com', 1, 1234, 'dcomp', 'Inativo'),
(7, 'teste5@teste5.com', 'teste25@teste5.com', 1, 12345, 'dcomp', 'Inativo');

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
(1, 1, 1, 'Aula de fundamento da matemática', 'MAT3242', '2018-12-02');

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

--
-- Extraindo dados da tabela `tbtipoeq`
--

INSERT INTO `tbtipoeq` (`idTipoEq`, `tipoEq`, `numEq`, `idCor`) VALUES
(1, 'Projetor', 1, NULL),
(2, 'PROJETOR', 1, 1),
(3, 'tipo1', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `idAfiliacao` int(10) UNSIGNED DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `senha` varchar(20) NOT NULL,
  `nomeUser` varchar(255) NOT NULL,
  `nivel` int(10) UNSIGNED NOT NULL,
  `statusUser` enum('Ativo','Inativo','Bloqueado','Aguardando Solicitante') NOT NULL DEFAULT 'Inativo',
  `email` varchar(50) DEFAULT NULL,
  `termo` tinyint(1) NOT NULL DEFAULT '0',
  `statusLogin` int(10) UNSIGNED DEFAULT '1',
  `sudo` enum('Ativo','Inativo') NOT NULL DEFAULT 'Inativo',
  `siapMatricula` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUser`, `idAfiliacao`, `login`, `cpf`, `senha`, `nomeUser`, `nivel`, `statusUser`, `email`, `termo`, `statusLogin`, `sudo`, `siapMatricula`) VALUES
(1, 1, 'professor', '1123', '123', 'Professor', 3, 'Aguardando Solicitante', 'leonardorpaixao3@gmail.com', 1, 1, 'Ativo', ''),
(2, 2, 'secretaria', '', '123', 'Secretaria', 1, 'Aguardando Solicitante', 'leonardorpaixao3@gmail.com', 1, 1, 'Ativo', ''),
(3, 3, 'Professor', '', '123', 'Aluno', 4, 'Ativo', 'abc123@xyz.com', 1, 0, 'Ativo', ''),
(4, 4, 'admin', '123', 'admin', 'Adminstrador', 1, 'Ativo', 'abc@abc.com', 1, 1, 'Ativo', ''),
(5, 3, 'leonardorpaixao3@gmail.com', '12345678954', 'ccet123456', 'Leonardo Rodrigues Paixão', 2, 'Aguardando Solicitante', 'leonardorpaixao3@gmail.com', 1, 1, 'Ativo', '201210011300'),
(12, 1, 'teste', NULL, '123', '', 5, 'Aguardando Solicitante', NULL, 1, 1, 'Ativo', NULL);

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
-- Indexes for table `tbprimeiroacessoccet`
--
ALTER TABLE `tbprimeiroacessoccet`
  ADD PRIMARY KEY (`idtbprimeiroacessoccet`);

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
  MODIFY `idData` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26874;

--
-- AUTO_INCREMENT for table `tbdisciplinas`
--
ALTER TABLE `tbdisciplinas`
  MODIFY `idDisc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `tbequipamento`
--
ALTER TABLE `tbequipamento`
  MODIFY `patrimonio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12346;

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
  MODIFY `idLogs` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17384;

--
-- AUTO_INCREMENT for table `tblogsforcado`
--
ALTER TABLE `tblogsforcado`
  MODIFY `idLogs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  MODIFY `idNoti` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbprazo`
--
ALTER TABLE `tbprazo`
  MODIFY `idPrazo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbprimeiroacessoccet`
--
ALTER TABLE `tbprimeiroacessoccet`
  MODIFY `idtbprimeiroacessoccet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `idReEq` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbreservalab`
--
ALTER TABLE `tbreservalab`
  MODIFY `idReLab` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbreservasala`
--
ALTER TABLE `tbreservasala`
  MODIFY `idReSala` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `idTipoEq` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
