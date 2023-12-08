-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Dez-2023 às 17:21
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud_biblio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id_emp` int(11) NOT NULL,
  `id_livro` varchar(255) NOT NULL,
  `nome_livro` varchar(255) NOT NULL,
  `nome_user` varchar(255) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero_book`
--

CREATE TABLE `genero_book` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `genero_book`
--

INSERT INTO `genero_book` (`id`, `nome`) VALUES
(1, 'Terror'),
(2, 'Ficção Científica'),
(3, 'Fantasia'),
(4, 'Romance');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id_historico` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `nome_livro` varchar(255) NOT NULL,
  `nome_user` varchar(255) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`id_historico`, `id_emp`, `id_livro`, `nome_livro`, `nome_user`, `hora`) VALUES
(0, 2, 52, 'Jackson Perkson', 'leo', '2023-12-08 13:14:42'),
(0, 1, 50, 'banana', 'leo', '2023-12-08 13:14:47'),
(0, 3, 52, 'Jackson Perkson', 'leo', '2023-12-08 13:14:53'),
(0, 4, 50, 'banana', 'leo', '2023-12-08 13:35:52'),
(0, 5, 50, 'banana', 'leo', '2023-12-08 13:35:56'),
(0, 6, 53, 'Harry Potter', 'leo', '2023-12-08 13:35:59'),
(0, 7, 55, 'cadê você bernadete', 'leo', '2023-12-08 15:50:07'),
(0, 8, 55, 'cadê você bernadete', 'leo', '2023-12-08 15:50:11'),
(0, 9, 55, 'cadê você bernadete', 'leo', '2023-12-08 15:50:14'),
(0, 10, 55, 'cadê você bernadete', 'leo', '2023-12-08 15:50:17'),
(0, 11, 55, 'cadê você bernadete', 'leo', '2023-12-08 15:50:19'),
(0, 12, 56, 'narnia', 'leo', '2023-12-08 15:50:59'),
(0, 13, 56, 'narnia', 'leo', '2023-12-08 15:51:09'),
(0, 14, 55, 'cadê você bernadete', 'Harry Potter2', '2023-12-08 16:09:08'),
(0, 15, 56, 'narnia', 'Harry Potter2', '2023-12-08 16:09:20'),
(0, 16, 56, 'narnia', 'Harry Potter2', '2023-12-08 16:09:23'),
(0, 17, 56, 'narnia', 'Harry Potter2', '2023-12-08 16:13:25'),
(0, 18, 56, 'narnia', 'Harry Potter2', '2023-12-08 16:13:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id_livro` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `qnt` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id_livro`, `nome`, `genero`, `qnt`, `autor`, `imagem`, `id_genero`) VALUES
(55, 'cadê você bernadete', 'fantasia', '5', 'Maria Semple', 'uploads/download.jpg', 3),
(56, 'narnia', 'fantasia', '2', 'c.s lewis', 'uploads/download (1).jpg', 3),
(57, 'Cinderela esta morta', 'fantasia', '1', 'kalynn bayron', 'uploads/51Xtmov8zdS.jpg', 3),
(58, 'o paciente', 'terror', '5', 'jasper', 'uploads/download (2).jpg', 1),
(59, 'a casa assombrada', 'terror', '9', 'edth', 'uploads/09ad33f05c.webp', 1),
(60, 'cemitério maldito', 'terror', '6', 'stephen', 'uploads/download (3).jpg', 1),
(61, 'maquina do tempo', 'ficçao cientifica', '5', 'h g wells', 'uploads/772d89c2bf52fe4ca4c0bd82a5ee1f1a.jpg', 2),
(62, 'no rastro da terra ', 'ficção cientifica', '5', 'wallac', 'uploads/418R7JPornL.jpg', 2),
(63, 'a guerra dos mundos', 'ficção cientifica', '1', 'h.g wells', 'uploads/a-guerra-dos-mundos-hg-wells.jpg', 2),
(64, 'como eu era antes de voce', 'romance', '5', 'jojo moyes', 'uploads/como-eu-era-antes-de-voce-livro-cke.webp', 4),
(65, 'a hipotese do amor', 'romance', '4', 'ali hazelwood', 'uploads/81LTEfXYgcL.jpg', 4),
(66, 'um romance nada inesperado', 'romance', '6', 'meghan', 'uploads/um_romance_nada_inesperado_457_1_feb5d7b8f3300488e97cf3282bd33110.webp', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `alvl` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `alvl`) VALUES
(9, 'leo', 'leo@gmail.com', '1411', 1),
(10, 'Fernanda Rogério da Silveira Gomes', 'fer2010gomes@gmail.com', '1310', 0),
(13, 'Harry Potter', 'harry@gmail.com', '123', 0),
(14, 'Harry Potter2', 'harry2@gmail.com', '12345', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id_emp`);

--
-- Índices para tabela `genero_book`
--
ALTER TABLE `genero_book`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id_livro`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id_emp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `genero_book`
--
ALTER TABLE `genero_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
