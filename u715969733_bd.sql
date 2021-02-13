-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Fev-2021 às 15:06
-- Versão do servidor: 10.4.15-MariaDB
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u715969733_bd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `robo`
--

CREATE TABLE `robo` (
  `ID_R` int(5) NOT NULL,
  `ID_URL` int(3) NOT NULL,
  `DATA_T` date NOT NULL,
  `HORA_T` time NOT NULL,
  `STATUS_URL` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RETORNO` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `robo`
--

INSERT INTO `robo` (`ID_R`, `ID_URL`, `DATA_T`, `HORA_T`, `STATUS_URL`, `RETORNO`) VALUES
(3, 1, '2021-02-13', '12:05:01', 'Off Line', ''),
(4, 14, '2021-02-13', '12:05:01', 'On Line', 'HTTP/1.1 200 OK'),
(6, 18, '2021-02-13', '12:05:02', 'On Line', 'HTTP/1.1 999 Request denied');

--
-- Acionadores `robo`
--
DELIMITER $$
CREATE TRIGGER `Deleta_URL` AFTER DELETE ON `robo` FOR EACH ROW DELETE FROM t_url WHERE ID NOT IN (SELECT ID_URL FROM robo)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_url`
--

CREATE TABLE `t_url` (
  `ID` int(3) NOT NULL,
  `ID_USU` int(3) NOT NULL,
  `URL` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `t_url`
--

INSERT INTO `t_url` (`ID`, `ID_USU`, `URL`) VALUES
(1, 1, 'http://localhost:8888/runtec/index1.php'),
(14, 2, 'https://www.nytimes.com/'),
(18, 2, 'https://www.linkedin.com/in/alexandre-rangel-79641510b/');

--
-- Acionadores `t_url`
--
DELIMITER $$
CREATE TRIGGER `Informa_Robo` AFTER INSERT ON `t_url` FOR EACH ROW insert into robo (ID_URL, DATA_T,HORA_T,STATUS_URL,RETORNO)
values (new.ID, CURRENT_DATE,CURRENT_TIME,'Processando','Ainda não Processado')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(3) NOT NULL,
  `NOME` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SENHA` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `NOME`, `SENHA`) VALUES
(1, 'Alexandre', '$2y$10$8DxYD4TySCKpqXlPh8iK1.hsJziVGWWbK91iQvSmbKzucn1tF5dxK'),
(2, 'Tamires', '$2y$10$8DxYD4TySCKpqXlPh8iK1.hsJziVGWWbK91iQvSmbKzucn1tF5dxK');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `robo`
--
ALTER TABLE `robo`
  ADD PRIMARY KEY (`ID_R`),
  ADD KEY `fk_url` (`ID_URL`);

--
-- Índices para tabela `t_url`
--
ALTER TABLE `t_url`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `robo`
--
ALTER TABLE `robo`
  MODIFY `ID_R` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `t_url`
--
ALTER TABLE `t_url`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `robo`
--
ALTER TABLE `robo`
  ADD CONSTRAINT `fk_url` FOREIGN KEY (`ID_URL`) REFERENCES `t_url` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
