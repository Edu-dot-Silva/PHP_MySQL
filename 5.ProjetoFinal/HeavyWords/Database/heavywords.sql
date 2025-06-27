-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/06/2025 às 20:06
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `heavywords`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `cliente_id`, `produto_id`, `quantidade`, `criado_em`) VALUES
(39, 3, 56, 3, '2025-06-26 16:56:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Livros'),
(2, 'Vinil'),
(3, 'CD'),
(4, 'Acessórios');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `criado_em`) VALUES
(1, 'admin', 'admin@admin.com.br', 'admin123', '2025-06-21 18:53:03'),
(2, 'Cliente teste', 'clienteste@email.com', '$2y$10$hSVkBwd4oYJc3FJ3kIQGg.hb6fHvEqhsfo7yEe1nDv1.fN8T9VNTC', '2025-06-21 19:39:57'),
(3, 'Eduardo', 'eduardo_esilva@hotmail.com', '$2y$10$1lWlnIeioQfwP18KFj47VealhdL/5JbrbM/s6J0jvsznsHYyMYnXy', '2025-06-21 19:48:08'),
(4, 'cliente teste compra', 'clientetestecompra@hotmail.com', '$2y$10$91khT7a5ifqrB3tcf04NM.AG3l4hsapplLAowx3OQfAD2f2i/x49y', '2025-06-21 20:08:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido_simulado`
--

CREATE TABLE `itens_pedido_simulado` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_pedido_simulado`
--

INSERT INTO `itens_pedido_simulado` (`id`, `pedido_id`, `produto_id`, `quantidade`, `preco_unitario`) VALUES
(7, 6, 54, 1, 94.00),
(8, 6, 76, 1, 48.90),
(9, 6, 48, 1, 30.00),
(10, 7, 78, 1, 47.50),
(11, 7, 77, 1, 43.90),
(12, 7, 79, 1, 44.90),
(13, 7, 74, 1, 45.90),
(14, 7, 115, 1, 58.00),
(15, 8, 78, 1, 47.50),
(16, 8, 119, 4, 74.70),
(17, 9, 56, 1, 64.99),
(18, 10, 56, 1, 64.99),
(19, 11, 56, 2, 64.99),
(20, 12, 95, 1, 195.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos_simulados`
--

CREATE TABLE `pedidos_simulados` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data_pedido` datetime DEFAULT current_timestamp(),
  `valor_total` decimal(10,2) DEFAULT NULL,
  `numero_pedido` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos_simulados`
--

INSERT INTO `pedidos_simulados` (`id`, `cliente_id`, `data_pedido`, `valor_total`, `numero_pedido`) VALUES
(6, 3, '2025-06-22 15:32:42', 172.90, '773479'),
(7, 3, '2025-06-22 15:36:47', 240.20, '653872'),
(8, 3, '2025-06-23 20:04:39', 346.30, '280434'),
(9, 3, '2025-06-23 20:07:44', 64.99, '532671'),
(10, 3, '2025-06-23 20:09:16', 64.99, '334697'),
(11, 3, '2025-06-23 20:10:06', 129.98, '178500'),
(12, 3, '2025-06-23 20:10:39', 195.00, '102252');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT 0,
  `vendidos` int(11) NOT NULL DEFAULT 0,
  `imagem_url` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `banda` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `estoque`, `vendidos`, `imagem_url`, `categoria_id`, `banda`, `tipo`, `ativo`, `criado_em`) VALUES
