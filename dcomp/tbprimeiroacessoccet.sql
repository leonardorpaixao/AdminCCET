-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Abr-2018 às 09:41
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
('leonardo2', 'leonardo2@DASDAS.COM', 3, 2147483647, 'COMP'),
('Rogerio Luz Pagano', 'rogerioce@gmail.com\r\n', 1, NULL, 'DEQ'),
('Rodolpho Rodrigues Fonseca', ' Fonseca.rodolpho@gmail.com\r\n', 1, NULL, 'DEQ'),
('Roberto Rodrigues de Souza', 'rrsouza@ufs.br\r\n', 1, NULL, 'DEQ'),
('Pedro Leite de Santana', 'Santana@ufs.br\r\n', 1, NULL, 'DEQ'),
('Paulo Henrique Leite Quintela', 'pauloquintela1984@gmail.com\r\n', 1, NULL, 'DEQ'),
('Marcelo Jose Barros de Souza', 'marcelojbs@ufs.br\r\n', 1, NULL, 'DEQ'),
('Manoel Marcelo do Prado', 'manoelmprado@yahoo.com.br\r\n', 1, NULL, 'DEQ'),
('Luanda Gimeno Marques', 'Luanda_gimeno@yahoo.com.br\r\n', 1, NULL, 'DEQ'),
('Jose da Paixao Lopes dos Santos', 'josepaixaosantos@yahoo.com.br\r\n', 1, NULL, 'DEQ'),
('Joao Baptista Severo Junior', 'jbs_junior@hotmail.com\r\n', 1, NULL, 'DEQ'),
('Jacqueline Rego da Silva Rodrigues', 'jrodrigues@ufs.br\r\n', 1, NULL, 'DEQ'),
('Helenice Leite Garcia', ' helenicelgarcia@gmail.com\r\n', 1, NULL, 'DEQ'),
('Giselia Cardoso', 'Giselia@ufs.br\r\n', 1, NULL, 'DEQ'),
('Edilson de Jesus Santos', 'ejs201107@gmail.com\r\n', 1, NULL, 'DEQ'),
('Denise Santos Ruzene', 'ruzeneds@hotmail.com\r\n', 1, NULL, 'DEQ'),
('Cristina Ferraz Silva', 'ferrazcristina@yahoo.com.br\r\n', 1, NULL, 'DEQ'),
('Alex Barreto Machado', ' machadoparana@gmail.com\r\n', 1, NULL, 'DEQ'),
('', '', 1, NULL, ''),
('Celso Satoshi Sakuraba', 'celsosakuraba@gmail.com\r\n', 1, NULL, 'DEPRO'),
('Emerson Cleister Lima Muniz', 'eng.prod.emerson@gmail.com\r\n', 1, NULL, 'DEPRO'),
('Cleiton Rodrigues de Vasconcelos', 'cleitongv@yahoo.com.br\r\n', 1, NULL, 'DEPRO'),
('Reynaldo Chile Palomino', 'reychile@hotmail.com\r\n', 1, NULL, 'DEPRO'),
('Pedro Felipe de Abreu', 'deabreu.pedro@gmail.com\r\n', 1, NULL, 'DEPRO'),
('Richard Andres Estombelo', 'restomb@hotmail.com\r\n', 1, NULL, 'DEPRO'),
('Isabelly Pereira da Silva', 'isabellypereira@outlok.com/isabelly@ufs.br\r\n', 1, NULL, 'DEPRO'),
('Simone de Cassia Silva', 'scassia@gmail.com\r\n', 1, NULL, 'DEPRO'),
('Luciano Fernandes Monteiro', 'lucianofm2007@gmail.com\r\n', 1, NULL, 'DEPRO'),
('Veruschka Vieira Franca', 'veruschkafranca@gmail.com\r\n', 1, NULL, 'DEPRO'),
('Daniel Pereira da silva', 'silvadp@hotmail.com\r\n', 1, NULL, 'DEPRO'),
('Allan Robert da Silva', 'all_robert02@yahoo.com.br\r\n', 1, NULL, 'DECAT'),
('Amanda da silva Lira', 'amandalira@ufs.br\r\n', 1, NULL, 'DECAT'),
('Carlos Raphael Ara?jo Daniel', 'raphael_crad@yahoo.com.br\r\n', 1, NULL, 'DECAT'),
('Cristiane Toniolo Dias', 'cristonidias@gmail.com\r\n', 1, NULL, 'DECAT'),
('Daniel Francisco Neyra Casta?eda', 'danielneyra@hotmail.com\r\n', 1, NULL, 'DECAT'),
('Eduardo Jos? de Souza Silva ', 'eduardojcufs@gmail.com\r\n', 1, NULL, 'DECAT'),
('Esdras Adriano Barbosa Dos Santos', 'esdras.adriano@gmail.com\r\n', 1, NULL, 'DECAT'),
('Eucymara Fran?a Nunes Santos', 'eucymara@gmail.com\r\n', 1, NULL, 'DECAT'),
('Jos? Rodrigo Santos Silva', 'rodrigo.ufs@gmail.com\r\n', 1, NULL, 'DECAT'),
('Juliana K?tia Da Silva', 'juliana.ks@ufs.br\r\n', 1, NULL, 'DECAT'),
('Kl?ber Fernandes De Oliveira', 'kleber.ufs@hotmail.com\r\n', 1, NULL, 'DECAT'),
('Luiz Henrique Gama Dore De Ara?jo', 'luizgd@yahoo.com.br\r\n', 1, NULL, 'DECAT'),
('Marcela Ver?nica Alves De Souza Bernardes', 'marcelavas2@hotmail.com\r\n', 1, NULL, 'DECAT'),
('Marcelo Coelho De S?', 'mcs.atuarial@gmail.com\r\n', 1, NULL, 'DECAT'),
('Oscar Felipe Falc?o Raposo', 'raposo.ufs@gmail.com\r\n', 1, NULL, 'DECAT'),
('Acto de Lima Cunha', 'actolimacunha@yahoo.com.br\r\n', 1, NULL, 'NUPETRO'),
('Gabriel Francisco da Silva', 'gabriel@ufs.br\r\n', 1, NULL, 'NUPRETO'),
('Joao Paulo Lobo dos Santos', 'jplobo2011@gmail.com\r\n', 1, NULL, 'NUPRETO'),
('Jose Bezerra de Almeida Neto', 'jalmeidnufs@gmail.com\r\n', 1, NULL, 'NUPRETO'),
('Flavio Gustavo Ribeiro Freitas', 'flaviogus@hotmail.com\r\n', 1, NULL, 'NUPRETO'),
('Ronice da Paixao Silva do Prado', 'roniceprado@ufs.br\r\n', 1, NULL, 'NUPETRO'),
('Rosivania da Paix?o Silva Oliveira', 'rosipaixao@yahoo.com.br\r\n', 1, NULL, 'NUPETRO'),
('Hariel Udi Santana Mendes', 'harieludi@hotmail.com\r\n', 1, NULL, 'NUPETRO'),
('Maria Suzana Silva', 'suzana.ufs@hotmail.com\r\n', 1, NULL, 'NUPETRO'),
('Alessandra Almeida Castro Pagani', 'alespagani@yahoo.com.br\r\n', 1, NULL, 'DTA'),
('Alvaro Alberto de Araujo', 'aliberto9@yahoo.fr\r\n', 1, NULL, 'DTA'),
('Ana Carla de Souza Abud', 'ana.abud@gmail.com\r\n', 1, NULL, 'DTA'),
('Angela da Silva Borges', 'angelasborges@yahoo.com.br\r\n', 1, NULL, 'DTA'),
('Antonio Martins de Oliveira Junior', 'amartins.junior@gmail.com\r\n', 1, NULL, 'DTA'),
('Jane de Jesus da Silva Moreira', 'jane240370@yahoo.com\r\n', 1, NULL, 'DTA'),
('Joao Antonio Belmino dos Santos', 'joaoantonio@ufs.br\r\n', 1, NULL, 'DTA'),
('Luciana Cristina Lins de Aquino Santana', 'aquinoluciana@hotmail.com\r\n', 1, NULL, 'DTA'),
('Marcelo Augusto Gutierrez Carnelossi', 'magcarnelossi@oi.com.br\r\n', 1, NULL, 'drta'),
('Alessandra Almeida Castro Pagani', 'alespagani@yahoo.com.br\r\n', 1, NULL, 'DTA'),
('Alvaro Alberto de Araujo', 'aliberto9@yahoo.fr\r\n', 1, NULL, 'DTA'),
('Ana Carla de Souza Abud', 'ana.abud@gmail.com\r\n', 1, NULL, 'DTA'),
('Angela da Silva Borges', 'angelasborges@yahoo.com.br\r\n', 1, NULL, 'DTA'),
('Antonio Martins de Oliveira Junior', 'amartins.junior@gmail.com\r\n', 1, NULL, 'DTA'),
('Jane de Jesus da Silva Moreira', 'jane240370@yahoo.com\r\n', 1, NULL, 'DTA'),
('Joao Antonio Belmino dos Santos', 'joaoantonio@ufs.br\r\n', 1, NULL, 'DTA'),
('Luciana Cristina Lins de Aquino Santana', 'aquinoluciana@hotmail.com\r\n', 1, NULL, 'DTA'),
('Marcelo Augusto Gutierrez Carnelossi', 'magcarnelossi@oi.com.br\r\n', 1, NULL, 'DTA'),
('Maria Aparecida Azevedo Pereira da Silva', 'cidamariaso@yahoo.com.br\r\n', 1, NULL, 'DTA'),
('Narendra Narain', 'narendra.narain@gmail.com\r\n', 1, NULL, 'DTA'),
('Patr?cia Beltr?o Lessa Constant', 'pblconstant@yahoo.com.br\r\n', 1, NULL, 'DTA'),
('Tatiana Pacheco Nunes', 'tpnunes@uol.com.br \r\n', 1, NULL, 'DTA'),
('Carlos Otavio Damas Martins', 'carlosmartinsufs@gmail.com\r\n', 1, NULL, 'DCEM'),
('Cristiane Xavier Resende', 'cristianexr@gmail.com\r\n', 1, NULL, 'DCEM'),
('Eduardo Kirinus Tentardini', 'etentardini@gmail.com\r\n', 1, NULL, 'DCEM'),
('Euler Araujo dos Santos', 'euler.ufs@gmail.com\r\n', 1, NULL, 'DCEM'),
('Jose Kaio Max Alves do Rego', 'kaiomax2000@gmail.com\r\n', 1, NULL, 'DCEM'),
('Ledjane Silva Barreto', 'ledjane.ufs@gmail.com\r\n', 1, NULL, 'DCEM'),
('Luis Eduardo Almeida', 'lealmeida2009@gmail.com\r\n', 1, NULL, 'DCEM'),
('Marcelo Massayoshi Ueki', 'mm_ueki@yahoo.com.br\r\n', 1, NULL, 'DCEM'),
('Michelle Cardinale Souza Silva Macedo', 'michellecardinales@gmail.com\r\n', 1, NULL, 'DCEM'),
('Rosane Maria Pessoa Betanio Oliveira', 'rosaneboliveira@gmail.com\r\n', 1, NULL, 'DCEM'),
('Sandra Andreia Stwart de Araujo Souza', 'sasouza.sandra@gmail.com\r\n', 1, NULL, 'DCEM'),
('Sandro Griza', 'griza@ufs.br\r\n', 1, NULL, 'DCEM'),
('Wilton Walter Batista ', 'wiltonwalter@hotmail.com\r\n', 1, NULL, 'DCEM'),
('Zora Ionara Gama dos Santos', 'ionarag@yahoo.com.br\r\n', 1, NULL, 'DCEM'),
('Andrea Novelli', 'deanovel@yahoo.com.br\r\n', 1, NULL, 'DEAM'),
('Andre Luis Dantas Ramos', 'aldramos@gmail.com\r\n', 1, NULL, 'DEAM'),
('Bruno Santos Souza', 'bruffno@gmail.com\r\n', 1, NULL, 'DEAM'),
('Daniella Rocha', 'daniellarocha.ufs@gmail.com\r\n', 1, NULL, 'DEAM'),
('Inaura Carolina Carneiro da Rocha', 'inaura.rocha@gmail.com\r\n', 1, NULL, 'DEAM'),
('Jefferson Arlen Freitas', 'jaf68ster@gmail.com\r\n', 1, NULL, 'DEAM'),
('Joel Alonso Palomino Romero', 'joelalonsopr@gmail.com\r\n', 1, NULL, 'DEAM'),
('Jose Jailton Marques', 'jjailton@uol.com.br\r\n', 1, NULL, 'DEAM'),
('Paulo Sergio de Rezende Nascimento', 'psrn.geologia@gmail.com\r\n', 1, NULL, 'DEAM'),
('Rosemeri Melo e Souza', 'rosemerimeloesouza@gmail.com\r\n', 1, NULL, 'DEAM'),
('Alessandra Gois Luciano de Azevedo', 'aglazevedo@hotmail.com\r\n', 1, NULL, 'DMEC'),
('Ana Cristina Ribeiro Veloso', 'anacrisveloso@yahoo.com.br\r\n', 1, NULL, 'DMEC'),
('Andre Luiz de Moraes Costa', 'andrekosta@bol.com.br\r\n', 1, NULL, 'DMEC'),
('Douglas Bressan Riffel', 'dbr.ufs@gmail.com\r\n', 1, NULL, 'DMEC'),
('Paulo M?rio Machado Ara?jo', 'paubaumma@yahoo.com.br\r\n', 1, NULL, 'DMEC'),
('Seyyed Said Dana', 'seyyeddana@gmail.com\r\n', 1, NULL, 'DMEC'),
('Wilson Luciano de Souza', 'wilsonluciano@yahoo.com.br\r\n', 1, NULL, 'DMEC'),
('Josegil Jorge Pereira de Ara?jo', 'josegil@ufs.br \r\n', 1, NULL, 'DMEC'),
('Jaqueline Dias Altidis', 'jaquelinealtidis@yahoo.com.br\r\n', 1, NULL, 'DMEC'),
('Macclarck Pessoa Nery', 'pessoanery@live.com\r\n', 1, NULL, 'DMEC'),
('Leonardo Maia Nogueira', 'nogueira.ufs@gmail.com\r\n', 1, NULL, 'DMEC'),
('Jose Aguiar dos Santos Junior', 'aguiarsjunior@gmail.com\r\n', 1, NULL, 'DMEC'),
('Adestenes Pedreira Dantas Matos', 'adestenes@gmail.com\r\n', 1, NULL, 'DEC'),
('Diego Faro Alves', 'diegofaro@gmail.com\r\n', 1, NULL, 'DEC'),
('Raquel Alves Cabral Silva', 'raquel.cabrals@yahoo.com.br\r\n', 1, NULL, 'DEC'),
('Alcigeimes Batista Celeste', 'geimes@yahoo.com\r\n', 1, NULL, 'DEC'),
('Alexsandro Tenorio Porangaba', 'soualex@hotmail.com.br\r\n', 1, NULL, 'DEC'),
('Ana Maria de Souza Martins Faria', 'anmsmfarias@yahoo.com.br\r\n', 1, NULL, 'DEC'),
('Angela Teresa Costa Sales ', 'angelasales19@gmail.com\r\n', 1, NULL, 'DEC'),
('Carlos Resende Cardozo Junior', 'Eng.carlosrezende@gmail.com\r\n', 1, NULL, 'DEC'),
('Daniel Moureira Fontes Lima', 'danielmfl@gmail.com\r\n', 1, NULL, 'DEC'),
('David Leonardo Nascimento de Figueiredo Amorim', 'davidnf2@gmail.com\r\n', 1, NULL, 'DEC'),
('Debora de Gois Santos', 'Debora de Gois Santos\r\n', 1, NULL, 'DEC'),
('Demostenes de Araujo Cavalcante Junior', 'geotec.csl@uol.com.br\r\n', 1, NULL, 'DEC'),
('Denise Concei?ao de Gois Santos Michelan', 'Emerson Meireles de Carvalho\r\n', 1, NULL, 'DEC'),
('Erinaldo Hilario Cavalcante', 'erinaldohc@gmail.com\r\n', 1, NULL, 'DEC'),
('Fabio Carlos da Rocha', 'fabioengcivil@yahoo.com.br\r\n', 1, NULL, 'DEC'),
('Fernando Luiz de Bragan?a Ferro', 'fernandoferroaju@uol.com.br\r\n', 1, NULL, 'DEC'),
('Fernando Marcio de Oliveira', 'fernandomarcio@hotmail.com\r\n', 1, NULL, 'DEC'),
('Fernando Silva Albuquerque', 'albuquerque.f.s@ufs.br\r\n', 1, NULL, 'DEC'),
('Franciely Abati Miranda', 'Franciely.miranda@gmail.com\r\n', 1, NULL, 'DEC'),
('Guilherme Bravo de Oliveira Almeida', 'gbravo1982@gmail.com\r\n', 1, NULL, 'DEC'),
('Higor Sergio Dantas de Argolo', 'higorsergio@ufs.br\r\n', 1, NULL, 'DEC'),
('Joelson Hora Costa', 'joelsonhcosta@gmail.com\r\n', 1, NULL, 'DEC'),
('Jorge Carvalho Costa', 'jorgecostase@gmail.com  \r\n', 1, NULL, 'DEC'),
('Josinaide Silva Martins Maciel', 'arqjosi0105@gmail.com  \r\n', 1, NULL, 'DEC'),
('Luciana Coelho Mendonca', 'lucianamendonca@ufs.br\r\n', 1, NULL, 'DEC'),
('Ludmilson Abritta Mendes', 'ludmilsonmendes@yahoo.com.br\r\n', 1, NULL, 'DEC'),
('Marcelo Augusto Costa Maciel', 'mamaciel081169@gmail.com\r\n', 1, NULL, 'DEC'),
('Marco Antonio Brarsiel Sampaio', 'marcobrasiel@gmail.com\r\n', 1, NULL, 'DEC'),
('Michelline Nei Bomfim de Santana', 'michellinenei@yahoo.com.br\r\n', 1, NULL, 'DEC'),
('Nilma Fontes de araujo Andrade', 'nilma@ufs.br\r\n', 1, NULL, 'DEC'),
('Rejane Martins Fernandes Canha', 'Rejane_canha@yahoo.com.br\r\n', 1, NULL, 'DEC'),
('Sandra Carla Lima Dorea', 'doreasandra@gmail.com\r\n', 1, NULL, 'DEC'),
('Adelmo Saturnino de Souza', 'adelmosaturnino@hotmail.com\r\n', 1, NULL, 'DFI'),
('Julia Maria Torres Roquette', 'juliaroquette@gmail.com\r\n', 1, NULL, 'DFI'),
('Marco Saulo Mello', 'mmello07@gmail.com\r\n', 1, NULL, 'DFI');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
