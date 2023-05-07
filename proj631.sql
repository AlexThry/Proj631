-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2023 at 04:18 PM
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
  `title` varchar(150) NOT NULL,
  `author` varchar(25) NOT NULL,
  `parution_date` date DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` longtext NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`title`, `author`, `parution_date`, `id`, `link`, `description`) VALUES
('Harry Potter à l\'école des sorciers', 'J.K. Rowling', '1997-06-26', 1, 'https://m.media-amazon.com/images/I/916DM68L6cS.jpg', 'Le jour de ses onze ans, Harry Potter, un orphelin élevé par un oncle et une tante qui le détestent, voit son existence bouleversée. Un géant vient le chercher pour l\'emmener à Poudlard, une école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l\'effroyable V., le mage dont personne n\'ose prononcer le nom.'),
('Harry Potter et la Chambre des secrets', 'J.K. Rowling', '1998-07-02', 2, 'https://products-images.di-static.com/image/j-k-rowling-harry-potter-tome-2-harry-potter-et-la-chambre-des-secrets/9782070624539-475x500-1.jpg', 'Une rentrée fracassante en voiture volante, une étrange malédiction quis\'abat sur les élèves, cette deuxième année à l\'école des sorciers ne s\'annonce pas de tout repos ! Entre les cours de potions magiques, les matchs de Quidditch et les combats de mauvais sorts, Harry et ses amis Ron et Hermione trouveront-ils le temps de percer le mystère de la Chambre des Secrets ?'),
('Harry Potter et le Prisonnier d\'Azkaban', 'J.K. Rowling', '1999-07-08', 3, 'https://m.media-amazon.com/images/I/91MKYJnP9FS.jpg', 'Sirius Black, le dangereux criminel qui s\'est échappé de la forteresse d\'Azkaban, recherche Harry Potter. C\'est donc sous bonne garde que l\'apprenti sorcier fait sa troisième rentrée. Au programme : des cours de divination, la fabrication d\'une potion de Ratatinage, le dressage des hippogriffes... Mais Harry est-il vraiment à l\'abri du danger qui le menace ?'),
('Harry Potter et la Coupe de feu', 'J.K. Rowling', '2000-11-16', 4, 'https://m.media-amazon.com/images/I/A1HGdMsaqnS.jpg', 'Harry Potter a quatorze ans et entre en quatrième année à Poudlard. Une grande nouvelle attend Harry, Ron et Hermione à leur arrivée : la tenue d\'un tournoi de magie exceptionnel entre les plus célèbres écoles de sorcellerie. Déjà les délégations étrangères font leur entrée. Harry se réjouit... Trop vite. Il va se trouver plongé au coeur des événements les plus dramatiques qu\'il ait jamais eu à affronter.'),
('Harry Potter et l\'Ordre du phénix', 'J.K. Rowling', '2003-06-21', 5, 'https://www.maisondelapresse.com/media/catalog/product/cache/666ba0261dffd6db8d54a645fdf6a3c8/9/7/9782070585212.jpg', 'À quinze ans, Harry entre en cinquième année à Poudlard, mais il n\'a jamais été si anxieux. L\'adolescence, la perspective des examens et ces étranges cauchemars... Car Celui-Dont-On-Ne-Doit-Pas-Prononcer-Le-Nom est de retour. Le ministère de la Magie semble ne pas prendre cette menace au sérieux, contrairement à Dumbledore. La résistance s\'organise alors autour de Harry qui va devoir compter sur le courage et la fidélité de ses amis de toujours...'),
('Harry Potter et le Prince de sang-mêlé', 'J.K. Rowling', '2005-07-16', 6, 'https://m.media-amazon.com/images/I/919PsaO3JaL.jpg', 'Dans un monde de plus en plus inquiétant, Harry se prépare à retrouver Ron et Hermione. Bientôt, ce sera la rentrée à Poudlard, avec les autres étudiants de sixième année. Mais pourquoi Dumbledore vient-il en personne chercher Harry chez les Dursley ? Dans quels extraordinaires voyages au coeur de la mémoire va-t-il l\'entraîner ?'),
('Harry Potter et les Reliques de la Mort', 'J.K. Rowling', '2007-07-21', 7, 'https://images.epagine.fr/911/9782070624911_1_75.jpg', 'Cette année, Harry a dix-sept ans et ne retourne pas à Poudlard. Avec Ron et Hermione, il se consacre à la dernière mission confiée par Dumbledore. Mais le Seigneur des Ténèbres règne en maître. Traqués, les trois fidèles amis sont contraints à la clandestinité. D\'épreuves en révélations, le courage, les choix et les sacrifices de Harry seront déterminants dans la lutte contre les forces du Mal.'),
('La Fraternité de l\'Anneau', 'J.R.R. Tolkien', '1954-07-29', 8, 'https://static.fnac-static.com/multimedia/Images/FR/NR/fb/87/01/100347/1507-1/tsp20221022061611/Le-seigneur-des-anneaux-T1-La-fraternite-de-l-anneau.jpg', 'Dans les vertes prairies du Comté, les Hobbits, ou Demi-hommes, vivaient en paix... Jusqu\'au jour fatal où l\'un d\'entre eux, au cours de ses voyages, entra en possession de l\'Anneau Unique aux immenses pouvoirs. Pour le reconquérir, Sauron, le seigneur Sombre, va déchaîner toutes les forces du Mal. Frodo, le Porteur de l\'Anneau, Gandalf, le magicien, et leurs intrépides compagnons réussiront-ils à écarter la menace qui pèse sur la Terre du Milieu ?'),
('Les Deux Tours', 'J.R.R. Tolkien', '1954-11-11', 9, 'https://m.media-amazon.com/images/I/418nMqhaLcL.jpg', 'La Fraternité de l’Anneau poursuit son voyage vers la Montagne du Feu où l’Anneau Unique fut forgé, et où Frodo a pour mission de le détruire. Cette quête terrible est parsemée d’embûches : Gandalf a disparu dans les Mines de la Moria et Boromir a succombé au pouvoir de l’Anneau. Frodo et Sam se sont échappés afin de poursuivre leur voyage jusqu’au cœur du Mordor. À présent, ils cheminent seuls dans la désolation qui entoure le pays de Sauron – mais c’est sans compter la mystérieuse silhouette qui les suit partout où ils vont.'),
('Le Retour du Roi', 'J.R.R. Tolkien', '1955-10-20', 10, 'https://e-leclerc.scene7.com/is/image/gtinternet/9782267046908_1?op_sharpen=1&resmode=bilin&fmt=pjpeg&qlt=85&wid=450&fit=fit,1&hei=450', 'Alors que les armées de Sauron se rassemblent et que son ombre maléfique s’étend de plus en plus en Terre du Milieu, Hommes, Nains, Elfes et Ents unissent leurs forces pour se battre contre les Ténèbres. Gandalf, quant à lui, élabore une stratégie désespérée afin de triompher du mal. Le Mordor s’est armé, ses créatures malfaisantes se sont multipliées, la riposte se prépare. Si l’Anneau tombe entre les mains du Seigneur des Ténèbres, qui pourra l’arrêter ? Tous les espoirs reposent sur Frodo et Sam, qui peinent à atteindre la Montagne du Feu afin de détruire, une bonne fois pour toutes, l’Anneau de Sauron.'),
('Le Hobbit', 'J.R.R. Tolkien', '1937-09-21', 11, 'https://m.media-amazon.com/images/I/71wNSrWLp-S.jpg', 'Bilbo, comme tous les hobbits, est un petit être paisible et sans histoire. Son quotidien est bouleversé un beau jour, lorsque Gandalf le magicien et treize nains barbus l’entraînent dans un voyage périlleux. C’est le début d’une grande aventure, d’une fantastique quête au trésor semée d’embûches et d’épreuves, qui mènera Bilbo jusqu’à la Montagne Solitaire gardée par le dragon Smaug…'),
('Les Misérables', 'Victor Hugo', '1862-04-04', 12, 'https://m.media-amazon.com/images/I/51JEItnoKFL.jpg', 'Valjean, l\'ancien forçat devenu bourgeois et protecteur des faibles ; Fantine, l\'ouvrière écrasée par sa condition ; le couple Thénardier, figure du mal et de l\'opportunisme ; Marius, l\'étudiant idéaliste ; Gavroche, le gamin des rues impertinent qui meurt sur les barricades ; Javert, la fatalité imposée par la société sous les traits d\'un policier vengeur... Et, bien sûr, Cosette, l\'enfant victime. Voilà comment une oeuvre immense incarne son siècle en quelques destins exemplaires, figures devenues mythiques qui continuent de susciter une multitude d\'adaptations.'),
('Germinal', 'Emile Zola', '1885-11-28', 13, 'https://images.epagine.fr/226/9782253004226_1_75.jpg', ' La mine, Etienne la haïssait d’avance. Une dévoreuse d’hommes, réduisant les ouvriers à l’état de machines, les crevant à la tâche pour un salaire de misère. La vie qu’il mène avec ses compagnons est indigne d’un homme. Il leur faut crier leur colère… Il faut s’unir, et faire la grève !'),
('La Parure', 'Guy de Maupassant', '1884-02-17', 14, 'https://images.epagine.fr/227/9782290091227_1_75.jpg', 'Lorsque son mari lui annonce qu\'ils sont invités à un bal, Mathilde Loisel se désole : elle n\'a ni bijoux ni robe à porter. Une amie lui prête un collier, et Mathilde oublie, le temps d\'une soirée, sa vie morne de femme d\'employé. Mais de retour chez elle, la parure n\'est plus à son cou. Pour remplacer et rendre le collier, les Loisel contractent une dette qu\'ils mettront une vie entière à rembourser. Jusqu\'au jour où Mathilde, rendue méconnaissable par les épreuves, croise son amie qui lui fait une terrible révélation…'),
('Dune', 'Frank Herbert', '1965-06-01', 15, 'https://m.media-amazon.com/images/I/614RBqUr5lL.jpg', 'Dans un futur lointain, l\'humanité a colonisé de nombreuses planètes, dont la désertique Arrakis, source de l\'épice, une substance aux pouvoirs surhumains. Paul Atréides, héritier de la famille régnante, doit faire face à la conspiration qui vise à lui voler son pouvoir et à contrôler cette substance.'),
('Fondation', 'Isaac Asimov', '1951-05-01', 16, 'https://images.leslibraires.ca/books/9782070360536/front/9782070360536_large.jpg', 'Dans un futur lointain, l\'Empire galactique est sur le déclin. Le savant Hari Seldon prévoit l\'effondrement de la civilisation et met en place un plan pour préserver les connaissances humaines et permettre une renaissance plus rapide. Ce plan repose sur la Fondation, une organisation chargée de collecter et de préserver ces connaissances.');

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
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `creation_date`) VALUES
(1, 'Alexis', '63a9f0ea7bb98050796b649e85481845', '2023-05-01'),
(2, 'Carlyne', '63a9f0ea7bb98050796b649e85481845', '2023-05-05'),
(3, 'Arnaud', '63a9f0ea7bb98050796b649e85481845', '2023-04-26'),
(4, 'Arthur', '63a9f0ea7bb98050796b649e85481845', '2023-05-03'),
(5, 'Hugo', '63a9f0ea7bb98050796b649e85481845', '2023-05-05'),
(6, 'Adam', '63a9f0ea7bb98050796b649e85481845', '2023-04-18');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wants_to_read`
--
ALTER TABLE `wants_to_read`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