(42, 'Chaveiro Disturbed', 'Chaveiro oficial da banda Disturbed', 83.35, 15, 0, 'assets/img/produtos/acessorios/produto_685817833dcb0.jpg', 4, 'Disturbed', '0', 1, '2025-06-22 11:47:31'),
(43, 'Patch Orbit Culture', 'Patch oficial da banda Orbit Culture.', 15.00, 20, 0, 'assets/img/produtos/acessorios/produto_685818609f39b.jpg', 4, 'Orbit Culture', '0', 1, '2025-06-22 11:51:12'),
(44, 'Poster Limp Bizkit', 'Poster oficial da banda Limp Bizkit.', 88.28, 2, 0, 'assets/img/produtos/acessorios/produto_6858194f5fdef.png', 4, 'Limp Bizkit', '0', 1, '2025-06-22 11:55:11'),
(45, 'Relógio Black Sabbath', 'Relógio oficial da banda Black Sabbath.', 89.30, 2, 0, 'assets/img/produtos/acessorios/produto_68581ab507528.png', 4, 'Black Sabbath', 'Relógio', 1, '2025-06-22 12:01:09'),
(46, 'Adesivo Meshuggah', 'Adesivos oficial da banda Meshuggah.', 2.50, 20, 0, 'assets/img/produtos/acessorios/produto_68581bef97774.jpg', 4, 'Meshuggah', 'Adesivos', 1, '2025-06-22 12:06:23'),
(47, 'Action Figure Nirvana', 'Action Figure oficial da banda Nirvana.', 950.00, 1, 0, 'assets/img/produtos/acessorios/produto_68581cd315d32.png', 4, 'Nirvana', 'Action Figure', 1, '2025-06-22 12:10:11'),
(48, 'Pulseira Ghost', 'Pulseira oficial da banda Ghost.', 30.00, 2, 1, 'assets/img/produtos/acessorios/produto_68581da504644.jpg', 4, 'Ghost', 'Pulseira', 1, '2025-06-22 12:13:41'),
(49, 'Touca Ghost', 'Touca oficial da banda Ghost.', 40.00, 5, 0, 'assets/img/produtos/acessorios/produto_68581e49a9730.jpg', 4, 'Ghost', 'Touca', 1, '2025-06-22 12:16:25'),
(50, 'Boné System of a Down', 'Boné oficial da banda System of a Down.', 81.00, 5, 0, 'assets/img/produtos/acessorios/produto_68581e9c5e7fe.jpg', 4, 'System of a Down', 'Boné', 1, '2025-06-22 12:17:48'),
(51, 'Ecobag Behemoth', 'Ecobag oficial da banda Behemoth.', 60.00, 6, 0, 'assets/img/produtos/acessorios/produto_68581f06d6c96.png', 4, 'Behemoth', 'Ecobag', 1, '2025-06-22 12:19:34'),
(52, 'Capa de celular Ghost', 'Capa de celular oficial da banda Ghost.', 73.00, 10, 0, 'assets/img/produtos/acessorios/produto_68581f8809231.jpeg', 4, 'Ghost', 'Capa de celular', 1, '2025-06-22 12:21:44'),
(53, 'Bottom Ratos de Porão', 'Bottom oficial da banda Ratos de Porão.', 20.00, 10, 0, 'assets/img/produtos/acessorios/produto_68581ff9f1f3b.jpg', 4, 'Ratos de Porão', 'Bottom', 1, '2025-06-22 12:23:37'),
(54, 'Almofada Misfits', 'Almofada Misfits', 94.00, 5, 1, 'assets/img/produtos/acessorios/produto_685820b9077a9.png', 4, 'Misfits', 'Almofada', 1, '2025-06-22 12:26:49'),
(55, 'Quadro decorativo Ratos de Porão', 'uadro decorativo oficial da banda Ratos de Porão.', 85.00, 2, 0, 'assets/img/produtos/acessorios/produto_68582113b207a.png', 4, 'Ratos de Porão', 'Quadro decorativo', 1, '2025-06-22 12:28:19'),
(56, 'Caneca Rage Against the Machine', 'Caneca esmaltada oficial da banda Rage Against the Machine. Exclusiva.', 64.99, 3, 4, 'assets/img/produtos/acessorios/produto_6858219054107.png', 4, 'Rage Against the Machine', 'Caneca', 1, '2025-06-22 12:30:24'),
(57, 'Touca de inverno Ozzy Osbourne', 'Touca de inverno oficial da banda Ozzy Osbourne.', 54.99, 10, 0, 'assets/img/produtos/acessorios/produto_685821f6356b3.png', 4, 'Ozzy Osbourne', 'Touca', 1, '2025-06-22 12:32:06'),
(58, 'Porta-copos Metallica', 'Porta-copos oficial da banda Metallica.', 10.00, 30, 0, 'assets/img/produtos/acessorios/produto_6858227330f17.jpg', 4, 'Metallica', 'Porta-copos', 1, '2025-06-22 12:34:11'),
(59, 'Disturbed – Ten Thousand Fists', 'CD original com encarte completo e som potente de hinos do metal alternativo.', 49.90, 10, 0, 'assets/img/produtos/cd/produto_685823bec5753.jpg', 3, 'Disturbed', 'CD', 1, '2025-06-22 12:39:42'),
(60, 'Limp Bizkit – Chocolate Starfish', 'CD Digipack com encarte exclusivo da era de ouro do nu-metal.', 42.90, 7, 0, 'assets/img/produtos/cd/produto_685824103b399.jpg', 3, 'Limp Bizkit', 'CD', 1, '2025-06-22 12:41:04'),
(61, 'System of a Down – Steal This Album!', 'Álbum icônico em embalagem inusitada com material exclusivo.', 70.00, 2, 0, 'assets/img/produtos/cd/produto_6858249f1a2af.jpg', 3, 'System of a Down', 'CD', 1, '2025-06-22 12:43:27'),
(62, 'Marilyn Manson – Antichrist Superstar', 'Álbum clássico do industrial metal em CD com booklet completo.', 49.99, 10, 0, 'assets/img/produtos/cd/produto_685824eba5846.jpg', 3, 'Marilyn Manson', 'CD', 1, '2025-06-22 12:44:43'),
(63, 'Linkin Park – Meteora', 'Edição especial com faixas bônus, demos e encarte expandido.', 59.90, 10, 0, 'assets/img/produtos/cd/produto_6858252ee09a7.jpg', 3, 'Linkin Park', 'CD', 1, '2025-06-22 12:45:50'),
(64, 'Meshuggah – Immutable', 'CD Digipack com livreto de letras e arte brutal.', 54.90, 12, 0, 'assets/img/produtos/cd/produto_6858256c27f71.jpg', 3, 'Meshuggah', 'CD', 1, '2025-06-22 12:46:52'),
(65, 'Metallica – Ride the Lightning', 'Clássico do thrash em reedição digital com som remasterizado.', 49.90, 20, 0, 'assets/img/produtos/cd/produto_685825b2d1019.jpg', 3, 'Metallica', 'CD', 1, '2025-06-22 12:48:02'),
(66, 'Korn – Issues', 'Um dos álbuns mais sombrios do Korn, com capa icônica e produção impecável.', 47.90, 6, 0, 'assets/img/produtos/cd/produto_685825eac91df.jpg', 3, 'Korn', 'CD', 1, '2025-06-22 12:48:58'),
(67, 'Nirvana – Nevermind', 'Álbum que definiu uma geração em CD com faixas bônus ao vivo.', 46.90, 10, 0, 'assets/img/produtos/cd/produto_685826c875c90.jpg', 3, 'Nirvana', 'CD', 1, '2025-06-22 12:52:40'),
(68, 'Ghost – Infestissumam', 'Segundo disco do Ghost com encarte detalhado e letras ocultistas.', 48.90, 8, 0, 'assets/img/produtos/cd/produto_68582700bc66f.jpg', 3, 'Ghost', 'CD', 1, '2025-06-22 12:53:36'),
(69, 'Ozzy Osbourne – Ordinary Man', 'CD com participações de Slash e Elton John, em capa holográfica.', 56.90, 10, 0, 'assets/img/produtos/cd/produto_68582b191a0f2.jpg', 3, 'Ozzy Osbourne', 'CD', 1, '2025-06-22 13:11:05'),
(70, 'Black Sabbath – 13', 'Retorno épico da formação clássica em CD digipack.', 52.90, 5, 0, 'assets/img/produtos/cd/produto_68582b7149a67.jpg', 3, 'Black Sabbath', 'CD', 1, '2025-06-22 13:12:33'),
(71, 'Behemoth – Opvs Contra Natvram', 'CD novo com arte luxuosa e encarte com conceito lírico completo.', 58.90, 16, 0, 'assets/img/produtos/cd/produto_68582bde0d66a.jpg', 3, 'Behemoth', 'CD', 1, '2025-06-22 13:14:22'),
(72, 'Alice Cooper – Detroit Stories', 'Retorno às raízes em CD com espírito garage rock.', 46.00, 8, 0, 'assets/img/produtos/cd/produto_68582c4e9f509.jpg', 3, 'Alice Cooper', 'CD', 1, '2025-06-22 13:16:14'),
(73, 'Meshuggah – Koloss', 'CD com brutalidade matemática e sonoridade esmagadora.', 49.90, 7, 0, 'assets/img/produtos/cd/produto_68582cc79bb12.jpg', 3, 'Meshuggah', 'CD', 1, '2025-06-22 13:18:15'),
(74, 'Aerosmith – Get a Grip', 'Sucesso dos anos 90 com clássicos como “Crazy” e “Cryin’” em CD com arte original.', 45.90, 6, 1, 'assets/img/produtos/cd/produto_68582d2d1f6af.jpg', 3, 'Aerosmith', 'CD', 1, '2025-06-22 13:19:57'),
(75, 'Motörhead – Bad Magic', 'Um dos últimos álbuns de Lemmy, com som cru e poderoso.', 50.00, 5, 0, 'assets/img/produtos/cd/produto_68582d69b104f.jpg', 3, 'Motörhead', 'CD', 1, '2025-06-22 13:20:57'),
(76, 'System of a Down – Mezmerize', 'CD com capa dupla e encarte psicodélico, som direto ao ponto.', 48.90, 14, 1, 'assets/img/produtos/cd/produto_68582df083321.jpg', 3, 'System of a Down', 'CD', 1, '2025-06-22 13:23:12'),
(77, 'Misfits – Famous Monsters', 'CD com arte inspirada em filmes de terror e encarte monstruoso.', 43.90, 1, 1, 'assets/img/produtos/cd/produto_68582e2d4cc41.jpg', 3, 'Misfits', 'CD', 1, '2025-06-22 13:24:13'),
(78, 'Slipknot – Slipknot', 'Álbum de estreia com energia bruta e som nu-metal agressivo, edição com encarte original.', 47.50, 1, 2, 'assets/img/produtos/cd/produto_68582ec7f3219.jpg', 3, 'Slipknot', 'CD', 1, '2025-06-22 13:26:47'),
(79, 'Sepultura – Roots', 'Clássico do metal brasileiro com influências tribais, edição nacional com encarte completo.', 44.90, 12, 1, 'assets/img/produtos/cd/produto_68582f10498f2.jpg', 3, 'Sepultura', 'CD', 1, '2025-06-22 13:28:00'),
(80, 'Metallica – Master of Puppets', 'Edição remasterizada em vinil 180g de um dos álbuns mais icônicos do metal.', 189.90, 6, 0, 'assets/img/produtos/vinil/produto_685830fbdf9b8.png', 2, 'Metallica', 'Vinil', 1, '2025-06-22 13:36:11'),
(81, 'Korn – Follow the Leader', 'Álbum clássico do nu-metal em vinil duplo com encarte especial.', 159.90, 7, 0, 'assets/img/produtos/vinil/produto_68583187a0f2d.png', 2, 'Korn', 'Vinil', 1, '2025-06-22 13:38:31'),
(83, 'Slipknot – Iowa', 'Edição deluxe em vinil duplo com faixas bônus e encarte inédito.', 179.90, 12, 0, 'assets/img/produtos/vinil/produto_68583f3fb1317.jpg', 2, 'Slipknot', 'Vinil', 1, '2025-06-22 14:37:03'),
(84, 'Meshuggah – ObZen', 'Vinil importado do álbum técnico e brutal que definiu o som da banda.', 199.90, 3, 0, 'assets/img/produtos/vinil/produto_68583f8c7099d.jpg', 2, 'Meshuggah', 'Vinil', 1, '2025-06-22 14:38:20'),
(85, 'Ghost – Meliora', 'Vinil ilustrado de edição especial do álbum mais atmosférico do Ghost.', 189.00, 5, 0, 'assets/img/produtos/vinil/produto_68584033797d8.jpg', 2, 'Ghost', 'Vinil', 1, '2025-06-22 14:41:07'),
(86, 'Linkin Park – Hybrid Theory', 'Edição de 20 anos em vinil duplo com faixas raras e pôster exclusivo.', 189.90, 7, 0, 'assets/img/produtos/vinil/produto_68584089ef03e.png', 2, 'Linkin Park', 'Vinil', 1, '2025-06-22 14:42:33'),
(87, 'Sepultura – Roots', 'Versão nacional colorida em vinil duplo do álbum que misturou metal e brasilidade.', 154.90, 6, 0, 'assets/img/produtos/vinil/produto_685840d3ecb2e.png', 2, 'Sepultura', 'Vinil', 1, '2025-06-22 14:43:47'),
(88, 'Marilyn Manson – Mechanical Animals', 'Vinil azul translúcido do disco mais ousado da carreira de Manson.', 169.90, 4, 0, 'assets/img/produtos/vinil/produto_68584128071bb.png', 2, 'Marilyn Manson', 'Vinil', 1, '2025-06-22 14:45:12'),
(89, 'Behemoth – The Satanist', 'Edição gatefold com encarte especial em vinil de alta gramatura.', 184.00, 7, 0, 'assets/img/produtos/vinil/produto_68584169da49d.png', 2, 'Behemoth', 'Vinil', 1, '2025-06-22 14:46:17'),
(90, 'Ozzy Osbourne – Blizzard of Ozz', 'Vinil reeditado com qualidade sonora superior do álbum solo de estreia de Ozzy.', 165.00, 7, 0, 'assets/img/produtos/vinil/produto_685841b2558e3.png', 2, 'Ozzy Osbourne', 'Vinil', 1, '2025-06-22 14:47:30'),
(91, 'System of a Down – Toxicity', 'Álbum aclamado da banda em vinil 180g, com encarte ilustrado.', 179.90, 10, 0, 'assets/img/produtos/vinil/produto_68584206b3374.png', 2, 'System of a Down', 'Vinil', 1, '2025-06-22 14:48:54'),
(92, 'Motörhead – Ace of Spades', 'Edição especial com capa dupla e encarte com fotos raras.', 174.90, 13, 0, 'assets/img/produtos/vinil/produto_685842633cd55.jpg', 2, 'Motörhead', 'Vinil', 1, '2025-06-22 14:50:27'),
(93, 'Nirvana – In Utero', 'Edição comemorativa com remix exclusivo e material inédito.', 199.90, 6, 0, 'assets/img/produtos/vinil/produto_6858429a711e6.jpg', 2, 'Nirvana', 'Vinil', 1, '2025-06-22 14:51:22'),
(94, 'Misfits – Collection I', 'Compilado em vinil preto com encarte cheio de arte clássica da banda.', 145.00, 3, 0, 'assets/img/produtos/vinil/produto_68584325725ba.jpg', 2, 'Misfits', 'Vinil', 1, '2025-06-22 14:53:41'),
(95, 'Black Sabbath – Paranoid', 'Picture disc em edição limitada de um dos álbuns mais importantes da história do metal.', 195.00, 5, 1, 'assets/img/produtos/vinil/produto_68584387dac73.jpg', 2, 'Black Sabbath', 'Vinil', 1, '2025-06-22 14:55:19'),
(96, 'Ghost – Prequelle (Dourado)', 'inil metálico dourado em edição limitada e numerada.', 199.90, 14, 0, 'assets/img/produtos/vinil/produto_685843c96ee07.png', 2, 'Ghost', 'Vinil', 1, '2025-06-22 14:56:25'),
(97, 'Meshuggah – Chaosphere', 'Relançamento em vinil 180g com nova masterização.', 179.00, 12, 0, 'assets/img/produtos/vinil/produto_6858440073864.jpg', 2, 'Meshuggah', 'Vinil', 1, '2025-06-22 14:57:20'),
(99, 'Justice for All: The Truth About Metallica', 'Livro sobre Metallica, trazendo histórias, bastidores e curiosidades. Essencial para fãs de rock.', 82.90, 10, 0, 'assets/img/produtos/livro/produto_685846606b092.jpg', 1, 'Metallica', 'Livro', 1, '2025-06-22 15:07:28'),
(100, 'My Plague – The Slipknot Story', 'Biografia intensa sobre a trajetória explosiva do Slipknot. Um mergulho sombrio no nu-metal.', 69.80, 10, 0, 'assets/img/produtos/livro/produto_6858469834e5b.png', 1, 'Slipknot', 'Livro', 1, '2025-06-22 15:08:24'),
(101, 'Heavier Than Heaven', 'Um relato íntimo da vida de Kurt Cobain e o impacto do Nirvana no mundo da música.', 74.90, 8, 0, 'assets/img/produtos/livro/produto_685846c461e96.jpg', 1, 'Nirvana', 'Livro', 1, '2025-06-22 15:09:08'),
(102, 'Confesso que Vivi... no Porão!', 'Autobiografia irreverente de João Gordo e os bastidores do Ratos de Porão.', 59.90, 18, 0, 'assets/img/produtos/livro/produto_685846e8cd9ac.png', 1, 'Ratos de Porão', 'Livro', 1, '2025-06-22 15:09:44'),
(103, 'Lords of Chaos', 'Explora a cena black metal extrema.', 89.90, 10, 0, 'assets/img/produtos/livro/produto_6858471c77572.jpg', 1, 'Mayhem', 'Livro', 1, '2025-06-22 15:10:36'),
(104, 'Ozzy: Eu Sou Ozzy', 'A autobiografia sem filtro do Príncipe das Trevas. Insana, hilária e lendária.', 84.90, 7, 0, 'assets/img/produtos/livro/produto_6858474303415.jpg', 1, 'Ozzy Osbourne', 'Livro', 1, '2025-06-22 15:11:15'),
(105, 'Tony Iommi: Iron Man', 'O criador do heavy metal conta tudo: do Sabbath às tragédias pessoais.', 76.30, 8, 0, 'assets/img/produtos/livro/produto_6858478c4f39e.jpg', 1, 'Black Sabbath', 'Livro', 1, '2025-06-22 15:12:28'),
(106, 'Walk This Way', 'A jornada caótica e triunfante do Aerosmith, direto das bocas dos membros.', 72.00, 8, 0, 'assets/img/produtos/livro/produto_685847be7bd04.jpg', 1, 'Aerosmith', 'Livro', 1, '2025-06-22 15:13:18'),
(107, 'Sound of the Beast', 'História do heavy metal, com destaque para Metallica, Slayer, Sepultura e mais.', 94.00, 7, 0, 'assets/img/produtos/livro/produto_685848148ddeb.jpg', 1, 'Sepultura', 'Livro', 1, '2025-06-22 15:14:44'),
(108, 'Ghost: The Satanic Pop Opera', 'Uma análise não oficial da teatralidade e sucesso do Ghost.', 69.90, 12, 0, 'assets/img/produtos/livro/produto_6858485074f43.png', 1, 'Ghost', 'Livro', 1, '2025-06-22 15:15:44'),
(109, 'Slipknot: Dysfunctional Family Portraits', 'Fotografias e depoimentos de bastidores dos mascarados de Iowa.', 79.50, 3, 0, 'assets/img/produtos/livro/produto_6858487c231f7.jpg', 1, 'Slipknot', 'Livro', 1, '2025-06-22 15:16:28'),
(110, 'The Heroin Diaries', 'Nikki Sixx abre o diário dos anos mais sombrios.', 73.90, 5, 0, 'assets/img/produtos/livro/produto_685848bf6cc05.jpg', 1, 'Mötley Crüe', 'Livro', 1, '2025-06-22 15:17:35'),
(111, 'Festa Infernal', 'Histórias do underground brasileiro com Ratos de Porão e Sepultura.', 54.90, 15, 0, 'assets/img/produtos/livro/produto_685848f382e4d.png', 1, 'Sepultura', 'Livro', 1, '2025-06-22 15:18:27'),
(112, 'The Dirt', 'A história suja do Mötley Crüe.', 84.00, 10, 0, 'assets/img/produtos/livro/produto_6858491d02110.jpg', 1, 'Mötley Crüe', 'Livro', 1, '2025-06-22 15:19:09'),
(113, 'Linkin Park: From the Inside', 'Relato visual e emocional sobre a jornada da banda e de Chester Bennington.', 66.00, 7, 0, 'assets/img/produtos/livro/produto_68584943c6d5d.png', 1, 'Linkin Park', 'Livro', 1, '2025-06-22 15:19:47'),
(114, 'Misfits: This Music Leaves Stains', 'Livro definitivo sobre o impacto do Misfits no punk e no horror rock.', 62.90, 4, 0, 'assets/img/produtos/livro/produto_68584969c952b.jpg', 1, 'Misfits', 'Livro', 1, '2025-06-22 15:20:25'),
(115, 'I Am the Warlock', 'Contos e memórias de Alice Cooper em seu alter ego teatral.', 58.00, 5, 1, 'assets/img/produtos/livro/produto_685849ae13aec.png', 1, 'Alice Cooper', 'Livro', 1, '2025-06-22 15:21:34'),
(116, 'Rage Against the Machine and the Art of Protest', 'Análise política e musical da fúria sonora do Rage Against the Machine.', 74.40, 10, 0, 'assets/img/produtos/livro/produto_685849eeeabcd.png', 1, 'Rage Against the Machine', 'Livro', 1, '2025-06-22 15:22:38'),
(117, 'Behemoth: Devil’s Conquistadors', 'Livro autorizado que destrincha a trajetória obscura da banda polonesa.', 98.00, 12, 0, 'assets/img/produtos/livro/produto_68584a4a4be09.jpg', 1, 'Behemoth', 'Livro', 1, '2025-06-22 15:24:10'),
(118, 'Black Sabbath FAQ', 'Tudo o que você sempre quis saber sobre a banda que inventou o metal.', 84.20, 9, 0, 'assets/img/produtos/livro/produto_68584a7c719a9.jpg', 1, 'Black Sabbath', 'Livro', 1, '2025-06-22 15:25:00'),
(119, 'Grunge Is Dead', 'História oral do grunge com foco em bandas como Nirvana, Alice in Chains e mais.', 74.70, 5, 4, 'assets/img/produtos/livro/produto_68584aa10ad00.jpg', 1, 'Nirvana', 'Livro', 1, '2025-06-22 15:25:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_admin`
--

CREATE TABLE `usuarios_admin` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios_admin`
--

INSERT INTO `usuarios_admin` (`id`, `nome`, `email`, `senha`, `criado_em`) VALUES
(5, 'admin', 'admin@admin.com.br', '$2y$10$jy2v6B1Ae4rivaSeG7ugIulVDMmcXQ33rUQyqSCKHBN45Htc2dDeO', '2025-06-21 16:29:02'),
(17, 'Eduardo', 'eduardo@admin.com.br', '$2y$10$p765adgaQ.qTQRIrc6OyPO0Br8hRdW6Qu0a0iMBOrhSyiKyoRywzq', '2025-06-21 18:55:52'),
(18, 'Eduardo Silva', 'eduardo.silva@admin.com.br', '$2y$10$FMjCQ60zZ/fwJRTl/2WV2uwKMi6x8KAersCoGuxHcXsPyZRtxbtd6', '2025-06-27 15:04:09');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `itens_pedido_simulado`
--
ALTER TABLE `itens_pedido_simulado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `pedidos_simulados`
--
ALTER TABLE `pedidos_simulados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `itens_pedido_simulado`
--
ALTER TABLE `itens_pedido_simulado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `pedidos_simulados`
--
ALTER TABLE `pedidos_simulados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de tabela `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `itens_pedido_simulado`
--
ALTER TABLE `itens_pedido_simulado`
  ADD CONSTRAINT `itens_pedido_simulado_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos_simulados` (`id`),
  ADD CONSTRAINT `itens_pedido_simulado_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `pedidos_simulados`
--
ALTER TABLE `pedidos_simulados`
  ADD CONSTRAINT `pedidos_simulados_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
