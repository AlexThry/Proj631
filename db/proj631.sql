-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 19 mai 2023 à 16:14
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Proj631`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(25) NOT NULL,
  `parution_date` date DEFAULT NULL,
  `image_url` longtext NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `parution_date`, `image_url`, `description`) VALUES
(1, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', '1997-06-26', 'https://m.media-amazon.com/images/I/916DM68L6cS.jpg', 'Le jour de ses onze ans, Harry Potter, un orphelin élevé par un oncle et une tante qui le détestent, voit son existence bouleversée. Un géant vient le chercher pour l\'emmener à Poudlard, une école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l\'effroyable V., le mage dont personne n\'ose prononcer le nom.'),
(2, 'Harry Potter et la Chambre des secrets', 'J.K. Rowling', '1998-07-02', 'https://products-images.di-static.com/image/j-k-rowling-harry-potter-tome-2-harry-potter-et-la-chambre-des-secrets/9782070624539-475x500-1.jpg', 'Une rentrée fracassante en voiture volante, une étrange malédiction quis\'abat sur les élèves, cette deuxième année à l\'école des sorciers ne s\'annonce pas de tout repos ! Entre les cours de potions magiques, les matchs de Quidditch et les combats de mauvais sorts, Harry et ses amis Ron et Hermione trouveront-ils le temps de percer le mystère de la Chambre des Secrets ?'),
(3, 'Harry Potter et le Prisonnier d\'Azkaban', 'J.K. Rowling', '1999-07-08', 'https://m.media-amazon.com/images/I/91MKYJnP9FS.jpg', 'Sirius Black, le dangereux criminel qui s\'est échappé de la forteresse d\'Azkaban, recherche Harry Potter. C\'est donc sous bonne garde que l\'apprenti sorcier fait sa troisième rentrée. Au programme : des cours de divination, la fabrication d\'une potion de Ratatinage, le dressage des hippogriffes... Mais Harry est-il vraiment à l\'abri du danger qui le menace ?'),
(4, 'Harry Potter et la Coupe de feu', 'J.K. Rowling', '2000-11-16', 'https://m.media-amazon.com/images/I/A1HGdMsaqnS.jpg', 'Harry Potter a quatorze ans et entre en quatrième année à Poudlard. Une grande nouvelle attend Harry, Ron et Hermione à leur arrivée : la tenue d\'un tournoi de magie exceptionnel entre les plus célèbres écoles de sorcellerie. Déjà les délégations étrangères font leur entrée. Harry se réjouit... Trop vite. Il va se trouver plongé au coeur des événements les plus dramatiques qu\'il ait jamais eu à affronter.'),
(5, 'Harry Potter et l\'Ordre du phénix', 'J.K. Rowling', '2003-06-21', 'https://products-images.di-static.com/image/j-k-rowling-harry-potter-tome-5-harry-potter-et-l-ordre-du-phenix/9782070624560-475x500-2.webp', 'À quinze ans, Harry entre en cinquième année à Poudlard, mais il n\'a jamais été si anxieux. L\'adolescence, la perspective des examens et ces étranges cauchemars... Car Celui-Dont-On-Ne-Doit-Pas-Prononcer-Le-Nom est de retour. Le ministère de la Magie semble ne pas prendre cette menace au sérieux, contrairement à Dumbledore. La résistance s\'organise alors autour de Harry qui va devoir compter sur le courage et la fidélité de ses amis de toujours...'),
(6, 'Harry Potter et le Prince de sang-mêlé', 'J.K. Rowling', '2005-07-16', 'https://m.media-amazon.com/images/I/919PsaO3JaL.jpg', 'Dans un monde de plus en plus inquiétant, Harry se prépare à retrouver Ron et Hermione. Bientôt, ce sera la rentrée à Poudlard, avec les autres étudiants de sixième année. Mais pourquoi Dumbledore vient-il en personne chercher Harry chez les Dursley ? Dans quels extraordinaires voyages au coeur de la mémoire va-t-il l\'entraîner ?'),
(7, 'Harry Potter et les Reliques de la Mort', 'J.K. Rowling', '2007-07-21', 'https://images.epagine.fr/911/9782070624911_1_75.jpg', 'Cette année, Harry a dix-sept ans et ne retourne pas à Poudlard. Avec Ron et Hermione, il se consacre à la dernière mission confiée par Dumbledore. Mais le Seigneur des Ténèbres règne en maître. Traqués, les trois fidèles amis sont contraints à la clandestinité. D\'épreuves en révélations, le courage, les choix et les sacrifices de Harry seront déterminants dans la lutte contre les forces du Mal.'),
(8, 'La Fraternité de l\'Anneau', 'J.R.R. Tolkien', '1954-07-29', 'https://static.fnac-static.com/multimedia/Images/FR/NR/fb/87/01/100347/1507-1/tsp20221022061611/Le-seigneur-des-anneaux-T1-La-fraternite-de-l-anneau.jpg', 'Dans les vertes prairies du Comté, les Hobbits, ou Demi-hommes, vivaient en paix... Jusqu\'au jour fatal où l\'un d\'entre eux, au cours de ses voyages, entra en possession de l\'Anneau Unique aux immenses pouvoirs. Pour le reconquérir, Sauron, le seigneur Sombre, va déchaîner toutes les forces du Mal. Frodo, le Porteur de l\'Anneau, Gandalf, le magicien, et leurs intrépides compagnons réussiront-ils à écarter la menace qui pèse sur la Terre du Milieu ?'),
(9, 'Les Deux Tours', 'J.R.R. Tolkien', '1954-11-11', 'https://m.media-amazon.com/images/I/418nMqhaLcL.jpg', 'La Fraternité de l’Anneau poursuit son voyage vers la Montagne du Feu où l’Anneau Unique fut forgé, et où Frodo a pour mission de le détruire. Cette quête terrible est parsemée d’embûches : Gandalf a disparu dans les Mines de la Moria et Boromir a succombé au pouvoir de l’Anneau. Frodo et Sam se sont échappés afin de poursuivre leur voyage jusqu’au cœur du Mordor. À présent, ils cheminent seuls dans la désolation qui entoure le pays de Sauron – mais c’est sans compter la mystérieuse silhouette qui les suit partout où ils vont.'),
(10, 'Le Retour du Roi', 'J.R.R. Tolkien', '1955-10-20', 'https://www.antretemps.com/upload/image/le-seigneur-des-anneaux-t3-le-retour-du-roi-p-image-40292-grande.jpg', 'Alors que les armées de Sauron se rassemblent et que son ombre maléfique s’étend de plus en plus en Terre du Milieu, Hommes, Nains, Elfes et Ents unissent leurs forces pour se battre contre les Ténèbres. Gandalf, quant à lui, élabore une stratégie désespérée afin de triompher du mal. Le Mordor s’est armé, ses créatures malfaisantes se sont multipliées, la riposte se prépare. Si l’Anneau tombe entre les mains du Seigneur des Ténèbres, qui pourra l’arrêter ? Tous les espoirs reposent sur Frodo et Sam, qui peinent à atteindre la Montagne du Feu afin de détruire, une bonne fois pour toutes, l’Anneau de Sauron.'),
(11, 'Le Hobbit', 'J.R.R. Tolkien', '1937-09-21', 'https://m.media-amazon.com/images/I/71wNSrWLp-S.jpg', 'Bilbo, comme tous les hobbits, est un petit être paisible et sans histoire. Son quotidien est bouleversé un beau jour, lorsque Gandalf le magicien et treize nains barbus l’entraînent dans un voyage périlleux. C’est le début d’une grande aventure, d’une fantastique quête au trésor semée d’embûches et d’épreuves, qui mènera Bilbo jusqu’à la Montagne Solitaire gardée par le dragon Smaug…'),
(12, 'Les Misérables', 'Victor Hugo', '1862-04-04', 'https://m.media-amazon.com/images/I/51JEItnoKFL.jpg', 'Valjean, l\'ancien forçat devenu bourgeois et protecteur des faibles ; Fantine, l\'ouvrière écrasée par sa condition ; le couple Thénardier, figure du mal et de l\'opportunisme ; Marius, l\'étudiant idéaliste ; Gavroche, le gamin des rues impertinent qui meurt sur les barricades ; Javert, la fatalité imposée par la société sous les traits d\'un policier vengeur... Et, bien sûr, Cosette, l\'enfant victime. Voilà comment une oeuvre immense incarne son siècle en quelques destins exemplaires, figures devenues mythiques qui continuent de susciter une multitude d\'adaptations.'),
(13, 'Germinal', 'Emile Zola', '1885-11-28', 'https://images.epagine.fr/226/9782253004226_1_75.jpg', ' La mine, Etienne la haïssait d’avance. Une dévoreuse d’hommes, réduisant les ouvriers à l’état de machines, les crevant à la tâche pour un salaire de misère. La vie qu’il mène avec ses compagnons est indigne d’un homme. Il leur faut crier leur colère… Il faut s’unir, et faire la grève !'),
(14, 'La Parure', 'Guy de Maupassant', '1884-02-17', 'https://images.epagine.fr/227/9782290091227_1_75.jpg', 'Lorsque son mari lui annonce qu\'ils sont invités à un bal, Mathilde Loisel se désole : elle n\'a ni bijoux ni robe à porter. Une amie lui prête un collier, et Mathilde oublie, le temps d\'une soirée, sa vie morne de femme d\'employé. Mais de retour chez elle, la parure n\'est plus à son cou. Pour remplacer et rendre le collier, les Loisel contractent une dette qu\'ils mettront une vie entière à rembourser. Jusqu\'au jour où Mathilde, rendue méconnaissable par les épreuves, croise son amie qui lui fait une terrible révélation…'),
(15, 'Dune', 'Frank Herbert', '1965-06-01', 'https://m.media-amazon.com/images/I/614RBqUr5lL.jpg', 'Dans un futur lointain, l\'humanité a colonisé de nombreuses planètes, dont la désertique Arrakis, source de l\'épice, une substance aux pouvoirs surhumains. Paul Atréides, héritier de la famille régnante, doit faire face à la conspiration qui vise à lui voler son pouvoir et à contrôler cette substance.'),
(16, 'Fondation', 'Isaac Asimov', '1951-05-01', 'https://images.leslibraires.ca/books/9782070360536/front/9782070360536_large.jpg', 'Dans un futur lointain, l\'Empire galactique est sur le déclin. Le savant Hari Seldon prévoit l\'effondrement de la civilisation et met en place un plan pour préserver les connaissances humaines et permettre une renaissance plus rapide. Ce plan repose sur la Fondation, une organisation chargée de collecter et de préserver ces connaissances.');

-- --------------------------------------------------------

--
-- Structure de la table `book_in_circle`
--

CREATE TABLE `book_in_circle` (
  `circle_id` bigint(11) UNSIGNED NOT NULL,
  `book_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book_in_circle`
--

INSERT INTO `book_in_circle` (`circle_id`, `book_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 15),
(3, 10),
(3, 11),
(3, 13),
(4, 2),
(4, 9),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 9),
(5, 10),
(5, 11);

