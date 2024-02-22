-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 16, 2024 alle 20:41
-- Versione del server: 5.7.44-48-log
-- Versione PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dboxfiaapnbn3h`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `ID` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Cognome` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` char(255) DEFAULT NULL,
  `Cell` varchar(100) DEFAULT NULL,
  `Bannato` tinyint(1) DEFAULT NULL,
  `DataFineBan` datetime DEFAULT NULL,
  `UltimaVoltaOnline` datetime DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`ID`, `username`, `Nome`, `Cognome`, `Email`, `Password`, `Cell`, `Bannato`, `DataFineBan`, `UltimaVoltaOnline`, `img`) VALUES
(1, 'ireilly', 'David', 'Williams', 'westtimothy@roth.com', '6e90d5e6934dfbc28d23e0511b66388189ea241b851e276ffd6565e6bdb23bd6', '895-826-5188x82226', 1, '2021-10-10 19:41:39', '2023-06-14 04:28:45', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(2, 'johnmorgan', 'Sheri', 'Lee', 'pmora@gmail.com', 'f14e58654328538c4574eedc529b9f7765ba756c2ef7a7b0f7cfefbbfbe35f1f', '(415)039-5469x555', 0, '2022-12-02 00:59:43', '2020-02-24 07:43:59', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(3, 'jose14', 'Michele', 'White', 'hroberts@gmail.com', 'fa439a03c1b9690c68e3ef231c098b863a39063eea5187aed0241d14b75613c8', '001-523-020-7478', 0, '2023-05-15 00:41:40', '2022-07-25 22:14:57', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(4, 'julie95', 'Nancy', 'Davis', 'astevens@gmail.com', 'cedf84126a7524426ef4df69e88bd749e952cda56ac9523e261fdc6d7e7402b8', '829-619-6923', 0, '2021-04-09 18:55:00', '2022-01-08 03:07:41', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(5, 'susan91', 'Charles', 'Lane', 'smithroger@yahoo.com', 'd79cf49af4f132e270ba1785afd5f4410662b8b651ea8592603de76874ac5163', '+1-387-735-0489x6302', 0, NULL, '2023-06-16 05:02:11', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(6, 'robertwalker', 'Nicole', 'Burns', 'kristen17@ellis.com', '6b6eeadf2c00289078eb0e0681012b968ad5af55f70c6762cf9b5cdf59a9febd', '7782063867', 1, '2021-09-02 00:05:26', '2021-09-08 12:14:38', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(7, 'danderson', 'Kevin', 'Massey', 'hmiller@gmail.com', 'e1ab26ce1e2744b75f2734d3dab8422f79f70521adda671d38f1e662d8512a87', '104.754.1305x58844', 0, '2021-03-25 07:20:32', '2020-07-26 13:16:02', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(8, 'hjones', 'Jeffrey', 'Murray', 'gregory27@lewis.com', 'a7f0e1b1d9a25945022c11df667a7af55611d68084b15efc6b46455922464538', '507.697.9352', 0, '2022-08-14 01:05:05', '2021-12-27 06:13:13', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(9, 'michael55', 'Sherry', 'Arnold', 'oconnornicole@hotmail.com', '5610681b77b14a90f3cfca1372b2e7925d847aaa93b6ca1d8feda2dca1e680bf', '535.627.9590x93546', 0, '2021-10-26 22:36:52', '2023-05-13 12:28:55', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(10, 'lawsonbrian', 'William', 'Kidd', 'reynoldsjennifer@patel-golden.biz', 'ec99852894065a8512ba0369973a337ccc02bce901ec07d9e947567e75ecf9f2', '564-785-2638', 1, '2021-11-14 08:42:54', '2023-08-19 19:16:45', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(11, 'zowen', 'Isaac', 'Grant', 'awilliams@yahoo.com', 'efb0e122234695afe0c57311e6130c5c241656d1d61e4621dd9f4f5b62aa664d', '080.898.5925x82992', 1, '2023-03-09 20:10:37', '2020-08-05 14:16:53', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaAgolhYd0a13rLiI6n3Bs5w8oro9vhmnpVg&usqp=CAU'),
(12, 'karenryan', 'Alvin', 'Sellers', 'wgarrison@yahoo.com', 'd88dc627443c0e64546245cd3c760611bd0fd71f834e291a74dc1d1dac798460', '402.950.6252x8455', 0, '2022-05-01 07:31:25', '2023-10-13 12:19:17', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(13, 'pughpeggy', 'Jenna', 'Pittman', 'zachary60@horton.com', '0f56ab4ebb78fa7f56e2c3c0844bdb7b8863b8524e78acca41ea83b1c17d93c6', '001-630-043-6438x68990', 1, '2020-04-07 18:09:49', '2020-11-13 22:43:46', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(14, 'cunninghamdenise', 'Andrea', 'Gutierrez', 'matthew20@hotmail.com', 'ba803249264e24da024c7b479683f978e9eee316c6014c39342f3372b978f940', '915.992.6566', 0, '2021-04-02 02:13:43', '2021-10-06 04:29:12', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(15, 'fvargas', 'Janet', 'Parsons', 'randallgreen@gmail.com', '21d37cd9b9d49d3720bfa01575808391fd4e0e8a45dd7c5934c6e7084d0a905b', '(547)981-7145x63708', 0, NULL, '2023-10-25 14:36:59', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(16, 'melissa74', 'Heather', 'Durham', 'matthew06@gmail.com', 'b155671d83282ef74b6a988027cdadb3e2ddcfb5a9bb8b6f94c53ee85bbfdac8', '432-785-7637x83942', 1, '2020-05-26 03:11:20', '2022-01-15 23:10:16', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(17, 'baldwinphillip', 'Katrina', 'Wilcox', 'matthewterrell@martinez-washington.info', '7e0bb86539e4c74cd8bb781fe871fb239d5d754c898f2692f91f68ff02148dc5', '+1-084-611-6327x32798', 0, '2020-10-28 07:31:53', '2020-07-24 14:59:59', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(18, 'rebecca74', 'Kimberly', 'Castillo', 'selena14@gmail.com', '0553055ea3c8ecde835a9fa94c9e79a87dc614b585d145ee5d7f2d74d30b34d7', '001-534-8246x3029', 1, '2021-08-18 22:29:57', '2023-06-07 06:21:34', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(19, 'scottglover', 'Matthew', 'Powers', 'ronald10@johnson-hill.com', '0595f69068c7e3c89d0e18d45fd22ee5b897a812aad3aa26d22f571b91af4ff9', '588-974-2730', 0, '2021-11-22 09:18:19', '2020-04-15 16:29:05', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(20, 'tyroneestes', 'Deanna', 'Hill', 'peter31@hotmail.com', '1d9ac9d7dfa5837ea78911c3caeb34141428138c2918c798e03bca75ab2ba15e', '(602)504-9699x18255', 1, NULL, '2022-06-14 19:16:25', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Netflix-avatar.png'),
(21, 'Simone', 'Simone', 'Piccinini', 'Simone.piccinini2005@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '333445332', NULL, NULL, NULL, 'https://cdn.bestmovie.it/wp-content/uploads/2021/11/GettyImages-1236337133-scaled.jpg'),
(22, 'Pippo', 'Pippo', 'Pippo', 'Pippo@gmail.com', '4a057a33f1d8158556eade51342786c6', NULL, NULL, NULL, NULL, 'https://statics.cedscdn.it/photos/MED_HIGH/38/03/3643803_2300_dwayne.jpg'),
(23, 'capra', 'Vittorio Umberto Antonio Maria', 'Sgarbi', 'sgarbi@gmail.com', 'a7641a103c1eadcec84f03140c0f0888', NULL, NULL, NULL, NULL, 'https://www.ansa.it/webimages/news_base/2023/1/20/c8e029070fea1317d695abf42a4ee9fc.jpg'),
(24, 'Say_My_Name', 'Walter', 'White', 'Walter@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, 'https://upload.wikimedia.org/wikipedia/en/thumb/0/03/Walter_White_S5B.png/220px-Walter_White_S5B.png'),
(25, 'Il_Tuo_Amichevole_Spiderman_Di_Quartiere', 'Peter', 'Parker', 'Peter@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, 'https://media.tenor.com/aWL_0M0e-OgAAAAe/tobey-maguire-scream.png'),
(26, 'better call saul', 'Jimmy ', 'McGill', 'bettercallmeman@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, 'https://i.pinimg.com/736x/3b/92/1c/3b921c51dc99d9fb2be192af3ec14f72.jpg'),
(27, 'Il tuo Avvofatto', 'Andrea', 'Dipre', 'Dipre@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, 'https://www.ilriformista.it/wp-content/uploads/2023/02/Andrea-Dipre-chi-e-750x513-1.jpeg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
