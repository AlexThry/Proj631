-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2023 at 05:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Proj631`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(25) NOT NULL,
  `parution_date` date DEFAULT NULL,
  `image_url` longtext NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `parution_date`, `image_url`, `description`) VALUES
(1, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', '1997-06-26', 'https://m.media-amazon.com/images/I/916DM68L6cS.jpg', 'Le jour de ses onze ans, Harry Potter, un orphelin élevé par un oncle et une tante qui le détestent, voit son existence bouleversée. Un géant vient le chercher pour l\'emmener à Poudlard, une école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l\'effroyable V., le mage dont personne n\'ose prononcer le nom.'),
(2, 'Harry Potter et la Chambre des secrets', 'J.K. Rowling', '1998-07-02', 'https://products-images.di-static.com/image/j-k-rowling-harry-potter-tome-2-harry-potter-et-la-chambre-des-secrets/9782070624539-475x500-1.jpg', 'Une rentrée fracassante en voiture volante, une étrange malédiction quis\'abat sur les élèves, cette deuxième année à l\'école des sorciers ne s\'annonce pas de tout repos ! Entre les cours de potions magiques, les matchs de Quidditch et les combats de mauvais sorts, Harry et ses amis Ron et Hermione trouveront-ils le temps de percer le mystère de la Chambre des Secrets ?'),
(3, 'Harry Potter et le Prisonnier d\'Azkaban', 'J.K. Rowling', '1999-07-08', 'https://m.media-amazon.com/images/I/91MKYJnP9FS.jpg', 'Sirius Black, le dangereux criminel qui s\'est échappé de la forteresse d\'Azkaban, recherche Harry Potter. C\'est donc sous bonne garde que l\'apprenti sorcier fait sa troisième rentrée. Au programme : des cours de divination, la fabrication d\'une potion de Ratatinage, le dressage des hippogriffes... Mais Harry est-il vraiment à l\'abri du danger qui le menace ?'),
(4, 'Harry Potter et la Coupe de feu', 'J.K. Rowling', '2000-11-16', 'https://m.media-amazon.com/images/I/A1HGdMsaqnS.jpg', 'Harry Potter a quatorze ans et entre en quatrième année à Poudlard. Une grande nouvelle attend Harry, Ron et Hermione à leur arrivée : la tenue d\'un tournoi de magie exceptionnel entre les plus célèbres écoles de sorcellerie. Déjà les délégations étrangères font leur entrée. Harry se réjouit... Trop vite. Il va se trouver plongé au coeur des événements les plus dramatiques qu\'il ait jamais eu à affronter.'),
(5, 'Harry Potter et l\'Ordre du phénix', 'J.K. Rowling', '2003-06-21', 'https://www.maisondelapresse.com/media/catalog/product/cache/666ba0261dffd6db8d54a645fdf6a3c8/9/7/9782070585212.jpg', 'À quinze ans, Harry entre en cinquième année à Poudlard, mais il n\'a jamais été si anxieux. L\'adolescence, la perspective des examens et ces étranges cauchemars... Car Celui-Dont-On-Ne-Doit-Pas-Prononcer-Le-Nom est de retour. Le ministère de la Magie semble ne pas prendre cette menace au sérieux, contrairement à Dumbledore. La résistance s\'organise alors autour de Harry qui va devoir compter sur le courage et la fidélité de ses amis de toujours...'),
(6, 'Harry Potter et le Prince de sang-mêlé', 'J.K. Rowling', '2005-07-16', 'https://m.media-amazon.com/images/I/919PsaO3JaL.jpg', 'Dans un monde de plus en plus inquiétant, Harry se prépare à retrouver Ron et Hermione. Bientôt, ce sera la rentrée à Poudlard, avec les autres étudiants de sixième année. Mais pourquoi Dumbledore vient-il en personne chercher Harry chez les Dursley ? Dans quels extraordinaires voyages au coeur de la mémoire va-t-il l\'entraîner ?'),
(7, 'Harry Potter et les Reliques de la Mort', 'J.K. Rowling', '2007-07-21', 'https://images.epagine.fr/911/9782070624911_1_75.jpg', 'Cette année, Harry a dix-sept ans et ne retourne pas à Poudlard. Avec Ron et Hermione, il se consacre à la dernière mission confiée par Dumbledore. Mais le Seigneur des Ténèbres règne en maître. Traqués, les trois fidèles amis sont contraints à la clandestinité. D\'épreuves en révélations, le courage, les choix et les sacrifices de Harry seront déterminants dans la lutte contre les forces du Mal.'),
(8, 'La Fraternité de l\'Anneau', 'J.R.R. Tolkien', '1954-07-29', 'https://static.fnac-static.com/multimedia/Images/FR/NR/fb/87/01/100347/1507-1/tsp20221022061611/Le-seigneur-des-anneaux-T1-La-fraternite-de-l-anneau.jpg', 'Dans les vertes prairies du Comté, les Hobbits, ou Demi-hommes, vivaient en paix... Jusqu\'au jour fatal où l\'un d\'entre eux, au cours de ses voyages, entra en possession de l\'Anneau Unique aux immenses pouvoirs. Pour le reconquérir, Sauron, le seigneur Sombre, va déchaîner toutes les forces du Mal. Frodo, le Porteur de l\'Anneau, Gandalf, le magicien, et leurs intrépides compagnons réussiront-ils à écarter la menace qui pèse sur la Terre du Milieu ?'),
(9, 'Les Deux Tours', 'J.R.R. Tolkien', '1954-11-11', 'https://m.media-amazon.com/images/I/418nMqhaLcL.jpg', 'La Fraternité de l’Anneau poursuit son voyage vers la Montagne du Feu où l’Anneau Unique fut forgé, et où Frodo a pour mission de le détruire. Cette quête terrible est parsemée d’embûches : Gandalf a disparu dans les Mines de la Moria et Boromir a succombé au pouvoir de l’Anneau. Frodo et Sam se sont échappés afin de poursuivre leur voyage jusqu’au cœur du Mordor. À présent, ils cheminent seuls dans la désolation qui entoure le pays de Sauron – mais c’est sans compter la mystérieuse silhouette qui les suit partout où ils vont.'),
(10, 'Le Retour du Roi', 'J.R.R. Tolkien', '1955-10-20', 'https://e-leclerc.scene7.com/is/image/gtinternet/9782267046908_1?op_sharpen=1&resmode=bilin&fmt=pjpeg&qlt=85&wid=450&fit=fit,1&hei=450', 'Alors que les armées de Sauron se rassemblent et que son ombre maléfique s’étend de plus en plus en Terre du Milieu, Hommes, Nains, Elfes et Ents unissent leurs forces pour se battre contre les Ténèbres. Gandalf, quant à lui, élabore une stratégie désespérée afin de triompher du mal. Le Mordor s’est armé, ses créatures malfaisantes se sont multipliées, la riposte se prépare. Si l’Anneau tombe entre les mains du Seigneur des Ténèbres, qui pourra l’arrêter ? Tous les espoirs reposent sur Frodo et Sam, qui peinent à atteindre la Montagne du Feu afin de détruire, une bonne fois pour toutes, l’Anneau de Sauron.'),
(11, 'Le Hobbit', 'J.R.R. Tolkien', '1937-09-21', 'https://m.media-amazon.com/images/I/71wNSrWLp-S.jpg', 'Bilbo, comme tous les hobbits, est un petit être paisible et sans histoire. Son quotidien est bouleversé un beau jour, lorsque Gandalf le magicien et treize nains barbus l’entraînent dans un voyage périlleux. C’est le début d’une grande aventure, d’une fantastique quête au trésor semée d’embûches et d’épreuves, qui mènera Bilbo jusqu’à la Montagne Solitaire gardée par le dragon Smaug…'),
(12, 'Les Misérables', 'Victor Hugo', '1862-04-04', 'https://m.media-amazon.com/images/I/51JEItnoKFL.jpg', 'Valjean, l\'ancien forçat devenu bourgeois et protecteur des faibles ; Fantine, l\'ouvrière écrasée par sa condition ; le couple Thénardier, figure du mal et de l\'opportunisme ; Marius, l\'étudiant idéaliste ; Gavroche, le gamin des rues impertinent qui meurt sur les barricades ; Javert, la fatalité imposée par la société sous les traits d\'un policier vengeur... Et, bien sûr, Cosette, l\'enfant victime. Voilà comment une oeuvre immense incarne son siècle en quelques destins exemplaires, figures devenues mythiques qui continuent de susciter une multitude d\'adaptations.'),
(13, 'Germinal', 'Emile Zola', '1885-11-28', 'https://images.epagine.fr/226/9782253004226_1_75.jpg', ' La mine, Etienne la haïssait d’avance. Une dévoreuse d’hommes, réduisant les ouvriers à l’état de machines, les crevant à la tâche pour un salaire de misère. La vie qu’il mène avec ses compagnons est indigne d’un homme. Il leur faut crier leur colère… Il faut s’unir, et faire la grève !'),
(14, 'La Parure', 'Guy de Maupassant', '1884-02-17', 'https://images.epagine.fr/227/9782290091227_1_75.jpg', 'Lorsque son mari lui annonce qu\'ils sont invités à un bal, Mathilde Loisel se désole : elle n\'a ni bijoux ni robe à porter. Une amie lui prête un collier, et Mathilde oublie, le temps d\'une soirée, sa vie morne de femme d\'employé. Mais de retour chez elle, la parure n\'est plus à son cou. Pour remplacer et rendre le collier, les Loisel contractent une dette qu\'ils mettront une vie entière à rembourser. Jusqu\'au jour où Mathilde, rendue méconnaissable par les épreuves, croise son amie qui lui fait une terrible révélation…'),
(15, 'Dune', 'Frank Herbert', '1965-06-01', 'https://m.media-amazon.com/images/I/614RBqUr5lL.jpg', 'Dans un futur lointain, l\'humanité a colonisé de nombreuses planètes, dont la désertique Arrakis, source de l\'épice, une substance aux pouvoirs surhumains. Paul Atréides, héritier de la famille régnante, doit faire face à la conspiration qui vise à lui voler son pouvoir et à contrôler cette substance.'),
(16, 'Fondation', 'Isaac Asimov', '1951-05-01', 'https://images.leslibraires.ca/books/9782070360536/front/9782070360536_large.jpg', 'Dans un futur lointain, l\'Empire galactique est sur le déclin. Le savant Hari Seldon prévoit l\'effondrement de la civilisation et met en place un plan pour préserver les connaissances humaines et permettre une renaissance plus rapide. Ce plan repose sur la Fondation, une organisation chargée de collecter et de préserver ces connaissances.');

-- --------------------------------------------------------

--
-- Table structure for table `book_in_circle`
--

CREATE TABLE `book_in_circle` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `circle_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_in_circle`
--

INSERT INTO `book_in_circle` (`id`, `circle_id`, `book_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 15),
(9, 3, 10),
(10, 3, 13),
(11, 3, 11),
(12, 4, 12),
(13, 4, 2),
(14, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `circle`
--

CREATE TABLE `circle` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image_url` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `circle`
--

INSERT INTO `circle` (`id`, `admin_id`, `title`, `description`, `image_url`) VALUES
(1, 3, 'Les fans d\'harry', 'Groupe de partage autour de l\'univers d\'harry potter.', 'https://cdn-uploads.gameblog.fr/img/news/409655_636d1f2213124.jpg?ver=1'),
(2, 3, 'Les duneux', 'On est là pour partager du contenu sur dune yes', 'https://www.realite-virtuelle.com/wp-content/uploads/2021/08/Dune-3.jpg'),
(3, 2, 'Cercle 3', 'Lorem ipsum ... ', 'data:image/jpeg;base64,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'),
(4, 1, 'Circle 42', 'Lorem ipsum ...', 'data:image/jpeg;base64,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');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `label`) VALUES
(1, 'Roman'),
(2, 'Nouvelle'),
(3, 'Science-fiction'),
(4, 'Fantasy'),
(5, 'Policier'),
(6, 'Thriller'),
(7, 'Historique'),
(8, 'Biographie'),
(9, 'Autobiographie'),
(10, 'Poésie');

-- --------------------------------------------------------

--
-- Table structure for table `has_genre`
--

CREATE TABLE `has_genre` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_book` bigint(20) NOT NULL,
  `id_genre` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `has_genre`
--

INSERT INTO `has_genre` (`id`, `id_book`, `id_genre`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 3, 4),
(4, 4, 4),
(5, 5, 4),
(6, 6, 4),
(7, 7, 4),
(8, 8, 4),
(9, 9, 4),
(10, 10, 4),
(11, 11, 4),
(12, 12, 1),
(13, 13, 1),
(14, 14, 2),
(15, 15, 3),
(16, 16, 3);

-- --------------------------------------------------------

--
-- Table structure for table `has_read`
--

CREATE TABLE `has_read` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_book` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `has_read`
--

INSERT INTO `has_read` (`id`, `id_book`, `id_user`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 8, 2),
(6, 9, 2),
(7, 10, 2),
(8, 11, 2),
(9, 12, 3),
(10, 13, 3),
(11, 14, 4),
(12, 15, 5),
(13, 16, 5),
(14, 1, 6),
(15, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parution_date` date NOT NULL,
  `content` longtext NOT NULL,
  `score` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_book` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `parution_date`, `content`, `score`, `id_user`, `id_book`) VALUES
(1, '2023-05-05', 'Super livre !', 5, 1, 1),
(2, '2023-05-05', 'J\'ai adoré ! À lire absolument...', 5, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `password` varchar(256) NOT NULL,
  `creation_date` date NOT NULL,
  `profile_url` longtext DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `creation_date`, `profile_url`, `first_name`, `last_name`, `email`) VALUES
(1, 'Alexis', '63a9f0ea7bb98050796b649e85481845', '2023-05-01', '', '', '', ''),
(2, 'Carlyne', '63a9f0ea7bb98050796b649e85481845', '2023-05-05', '', '', '', ''),
(3, 'Arnaud', '63a9f0ea7bb98050796b649e85481845', '2023-04-26', 'https://avatars.githubusercontent.com/u/96651063?v=4', 'Arnaud', 'Pfundstein', 'contact@gmail.com'),
(4, 'Arthur', '63a9f0ea7bb98050796b649e85481845', '2023-05-03', '', '', '', ''),
(5, 'Hugo', '63a9f0ea7bb98050796b649e85481845', '2023-05-05', '', '', '', ''),
(6, 'Adam', '63a9f0ea7bb98050796b649e85481845', '2023-04-18', '', '', '', ''),
(7, 'romain', 'd0fa06cd93335c8cae357ffe5cd1c4e9', '2023-05-07', '', '', '', ''),
(8, 'azer', 'c9acf5ec0b8b58ff87d7e8eb942c58e9', '2023-05-09', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_in_circle`
--

CREATE TABLE `user_in_circle` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `circle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_in_circle`
--

INSERT INTO `user_in_circle` (`id`, `circle_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 5),
(5, 2, 1),
(6, 3, 3),
(7, 4, 1),
(8, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `wants_to_read`
--

CREATE TABLE `wants_to_read` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_book` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wants_to_read`
--

INSERT INTO `wants_to_read` (`id`, `id_book`, `id_user`) VALUES
(3, 5, 1),
(4, 6, 1),
(5, 7, 1),
(6, 15, 1),
(7, 15, 3),
(8, 16, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `book_in_circle`
--
ALTER TABLE `book_in_circle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `circle`
--
ALTER TABLE `circle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `has_genre`
--
ALTER TABLE `has_genre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `has_read`
--
ALTER TABLE `has_read`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_in_circle`
--
ALTER TABLE `user_in_circle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wants_to_read`
--
ALTER TABLE `wants_to_read`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `book_in_circle`
--
ALTER TABLE `book_in_circle`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `circle`
--
ALTER TABLE `circle`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `has_genre`
--
ALTER TABLE `has_genre`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `has_read`
--
ALTER TABLE `has_read`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_in_circle`
--
ALTER TABLE `user_in_circle`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wants_to_read`
--
ALTER TABLE `wants_to_read`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