-- --------------------------------------------------------

--
-- Structure de la table `circle`
--

CREATE TABLE `circle` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image_url` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `circle`
--

INSERT INTO `circle` (`id`, `admin_id`, `title`, `description`, `image_url`) VALUES
(1, 3, 'Les fans d\'harry', 'Un cercle dédié aux passionnés de l\'univers magique d\'Harry Potter. Rejoignez-nous pour discuter des livres, des films, partager des théories et vivre la magie ensemble.', 'https://cdn-uploads.gameblog.fr/img/news/409655_636d1f2213124.jpg?ver=1'),
(2, 3, 'Les duneux', 'Rejoignez notre cercle dédié à l\'univers fascinant de Dune. Que vous soyez fans des livres de Frank Herbert ou du récent film, venez discuter des intrigues complexes, des personnages captivants et des thèmes philosophiques qui font de Dune une œuvre incontournable de la science-fiction. Plongez dans l\'univers des fremens, des maisons nobles et de l\'Épice, et partagez votre passion pour ce chef-d\'œuvre de l\'imagination.', 'https://www.realite-virtuelle.com/wp-content/uploads/2021/08/Dune-3.jpg'),
(3, 2, 'Cercle 3', 'Lorem ipsum ... ', 'https://www.referenseo.com/wp-content/uploads/2019/03/image-attractive-960x540.jpg'),
(4, 1, 'Circle 42', 'Lorem ipsum ...', 'data:image/jpeg;base64,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'),
(5, 5, 'RP community', 'La communauté du Roleplaying se retrouve ! Château, Dongeons (et Dragons <3), ici, on passe un bon moment, avec une commu\' qui respecte et qui s\'amuse !', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.jeuxvideo.com%2Fnews%2F1093561%2Fbillet-le-roleplay-est-aussi-la-ou-on-ne-l-attend-pas.htm&psig=AOvVaw2oylnIGGVh8miw1Pg3cLrf&ust=1684075574839000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCID7-MXE8v4CFQAAAAAdAAAAABAE');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `genre`
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
-- Structure de la table `has_genre`
--

CREATE TABLE `has_genre` (
  `id_book` bigint(20) UNSIGNED NOT NULL,
  `id_genre` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `has_genre`
--

INSERT INTO `has_genre` (`id_book`, `id_genre`) VALUES
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 1),
(13, 1),
(14, 2),
(15, 3),
(16, 3);

-- --------------------------------------------------------

--
-- Structure de la table `has_read`
--

CREATE TABLE `has_read` (
  `id_book` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `has_read`
--

INSERT INTO `has_read` (`id_book`, `id_user`) VALUES
(1, 1),
(1, 6),
(2, 1),
(2, 6),
(3, 1),
(4, 1),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(13, 3),
(14, 4),
(16, 5);

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE `review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parution_date` date NOT NULL,
  `content` longtext NOT NULL,
  `score` int(11) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_book` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id`, `parution_date`, `content`, `score`, `id_user`, `id_book`) VALUES
(1, '2023-05-05', 'Super livre !', 5, 1, 1),
(2, '2023-05-05', 'J\'ai adoré ! À lire absolument...', 5, 2, 8),
(3, '2023-05-16', 'Ok tier le livre', 2, 5, 3),
(4, '2023-05-16', 'Ok moyen le livre', 3, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user`
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
-- Structure de la table `user_in_circle`
--

