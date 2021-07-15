-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Maio-2021 às 04:42
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `food`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `cidade` varchar(20) NOT NULL DEFAULT 'Curitiba',
  `valor_entrega` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`id`, `nome`, `slug`, `cidade`, `valor_entrega`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Água Verde', 'agua-verde', 'Curitiba', '25.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(2, 'Ahú', 'ahu', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(3, 'Centro', 'centro', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(4, 'Alto da Glória', 'alto-da-gloria', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(5, 'Alto da Rua XV', 'alto-da-rua-xv', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(6, 'Bacacheri', 'bacacheri', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(7, 'Portão', 'portao', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(8, 'Cristo Rei', 'cristo-rei', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(9, 'Bairro Alto', 'bairro-alto', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(10, 'Batel', 'batel', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(11, 'Bigorrilho', 'bigorrilho', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(12, 'Boa Vista', 'boa-vista', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(13, 'Bom Retiro', 'bom-retiro', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(14, 'Cabral', 'cabral', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(15, 'Cajuru', 'cajuru', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(16, 'Capão da Imbuia', 'capao-da-embuia', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(17, 'Centro Cívico', 'centro-civico', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(18, 'Guabirotuba', 'guabirotuba', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(19, 'Hugo Lange', 'hugo-langue', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(20, 'Jardim Botânico', 'jardim-botanico', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(21, 'Jardim das Américas', 'jardim-das-americas', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(22, 'Jardim Social', 'jardim-social', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(23, 'Juvevê', 'juveve', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(24, 'Mercês', 'merces', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(25, 'Parolin', 'parolim', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(26, 'Prado Velho', '', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(27, 'Rebouças', '', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(28, 'São Francisco', 'sao-francisco', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(29, 'São Lourenço', '', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(30, 'Tarumã', '', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(31, 'Uberaba', '', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(32, 'Vila Izabel', '', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL),
(34, 'Cascatinha', '', 'Curitiba', '15.00', 1, '2021-04-21 02:30:50', '2021-04-21 02:30:50', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `slug`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pizzas doces', 'pizzas-doces', 1, '2021-03-13 01:58:01', '2021-03-29 00:07:11', NULL),
(3, 'Porções', 'porcoes', 1, '2021-03-13 03:10:35', '2021-03-13 03:11:14', NULL),
(4, 'Pizzas salgadas', 'pizzas-salgadas', 1, '2021-03-29 00:07:00', '2021-03-29 00:07:00', NULL),
(5, 'Refrigerantes', 'refrigerantes', 1, '2021-03-29 00:07:29', '2021-03-29 00:07:29', NULL),
(6, 'Sobremesas', 'sobremesas', 1, '2021-03-29 00:07:46', '2021-03-29 00:07:46', NULL),
(7, 'Calzones', 'calzones', 1, '2021-03-29 00:07:56', '2021-03-29 00:07:56', NULL),
(8, 'Lasanhas', 'lasanhas', 1, '2021-03-29 00:08:58', '2021-03-29 00:13:59', NULL),
(9, 'Sanduiches', 'sanduiches', 1, '2021-03-29 01:10:59', '2021-03-29 01:10:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregadores`
--

CREATE TABLE `entregadores` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(240) NOT NULL,
  `imagem` varchar(240) DEFAULT NULL,
  `veiculo` varchar(240) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entregadores`
--

INSERT INTO `entregadores` (`id`, `nome`, `cpf`, `cnh`, `email`, `telefone`, `endereco`, `imagem`, `veiculo`, `placa`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'O Justiceiro', '694.190.750-95', '19816557798', 'pedroluiz@email.com', '(41) 9999-9999', 'Rua do trabalho, 45, Centro Cívico - Curitiba - PR', '1616655270_2dcfccdb04b226344f2e.jpeg', 'Titan 250 - Preta - 2018', 'AUG-8667', 1, '2021-03-25 02:18:12', '2021-03-25 03:54:31', NULL),
(2, 'Cristiane Julia Lúcia de Paula', '318.220.968-04', '86287492550', 'cristianejulialuciadepaula@argo.com.br', '(89) 98928-5026', 'Rua Joaquim Pedro Gonçalves - Paraibinha - Picos - PI', '1616656013_9b661bcbdde6ffab6cdb.jpg', 'CG 2018 - Vermelha', 'LVM-5010', 1, '2021-03-25 03:44:23', '2021-03-25 04:06:54', NULL),
(3, 'Denzel washington', '996.959.769-80', '45754118441', 'denzel@email.com', '(46) 54654-6546', 'Nova York', '1616655968_d6e2b94ca1b35b7119d5.jpg', 'CB - 400 - Preta', 'DEN-4654', 1, '2021-03-25 03:58:01', '2021-05-02 15:49:30', NULL),
(4, 'Hannibal', '427.027.450-67', '31726885933', 'haninal@email.com', '(45) 66465-4564', 'Rua da Gastronomia', '1619981617_939e448f3bc7c3e0246e.jpg', 'Moto Honda CB 400 ', 'HAN-8999', 1, '2021-05-02 15:53:25', '2021-05-02 15:53:37', NULL),
(5, 'Lisabeth Salander', '315.586.010-31', '18661492828', 'lisabeth@email.com', '(45) 46546-4654', 'Mlillenium', '1619981868_c9c0725317db1ada16de.jpg', 'The Monster 797', 'ELI-9999', 1, '2021-05-02 15:57:39', '2021-05-02 15:57:48', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `expediente`
--

CREATE TABLE `expediente` (
  `id` int(5) UNSIGNED NOT NULL,
  `dia` int(5) NOT NULL,
  `dia_descricao` varchar(50) NOT NULL,
  `abertura` time DEFAULT NULL,
  `fechamento` time DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `expediente`
--

INSERT INTO `expediente` (`id`, `dia`, `dia_descricao`, `abertura`, `fechamento`, `situacao`) VALUES
(1, 0, 'Domingo', '00:00:00', '23:00:00', 1),
(2, 1, 'Segunda', '00:30:00', '23:00:00', 1),
(3, 2, 'Terça', '18:00:00', '23:00:00', 1),
(4, 3, 'Quarta', '18:00:00', '23:00:00', 1),
(5, 4, 'Quinta', '18:00:00', '23:00:00', 1),
(6, 5, 'Sexta', '18:00:00', '23:00:00', 1),
(7, 6, 'Sábado', '18:00:00', '23:59:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extras`
--

CREATE TABLE `extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `extras`
--

INSERT INTO `extras` (`id`, `nome`, `slug`, `preco`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'catupiry importado', 'catupiry-importado', '10.00', 'Extra de catupiry importado para pizzass', 1, '2021-03-16 02:03:45', '2021-03-29 00:17:46', '2021-03-29 00:17:46'),
(3, 'Borda de cheddar', 'borda-de-cheddar', '7.00', 'Borda de cheddar', 1, '2021-03-16 02:44:38', '2021-03-16 02:45:01', NULL),
(4, 'Batata extra fina', 'batata-extra-fina', '5.00', 'Extra de batata extra fina', 1, '2021-03-29 00:14:40', '2021-03-29 00:14:40', NULL),
(5, 'Azeitona', 'azeitona', '5.00', 'Extra de azeitona', 1, '2021-03-29 00:15:08', '2021-03-29 00:15:08', NULL),
(6, 'Borda de catupiry', 'borda-de-catupiry', '5.00', 'Borda de catupiry', 1, '2021-03-29 00:15:52', '2021-03-29 00:15:52', NULL),
(7, 'Borda vulcão', 'borda-vulcao', '8.00', 'Borda vulcão', 1, '2021-03-29 00:16:30', '2021-03-29 00:16:30', NULL),
(8, 'Bacon com milho', 'bacon-com-milho', '15.00', 'Extra de bacon com milho para pizzas', 1, '2021-03-29 00:18:23', '2021-03-29 00:18:23', NULL),
(9, 'Calabresa com catupiry', 'calabresa-com-catupiry', '15.00', 'Extra de calabresa com catupiry', 1, '2021-03-29 00:19:54', '2021-03-29 00:19:54', NULL),
(10, 'Chocolate MM\'s', 'chocolate-mms', '8.00', 'Extra de chocolate MM\'s', 1, '2021-03-29 00:20:33', '2021-03-29 00:20:33', NULL),
(11, 'Morango', 'morango', '8.00', 'Extra de morango', 1, '2021-03-29 00:20:55', '2021-03-29 00:20:55', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamento`
--

CREATE TABLE `formas_pagamento` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formas_pagamento`
--

INSERT INTO `formas_pagamento` (`id`, `nome`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Dinheiro', 1, '2021-03-22 00:53:29', '2021-03-22 00:53:29', NULL),
(2, 'Cartão de crédito', 1, '2021-03-25 01:26:49', '2021-03-25 02:00:52', NULL),
(3, 'Cartão de débito', 1, '2021-03-25 01:46:28', '2021-03-25 02:00:26', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medidas`
--

CREATE TABLE `medidas` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medidas`
--

INSERT INTO `medidas` (`id`, `nome`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pizza Grande (35cm – 10 fatias)', 'Grande (35cm – 10 fatias)', 1, '2021-03-16 02:56:56', '2021-03-29 00:42:49', NULL),
(2, 'Pizza Família (40cm – 12 fatias)', 'Família (40cm – 12 fatias)', 1, '2021-03-17 01:38:40', '2021-03-29 00:43:13', NULL),
(3, 'Pizza pequena (25 cm – 6 fatias)', 'Pizza pequena (25 cm – 6 fatias)', 1, '2021-03-29 00:24:39', '2021-03-29 00:43:30', NULL),
(4, 'Pizza média (30cm – 8 fatias)', 'Média (30cm – 8 fatias)', 1, '2021-03-29 00:25:15', '2021-03-29 00:43:44', NULL),
(5, 'Pizza gigante (45cm – 16 fatias)', 'Gigante (45cm – 16 fatias)', 1, '2021-03-29 00:27:33', '2021-03-29 00:43:58', NULL),
(6, 'Pet 2 litros', 'Bebida de 2 litros', 1, '2021-03-29 00:28:15', '2021-03-29 00:28:15', NULL),
(7, 'Pet 2,5 litros', 'Pet 2,5 litros', 1, '2021-03-29 00:28:42', '2021-03-29 00:28:42', NULL),
(8, 'Pet 250ml', 'Pet 250ml', 1, '2021-03-29 00:28:59', '2021-03-29 00:28:59', NULL),
(9, 'Lata 310ml', 'Lata 310ml', 1, '2021-03-29 00:29:19', '2021-03-29 00:29:19', NULL),
(10, 'Lata 220ml', 'Lata 220ml', 1, '2021-03-29 00:29:39', '2021-03-29 00:29:39', NULL),
(11, 'Pet 1 litro', 'Pet 1 litro', 1, '2021-03-29 00:29:54', '2021-03-29 00:29:54', NULL),
(12, 'Porção pequena', 'Porção pequena', 1, '2021-03-29 00:30:08', '2021-03-29 00:30:08', NULL),
(13, 'Porção média', 'Porção média', 1, '2021-03-29 00:30:24', '2021-03-29 00:30:24', NULL),
(14, 'Porção grande', 'Porção grande', 1, '2021-03-29 00:30:39', '2021-03-29 00:30:39', NULL),
(15, 'Hamburguer médio - 100 gramas', 'Hamburguer médio - 100 gramas', 1, '2021-03-29 00:35:01', '2021-03-29 01:08:51', NULL),
(16, 'Hambúrguer Grande - 300 gramas', 'Hambúrguer Grande - 300 gramas', 1, '2021-03-29 00:35:24', '2021-03-29 01:09:08', NULL),
(17, 'Hambúrguer Gigante - 500 gramas', 'Hambúrguer Gigante - 500 gramas', 1, '2021-03-29 00:38:49', '2021-03-29 01:09:28', NULL),
(18, 'Calzone pequeno', 'Calzone pequeno', 1, '2021-03-29 01:26:05', '2021-03-29 01:27:17', NULL),
(19, 'Calzone grande', 'Calzone pequeno', 1, '2021-03-29 01:27:34', '2021-03-29 01:27:34', NULL),
(20, 'Sorvete médio - 200 gramas', 'Sorvete médio - 200 gramas', 1, '2021-03-29 01:36:54', '2021-03-29 01:36:54', NULL),
(21, 'Sorvete grande - 300 gramas', 'Sorvete grande - 300 gramas', 1, '2021-03-29 01:37:20', '2021-03-29 01:37:20', NULL),
(22, 'Lasanha média', 'Lasanha média', 1, '2021-03-29 01:43:18', '2021-03-29 01:43:18', NULL),
(23, 'Lasanha grande', 'Lasanha grande', 1, '2021-03-29 01:43:35', '2021-03-29 01:43:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(4, '2021-03-03-065421', 'App\\Database\\Migrations\\CriaTabelaUsuarios', 'default', 'App', 1614920587, 1),
(6, '2021-03-13-045312', 'App\\Database\\Migrations\\CriaTabelaCategorias', 'default', 'App', 1615611469, 2),
(7, '2021-03-16-044348', 'App\\Database\\Migrations\\CriaTabelaExtras', 'default', 'App', 1615870030, 3),
(8, '2021-03-16-055529', 'App\\Database\\Migrations\\CriaTabelaMedidas', 'default', 'App', 1615874203, 4),
(9, '2021-03-17-045620', 'App\\Database\\Migrations\\CriaTabelaProdutos', 'default', 'App', 1615957597, 5),
(11, '2021-03-21-213535', 'App\\Database\\Migrations\\CriaTabelaProdutosExtras', 'default', 'App', 1616362767, 6),
(12, '2021-03-22-002515', 'App\\Database\\Migrations\\CriaTabelaProdutosEspecificacoes', 'default', 'App', 1616372902, 7),
(13, '2021-03-22-034102', 'App\\Database\\Migrations\\CriaTabelaFormasPagamento', 'default', 'App', 1616384637, 8),
(14, '2021-03-25-051027', 'App\\Database\\Migrations\\CriaTabelaEntregadores', 'default', 'App', 1616649362, 9),
(15, '2021-03-28-172355', 'App\\Database\\Migrations\\CriaTabelaBairros', 'default', 'App', 1616952440, 10),
(17, '2021-03-28-230446', 'App\\Database\\Migrations\\CriaTabelaExpediente', 'default', 'App', 1616973726, 11),
(18, '2021-04-18-224816', 'App\\Database\\Migrations\\CriaTabelaPedidos', 'default', 'App', 1618786606, 12),
(19, '2021-04-22-013359', 'App\\Database\\Migrations\\CriaTabelaPedidosProdutos', 'default', 'App', 1619055371, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(5) UNSIGNED NOT NULL,
  `usuario_id` int(5) UNSIGNED NOT NULL,
  `entregador_id` int(5) UNSIGNED DEFAULT NULL,
  `codigo` varchar(10) NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `situacao` tinyint(1) NOT NULL DEFAULT 0,
  `produtos` text NOT NULL,
  `valor_produtos` decimal(10,2) NOT NULL,
  `valor_entrega` decimal(10,2) NOT NULL,
  `valor_pedido` decimal(10,2) NOT NULL,
  `endereco_entrega` varchar(255) NOT NULL,
  `observacoes` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `entregador_id`, `codigo`, `forma_pagamento`, `situacao`, `produtos`, `valor_produtos`, `valor_entrega`, `valor_pedido`, `endereco_entrega`, `observacoes`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(2, 5, 2, '03289176', 'Dinheiro', 2, 'a:2:{i:0;a:6:{s:2:\"id\";s:1:\"3\";s:4:\"nome\";s:82:\"Pízza de Calabresa Pizza Família (40cm – 12 fatias) Com extra Borda de cheddar\";s:4:\"slug\";s:74:\"pizza-de-calabresa-pizza-familia-40cm-12-fatias-com-extra-borda-de-cheddar\";s:5:\"preco\";s:5:\"62.00\";s:10:\"quantidade\";i:2;s:7:\"tamanho\";s:35:\"Pizza Família (40cm – 12 fatias)\";}i:1;a:6:{s:2:\"id\";s:2:\"12\";s:4:\"nome\";s:22:\"Sprite Pet 2,5 litros \";s:4:\"slug\";s:20:\"sprite-pet-25-litros\";s:5:\"preco\";s:5:\"12.00\";s:10:\"quantidade\";i:2;s:7:\"tamanho\";s:14:\"Pet 2,5 litros\";}}', '148.00', '12.00', '160.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR</span> - Número 1000', 'Ponto de referência: Ao lado do Passeio Público - Número: 1000. Você informou que precisa de troco para: R$ 200.00', '2021-04-18 21:48:13', '2021-04-21 23:47:40', '2021-04-21 23:47:40'),
(3, 5, NULL, '01698352', 'Cartão de crédito', 3, 'a:2:{i:0;a:6:{s:2:\"id\";s:1:\"3\";s:4:\"nome\";s:82:\"Pízza de Calabresa Pizza Família (40cm – 12 fatias) Com extra Borda de cheddar\";s:4:\"slug\";s:74:\"pizza-de-calabresa-pizza-familia-40cm-12-fatias-com-extra-borda-de-cheddar\";s:5:\"preco\";s:5:\"62.00\";s:10:\"quantidade\";i:2;s:7:\"tamanho\";s:35:\"Pizza Família (40cm – 12 fatias)\";}i:1;a:6:{s:2:\"id\";s:2:\"12\";s:4:\"nome\";s:22:\"Sprite Pet 2,5 litros \";s:4:\"slug\";s:20:\"sprite-pet-25-litros\";s:5:\"preco\";s:5:\"12.00\";s:10:\"quantidade\";i:2;s:7:\"tamanho\";s:14:\"Pet 2,5 litros\";}}', '148.00', '15.00', '163.00', 'Cidade Industrial - Curitiba - Rua Cidade de Rodeio - CEP 81270-140 - PR - Número 1900', 'Ponto de referência: Centro - Número: 1900', '2021-04-18 22:02:28', '2021-04-21 23:47:13', '2021-04-21 23:47:13'),
(4, 1, NULL, '60758213', 'Dinheiro', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"14\";s:4:\"nome\";s:45:\"Calzone de frango com palmito Calzone grande \";s:4:\"slug\";s:44:\"calzone-de-frango-com-palmito-calzone-grande\";s:5:\"preco\";s:5:\"15.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:14:\"Calzone grande\";}}', '15.00', '15.00', '30.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 32', 'Ponto de referência: Centro - Número: 32. Você informou que precisa de troco para: R$ 50.00', '2021-05-01 23:15:51', '2021-05-01 23:15:51', NULL),
(5, 1, NULL, '81045237', 'Cartão de crédito', 0, 'a:2:{i:0;a:6:{s:2:\"id\";s:1:\"8\";s:4:\"nome\";s:61:\"Hambúrguer de queijo nobre Hambúrguer Gigante - 500 gramas \";s:4:\"slug\";s:56:\"hamburguer-de-queijo-nobre-hamburguer-gigante-500-gramas\";s:5:\"preco\";s:5:\"45.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:32:\"Hambúrguer Gigante - 500 gramas\";}i:1;a:6:{s:2:\"id\";s:2:\"19\";s:4:\"nome\";s:34:\"Lasanha bolonhesa  Lasanha grande \";s:4:\"slug\";s:32:\"lasanha-bolonhesa-lasanha-grande\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:2;s:7:\"tamanho\";s:14:\"Lasanha grande\";}}', '115.00', '15.00', '130.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 300', 'Ponto de referência: Ao lado do Passeio Público - Número: 300', '2021-05-01 23:21:46', '2021-05-01 23:21:46', NULL),
(6, 3, 5, '78913452', 'Cartão de crédito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"15\";s:4:\"nome\";s:33:\"Calzone de mignon Calzone grande \";s:4:\"slug\";s:32:\"calzone-de-mignon-calzone-grande\";s:5:\"preco\";s:5:\"22.00\";s:10:\"quantidade\";i:10;s:7:\"tamanho\";s:14:\"Calzone grande\";}}', '220.00', '15.00', '235.00', 'Ahú - Curitiba - Rua Alberto Folloni - CEP 80540-000 - PR - Número 32', 'Ponto de referência: Centro - Número: 32', '2021-05-02 00:05:04', '2021-05-02 16:50:56', NULL),
(7, 3, 4, '80617924', 'Cartão de débito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:93:\"Pizza de chocolate com morango Pizza Família (40cm – 12 fatias) Com extra Borda de cheddar\";s:4:\"slug\";s:86:\"pizza-de-chocolate-com-morango-pizza-familia-40cm-12-fatias-com-extra-borda-de-cheddar\";s:5:\"preco\";s:5:\"42.00\";s:10:\"quantidade\";i:8;s:7:\"tamanho\";s:35:\"Pizza Família (40cm – 12 fatias)\";}}', '336.00', '15.00', '351.00', 'Ahú - Curitiba - Rua Alberto Folloni - CEP 80540-000 - PR - Número 32', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 32', '2021-05-02 00:05:54', '2021-05-02 16:01:13', NULL),
(8, 3, 1, '34916570', 'Cartão de débito', 2, 'a:2:{i:0;a:6:{s:2:\"id\";s:2:\"11\";s:4:\"nome\";s:25:\"Coca cola Pet 2,5 litros \";s:4:\"slug\";s:23:\"coca-cola-pet-25-litros\";s:5:\"preco\";s:5:\"18.00\";s:10:\"quantidade\";i:7;s:7:\"tamanho\";s:14:\"Pet 2,5 litros\";}i:1;a:6:{s:2:\"id\";s:1:\"7\";s:4:\"nome\";s:50:\"Porção de batata frita simples Porção pequena \";s:4:\"slug\";s:45:\"porcao-de-batata-frita-simples-porcao-pequena\";s:5:\"preco\";s:4:\"8.00\";s:10:\"quantidade\";i:7;s:7:\"tamanho\";s:16:\"Porção pequena\";}}', '182.00', '15.00', '197.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 32', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 32', '2021-05-02 00:36:44', '2021-05-02 16:00:34', NULL),
(9, 3, 2, '48359216', 'Cartão de crédito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"9\";s:4:\"nome\";s:69:\"Hambúrguer de bacon com champignon  Hambúrguer Grande - 300 gramas \";s:4:\"slug\";s:63:\"hamburguer-de-bacon-com-champignon-hamburguer-grande-300-gramas\";s:5:\"preco\";s:5:\"45.00\";s:10:\"quantidade\";i:5;s:7:\"tamanho\";s:31:\"Hambúrguer Grande - 300 gramas\";}}', '225.00', '15.00', '240.00', 'Ahú - Curitiba - Rua Alberto Folloni - CEP 80540-000 - PR - Número 300', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 300', '2021-05-02 00:37:47', '2021-05-02 16:00:08', NULL),
(10, 4, 4, '23516074', 'Cartão de débito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"6\";s:4:\"nome\";s:41:\"Porção de frango frito Porção grande \";s:4:\"slug\";s:36:\"porcao-de-frango-frito-porcao-grande\";s:5:\"preco\";s:5:\"22.00\";s:10:\"quantidade\";i:6;s:7:\"tamanho\";s:15:\"Porção grande\";}}', '132.00', '15.00', '147.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 32', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 32', '2021-05-02 00:38:58', '2021-05-02 15:59:42', NULL),
(11, 4, NULL, '09815367', 'Dinheiro', 3, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"19\";s:4:\"nome\";s:34:\"Lasanha bolonhesa  Lasanha grande \";s:4:\"slug\";s:32:\"lasanha-bolonhesa-lasanha-grande\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:10;s:7:\"tamanho\";s:14:\"Lasanha grande\";}}', '350.00', '15.00', '365.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 300', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 300. Você informou que não precisa de troco', '2021-05-02 00:39:48', '2021-05-02 01:00:23', NULL),
(12, 4, 3, '29463170', 'Cartão de débito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"14\";s:4:\"nome\";s:46:\"Calzone de frango com palmito Calzone pequeno \";s:4:\"slug\";s:45:\"calzone-de-frango-com-palmito-calzone-pequeno\";s:5:\"preco\";s:4:\"8.00\";s:10:\"quantidade\";i:6;s:7:\"tamanho\";s:15:\"Calzone pequeno\";}}', '48.00', '15.00', '63.00', 'Ahú - Curitiba - Rua Alberto Folloni - CEP 80540-000 - PR - Número 300', 'Ponto de referência: Centro - Número: 300', '2021-05-02 00:40:18', '2021-05-02 00:47:06', NULL),
(13, 4, 2, '31074695', 'Cartão de crédito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:93:\"Pizza de chocolate com morango Pizza Família (40cm – 12 fatias) Com extra Borda de cheddar\";s:4:\"slug\";s:86:\"pizza-de-chocolate-com-morango-pizza-familia-40cm-12-fatias-com-extra-borda-de-cheddar\";s:5:\"preco\";s:5:\"42.00\";s:10:\"quantidade\";i:5;s:7:\"tamanho\";s:35:\"Pizza Família (40cm – 12 fatias)\";}}', '210.00', '15.00', '225.00', 'Ahú - Curitiba - Rua Alberto Folloni - CEP 80540-000 - PR - Número 300', 'Ponto de referência: Centro - Número: 300', '2021-05-02 00:41:10', '2021-05-02 00:46:32', NULL),
(14, 4, 2, '29013648', 'Cartão de débito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"12\";s:4:\"nome\";s:22:\"Sprite Pet 2,5 litros \";s:4:\"slug\";s:20:\"sprite-pet-25-litros\";s:5:\"preco\";s:5:\"12.00\";s:10:\"quantidade\";i:4;s:7:\"tamanho\";s:14:\"Pet 2,5 litros\";}}', '48.00', '15.00', '63.00', 'Ahú - Curitiba - Rua Alberto Folloni - CEP 80540-000 - PR - Número 32', 'Ponto de referência: Centro - Número: 32', '2021-05-02 00:41:42', '2021-05-02 00:46:08', NULL),
(15, 5, 2, '90647158', 'Cartão de crédito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"17\";s:4:\"nome\";s:57:\"Sorvete de caramelo crocante Sorvete grande - 300 gramas \";s:4:\"slug\";s:54:\"sorvete-de-caramelo-crocante-sorvete-grande-300-gramas\";s:5:\"preco\";s:5:\"20.00\";s:10:\"quantidade\";i:4;s:7:\"tamanho\";s:27:\"Sorvete grande - 300 gramas\";}}', '80.00', '15.00', '95.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 32', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 32', '2021-05-02 00:42:43', '2021-05-02 00:45:31', NULL),
(16, 5, NULL, '20945786', 'Cartão de débito', 3, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"8\";s:4:\"nome\";s:61:\"Hambúrguer de queijo nobre Hambúrguer Gigante - 500 gramas \";s:4:\"slug\";s:56:\"hamburguer-de-queijo-nobre-hamburguer-gigante-500-gramas\";s:5:\"preco\";s:5:\"45.00\";s:10:\"quantidade\";i:7;s:7:\"tamanho\";s:32:\"Hambúrguer Gigante - 500 gramas\";}}', '315.00', '15.00', '330.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 300', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 300', '2021-05-02 00:43:12', '2021-05-02 00:45:04', NULL),
(17, 5, 1, '82396054', 'Cartão de débito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"17\";s:4:\"nome\";s:57:\"Sorvete de caramelo crocante Sorvete médio - 200 gramas \";s:4:\"slug\";s:53:\"sorvete-de-caramelo-crocante-sorvete-medio-200-gramas\";s:5:\"preco\";s:5:\"15.00\";s:10:\"quantidade\";i:6;s:7:\"tamanho\";s:27:\"Sorvete médio - 200 gramas\";}}', '90.00', '15.00', '105.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 32', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 32', '2021-05-02 00:44:02', '2021-05-02 00:44:49', NULL),
(18, 12, 4, '79841620', 'Cartão de crédito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"14\";s:4:\"nome\";s:46:\"Calzone de frango com palmito Calzone pequeno \";s:4:\"slug\";s:45:\"calzone-de-frango-com-palmito-calzone-pequeno\";s:5:\"preco\";s:4:\"8.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:15:\"Calzone pequeno\";}}', '8.00', '15.00', '23.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 32', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 32', '2021-05-02 02:50:17', '2021-05-02 15:58:54', NULL),
(19, 12, 4, '84095137', 'Cartão de débito', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:2:\"19\";s:4:\"nome\";s:34:\"Lasanha bolonhesa  Lasanha grande \";s:4:\"slug\";s:32:\"lasanha-bolonhesa-lasanha-grande\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:14:\"Lasanha grande\";}}', '35.00', '15.00', '50.00', 'Centro Cívico - Curitiba - Avenida Cândido de Abreu - CEP 80530-000 - PR - Número 300', 'Ponto de referência: Ao lado do posto Ipiranga - Número: 300', '2021-05-02 02:51:25', '2021-05-02 15:58:29', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

CREATE TABLE `pedidos_produtos` (
  `id` int(5) UNSIGNED NOT NULL,
  `pedido_id` int(5) UNSIGNED NOT NULL,
  `produto` varchar(128) NOT NULL,
  `quantidade` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`id`, `pedido_id`, `produto`, `quantidade`) VALUES
(1, 2, 'Pízza de Calabresa Pizza Família (40cm – 12 fatias) Com extra Borda de cheddar', 2),
(2, 2, 'Sprite Pet 2,5 litros ', 2),
(3, 2, 'Pízza de Calabresa Pizza Família (40cm – 12 fatias) Com extra Borda de cheddar', 2),
(4, 2, 'Sprite Pet 2,5 litros ', 2),
(5, 17, 'Sorvete de caramelo crocante Sorvete médio - 200 gramas ', 6),
(6, 15, 'Sorvete de caramelo crocante Sorvete grande - 300 gramas ', 4),
(7, 14, 'Sprite Pet 2,5 litros ', 4),
(8, 13, 'Pizza de chocolate com morango Pizza Família (40cm – 12 fatias) Com extra Borda de cheddar', 5),
(9, 12, 'Calzone de frango com palmito Calzone pequeno ', 6),
(10, 19, 'Lasanha bolonhesa  Lasanha grande ', 1),
(11, 18, 'Calzone de frango com palmito Calzone pequeno ', 1),
(12, 10, 'Porção de frango frito Porção grande ', 6),
(13, 9, 'Hambúrguer de bacon com champignon  Hambúrguer Grande - 300 gramas ', 5),
(14, 8, 'Coca cola Pet 2,5 litros ', 7),
(15, 8, 'Porção de batata frita simples Porção pequena ', 7),
(16, 7, 'Pizza de chocolate com morango Pizza Família (40cm – 12 fatias) Com extra Borda de cheddar', 8),
(17, 6, 'Calzone de mignon Calzone grande ', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(5) UNSIGNED NOT NULL,
  `categoria_id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ingredientes` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `imagem` varchar(200) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `categoria_id`, `nome`, `slug`, `ingredientes`, `ativo`, `imagem`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 1, 'Pizza de chocolate com morango', 'pizza-de-chocolate-com-morango', 'Pizza de chocolate com morango', 1, '1616987047_03f09f796a175df2e11b.jpg', '2021-03-17 02:08:50', '2021-03-29 00:04:28', NULL),
(2, 3, 'Porção de batata com bacon', 'porcao-de-batata-com-bacon', 'Porção de batata com bacon', 1, '1616987148_338ed178e95fe6023869.webp', '2021-03-19 02:53:07', '2021-03-29 00:05:48', NULL),
(3, 4, 'Pízza de Calabresa', 'pizza-de-calabresa', 'Pizza de calabresa deliciosa', 1, '1616989264_8a2eff5355c86d7f7afd.jpg', '2021-03-29 00:39:23', '2021-03-29 01:55:26', NULL),
(4, 4, 'Pizza de quatro queijos', 'pizza-de-quatro-queijos', 'Pizza deliciosa de quatros queijos.', 0, '1616990322_46ed011d2a2b1a40aa35.jpg', '2021-03-29 00:57:10', '2021-03-29 00:58:42', NULL),
(5, 4, 'Pizza de peperoni', 'pizza-de-peperoni', 'Pizza de peperoni', 1, '1616990471_486cc8af1fabf3d167eb.jpg', '2021-03-29 01:01:01', '2021-03-29 01:01:37', NULL),
(6, 3, 'Porção de frango frito', 'porcao-de-frango-frito', 'Porção de frango frito', 1, '1616990725_706fe5b16d14b40c4b04.webp', '2021-03-29 01:05:11', '2021-03-29 01:05:25', NULL),
(7, 3, 'Porção de batata frita simples', 'porcao-de-batata-frita-simples', 'Porção de batata frita simples', 1, '1616990796_37bddaa3740e986ec7f3.jpg', '2021-03-29 01:06:18', '2021-03-29 01:06:37', NULL),
(8, 9, 'Hambúrguer de queijo nobre', 'hamburguer-de-queijo-nobre', 'Hambúrguer de queijo nobre delicioso', 1, '1616991108_de70e1b09c88ae49ed82.jpg', '2021-03-29 01:11:39', '2021-03-29 01:11:49', NULL),
(9, 9, 'Hambúrguer de bacon com champignon ', 'hamburguer-de-bacon-com-champignon', 'Hambúrguer de bacon com champignon ', 1, '1616991249_f3d2da2a901c644269a2.webp', '2021-03-29 01:13:59', '2021-03-29 01:14:09', NULL),
(10, 9, 'Hambúrguer de alcatra com picles', 'hamburguer-de-alcatra-com-picles', 'Hambúrguer de alcatra com picles', 1, '1616991348_17feb151931d8839f3ff.jpeg', '2021-03-29 01:15:37', '2021-03-29 01:15:48', NULL),
(11, 5, 'Coca cola', 'coca-cola', 'Refrigerante coca cola para acompanhar', 1, '1616991437_16425f221922f3606534.webp', '2021-03-29 01:17:08', '2021-03-29 01:17:18', NULL),
(12, 5, 'Sprite', 'sprite', 'Sprite geladinha para acompanhar', 1, '1616991539_7dde0d22b27007f948b1.webp', '2021-03-29 01:18:51', '2021-03-29 01:18:59', NULL),
(13, 5, 'Guaraná antártica', 'guarana-antartica', 'Guaraná antártica geladinho', 1, '1616991688_4658e0ce575d69d58ac9.jpg', '2021-03-29 01:21:17', '2021-03-29 01:21:29', NULL),
(14, 7, 'Calzone de frango com palmito', 'calzone-de-frango-com-palmito', 'Calzone de frango com palmito', 1, '1616991908_de44785676ebeed35a30.jpg', '2021-03-29 01:24:54', '2021-03-29 01:25:08', NULL),
(15, 7, 'Calzone de mignon', 'calzone-de-mignon', 'Calzone de mignon', 1, '1616992127_da4ead4eba420db7593e.jpg', '2021-03-29 01:28:38', '2021-03-29 01:28:48', NULL),
(16, 6, 'Sorvete de chocolate belga 70% cacau', 'sorvete-de-chocolate-belga-70-cacau', 'Sorvete de chocolate belga 70% cacau', 1, '1616992821_c041e99e70a5de235fac.jpg', '2021-03-29 01:30:51', '2021-03-29 01:40:21', NULL),
(17, 6, 'Sorvete de caramelo crocante', 'sorvete-de-caramelo-crocante', 'Sorvete de caramelo crocante', 1, '1616992741_7108abab194384affc70.jpg', '2021-03-29 01:31:46', '2021-03-29 01:39:01', NULL),
(18, 6, 'Sorvete de chocolate trufado com amêndoas', 'sorvete-de-chocolate-trufado-com-amendoas', 'Sorvete de chocolate trufado com amêndoas', 1, '1616992463_4b1fbc999b100f63b286.jpg', '2021-03-29 01:32:28', '2021-03-29 01:34:23', NULL),
(19, 8, 'Lasanha bolonhesa ', 'lasanha-bolonhesa', 'Lasanha bolonhesa ', 1, '1616993065_a4d4816c20593962fe22.jpg', '2021-03-29 01:44:07', '2021-03-29 01:44:25', NULL),
(20, 8, 'Lasanha de frango', 'lasanha-de-frango', 'Lasanha de frango', 1, '1616993127_d10c8b99a3d40ea28396.jpeg', '2021-03-29 01:45:15', '2021-03-29 01:45:28', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_especificacoes`
--

CREATE TABLE `produtos_especificacoes` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `medida_id` int(5) UNSIGNED NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `customizavel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_especificacoes`
--

INSERT INTO `produtos_especificacoes` (`id`, `produto_id`, `medida_id`, `preco`, `customizavel`) VALUES
(1, 1, 1, '50.00', 1),
(3, 1, 2, '35.00', 0),
(4, 3, 1, '50.00', 1),
(5, 3, 4, '30.00', 1),
(6, 3, 3, '18.00', 0),
(7, 3, 5, '62.00', 1),
(8, 3, 2, '55.00', 1),
(9, 4, 1, '45.00', 1),
(10, 4, 2, '55.00', 1),
(11, 4, 5, '65.00', 1),
(14, 5, 1, '55.00', 1),
(15, 5, 2, '65.00', 1),
(16, 5, 5, '75.00', 1),
(17, 6, 13, '15.00', 0),
(18, 6, 14, '22.00', 0),
(19, 7, 12, '8.00', 1),
(20, 7, 13, '15.00', 1),
(21, 8, 15, '22.00', 0),
(22, 8, 16, '32.00', 0),
(23, 8, 17, '45.00', 0),
(24, 9, 17, '55.00', 0),
(25, 9, 16, '45.00', 0),
(26, 10, 16, '55.00', 0),
(27, 10, 17, '65.00', 0),
(28, 11, 6, '12.00', 0),
(29, 11, 7, '18.00', 0),
(30, 11, 9, '6.00', 0),
(31, 12, 7, '12.00', 0),
(32, 13, 11, '8.00', 0),
(33, 13, 7, '15.00', 0),
(34, 14, 18, '8.00', 0),
(35, 14, 19, '15.00', 0),
(36, 15, 19, '22.00', 0),
(37, 17, 20, '15.00', 0),
(38, 17, 21, '20.00', 0),
(39, 16, 21, '25.00', 0),
(40, 19, 22, '25.00', 0),
(41, 19, 23, '35.00', 0),
(43, 20, 22, '30.00', 0),
(44, 20, 23, '40.00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_extras`
--

CREATE TABLE `produtos_extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `extra_id` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_extras`
--

INSERT INTO `produtos_extras` (`id`, `produto_id`, `extra_id`) VALUES
(1, 1, 3),
(3, 2, 3),
(5, 2, 1),
(6, 3, 3),
(7, 3, 6),
(8, 4, 3),
(9, 4, 6),
(10, 4, 7),
(11, 5, 5),
(12, 5, 6),
(14, 16, 10),
(15, 16, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 0,
  `password_hash` varchar(255) NOT NULL,
  `ativacao_hash` varchar(64) DEFAULT NULL,
  `reset_hash` varchar(64) DEFAULT NULL,
  `reset_expira_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `is_admin`, `ativo`, `password_hash`, `ativacao_hash`, `reset_hash`, `reset_expira_em`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Lucio Antonio de Souza', 'admin@admin.com', '388.012.100-19', '(41) 9999-9999', 1, 1, '$2y$10$VeWk9n.w8JG6XtLVlewONONwMqvFtqjFWXu/v6adSpFf83I.dN5M2', NULL, NULL, NULL, '2021-03-07 02:37:19', '2021-03-07 20:04:03', NULL),
(2, 'Miriam Cruz da Silva', 'miriam@email.com', '501.521.540-19', '(99) 96545-6454', 0, 1, '$2y$10$5UV8TI5F784Hs7pXp1w1puWmG7FMYbAMEBn7RcnsYWt.0ggUoMx06', NULL, NULL, NULL, '2021-03-07 02:37:55', '2021-04-18 13:51:32', NULL),
(3, 'Maria da Luz', 'maria@email.com', '831.736.010-50', '(46) 54645-6465', 0, 1, '$2y$10$fhmdoqzPcy77jtFNCYayGedUhKQcat99z4HZXVfGr/kyMAsU7SS3e', NULL, NULL, NULL, '2021-03-07 20:14:15', '2021-05-02 00:00:16', NULL),
(4, 'Fabiano Pereira', 'fabiano@email.com', '891.767.780-02', '(46) 54545-6465', 0, 1, '$2y$10$IQKNVV6TZQIXw4B5o.rHn.2hghtICNmx3CZEkYnkxSlrnTIjhHuC.', NULL, NULL, NULL, '2021-03-07 20:14:50', '2021-05-02 00:02:04', NULL),
(5, 'Ana Liliam', 'ana@email.com', '829.435.670-00', '(41) 46465-4654', 0, 1, '$2y$10$c41Xgw6/sjgb3dAOxftTJ.5k2WJokZpbnlaIMhf2W4qT8SQSGP5u2', NULL, NULL, NULL, '2021-03-12 02:26:31', '2021-05-02 00:00:02', NULL),
(11, 'Luana Pereira', 'luana@email.com', '796.622.710-31', '', 0, 1, '$2y$10$YXyOQFC3hv4Klhwb4Sagl.6/r6ia5VOVL5ItYiAOOpdp2LP9jSYH2', '61c6b2bafa404c7726c752ccacb4c29acb61b8a04dfb9490cfe72862b7fe4a30', NULL, NULL, '2021-04-06 03:03:31', '2021-05-02 01:26:21', NULL),
(12, 'Luiz Paulo', 'luizpaulo@email.com', '337.840.160-57', '', 0, 1, '$2y$10$HIGBNWFYc.IuW1RDvYZ9sOXN0nLjbAgeYNJHc7bpwGViFFUc97JVW', NULL, NULL, NULL, '2021-04-06 03:27:53', '2021-05-02 02:48:52', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `entregadores`
--
ALTER TABLE `entregadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `cnh` (`cnh`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices para tabela `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_usuario_id_foreign` (`usuario_id`),
  ADD KEY `pedidos_entregador_id_foreign` (`entregador_id`);

--
-- Índices para tabela `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_produtos_pedido_id_foreign` (`pedido_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `produtos_categoria_id_foreign` (`categoria_id`);

--
-- Índices para tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_especificacoes_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_especificacoes_medida_id_foreign` (`medida_id`);

--
-- Índices para tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_extras_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_extras_extra_id_foreign` (`extra_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `ativacao_hash` (`ativacao_hash`),
  ADD UNIQUE KEY `reset_hash` (`reset_hash`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `expediente`
--
ALTER TABLE `expediente`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_entregador_id_foreign` FOREIGN KEY (`entregador_id`) REFERENCES `entregadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD CONSTRAINT `pedidos_produtos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD CONSTRAINT `produtos_especificacoes_medida_id_foreign` FOREIGN KEY (`medida_id`) REFERENCES `medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_especificacoes_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD CONSTRAINT `produtos_extras_extra_id_foreign` FOREIGN KEY (`extra_id`) REFERENCES `extras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_extras_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
