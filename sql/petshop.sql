-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 26-Jun-2022 às 11:57
-- Versão do servidor: 8.0.22
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `petshop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ps_agendamentos`
--

CREATE TABLE `ps_agendamentos` (
  `id` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `pet` varchar(50) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `hora` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ps_agendamentos`
--

INSERT INTO `ps_agendamentos` (`id`, `nome`, `pet`, `tel`, `email`, `data`, `hora`) VALUES
(2, 'Leandro Vitorino', 'Franck', '(21) 980068401', 'desa.vitorino@gmail.com', '2021-11-29', 10),
(4, 'Marquinhos Maciel', 'Tanajura', '32998745666', 'nona@wat.com', '2022-06-15', 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ps_carrinho`
--

CREATE TABLE `ps_carrinho` (
  `id` int NOT NULL,
  `idLogin` int NOT NULL,
  `idProduto` int NOT NULL,
  `Quantidade` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ps_carrinho`
--

INSERT INTO `ps_carrinho` (`id`, `idLogin`, `idProduto`, `Quantidade`) VALUES
(45, 7, 3, 0),
(46, 7, 7, 0),
(47, 7, 8, 0),
(48, 9, 3, 0),
(49, 9, 3, 0),
(55, 7, 7, 6),
(56, 7, 7, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ps_login`
--

CREATE TABLE `ps_login` (
  `id` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `niveis_acesso_id` int NOT NULL,
  `data` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ps_login`
--

INSERT INTO `ps_login` (`id`, `nome`, `email`, `senha`, `telefone`, `endereco`, `cpf`, `niveis_acesso_id`, `data`) VALUES
(1, 'Leandro Vitorino', 'desa.vitorino@gmail.com', 'd2c3444c2f1aeea03a9d7218bb795701', '(21) 980068401', 'Rua General Jacques Ourique, 616, Apt 102', '122.566.291-60', 1, '03/07/1996'),
(2, 'Juan Luis Fonseca Da Silva', 'juanluis-fonseca@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '(21) 965140651', 'Rua Barroso, 235', '184.000.807-00', 1, '26/08/2000'),
(6, 'Paloma Dutra', 'palomadutra02211@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '(21) 980068401', 'Rua General Jacques Ourique, 616, Apt 102', '122.566.291-60', 2, '03/07/1996'),
(7, 'Admin', 'admin@petshop.com.br', '21232f297a57a5a743894a0e4a801fc3', '(21) 999999999', 'Rua Clarimundo', '111.111.111-11', 1, '03/07/1996'),
(8, 'Jucimara Gomes', 'belsanpesou@yahoo.com.br', 'e10adc3949ba59abbe56e057f20f883e', '(21) 999055015', 'rua Lucio José filho', '523.067.297-15', 2, '1941-11-10'),
(9, 'Ricardo Russo', 'megame@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '(21) 998554455', 'Rua Bonivari, 36', '054.688.745-98', 2, '2012-05-01'),
(10, 'Gokudera Pink', 'horasd_ponk@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '(21) 998775544', 'Rua Elevarios da Mata, 65', '877.354.180-00', 2, '2000-05-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ps_pedidos`
--

CREATE TABLE `ps_pedidos` (
  `id` int NOT NULL,
  `idLogin` int NOT NULL,
  `idProduto` int NOT NULL,
  `data` varchar(10) NOT NULL,
  `Quantidade` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ps_pedidos`
--

INSERT INTO `ps_pedidos` (`id`, `idLogin`, `idProduto`, `data`, `Quantidade`) VALUES
(3, 1, 3, '30/11/21', 0),
(6, 8, 7, '20/06/22', 0),
(7, 8, 7, '25/06/22', 0),
(8, 8, 7, '25/06/22', 0),
(9, 8, 7, '25/06/22', 0),
(10, 8, 7, '25/06/22', 5),
(11, 8, 9, '25/06/22', 5),
(12, 8, 11, '25/06/22', 3),
(13, 8, 8, '25/06/22', 11),
(14, 8, 3, '25/06/22', 2),
(15, 8, 3, '25/06/22', 3),
(16, 8, 7, '25/06/22', 7),
(17, 8, 8, '25/06/22', 5),
(18, 8, 9, '25/06/22', 6),
(19, 8, 10, '25/06/22', 6),
(20, 8, 11, '25/06/22', 7),
(21, 8, 3, '25/06/22', 5),
(22, 8, 3, '25/06/22', 1),
(23, 8, 8, '25/06/22', 1),
(24, 8, 7, '25/06/22', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ps_produtos`
--

CREATE TABLE `ps_produtos` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `preco` float NOT NULL,
  `qtd` int NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ps_produtos`
--

INSERT INTO `ps_produtos` (`id`, `nome`, `descricao`, `preco`, `qtd`, `img`) VALUES
(3, 'Scalibor Coleira Antiparasitária', 'Eficaz inseticida e repelente comprovada por estudos científicos', 63.2, 85, 'dist/images/7._AC_SS130_.jpg'),
(7, 'Ração Seca Nutrilus Pro Frango & Carne Para Cães Adultos', 'Ração para cachorro Premium Especial: Nutrição de alta qualidade pelo melhor custo benefí­cio', 100, 83, 'dist/images/4.jpg'),
(8, 'Tapete Higiênico Me.au Pet Para Cães', 'Tapete Higiênico Me.Au Pet: Alegria em forma de produtos de qualidade, que te ajudam a economizar tempo e dinheiro.', 60.7, 83, 'dist/images/8.jpg'),
(9, 'Ração De Raças Pequenas', 'Ração Amida Pedigree Sachê Cordeiro ao Molho para Cães Adultos de Raças Pequenas', 50, 89, 'dist/images/9.jpg'),
(10, 'Petisco Pedigree Dentastix', 'Petisco Pedigree Dentastix Cuidado Oral Para Cães Adultos Raças Pequenas', 75.3, 94, 'dist/images/10.jpg'),
(11, 'Escova Para Gato Ferplast', 'É uma rasqueadeira para gatos com dentes de plástico, ideal para cuidar de animais com pelos curtos, médios e longos.', 23, 90, 'dist/images/11.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ps_agendamentos`
--
ALTER TABLE `ps_agendamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ps_carrinho`
--
ALTER TABLE `ps_carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_login` (`idLogin`),
  ADD KEY `fk_produtos` (`idProduto`);

--
-- Índices para tabela `ps_login`
--
ALTER TABLE `ps_login`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ps_pedidos`
--
ALTER TABLE `ps_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ps_produtos`
--
ALTER TABLE `ps_produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ps_agendamentos`
--
ALTER TABLE `ps_agendamentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ps_carrinho`
--
ALTER TABLE `ps_carrinho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `ps_login`
--
ALTER TABLE `ps_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `ps_pedidos`
--
ALTER TABLE `ps_pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `ps_produtos`
--
ALTER TABLE `ps_produtos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ps_carrinho`
--
ALTER TABLE `ps_carrinho`
  ADD CONSTRAINT `fk_login` FOREIGN KEY (`idLogin`) REFERENCES `ps_login` (`id`),
  ADD CONSTRAINT `fk_produtos` FOREIGN KEY (`idProduto`) REFERENCES `ps_produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