CREATE TABLE `user_in_circle` (
  `circle_id` bigint(11) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_in_circle`
--

INSERT INTO `user_in_circle` (`circle_id`, `user_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 5),
(2, 1),
(3, 3),
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `wants_to_read`
--

CREATE TABLE `wants_to_read` (
  `id_book` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `wants_to_read`
--

INSERT INTO `wants_to_read` (`id_book`, `id_user`) VALUES
(5, 1),
(6, 1),
(7, 1),
(9, 5),
(15, 1),
(15, 3),
(15, 5),
(16, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `book_in_circle`
--
ALTER TABLE `book_in_circle`
  ADD PRIMARY KEY (`circle_id`,`book_id`),
  ADD KEY `fk_book_id` (`book_id`);

--
-- Index pour la table `circle`
--
ALTER TABLE `circle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `has_genre`
--
ALTER TABLE `has_genre`
  ADD PRIMARY KEY (`id_book`,`id_genre`),
  ADD KEY `fk_genre` (`id_genre`);

--
-- Index pour la table `has_read`
--
ALTER TABLE `has_read`
  ADD PRIMARY KEY (`id_book`,`id_user`),
  ADD KEY `fk_read_genre_id` (`id_user`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_review_user_id` (`id_user`),
  ADD KEY `fk_review_book_id` (`id_book`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Index pour la table `user_in_circle`
--
ALTER TABLE `user_in_circle`
  ADD PRIMARY KEY (`circle_id`,`user_id`),
  ADD KEY `fk_circle_user_id` (`user_id`);

--
-- Index pour la table `wants_to_read`
--
ALTER TABLE `wants_to_read`
  ADD PRIMARY KEY (`id_book`,`id_user`),
  ADD KEY `fk_read_user_id` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `circle`
--
ALTER TABLE `circle`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book_in_circle`
--
ALTER TABLE `book_in_circle`
  ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `fk_circle_id` FOREIGN KEY (`circle_id`) REFERENCES `circle` (`id`);

--
-- Contraintes pour la table `has_genre`
--
ALTER TABLE `has_genre`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`id_book`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `fk_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id`);

--
-- Contraintes pour la table `has_read`
--
ALTER TABLE `has_read`
  ADD CONSTRAINT `fk_read_book_id` FOREIGN KEY (`id_book`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `fk_read_genre_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_book_id` FOREIGN KEY (`id_book`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `fk_review_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_in_circle`
--
ALTER TABLE `user_in_circle`
  ADD CONSTRAINT `fk_circle_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_user_in_circle_id` FOREIGN KEY (`circle_id`) REFERENCES `circle` (`id`);

--
-- Contraintes pour la table `wants_to_read`
--
ALTER TABLE `wants_to_read`
  ADD CONSTRAINT `fk_read_book` FOREIGN KEY (`id_book`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `fk_read_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
