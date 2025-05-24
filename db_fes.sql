-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 03:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `row` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `fn` text NOT NULL,
  `mn` text NOT NULL,
  `ln` text NOT NULL,
  `image` text NOT NULL,
  `ay` text NOT NULL,
  `sem` text NOT NULL,
  `period` text NOT NULL,
  `department` text NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`row`, `user`, `pass`, `fn`, `mn`, `ln`, `image`, `ay`, `sem`, `period`, `department`, `position`) VALUES
(4, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 'Caisa Mae', 'Amoguis', 'Cambaya', 'None', '2023', 'First Semester', '2020', '23', 'Administrator'),
(5, 'aadmin', '21232f297a57a5a743894a0e4a801fc3', 'Marc Crisald', 'Peru', 'Cancio', 'None', '2023', 'First Semester', '', '', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `row` int(11) NOT NULL,
  `frm_no` text NOT NULL,
  `cat_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`row`, `frm_no`, `cat_name`) VALUES
(10, '7', 'Commitment'),
(11, '7', 'Knowledge of Subject'),
(12, '7', 'Teaching for Independent Learning'),
(13, '7', 'Management of Learning');

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `row` int(11) NOT NULL,
  `fn` text NOT NULL,
  `mn` text NOT NULL,
  `ln` text NOT NULL,
  `ext` text NOT NULL,
  `designation` text NOT NULL,
  `period` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`row`, `fn`, `mn`, `ln`, `ext`, `designation`, `period`) VALUES
(161, 'Joshua Edson', 'G', 'Ordiz', 'MST', 'Member', '2020'),
(163, 'ANNABELLE ', 'M.', 'HUFALAR', 'DevEdD', 'Overall Chair', '2020'),
(164, 'MARIE KHUL', 'C.', 'LANGUB', 'PhD', 'Faculty President', '2020'),
(165, 'Vangilit', 'G', 'Retome', 'PhD', 'Member', '2020'),
(166, 'Gwendolyn', '', 'Tatoy', 'PhD', 'College Dean', '2020'),
(167, 'HAZELLE ', '', 'VILLA-ASALDO', 'MDM', 'Human Resource Officer', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `row` int(11) NOT NULL,
  `dptno` text NOT NULL,
  `dscrpt` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`row`, `dptno`, `dscrpt`, `email`, `contact`) VALUES
(22, 'BTLED', 'Bachelor of Science In Technology and Livelihood Education', 'asdf', 'asdf'),
(23, 'BSED', 'Bachelor of Science in Secondary Education', 'dasd', 'asd'),
(24, 'BSINDUTECH', 'Department of Industrial Technology', 'sad', 'asda'),
(25, 'DBM', 'Department of Business Management', 'aaaa', ''),
(26, 'DA', 'Department of Accountancy', 'aaaaaaa', ''),
(27, 'CCSIT', 'Department of Information Technology', 'aaaaaaaaaaaa', '');

-- --------------------------------------------------------

--
-- Table structure for table `evaluate`
--

CREATE TABLE `evaluate` (
  `row` int(11) NOT NULL,
  `evaluator_no` text NOT NULL,
  `fac_no` text NOT NULL,
  `shed_no` int(11) NOT NULL,
  `rate` text NOT NULL,
  `points` text NOT NULL,
  `comment` text NOT NULL,
  `lexicon` text NOT NULL,
  `dateEval` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluate`
--

INSERT INTO `evaluate` (`row`, `evaluator_no`, `fac_no`, `shed_no`, `rate`, `points`, `comment`, `lexicon`, `dateEval`) VALUES
(18, '100', '123', 44, '17 5,18 5,19 5,20 5,22 5,23 5,24 5,25 5,26 5,27 5,28 5,29 5,30 5,31 5,32 5,33 5,34 5,35 5,36 5,37 5', '24', '', '0% Neutral (Empty)', '2023-05-11'),
(19, '200', '123', 715, '17 5,18 5,19 5,20 5,22 5,23 5,24 5,25 5,26 5,27 5,28 5,29 5,30 5,31 5,32 5,33 5,34 5,35 5,36 5,37 5', '36', '', '0% Neutral (Empty)', '2023-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_form`
--

CREATE TABLE `evaluation_form` (
  `row` int(11) NOT NULL,
  `frm_no` text NOT NULL,
  `ay` text NOT NULL,
  `sem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_form`
--

INSERT INTO `evaluation_form` (`row`, `frm_no`, `ay`, `sem`) VALUES
(3, '7', '2022', 'First Semester'),
(4, '7', '2022', 'Second Semester'),
(5, '7', '2023', 'First Semester');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `row` int(11) NOT NULL,
  `fn` text NOT NULL,
  `mn` text NOT NULL,
  `ln` text NOT NULL,
  `id` text NOT NULL,
  `dept` text NOT NULL,
  `rank` text NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`row`, `fn`, `mn`, `ln`, `id`, `dept`, `rank`, `position`) VALUES
(99, 'Santiago', '', 'Abrea', '2', '23', 'None', 'Faculty'),
(100, 'Jerry Mae', '', 'Abrigana', '3', '27', 'None', 'Faculty'),
(101, 'Argiebel', '', 'Adoracion', '4', '24', 'None', 'Faculty'),
(102, 'Cerenio', '', 'Adriatico', '5', '25', 'None', 'Faculty'),
(103, 'Mylyn', '', 'Agapay', '6', '25', 'None', 'Faculty'),
(104, 'Roderick', '', 'Alacre', '7', '24', 'None', 'Faculty'),
(105, 'Asterlita', '', 'Alfaro', '8', '23', 'None', 'Faculty'),
(106, 'Elysha', '', 'Alvarado', '9', '23', 'None', 'Faculty'),
(107, 'Michael', '', 'Alvinez', '10', '24', 'None', 'Faculty'),
(108, 'Shaina Maree', '', 'Amiscua', '11', '22', 'None', 'Faculty'),
(109, 'Gino', '', 'Anduyan', '12', '22', 'None', 'Faculty'),
(110, 'Christopher', '', 'Asma', '13', '24', 'None', 'Faculty'),
(115, 'Thea', '', 'Avila', '14', '22', 'None', 'Faculty'),
(116, 'Mameej', '', 'Balmes', '15', '23', 'None', 'Faculty'),
(117, 'Sheena', '', 'Batino', '16', '23', 'None', 'Faculty'),
(118, 'Felix', '', 'Bolocon', '17', '23', 'None', 'Faculty'),
(119, 'John', '', 'Brodeth', '18', '25', 'None', 'Faculty'),
(121, 'Carla', '', 'Bulacan', '19', '25', 'None', 'Faculty'),
(122, 'Rogen', '', 'Cagorol', '20', '24', 'None', 'Faculty'),
(123, 'Francis', '', 'Cambaya', '21', '27', 'None', 'Faculty'),
(124, 'Aiza', '', 'Casenas', '22', '23', 'None', 'Faculty'),
(125, 'Junico', '', 'Casundo', '23', '24', 'None', 'Faculty'),
(126, 'Jaztine', '', 'Catindoy', '24', '22', 'None', 'Faculty'),
(127, 'Donald', '', 'Celmar', '25', '22', 'None', 'Faculty'),
(128, 'Jowitz', '', 'Cero', '26', '24', 'None', 'Faculty'),
(129, 'Mae Ann', '', 'Coquila', '27', '23', 'None', 'Faculty'),
(130, 'Glecil Joy', '', 'Dalupo', '28', '22', 'None', 'Faculty'),
(131, 'Clonelyn', '', 'De Jose', '29', '25', 'None', 'Faculty'),
(132, 'Michael', '', 'Diaz', '30', '25', 'None', 'Faculty'),
(133, 'Marc Vincent', '', 'Dojello', '31', '23', 'None', 'Faculty'),
(134, 'Kenneth Jay', '', 'Dugaria', '32', '27', 'None', 'Faculty'),
(135, 'Danilo', '', 'Escobido', '33', '25', 'None', 'Faculty'),
(136, 'Nissi Praise', '', 'Espejo', '34', '22', 'None', 'Faculty'),
(137, 'Maricris', '', 'Estubio', '35', '22', 'None', 'Faculty'),
(138, 'Ines', '', 'Falcon', '36', '27', 'None', 'Faculty'),
(139, 'Jessa', '', 'Gamolo', '37', '24', 'None', 'Faculty'),
(140, 'Eden', '', 'Garces', '38', '24', 'None', 'Faculty'),
(141, 'Catherine', '', 'Garcia', '39', '25', 'None', 'Faculty'),
(142, 'Mercy Joy', '', 'Garcia', '40', '23', 'None', 'Faculty'),
(143, 'Gary', '', 'Garcia', '41', '23', 'None', 'Faculty'),
(144, 'Joseph', '', 'Gazo', '42', '22', 'None', 'Faculty'),
(145, 'Jaype', '', 'Goriding', '43', '27', 'None', 'Faculty'),
(146, 'Essiel Cris', '', 'Goring', '44', '23', 'None', 'Faculty'),
(147, 'Andrew', '', 'Gorme', '45', '25', 'None', 'Faculty'),
(148, 'Myla', '', 'Gumanit', '46', '27', 'None', 'Faculty'),
(149, 'Dolly', '', 'Hinayon', '47', '25', 'None', 'Faculty'),
(150, 'Mary Annchyr', '', 'Jumarito', '48', '24', 'None', 'Faculty'),
(151, 'Charra Mae', '', 'Lagumbay', '49', '22', 'None', 'Faculty'),
(152, 'Wilfredo', '', 'Lariba', '50', '24', 'None', 'Faculty'),
(153, 'Sergio ', '', 'Lepiten', '51', '25', 'None', 'Faculty'),
(154, 'Kenneth', '', 'Magabo', '52', '24', 'None', 'Faculty'),
(155, 'Jonabelle', '', 'Malubay', '53', '25', 'None', 'Faculty'),
(156, 'Pearliencito', '', 'Masing', '54', '24', 'None', 'Faculty'),
(157, 'Jan Callel', '', 'Menoza', '55', '24', 'None', 'Faculty'),
(158, 'Melissa', '', 'Misoles', '56', '23', 'None', 'Faculty'),
(159, 'Krissanto Ray', '', 'Mogueis', '57', '22', 'None', 'Faculty'),
(160, 'Cherry Ann', '', 'Montecalbo', '58', '22', 'None', 'Faculty'),
(161, 'Louremel', '', 'Muncada', '59', '25', 'None', 'Faculty'),
(162, 'Flora Mae', '', 'Navos', '60', '23', 'None', 'Faculty'),
(163, 'Ryan', '', 'Negros', '61', '23', 'None', 'Faculty'),
(164, 'Joshua Edson', '', 'Ordiz', '62', '23', 'None', 'Faculty'),
(165, 'Amber Ghea', '', 'Pablo', '63', '25', 'None', 'Faculty'),
(166, 'Lorenito', '', 'Pacha', '64', '23', 'None', 'Faculty'),
(167, 'Federico', '', 'Paler', '65', '23', 'None', 'Faculty'),
(168, 'Israel', '', 'Palero', '66', '22', 'None', 'Faculty'),
(169, 'Lilibeth', '', 'Pasadas', '67', '23', 'None', 'Faculty'),
(170, 'Romeo', '', 'Patual', '68', '23', 'None', 'Faculty'),
(171, 'Catherine', '', 'Patual', '69', '23', 'None', 'Faculty'),
(172, 'Virgilio', '', 'Perez', '70', '24', 'None', 'Faculty'),
(173, 'Jeane', '', 'Pollenza', '71', '23', 'None', 'Faculty'),
(174, 'Danna', '', 'Remojo', '72', '27', 'None', 'Faculty'),
(175, 'Vangilit', '', 'Retome', '73', '23', 'None', 'Faculty'),
(176, 'Victor', '', 'Retome', '74', '24', 'None', 'Faculty'),
(177, 'Yvon', '', 'Salamones', '75', '27', 'None', 'Faculty'),
(178, 'Rosemarie', '', 'Saligue', '76', '27', 'None', 'Faculty'),
(179, 'Emmanuel', '', 'Saligue', '77', '27', 'None', 'Faculty'),
(180, 'Julian', '', 'Samaniego', '78', '27', 'None', 'Faculty'),
(181, 'Abdel Khan', '', 'Sampang', '79', '25', 'None', 'Faculty'),
(182, 'Jackylou', '', 'Sarsale', '80', '23', 'None', 'Faculty'),
(183, 'Melvin', '', 'Sarrsale', '81', '25', 'None', 'Faculty'),
(184, 'Mark Joevane', '', 'Sayahon', '82', '23', 'None', 'Faculty'),
(185, 'Marilou', '', 'Siega', '83', '24', 'None', 'Faculty'),
(186, 'Clarence Michelle', '', 'Sordilla', '84', '23', 'None', 'Faculty'),
(187, 'Razel', '', 'Sumaylo', '85', '24', 'None', 'Faculty'),
(188, 'Eduardson', '', 'Talosig', '86', '27', 'None', 'Faculty'),
(189, 'Gwendolyn', '', 'Tatoy', '87', '25', 'None', 'Faculty'),
(190, 'Jessamyne Jacil', '', 'Tayor', '88', '23', 'None', 'Faculty'),
(191, 'Ronald', '', 'Tecson', '89', '25', 'None', 'Faculty'),
(192, 'Lovely Riza', '', 'Timbal', '90', '25', 'None', 'Faculty'),
(193, 'Gilda', '', 'Tumanda', '91', '22', 'None', 'Faculty'),
(194, 'Jesyl', '', 'Unabia', '92', '24', 'None', 'Faculty'),
(195, 'Imelda', '', 'Yaoyao', '93', '23', 'None', 'Faculty'),
(196, 'Alvin', '', 'Yaoyao', '94', '24', 'None', 'Faculty'),
(197, 'Fil Ryan', '', 'Yap', '95', '24', 'None', 'Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `row` int(11) NOT NULL,
  `frm_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`row`, `frm_name`) VALUES
(7, 'NBC 461 QCE Form O1A');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `row` int(11) NOT NULL,
  `cat_no` text NOT NULL,
  `question` text NOT NULL,
  `arrngmnt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`row`, `cat_no`, `question`, `arrngmnt`) VALUES
(17, '10', 'Demonstrates sensitivity to students ability to attend and absorb content information.', '1'),
(18, '10', 'Integrates sensitivity his/her learning objectives with those of the students in a collaborative process.', '2'),
(19, '10', 'Makes self-available to students beyond official time.', '3'),
(20, '10', 'Regularly comes to class on time, well-groomed and well-prepared to complete assigned responsibilities.', '4'),
(22, '10', 'Keeps accurate records of students performance and prompt submission of the same.', '5'),
(23, '11', 'Demonstrates mastery of the subject matter(explain the subject matter without relying solely on the prescribed textbook).', '1'),
(24, '11', 'Draws and share information on the state on the art of theory and practice in his/her discipline.', '2'),
(25, '11', 'Integrates subject to practical circumstances and learning intents/ purposes of students.', '3'),
(26, '11', 'Explains the relevance of present topics to the previous lessons, and relate the subject matter to relevant current issues and or daily life activities.', '4'),
(27, '11', 'Demonstrates up-to-date knowledge and/or awareness on current trends and issues of the subject.', '5'),
(28, '12', 'Creates teaching strategies that allow students to practice using concepts they need to undestand (Interative discussion).', '1'),
(29, '12', 'Enhances student self-esteem and/or gives due recognitionto students performance/ pontentials.', '2'),
(30, '12', 'Allows students to create their own course with objectives and realistically defined student-professor rules and make them accountable for their performance.', '3'),
(31, '12', 'Allows students to think independently and make theri own decisions and holding them accountable for their performance based largely on their success in executing decisions.', '4'),
(32, '12', 'Encourages students to learn beyond what is required and help/guide the students how to apply the concepts learned.', '5'),
(33, '13', 'Creates oppurtunities for intensive and/or extensive contribution of students in the class activitities(e.g. breaks class into dyards, triads, or buzz/task groups).', '1'),
(34, '13', 'Assumes roles as facilitator, resource person, couch inquistor, integration, referee in drawing students to contribute to knowledge and understanding of the concepts at hands.', '2'),
(35, '13', 'Designs and implements learning conditions and experience that promotes healthy exchange and/or confrontations.', '3'),
(36, '13', 'Structures re-structures learning and teaching-learning context to enhance attainment of collective learning objectives.', '4'),
(37, '13', 'Use of instructional Materials(audio/video materials: fieldtrips, film-showing, computer aided instruction and etc.) to reinforces learning process.', '5');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `row` int(11) NOT NULL,
  `frm_no` text NOT NULL,
  `stud_no` text NOT NULL,
  `ay` text NOT NULL,
  `sem` text NOT NULL,
  `fac_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`row`, `frm_no`, `stud_no`, `ay`, `sem`, `fac_no`) VALUES
(9, '7', '201', '2022', 'Second Semester', 188),
(14, '7', '120', '2023', 'Second Semester', 188),
(15, '7', '204', '2022', 'Second Semester', 188),
(17, '7', '205', '2022', 'Second Semester', 147),
(23, '7', '206', '2022', 'Second Semester', 149),
(24, '7', '211', '2022', 'Second Semester', 129),
(25, '7', '211', '2022', 'Second Semester', 156),
(26, '7', '211', '2022', 'Second Semester', 101),
(27, '7', '211', '2022', 'Second Semester', 196),
(28, '7', '214', '2022', 'Second Semester', 188),
(29, '7', '213', '2022', 'Second Semester', 188),
(30, '7', '215', '2022', 'Second Semester', 141),
(31, '7', '215', '2022', 'Second Semester', 118),
(33, '7', '215', '2022', 'Second Semester', 149),
(34, '7', '215', '2022', 'Second Semester', 132),
(35, '7', '215', '2022', 'Second Semester', 124),
(36, '7', '216', '2022', 'Second Semester', 190),
(37, '7', '216', '2022', 'Second Semester', 105),
(38, '7', '216', '2022', 'Second Semester', 100),
(39, '7', '216', '2022', 'Second Semester', 138),
(40, '7', '216', '2022', 'Second Semester', 178),
(41, '7', '216', '2022', 'Second Semester', 174),
(42, '7', '217', '2022', 'Second Semester', 134),
(43, '7', '217', '2022', 'Second Semester', 148),
(44, '7', '217', '2022', 'Second Semester', 123),
(45, '7', '217', '2022', 'Second Semester', 174),
(46, '7', '217', '2022', 'Second Semester', 105),
(47, '7', '217', '2022', 'Second Semester', 190),
(48, '7', '218', '2022', 'Second Semester', 174),
(49, '7', '218', '2022', 'Second Semester', 138),
(50, '7', '218', '2022', 'Second Semester', 133),
(51, '7', '218', '2022', 'Second Semester', 123),
(52, '7', '218', '2022', 'Second Semester', 134),
(53, '7', '218', '2022', 'Second Semester', 190),
(54, '7', '219', '2022', 'Second Semester', 190),
(55, '7', '219', '2022', 'Second Semester', 105),
(56, '7', '219', '2022', 'Second Semester', 100),
(57, '7', '219', '2022', 'Second Semester', 138),
(58, '7', '219', '2022', 'Second Semester', 178),
(59, '7', '219', '2022', 'Second Semester', 174),
(60, '7', '220', '2022', 'Second Semester', 190),
(61, '7', '220', '2022', 'Second Semester', 100),
(62, '7', '220', '2022', 'Second Semester', 138),
(63, '7', '220', '2022', 'Second Semester', 178),
(64, '7', '220', '2022', 'Second Semester', 174),
(65, '7', '221', '2022', 'Second Semester', 174),
(66, '7', '221', '2022', 'Second Semester', 138),
(67, '7', '221', '2022', 'Second Semester', 133),
(68, '7', '221', '2022', 'Second Semester', 123),
(69, '7', '221', '2022', 'Second Semester', 134),
(70, '7', '221', '2022', 'Second Semester', 190),
(71, '7', '223', '2022', 'Second Semester', 134),
(72, '7', '223', '2022', 'Second Semester', 148),
(73, '7', '223', '2022', 'Second Semester', 123),
(74, '7', '223', '2022', 'Second Semester', 174),
(75, '7', '223', '2022', 'Second Semester', 105),
(76, '7', '223', '2022', 'Second Semester', 190),
(77, '7', '225', '2022', 'Second Semester', 190),
(78, '7', '225', '2022', 'Second Semester', 105),
(79, '7', '225', '2022', 'Second Semester', 100),
(80, '7', '225', '2022', 'Second Semester', 138),
(81, '7', '225', '2022', 'Second Semester', 178),
(82, '7', '225', '2022', 'Second Semester', 174),
(83, '7', '226', '2022', 'Second Semester', 174),
(84, '7', '226', '2022', 'Second Semester', 138),
(85, '7', '226', '2022', 'Second Semester', 133),
(86, '7', '226', '2022', 'Second Semester', 123),
(87, '7', '226', '2022', 'Second Semester', 134),
(88, '7', '226', '2022', 'Second Semester', 190),
(89, '7', '227', '2022', 'Second Semester', 134),
(90, '7', '227', '2022', 'Second Semester', 148),
(91, '7', '227', '2022', 'Second Semester', 123),
(92, '7', '227', '2022', 'Second Semester', 174),
(93, '7', '227', '2022', 'Second Semester', 105),
(94, '7', '227', '2022', 'Second Semester', 190),
(95, '7', '202', '2022', 'Second Semester', 100),
(96, '7', '202', '2022', 'Second Semester', 180),
(97, '7', '202', '2022', 'Second Semester', 132),
(98, '7', '202', '2022', 'Second Semester', 190),
(99, '7', '202', '2022', 'Second Semester', 105),
(100, '7', '202', '2022', 'Second Semester', 178),
(101, '7', '202', '2022', 'Second Semester', 174),
(102, '7', '234', '2022', 'Second Semester', 134),
(103, '7', '234', '2022', 'Second Semester', 148),
(104, '7', '234', '2022', 'Second Semester', 123),
(105, '7', '234', '2022', 'Second Semester', 174),
(106, '7', '234', '2022', 'Second Semester', 105),
(107, '7', '234', '2022', 'Second Semester', 190),
(108, '7', '235', '2022', 'Second Semester', 190),
(109, '7', '235', '2022', 'Second Semester', 105),
(110, '7', '235', '2022', 'Second Semester', 100),
(111, '7', '235', '2022', 'Second Semester', 138),
(112, '7', '235', '2022', 'Second Semester', 178),
(113, '7', '235', '2022', 'Second Semester', 174),
(114, '7', '236', '2022', 'Second Semester', 100),
(115, '7', '236', '2022', 'Second Semester', 180),
(116, '7', '236', '2022', 'Second Semester', 133),
(117, '7', '236', '2022', 'Second Semester', 178),
(118, '7', '236', '2022', 'Second Semester', 174),
(119, '7', '236', '2022', 'Second Semester', 190),
(120, '7', '238', '2022', 'Second Semester', 100),
(121, '7', '238', '2022', 'Second Semester', 180),
(122, '7', '238', '2022', 'Second Semester', 133),
(123, '7', '238', '2022', 'Second Semester', 178),
(124, '7', '238', '2022', 'Second Semester', 174),
(125, '7', '238', '2022', 'Second Semester', 190),
(126, '7', '239', '2022', 'Second Semester', 174),
(127, '7', '239', '2022', 'Second Semester', 138),
(128, '7', '239', '2022', 'Second Semester', 133),
(129, '7', '239', '2022', 'Second Semester', 123),
(130, '7', '239', '2022', 'Second Semester', 134),
(131, '7', '239', '2022', 'Second Semester', 190),
(132, '7', '240', '2022', 'Second Semester', 100),
(133, '7', '240', '2022', 'Second Semester', 180),
(134, '7', '240', '2022', 'Second Semester', 132),
(135, '7', '240', '2022', 'Second Semester', 190),
(136, '7', '240', '2022', 'Second Semester', 105),
(137, '7', '240', '2022', 'Second Semester', 178),
(138, '7', '240', '2022', 'Second Semester', 168),
(139, '7', '240', '2022', 'Second Semester', 174),
(140, '7', '241', '2022', 'Second Semester', 100),
(141, '7', '241', '2022', 'Second Semester', 180),
(142, '7', '241', '2022', 'Second Semester', 132),
(143, '7', '241', '2022', 'Second Semester', 190),
(144, '7', '241', '2022', 'Second Semester', 105),
(145, '7', '241', '2022', 'Second Semester', 178),
(146, '7', '241', '2022', 'Second Semester', 168),
(147, '7', '241', '2022', 'Second Semester', 174),
(148, '7', '242', '2022', 'Second Semester', 134),
(149, '7', '242', '2022', 'Second Semester', 148),
(150, '7', '242', '2022', 'Second Semester', 123),
(151, '7', '242', '2022', 'Second Semester', 174),
(152, '7', '242', '2022', 'Second Semester', 105),
(153, '7', '242', '2022', 'Second Semester', 190),
(154, '7', '243', '2022', 'Second Semester', 174),
(155, '7', '243', '2022', 'Second Semester', 138),
(156, '7', '243', '2022', 'Second Semester', 133),
(157, '7', '243', '2022', 'Second Semester', 123),
(158, '7', '243', '2022', 'Second Semester', 134),
(159, '7', '243', '2022', 'Second Semester', 190),
(160, '7', '245', '2022', 'Second Semester', 100),
(161, '7', '245', '2022', 'Second Semester', 180),
(162, '7', '245', '2022', 'Second Semester', 133),
(163, '7', '245', '2022', 'Second Semester', 178),
(164, '7', '245', '2022', 'Second Semester', 174),
(165, '7', '245', '2022', 'Second Semester', 190),
(166, '7', '246', '2022', 'Second Semester', 174),
(167, '7', '246', '2022', 'Second Semester', 138),
(168, '7', '246', '2022', 'Second Semester', 133),
(169, '7', '246', '2022', 'Second Semester', 123),
(170, '7', '246', '2022', 'Second Semester', 134),
(171, '7', '246', '2022', 'Second Semester', 190),
(172, '7', '247', '2022', 'Second Semester', 100),
(173, '7', '247', '2022', 'Second Semester', 180),
(174, '7', '247', '2022', 'Second Semester', 133),
(175, '7', '247', '2022', 'Second Semester', 178),
(176, '7', '247', '2022', 'Second Semester', 174),
(177, '7', '247', '2022', 'Second Semester', 190),
(178, '7', '248', '2022', 'Second Semester', 190),
(179, '7', '248', '2022', 'Second Semester', 105),
(180, '7', '248', '2022', 'Second Semester', 100),
(181, '7', '248', '2022', 'Second Semester', 138),
(182, '7', '248', '2022', 'Second Semester', 178),
(183, '7', '248', '2022', 'Second Semester', 174),
(184, '7', '249', '2022', 'Second Semester', 100),
(185, '7', '249', '2022', 'Second Semester', 180),
(186, '7', '249', '2022', 'Second Semester', 133),
(187, '7', '249', '2022', 'Second Semester', 178),
(188, '7', '249', '2022', 'Second Semester', 174),
(189, '7', '249', '2022', 'Second Semester', 190),
(190, '7', '250', '2022', 'Second Semester', 134),
(191, '7', '250', '2022', 'Second Semester', 148),
(192, '7', '250', '2022', 'Second Semester', 123),
(193, '7', '250', '2022', 'Second Semester', 174),
(194, '7', '250', '2022', 'Second Semester', 105),
(195, '7', '250', '2022', 'Second Semester', 190),
(196, '7', '251', '2022', 'Second Semester', 190),
(197, '7', '251', '2022', 'Second Semester', 105),
(198, '7', '251', '2022', 'Second Semester', 100),
(199, '7', '251', '2022', 'Second Semester', 138),
(200, '7', '251', '2022', 'Second Semester', 178),
(201, '7', '251', '2022', 'Second Semester', 174),
(202, '7', '252', '2022', 'Second Semester', 174),
(203, '7', '252', '2022', 'Second Semester', 138),
(204, '7', '252', '2022', 'Second Semester', 133),
(205, '7', '252', '2022', 'Second Semester', 123),
(206, '7', '252', '2022', 'Second Semester', 134),
(207, '7', '252', '2022', 'Second Semester', 190),
(208, '7', '254', '2022', 'Second Semester', 190),
(209, '7', '254', '2022', 'Second Semester', 105),
(210, '7', '254', '2022', 'Second Semester', 100),
(211, '7', '254', '2022', 'Second Semester', 138),
(212, '7', '254', '2022', 'Second Semester', 178),
(213, '7', '254', '2022', 'Second Semester', 174),
(214, '7', '255', '2022', 'Second Semester', 190),
(215, '7', '255', '2022', 'Second Semester', 105),
(216, '7', '255', '2022', 'Second Semester', 100),
(217, '7', '255', '2022', 'Second Semester', 138),
(218, '7', '255', '2022', 'Second Semester', 178),
(219, '7', '255', '2022', 'Second Semester', 174),
(220, '7', '256', '2022', 'Second Semester', 134),
(221, '7', '256', '2022', 'Second Semester', 148),
(222, '7', '256', '2022', 'Second Semester', 123),
(223, '7', '256', '2022', 'Second Semester', 174),
(224, '7', '256', '2022', 'Second Semester', 105),
(225, '7', '256', '2022', 'Second Semester', 190),
(226, '7', '257', '2022', 'Second Semester', 174),
(227, '7', '257', '2022', 'Second Semester', 138),
(228, '7', '257', '2022', 'Second Semester', 133),
(229, '7', '257', '2022', 'Second Semester', 123),
(230, '7', '257', '2022', 'Second Semester', 134),
(231, '7', '257', '2022', 'Second Semester', 190),
(232, '7', '259', '2022', 'Second Semester', 134),
(233, '7', '259', '2022', 'Second Semester', 148),
(234, '7', '259', '2022', 'Second Semester', 123),
(235, '7', '259', '2022', 'Second Semester', 174),
(236, '7', '259', '2022', 'Second Semester', 105),
(237, '7', '259', '2022', 'Second Semester', 190),
(238, '7', '260', '2022', 'Second Semester', 174),
(239, '7', '260', '2022', 'Second Semester', 138),
(240, '7', '260', '2022', 'Second Semester', 133),
(241, '7', '260', '2022', 'Second Semester', 123),
(242, '7', '260', '2022', 'Second Semester', 134),
(243, '7', '260', '2022', 'Second Semester', 190),
(244, '7', '261', '2022', 'Second Semester', 100),
(245, '7', '261', '2022', 'Second Semester', 180),
(246, '7', '261', '2022', 'Second Semester', 133),
(247, '7', '261', '2022', 'Second Semester', 178),
(248, '7', '261', '2022', 'Second Semester', 174),
(249, '7', '261', '2022', 'Second Semester', 190),
(250, '7', '262', '2022', 'Second Semester', 134),
(251, '7', '262', '2022', 'Second Semester', 148),
(252, '7', '262', '2022', 'Second Semester', 123),
(253, '7', '262', '2022', 'Second Semester', 174),
(254, '7', '262', '2022', 'Second Semester', 105),
(255, '7', '262', '2022', 'Second Semester', 190),
(256, '7', '263', '2022', 'Second Semester', 190),
(257, '7', '263', '2022', 'Second Semester', 105),
(258, '7', '263', '2022', 'Second Semester', 100),
(259, '7', '263', '2022', 'Second Semester', 138),
(260, '7', '263', '2022', 'Second Semester', 178),
(261, '7', '263', '2022', 'Second Semester', 174),
(262, '7', '265', '2022', 'Second Semester', 174),
(263, '7', '265', '2022', 'Second Semester', 138),
(264, '7', '265', '2022', 'Second Semester', 133),
(265, '7', '265', '2022', 'Second Semester', 123),
(266, '7', '265', '2022', 'Second Semester', 134),
(267, '7', '265', '2022', 'Second Semester', 190),
(268, '7', '268', '2022', 'Second Semester', 134),
(269, '7', '268', '2022', 'Second Semester', 148),
(270, '7', '268', '2022', 'Second Semester', 123),
(271, '7', '268', '2022', 'Second Semester', 174),
(272, '7', '268', '2022', 'Second Semester', 105),
(273, '7', '268', '2022', 'Second Semester', 190),
(274, '7', '269', '2022', 'Second Semester', 100),
(275, '7', '269', '2022', 'Second Semester', 180),
(276, '7', '269', '2022', 'Second Semester', 132),
(277, '7', '269', '2022', 'Second Semester', 190),
(278, '7', '269', '2022', 'Second Semester', 105),
(279, '7', '269', '2022', 'Second Semester', 178),
(280, '7', '269', '2022', 'Second Semester', 168),
(281, '7', '269', '2022', 'Second Semester', 174),
(288, '7', '272', '2022', 'Second Semester', 174),
(289, '7', '272', '2022', 'Second Semester', 138),
(290, '7', '272', '2022', 'Second Semester', 133),
(291, '7', '272', '2022', 'Second Semester', 123),
(292, '7', '272', '2022', 'Second Semester', 134),
(293, '7', '272', '2022', 'Second Semester', 190),
(294, '7', '273', '2022', 'First Semester', 100),
(295, '7', '273', '2022', 'First Semester', 180),
(296, '7', '273', '2022', 'First Semester', 132),
(297, '7', '273', '2022', 'First Semester', 190),
(298, '7', '273', '2022', 'First Semester', 105),
(299, '7', '273', '2022', 'First Semester', 178),
(300, '7', '273', '2022', 'First Semester', 168),
(301, '7', '273', '2022', 'First Semester', 174),
(302, '7', '274', '2022', 'Second Semester', 190),
(303, '7', '274', '2022', 'Second Semester', 105),
(304, '7', '274', '2022', 'Second Semester', 100),
(305, '7', '274', '2022', 'Second Semester', 138),
(306, '7', '274', '2022', 'Second Semester', 178),
(307, '7', '274', '2022', 'Second Semester', 174),
(308, '7', '275', '2022', 'Second Semester', 100),
(309, '7', '275', '2022', 'Second Semester', 180),
(310, '7', '275', '2022', 'Second Semester', 133),
(311, '7', '275', '2022', 'Second Semester', 178),
(312, '7', '275', '2022', 'Second Semester', 174),
(313, '7', '275', '2022', 'Second Semester', 190),
(314, '7', '276', '2022', 'Second Semester', 134),
(315, '7', '276', '2022', 'Second Semester', 148),
(316, '7', '276', '2022', 'Second Semester', 123),
(317, '7', '276', '2022', 'Second Semester', 174),
(318, '7', '276', '2022', 'Second Semester', 105),
(319, '7', '276', '2022', 'Second Semester', 190),
(320, '7', '277', '2022', 'Second Semester', 190),
(321, '7', '277', '2022', 'Second Semester', 105),
(322, '7', '277', '2022', 'Second Semester', 100),
(323, '7', '277', '2022', 'Second Semester', 138),
(324, '7', '277', '2022', 'Second Semester', 178),
(325, '7', '277', '2022', 'Second Semester', 174),
(326, '7', '278', '2022', 'Second Semester', 174),
(327, '7', '278', '2022', 'Second Semester', 138),
(328, '7', '278', '2022', 'Second Semester', 133),
(329, '7', '278', '2022', 'Second Semester', 123),
(330, '7', '278', '2022', 'Second Semester', 134),
(331, '7', '278', '2022', 'Second Semester', 190),
(332, '7', '280', '2022', 'Second Semester', 190),
(333, '7', '280', '2022', 'Second Semester', 105),
(334, '7', '280', '2022', 'Second Semester', 100),
(335, '7', '280', '2022', 'Second Semester', 138),
(336, '7', '280', '2022', 'Second Semester', 178),
(337, '7', '280', '2022', 'Second Semester', 174),
(338, '7', '283', '2022', 'Second Semester', 134),
(339, '7', '283', '2022', 'Second Semester', 148),
(340, '7', '283', '2022', 'Second Semester', 123),
(341, '7', '283', '2022', 'Second Semester', 174),
(342, '7', '283', '2022', 'Second Semester', 105),
(343, '7', '283', '2022', 'Second Semester', 190),
(344, '7', '284', '2022', 'Second Semester', 174),
(345, '7', '284', '2022', 'Second Semester', 138),
(346, '7', '284', '2022', 'Second Semester', 133),
(347, '7', '284', '2022', 'Second Semester', 123),
(348, '7', '284', '2022', 'Second Semester', 134),
(349, '7', '284', '2022', 'Second Semester', 190),
(350, '7', '285', '2022', 'Second Semester', 190),
(351, '7', '285', '2022', 'Second Semester', 105),
(352, '7', '285', '2022', 'Second Semester', 100),
(353, '7', '285', '2022', 'Second Semester', 138),
(354, '7', '285', '2022', 'Second Semester', 178),
(355, '7', '285', '2022', 'Second Semester', 174),
(356, '7', '286', '2022', 'Second Semester', 174),
(357, '7', '286', '2022', 'Second Semester', 138),
(358, '7', '286', '2022', 'Second Semester', 133),
(359, '7', '286', '2022', 'Second Semester', 123),
(360, '7', '286', '2022', 'Second Semester', 134),
(361, '7', '286', '2022', 'Second Semester', 190),
(362, '7', '287', '2022', 'Second Semester', 134),
(363, '7', '287', '2022', 'Second Semester', 148),
(364, '7', '287', '2022', 'Second Semester', 123),
(365, '7', '287', '2022', 'Second Semester', 174),
(366, '7', '287', '2022', 'Second Semester', 105),
(367, '7', '287', '2022', 'Second Semester', 190),
(368, '7', '289', '2022', 'Second Semester', 100),
(369, '7', '289', '2022', 'Second Semester', 180),
(370, '7', '289', '2022', 'Second Semester', 132),
(371, '7', '289', '2022', 'Second Semester', 190),
(372, '7', '289', '2022', 'Second Semester', 105),
(373, '7', '289', '2022', 'Second Semester', 178),
(374, '7', '289', '2022', 'Second Semester', 168),
(375, '7', '289', '2022', 'Second Semester', 174),
(376, '7', '290', '2022', 'Second Semester', 100),
(377, '7', '290', '2022', 'Second Semester', 180),
(378, '7', '290', '2022', 'Second Semester', 132),
(379, '7', '290', '2022', 'Second Semester', 190),
(380, '7', '290', '2022', 'Second Semester', 105),
(381, '7', '290', '2022', 'Second Semester', 178),
(382, '7', '290', '2022', 'Second Semester', 168),
(383, '7', '290', '2022', 'Second Semester', 174),
(384, '7', '291', '2022', 'Second Semester', 190),
(385, '7', '291', '2022', 'Second Semester', 105),
(386, '7', '291', '2022', 'Second Semester', 100),
(387, '7', '291', '2022', 'Second Semester', 138),
(388, '7', '291', '2022', 'Second Semester', 178),
(389, '7', '291', '2022', 'Second Semester', 174),
(390, '7', '292', '2022', 'Second Semester', 190),
(391, '7', '292', '2022', 'Second Semester', 105),
(392, '7', '292', '2022', 'Second Semester', 100),
(393, '7', '292', '2022', 'Second Semester', 138),
(394, '7', '292', '2022', 'Second Semester', 178),
(395, '7', '292', '2022', 'Second Semester', 174),
(396, '7', '294', '2022', 'Second Semester', 174),
(397, '7', '294', '2022', 'Second Semester', 138),
(398, '7', '294', '2022', 'Second Semester', 133),
(399, '7', '294', '2022', 'Second Semester', 123),
(400, '7', '294', '2022', 'Second Semester', 134),
(401, '7', '294', '2022', 'Second Semester', 190),
(402, '7', '295', '2022', 'Second Semester', 100),
(403, '7', '295', '2022', 'Second Semester', 180),
(404, '7', '295', '2022', 'Second Semester', 132),
(405, '7', '295', '2022', 'Second Semester', 190),
(406, '7', '295', '2022', 'Second Semester', 105),
(407, '7', '295', '2022', 'Second Semester', 178),
(408, '7', '295', '2022', 'Second Semester', 168),
(409, '7', '295', '2022', 'Second Semester', 174),
(410, '7', '296', '2022', 'Second Semester', 100),
(411, '7', '296', '2022', 'Second Semester', 180),
(412, '7', '296', '2022', 'Second Semester', 133),
(413, '7', '296', '2022', 'Second Semester', 178),
(414, '7', '296', '2022', 'Second Semester', 174),
(415, '7', '296', '2022', 'Second Semester', 190),
(416, '7', '297', '2022', 'Second Semester', 190),
(417, '7', '297', '2022', 'Second Semester', 105),
(418, '7', '297', '2022', 'Second Semester', 100),
(419, '7', '297', '2022', 'Second Semester', 138),
(420, '7', '297', '2022', 'Second Semester', 178),
(421, '7', '297', '2022', 'Second Semester', 174),
(422, '7', '299', '2022', 'Second Semester', 100),
(423, '7', '299', '2022', 'Second Semester', 180),
(424, '7', '299', '2022', 'Second Semester', 133),
(425, '7', '299', '2022', 'Second Semester', 178),
(426, '7', '299', '2022', 'Second Semester', 174),
(427, '7', '299', '2022', 'Second Semester', 190),
(428, '7', '301', '2022', 'Second Semester', 100),
(429, '7', '301', '2022', 'Second Semester', 180),
(430, '7', '301', '2022', 'Second Semester', 133),
(431, '7', '301', '2022', 'Second Semester', 178),
(432, '7', '301', '2022', 'Second Semester', 174),
(433, '7', '301', '2022', 'Second Semester', 190),
(434, '7', '302', '2022', 'Second Semester', 100),
(435, '7', '302', '2022', 'Second Semester', 180),
(436, '7', '302', '2022', 'Second Semester', 133),
(437, '7', '302', '2022', 'Second Semester', 178),
(438, '7', '302', '2022', 'Second Semester', 174),
(439, '7', '302', '2022', 'Second Semester', 190),
(440, '7', '303', '2022', 'Second Semester', 174),
(441, '7', '303', '2022', 'Second Semester', 138),
(442, '7', '303', '2022', 'Second Semester', 133),
(443, '7', '303', '2022', 'Second Semester', 123),
(444, '7', '303', '2022', 'Second Semester', 134),
(445, '7', '303', '2022', 'Second Semester', 190),
(446, '7', '304', '2022', 'Second Semester', 174),
(447, '7', '304', '2022', 'Second Semester', 138),
(448, '7', '304', '2022', 'Second Semester', 133),
(449, '7', '304', '2022', 'Second Semester', 123),
(450, '7', '304', '2022', 'Second Semester', 134),
(451, '7', '304', '2022', 'Second Semester', 190),
(452, '7', '305', '2022', 'Second Semester', 134),
(453, '7', '305', '2022', 'Second Semester', 148),
(454, '7', '305', '2022', 'Second Semester', 123),
(455, '7', '305', '2022', 'Second Semester', 174),
(456, '7', '305', '2022', 'Second Semester', 105),
(457, '7', '305', '2022', 'Second Semester', 190),
(458, '7', '306', '2022', 'Second Semester', 100),
(459, '7', '306', '2022', 'Second Semester', 180),
(460, '7', '306', '2022', 'Second Semester', 133),
(461, '7', '306', '2022', 'Second Semester', 178),
(462, '7', '306', '2022', 'Second Semester', 174),
(463, '7', '306', '2022', 'Second Semester', 190),
(464, '7', '307', '2022', 'Second Semester', 100),
(465, '7', '307', '2022', 'Second Semester', 180),
(466, '7', '307', '2022', 'Second Semester', 133),
(467, '7', '307', '2022', 'Second Semester', 178),
(468, '7', '307', '2022', 'Second Semester', 174),
(469, '7', '307', '2022', 'Second Semester', 190),
(470, '7', '308', '2022', 'Second Semester', 190),
(471, '7', '308', '2022', 'Second Semester', 105),
(472, '7', '308', '2022', 'Second Semester', 100),
(473, '7', '308', '2022', 'Second Semester', 138),
(474, '7', '308', '2022', 'Second Semester', 178),
(475, '7', '308', '2022', 'Second Semester', 174),
(476, '7', '310', '2022', 'Second Semester', 100),
(477, '7', '310', '2022', 'Second Semester', 180),
(478, '7', '310', '2022', 'Second Semester', 133),
(479, '7', '310', '2022', 'Second Semester', 178),
(480, '7', '310', '2022', 'Second Semester', 174),
(481, '7', '310', '2022', 'Second Semester', 190),
(482, '7', '311', '2022', 'Second Semester', 174),
(483, '7', '311', '2022', 'Second Semester', 138),
(484, '7', '311', '2022', 'Second Semester', 133),
(485, '7', '311', '2022', 'Second Semester', 123),
(486, '7', '311', '2022', 'Second Semester', 134),
(487, '7', '311', '2022', 'Second Semester', 190),
(488, '7', '312', '2022', 'Second Semester', 100),
(489, '7', '312', '2022', 'Second Semester', 180),
(490, '7', '312', '2022', 'Second Semester', 132),
(491, '7', '312', '2022', 'Second Semester', 190),
(492, '7', '312', '2022', 'Second Semester', 105),
(493, '7', '312', '2022', 'Second Semester', 178),
(494, '7', '312', '2022', 'Second Semester', 168),
(495, '7', '312', '2022', 'Second Semester', 174),
(496, '7', '313', '2022', 'Second Semester', 100),
(497, '7', '313', '2022', 'Second Semester', 180),
(498, '7', '313', '2022', 'Second Semester', 132),
(499, '7', '313', '2022', 'Second Semester', 190),
(500, '7', '313', '2022', 'Second Semester', 105),
(501, '7', '313', '2022', 'Second Semester', 178),
(502, '7', '313', '2022', 'Second Semester', 168),
(503, '7', '313', '2022', 'Second Semester', 174),
(504, '7', '314', '2022', 'Second Semester', 190),
(505, '7', '314', '2022', 'Second Semester', 105),
(506, '7', '314', '2022', 'Second Semester', 100),
(507, '7', '314', '2022', 'Second Semester', 138),
(508, '7', '314', '2022', 'Second Semester', 178),
(509, '7', '314', '2022', 'Second Semester', 174),
(510, '7', '315', '2022', 'Second Semester', 174),
(511, '7', '315', '2022', 'Second Semester', 138),
(512, '7', '315', '2022', 'Second Semester', 133),
(513, '7', '315', '2022', 'Second Semester', 123),
(514, '7', '315', '2022', 'Second Semester', 134),
(515, '7', '315', '2022', 'Second Semester', 190),
(516, '7', '316', '2022', 'Second Semester', 100),
(517, '7', '316', '2022', 'Second Semester', 180),
(518, '7', '316', '2022', 'Second Semester', 133),
(519, '7', '316', '2022', 'Second Semester', 178),
(520, '7', '316', '2022', 'Second Semester', 174),
(521, '7', '316', '2022', 'Second Semester', 190),
(522, '7', '317', '2022', 'Second Semester', 100),
(523, '7', '317', '2022', 'Second Semester', 180),
(524, '7', '317', '2022', 'Second Semester', 132),
(525, '7', '317', '2022', 'Second Semester', 190),
(526, '7', '317', '2022', 'Second Semester', 105),
(527, '7', '317', '2022', 'Second Semester', 178),
(528, '7', '317', '2022', 'Second Semester', 168),
(529, '7', '317', '2022', 'Second Semester', 174),
(530, '7', '318', '2022', 'Second Semester', 190),
(531, '7', '318', '2022', 'Second Semester', 105),
(532, '7', '318', '2022', 'Second Semester', 100),
(533, '7', '318', '2022', 'Second Semester', 138),
(534, '7', '318', '2022', 'Second Semester', 178),
(535, '7', '318', '2022', 'Second Semester', 174),
(536, '7', '322', '2022', 'Second Semester', 100),
(537, '7', '322', '2022', 'Second Semester', 180),
(538, '7', '322', '2022', 'Second Semester', 133),
(539, '7', '322', '2022', 'Second Semester', 178),
(540, '7', '322', '2022', 'Second Semester', 174),
(541, '7', '322', '2022', 'Second Semester', 190),
(542, '7', '323', '2022', 'Second Semester', 100),
(543, '7', '323', '2022', 'Second Semester', 180),
(544, '7', '323', '2022', 'Second Semester', 132),
(545, '7', '323', '2022', 'Second Semester', 190),
(546, '7', '323', '2022', 'Second Semester', 105),
(547, '7', '323', '2022', 'Second Semester', 178),
(548, '7', '323', '2022', 'Second Semester', 168),
(549, '7', '323', '2022', 'Second Semester', 174),
(550, '7', '324', '2022', 'Second Semester', 188),
(551, '7', '325', '2022', 'First Semester', 100),
(552, '7', '325', '2022', 'First Semester', 180),
(553, '7', '325', '2022', 'First Semester', 133),
(554, '7', '325', '2022', 'First Semester', 178),
(555, '7', '325', '2022', 'First Semester', 174),
(556, '7', '325', '2022', 'First Semester', 190),
(557, '7', '327', '2022', 'Second Semester', 100),
(558, '7', '327', '2022', 'Second Semester', 180),
(559, '7', '327', '2022', 'Second Semester', 132),
(560, '7', '327', '2022', 'Second Semester', 190),
(561, '7', '327', '2022', 'Second Semester', 105),
(562, '7', '327', '2022', 'Second Semester', 178),
(563, '7', '327', '2022', 'Second Semester', 168),
(564, '7', '327', '2022', 'Second Semester', 174),
(565, '7', '328', '2022', 'Second Semester', 100),
(566, '7', '328', '2022', 'Second Semester', 180),
(567, '7', '328', '2022', 'Second Semester', 132),
(568, '7', '328', '2022', 'Second Semester', 190),
(569, '7', '328', '2022', 'Second Semester', 105),
(570, '7', '328', '2022', 'Second Semester', 178),
(571, '7', '328', '2022', 'Second Semester', 168),
(572, '7', '328', '2022', 'Second Semester', 174),
(573, '7', '329', '2022', 'Second Semester', 190),
(574, '7', '329', '2022', 'Second Semester', 105),
(575, '7', '329', '2022', 'Second Semester', 100),
(576, '7', '329', '2022', 'Second Semester', 138),
(577, '7', '329', '2022', 'Second Semester', 178),
(578, '7', '329', '2022', 'Second Semester', 174),
(579, '7', '332', '2022', 'Second Semester', 100),
(580, '7', '332', '2022', 'Second Semester', 180),
(581, '7', '332', '2022', 'Second Semester', 133),
(582, '7', '332', '2022', 'Second Semester', 178),
(583, '7', '332', '2022', 'Second Semester', 174),
(584, '7', '332', '2022', 'Second Semester', 190),
(585, '7', '334', '2022', 'Second Semester', 134),
(587, '7', '334', '2022', 'Second Semester', 148),
(588, '7', '334', '2022', 'Second Semester', 123),
(589, '7', '334', '2022', 'Second Semester', 174),
(590, '7', '334', '2022', 'Second Semester', 105),
(591, '7', '334', '2022', 'Second Semester', 190),
(592, '7', '335', '2022', 'Second Semester', 100),
(593, '7', '335', '2022', 'Second Semester', 180),
(594, '7', '335', '2022', 'Second Semester', 132),
(595, '7', '335', '2022', 'Second Semester', 190),
(596, '7', '335', '2022', 'Second Semester', 105),
(597, '7', '335', '2022', 'Second Semester', 178),
(598, '7', '335', '2022', 'Second Semester', 168),
(599, '7', '335', '2022', 'Second Semester', 174),
(600, '7', '337', '2023', 'First Semester', 190),
(601, '7', '337', '2023', 'First Semester', 105),
(602, '7', '337', '2023', 'First Semester', 100),
(603, '7', '337', '2023', 'First Semester', 138),
(604, '7', '337', '2023', 'First Semester', 178),
(605, '7', '337', '2023', 'First Semester', 174),
(606, '7', '338', '2022', 'Second Semester', 134),
(607, '7', '338', '2022', 'Second Semester', 148),
(608, '7', '338', '2022', 'Second Semester', 123),
(609, '7', '338', '2022', 'Second Semester', 174),
(610, '7', '338', '2022', 'Second Semester', 105),
(611, '7', '338', '2022', 'Second Semester', 190),
(613, '7', '339', '2022', 'First Semester', 180),
(614, '7', '352', '2022', 'Second Semester', 123),
(615, '7', '352', '2022', 'Second Semester', 134),
(616, '7', '352', '2022', 'Second Semester', 179),
(617, '7', '352', '2022', 'Second Semester', 178),
(618, '7', '352', '2022', 'Second Semester', 145),
(619, '7', '352', '2022', 'Second Semester', 105),
(620, '7', '352', '2022', 'Second Semester', 138),
(621, '7', '354', '2022', 'Second Semester', 134),
(622, '7', '354', '2022', 'Second Semester', 179),
(623, '7', '354', '2022', 'Second Semester', 145),
(624, '7', '354', '2022', 'Second Semester', 174),
(625, '7', '354', '2022', 'Second Semester', 138),
(626, '7', '354', '2022', 'Second Semester', 178),
(627, '7', '354', '2022', 'Second Semester', 123),
(628, '7', '456', '2022', 'Second Semester', 122),
(629, '7', '456', '2022', 'Second Semester', 139),
(630, '7', '456', '2022', 'Second Semester', 197),
(631, '7', '456', '2022', 'Second Semester', 133),
(632, '7', '456', '2022', 'Second Semester', 196),
(633, '7', '457', '2022', 'Second Semester', 195),
(634, '7', '457', '2022', 'Second Semester', 182),
(635, '7', '457', '2022', 'Second Semester', 109),
(636, '7', '457', '2022', 'Second Semester', 99),
(637, '7', '457', '2022', 'Second Semester', 141),
(638, '7', '457', '2022', 'Second Semester', 146),
(639, '7', '457', '2022', 'Second Semester', 149),
(640, '7', '458', '2022', 'Second Semester', 195),
(641, '7', '458', '2022', 'Second Semester', 182),
(642, '7', '458', '2022', 'Second Semester', 109),
(643, '7', '458', '2022', 'Second Semester', 99),
(644, '7', '458', '2022', 'Second Semester', 141),
(645, '7', '458', '2022', 'Second Semester', 146),
(646, '7', '458', '2022', 'Second Semester', 149),
(647, '7', '459', '2022', 'Second Semester', 116),
(648, '7', '459', '2022', 'Second Semester', 184),
(650, '7', '459', '2022', 'Second Semester', 173),
(651, '7', '459', '2022', 'Second Semester', 149),
(652, '7', '460', '2022', 'Second Semester', 147),
(653, '7', '460', '2022', 'Second Semester', 103),
(654, '7', '460', '2022', 'Second Semester', 131),
(655, '7', '460', '2022', 'Second Semester', 192),
(656, '7', '460', '2022', 'Second Semester', 153),
(657, '7', '460', '2022', 'Second Semester', 191),
(658, '7', '460', '2022', 'Second Semester', 141),
(659, '7', '461', '2022', 'Second Semester', 126),
(660, '7', '461', '2022', 'Second Semester', 118),
(661, '7', '461', '2022', 'Second Semester', 132),
(662, '7', '461', '2022', 'Second Semester', 124),
(664, '7', '461', '2022', 'Second Semester', 171),
(665, '7', '461', '2022', 'Second Semester', 149),
(666, '7', '120', '2022', 'Second Semester', 188),
(714, '7', '200', '2022', 'Second Semester', 100),
(715, '7', '200', '2022', 'Second Semester', 123),
(716, '7', '200', '2022', 'Second Semester', 134),
(717, '7', '200', '2022', 'Second Semester', 138),
(718, '7', '200', '2022', 'Second Semester', 145),
(719, '7', '200', '2022', 'Second Semester', 148),
(720, '7', '200', '2022', 'Second Semester', 174),
(721, '7', '200', '2022', 'Second Semester', 177),
(722, '7', '200', '2022', 'Second Semester', 178),
(723, '7', '200', '2022', 'Second Semester', 179),
(724, '7', '200', '2022', 'Second Semester', 180),
(725, '7', '200', '2022', 'Second Semester', 188);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `row` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `fn` text NOT NULL,
  `mn` text NOT NULL,
  `ln` text NOT NULL,
  `id` text NOT NULL,
  `dept` text NOT NULL,
  `image` text NOT NULL,
  `ay` text NOT NULL,
  `sem` text NOT NULL,
  `position` text NOT NULL,
  `signature` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`row`, `user`, `pass`, `fn`, `mn`, `ln`, `id`, `dept`, `image`, `ay`, `sem`, `position`, `signature`) VALUES
(120, '19-10014', '21232f297a57a5a743894a0e4a801fc3', 'Jonalyn', 'Balicuatro', 'Campos', '19-10014', '27', 'None', '2023', 'First Semester', 'Student', ''),
(199, '19-10118', '21232f297a57a5a743894a0e4a801fc3', 'Caisa', 'Amoguis', 'Cambaya', '19-10118', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(200, '19-10741', '23843b13f537a323e5ccb87e890ccbab', 'Marc Crisald', 'Peru', 'Cancio', '19-10741', '27', 'None', '2022', 'Second Semester', 'Student', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAArwAAAF8CAYAAAAtumhqAAAAAXNSR0IArs4c6QAAIABJREFUeF7t3Qu0dd09H A/6hqhIqFyqVuiGjSKSpAiHVHXiAShGNK4fW4VuQg62oaWIpIQ1SAucae VjTSuERLWiKppMjIhRAqEsFHokkQinT8kjV1ZmWfc/bZ9zX3s8Z4x/u 5 y91prPnOfs35prrjlfr2wECBAgQIAAAQIEBhZ4vYHLpmgECBAgQIAAAQIESuDVCAgQIECAAAECBIYWEHiHrl6FI0CAAAECBAgQEHi1AQIECBAgQIAAgaEFBN6hq1fhCBAgQIAAAQIEBF5tgAABAgQIECBAYGgBgXfo6lU4AgQIECBAgAABgVcbIECAAAECBAgQGFpA4B26ehWOAAECBAgQIEBA4NUGCBAgQIAAAQIEhhYQeIeuXoUjQIAAAQIECBAQeLUBAgQIECBAgACBoQUE3qGrV EIECBAgAABAgQEXm2AAAECBAgQIEBgaAGBd jqVTgCBAgQIECAAAGBVxsgQIAAAQIECBAYWkDgHbp6FY4AAQIECBAgQEDg1QYIECBAgAABAgSGFhB4h65ehSNAgAABAgQIEBB4tQECBAgQIECAAIGhBQTeoatX4QgQIECAAAECBARebYAAAQIECBAgQGBoAYF36OpVOAIECBAgQIAAAYFXGyBAgAABAgQIEBhaQOAdunoVjgABAgQIECBAQODVBggQIECAAAECBIYWEHiHrl6FI0CAAAECBAgQEHi1AQIECBAgQIAAgaEFBN6hq1fhCBAgQIAAAQIEBF5tgAABAgQIECBAYGgBgXfo6lU4AgQIECBAgAABgVcbIECAAAECBAgQGFpA4B26ehWOAAECBAgQIEBA4NUGCBAgQIAAAQIEhhYQeIeuXoUjQIAAAQIECBAQeLUBAgQIECBAgACBoQUE3qGrV EIECBAgAABAgQEXm2AAAECBAgQIEBgaAGBd jqVTgCBAgQIECAAAGBVxsgQIAAAQIECBAYWkDgHbp6FY4AAQIECBAgQEDg1QYIECBAgAABAgSGFhB4h65ehSNAgAABAgQIEBB4tQECBAgQIECAAIGhBQTeoatX4QgQIECAAAECBARebYAAAQIECBAgQGBoAYF36OpVOAIECBAgQIAAAYFXGyBAgAABAgQIEBhaQOAdunoVjgABAgQIECBAQODVBggQIECAAAECBIYWEHiHrl6FI0CAAAECBAgQEHi1AQIECBAgQIAAgaEFBN6hq1fhCBAgQIAAAQIEBF5tgAABAgQIECBAYGgBgXfo6lU4AgQIECBAgAABgVcbIECAAAECBAgQGFpA4B26ehWOAAECBAgQIEBA4NUGCBAgQIAAAQIEhhYQeIeuXoUjQIAAAQIECBAQeLUBAgQIECBAgACBoQUE3qGrV EIECBAgAABAgQEXm2AAAECBAgQIEBgaAGBd jqVTgCBAgQIECAAAGBVxsgQIAAAQIECBAYWkDgHbp6FY4AAQIECBAgQEDg1QYIECBAgAABAgSGFhB4h65ehSNAgAABAgQIEBB4tQECBAgQIECAAIGhBQTeoatX4QgQIECAAAECBARebYAAAQIECBAgQGBoAYF36OpVOAIECBAgQIAAAYFXGyBAgAABAgQIEBhaQOAdunoVjgABAgQIECBAQODVBggQIECAAAECBIYWEHiHrl6FI0CAAAECBAgQEHi1AQIECBAgQIAAgaEFBN6hq1fhCBAgQIAAAQIEBF5tgAABAgQIECBAYGgBgXfo6lU4AgQIECBAgAABgVcbIECAAAECBAgQGFpA4B26ehWOAAECBAgQIEBA4NUGCBAgQIAAAQIEhhYQeIeuXoUjQIAAAQIECBAQeLUBAgQIECBAgACBoQUE3qGrV EIECBAgAABAgQEXm2AAAECBAgQIEBgaAGBd jqVTgCBAgQIECAAAGBVxsgQIAAAQIECBAYWkDgHbp6FY4AAQIECBAgQEDg1QYIECBAgAABAgSGFhB4h65ehSNAgAABAgQIEBB4tQECBAgQIECAAIGhBQTeoatX4QgQIECAAAECBARebYAAAQIECBAgQGBoAYF36OpVOAIECBAgQIAAAYFXGyBAgAABAgQIEBhaQOAdunoVjgABAgQIECBAQODVBggQIECAAAECBIYWEHiHrl6FI0CAAAECBAgQEHi1AQIECBAgQIAAgaEFBN6hq1fhCBAgQIAAAQIEBF5tgAABAgQIECBAYGgBgXfo6lU4AgQIECBAgAABgVcbIECAAAECBAgQGFpA4B26ehWOAAECBAgQIEBA4NUGCBAgQIAAAQIEhhYQeIeuXoUjQIAAAQIECBAQeLUBAgQIECBAgACBoQUE3qGrV EIECBAgAABAgQEXm2AAAECBAgQIEBgaAGBd jqVTgCBAgQIECAAAGBVxsgQIAAAQIECBAYWkDgHbp6FY4AAQIECBAgQEDg1QYIECBAgAABAgSGFhB4h65ehSNAgAABAgQIEBB4tQECBAgQIECAAIGhBQTeoatX4QgQIECAAAECBARebYAAAQIECBAgQGBoAYF36OpVOAIECBAgQIAAAYFXGyBAgAABAgQIEBhaQOAdunoVjgABAgQIECBAQODVBggQIECAAAECBIYWEHiHrl6FI0CAAAECBAgQEHi1AQIECBAgQIAAgaEFBN6hq1fhCBAgQIAAAQIEBF5tgAABAgQIECBAYGgBgXfo6lU4AgQIECBAgAABgVcbIECAAAECBAgQGFpA4B26ehWOwN4E3rmq3riqfqOqXrm3o9gxAQIECBDYgYDAuwNEuyBwRgKfW1WPqKo3mcr8x1V1v6q68YwMFJUAAQIEFiYg8C6swpwugSMKvGtVPXfF8X  qt7/iOfl0AQIECBA4FIBgVcDIUBgHYG3rar/XFV3XvHi51XV31lnJ15zUgLvUFV/tOKMVn3tpE7cyRAgQOC6AgLvdcW8nsDpCyTI/M2qesuqyr/zJ1u 1v 5qCQZrvC3qurm0wveYHrfRa//q6p6QffNHCOhKX 34/7v7v99oMq/ 9fm9fPA1b6f8cLvdED dtxnV9VtrjDY92ldZdCs 3pu/97VuaUO23nk79 qqre/IDT39djqM 9vW77W9pev/Z q qVdnaj9ECBAYC4g8GoTBE5XoA qCa/ZWoDtw2S 9oqquuuBQtlLquoWHdufV1WGNexrayHr VWVh UOtbXjPquqbjvZzsP5oc9lFwbt4mPVxUZfnnmInl/EpM3FJaF3V1s7pz4Qt2CcQJzPrPy/D8 7Orb9ECAwsIDAO3DlKtrJCXzQFJpaD x7zgJq 3ofNC4rRHrFWjB4ZlW9RRcEWkhovWstSKwKCl9YVffveoJzzO oqr oqjeavv6GVfXfq phVXXvqvr22Yn5XXJyze1oJzRvx/P/t7sM7YIuf28Smn vqv50KmVr12nnrae4BWO9x0drCg5M4HQEfEidTl04k3EEPnj6AE gzb/bB/5FJcyt4fnt3v72bt/bdVlwvY5gQsd9qyphtwWPvP/JU6h94hU7e5XAex1ur11ToL8I7O9m9Hc7WkDOnYVckK27tQCcn638HP3MNCxDb/G6gl5HYMECAu CK8 pn4RAgmM gO85hdsE3H775e7Dtb8V2z50j1GIf1pVD50F3e qqi9b81ZxyvjTAu8xqs4xO4EWiNvfCcvt320I0Lpg XlsP5P5Oz 3L5rGsWfsuI0AgYULCLwLr0CnfxSBfKimdzTBr/VItdumCbXpOWofoEc5wQsOmnP9uum820seNQXd6zyZ/9iqSmhuW8p7t1MqqHM5e4FciKa9txDc/t5k6ETrAf7JqnpxVf1 VT1telDzprOXBkBgIQIC70IqymkeVSAfnhl/m5B3q6r6gOlsMk3Xj0y9osfssV0H5 uncbrttenRzXCG6wTd9t75cIZ7VNUT1jkJryFwZIF2RyYXrS0Qt3B83V7hFCUXey305u fqKqXdReV/RCk/O64WTcM49aTRX53ZGq/5xzZxuEJDC0g8A5dvQq3hUAC7sd0vbjZVQLuD1bV704fdFvs/mBvTUhPr257EC5jdBN0N50CKsMeMhyibXp3D1aVDrRngRZ8E4bvXlVZRfC9pz97PvSrd5 e5KdU1Uur6uemYRVC8CHkHeMsBATes6hmhVxDoPXiJuS22/V5mCw9uK0Xd2kPt S8M7Y4W8qSoJuvbbM9vqrSo9u2G6rqMdvs0HsJnLhAQm/mf/746Q7PfJz Pk8/v3Pa Pp9Hse CQwvIPAOX8UKeIlAC7kJgu1DLMHwO6ce3PReLm1rsy9kCEO2jC3Ov9Mzu 3mYbVtBb1/FIEWglOeDFP4hKr6s6r61dlUaW82FfhvTw/A3XF6sO4Pr9lz/DVV9SWj4CkHgWMICLzHUHfMYwskuGXe2fTmZssT2S3kbnqr/9hlyvFTngxfaFM4bTt8YV6mDGXog/OXVtVXn0LBnQOBhQrkd9HLpx7kBOf7VdWbV1WC8rvOynSvHdyhWSiT0yawvYDAu72hPSxDID2fCbkZrpBA2IYrJOguOeRGP VJ0O0DfHqtd9lDnWP85qyq71BVv76M6neWBBYnkOcIvq2qbj d VdU1b9cXCmcMIETERB4T6QinMbeBBLUWtBN6E1vbnoptx3LurcTvuaOU5aUrz2U9uXTEIZNZl 47NC5pfqQ7gUJ2A 85rl6OQEC1xPof 6eXVXvfr23ezUBAk1A4NUWRhWYB908 JGxrEvvzW31lVuhCZ2ZWilbhi k93ofD9Zl3GE bNuWp8jvahqlUX90lOuEBDJW OnT WTmhvzc2QgQ2EBA4N0AzVtOWiA9ne32fv59nRXETrpg08m18rWZJPJQWv69rx7rXDg8bHpCvfk8oqoevAQs50hg4QL9NICmAFx4ZTr94woIvMf1d/TdCbTVz9pDVVlBLD26  jx3N1ZX29P6dXNKmftobRtFo9Y98ifVVXf0r34xqq6z7pv9joCBLYSyBLebQaZDFfaxWwrW52QNxNYqoDAu9Sac95NoD2Mloe00p7T07npCmKnqtrK2D7s9t2r2zv8TlW93fSF9JxnHt5dPgx3qubOi8ApCPxQd3cly3f72TuFWnEOixQQeBdZbU56Esg0WQm3Iw5daJWc3tzHdWN1s9pbhjDs qG0VY3qe6vqk6dvPKOq3kfLI0DgoAJ94PV5fVB6BxtNwA/QaDV6HuXp54PN0IX0fB4iAB5aN2E varZDtmrm PNhzLcpaqedmgAxyNw5gLP7ebj9Xl95o1B8bcT8AO0nZ93H05gflt/5KAb1cwmcaeJ9xBjdfuazBKq6Vlqm1uph2vnjkSgF3hiVX349IV3HOyZBDVN4KACAu9BuR1sA4Hc0r/n1Iub0LuveWY3OLW9vKXv1c3iGPn/vmZgWFWA/qnwfD8PqOVBNRsBAocX6H8eXXge3t8RBxIQeAeqzMGKkieTs3b8G1bVW09L/2bWhVG3BPvMwNCeyD50r25c5z27N1TVY0YFVy4CCxDI74PM1JDNLA0LqDCneLoCAu/p1s25nlkWUsi41fyiz4wAX1VVvzLoGN1Wx3kILeOSE3qzEtyulwVepy3Nw27G62bcro0AgeMKvKiqbj1d9N/vuKfi6ASWKyDwLrfuRjvzBNz7TjMQZOqd9GaMPgVPhmikV/djpso8Rq9u3D 6qh7QNShz7S7vpytTx92rqv5kunDKz87oPz/Lq6XNzrjNxauHdzM/7yLwagGBV0M4tsCbVtV7VdUjq p9p/Gi57CwQYJmphtL6M1Y3YzV 84jVMZTqur9hN0jyO/mkOnxyx2Rt1yxu8yhnLD0Kbs5lL0cQSB3vFKH T1hiNERKsAhxxEQeMepy6WWpL Vnp7FRw/eM5UPrjZ/cOos8 pmCMOhV4S7 zT1WPzbpgdpGT9FGWqSi8L06LZV9y47c/W6jHpddZb9Q2vvVlXPWW5RnDmB4woIvMf1P/ej972Lv1BVH1lVNw2Mkt6a9OompGRe3TyEd ilQm9eVR829ajfdrLOhUZ6CX9 YPtRipZlnjNH8nU2gfc6Wqf12t uqvycPnV2J a0ztLZEFiAgMC7gEoa8BQzZjQ9ubeZypZb Q qqpcMWNZWpATb 0 3JvNgWh5Uy1y7h94SbNOj3LbYexDm0LVw/eOl/XxeVd1yxVufWVXPq6onVdVHVNWHVNWbTa/LhVXuKtiWJ9Df/frAqvofyyuCMyZwOgIC7 nUxbmcSR7QSuhqt2J/rqruOnDhEzbSq9tPN5awe gt5xH3/tjGBB66FjY73nxu5LaXH62qJ0xTx6V9Pbyq3rs7RAJweoMPPVxms1J6Vy/QT0eWqQHzs2ojQGALAYF3CzxvvbbA7adeqH7cYebYHbVnN E szC0B9MSNo/x5Px8jt8/rKrUxYjLMV 7UZ74G7LiXT/OOqebOwOfUVXPmO6MfP5sLK8hDCdeqWucXqv3/L7IghM2AgS2FBB4twT09msJfG9VfXL3jpFX8crqaFkhLreUM2wgvXTHCJj9bBChf/I0DdoxzuVajeXMX3yrqvrmqrr3zCFh9oerKg8d/rOqeouq supF/chVfXrVfXCM7dbcvFzcZOHWvOA2rOn6RmtdLjkGnXuJyMg8J5MVQx/IvkA//2ulHlA6kOr6uWDlTxjKL/vBHp153P8hjnz/B5jOMVgVbz34nxUVX3qrGc3t7Uzo0fG5 bOQXrtf3cKv kFFIr2Xi17P8AXVNWjpqNk NED935EByBwRgIC7xlV9gkU9VXdOWS84RedwDnt6hQSQPIhlTDyp9O4ylPp1U0vcx5UO8Y8v7vyPZf9pEf e6Yn81uZs9rg3 0WKMnXE4yO1b7OpS4OWc6nd OvDUk5pLxjnY2AwHs2VX3Ugt6iqv5rVWVarrb95NTDe9QT29HBE1IyVrctDZzQe4wHhVY9mHbMGSF2xHs2u0k7 sbpdnYK/eKqekFV3XkSaMNjMp3dMdrX2VTEAQv6LlX1/VPYTQfAs6rqxw94fIcicDYCAu/ZVPVRC5pxuxm/228Zn/g5Rz2r7Q8 HzaQnpmEkWOMj83FREJ3u6ho8/we63y21z2/PXx1VX3ximKry/HaQn53ZJrC9NL/5jRu96emi5zxSqtEBE5AQOA9gUo4g1PI/JH91GN/UlUfu/CejL5XN0sDH2sGhjSf9Chn6rO2pVc3QxiOMSPEGTTnvRQxQTeBt9 OueT0Xgppp68WyEVphj/ld8ixf3eoEgJnIyDwnk1VH7WgeXL8nbszeNr0BHpmMjhGb i2GOk1Te9MtmOPpUzQzodnW1zA L9ta/ew72/DUHIX5A2nQ/9ZVX1iVeXnwzaWQP/zeqxlxccSVRoCawoIvGtCedlWAo sqgdcsIf0QmYc262ncYkJAK9fVT9YVW9VVZndoc3bm3G/eW0bv5jekbepqj YVqD61SlAt9cnTF 0ylS lz/zsZC5fdxCeHtN9pE/t6uqb5h6aF5UVZ9dVT87fa 9px1vHuT3Eez7BQk8mLZVEz34m9PLd9/ZqnftJLL0808c/Ixe94AZe59pz/Izkp/FN5le8sbT19JD2X5 8nd Vt uqt68qn5teu3fnv7OktbZMitL/p2f0awG99LpNn7ee7PpNX88W2K8zeTyf6sqq8otccvvhUw31lY5zO/DPES6j98LS/RxzgT2LiDw7p3YAaZAmN6MLI9pu1igBey8og/r7esJAgkFCQDv0V0IvHJ62OUVW DmA3l zL8xhZeEmX6xkPn5tff2h  /tur7q041x88FzJ/PzmX 2v5c wuNqy465vvJ67PwSZvHdn6hNL9gmpfjqjKuKvdbTuGxXRjl2NneYPr7pmm6sXy9L dFF1IXOebrWYb4r6rqN6YwGtsEy2yp0yxAki2rs X//cVfXpe5YLNlgYsE1/beLZrZ1m9d4h2MUxr tHUF2AGBpQoIvEutuWWe9093S wuswT7Pet573IfmBK WuDN1 80nUpCbsbs/sWOTq0PVqsCbwuBfRicn2frEZ H0ct63HP66wTevCbBdN4zNg fbX XsawKvPNz7u8QXBV4ExhX3VF4o6pK0H3b6WQSbjOOPYEzxukVbVseYHrZ9J/5RUh7zTqOeW0Cb4LzSIH3wVX1iB219X3vZt6rm4v DGnQq7tvefsnsEJA4NUsDimQoJI5RT9u qBfdex8GGwypCG9TxkbnK0PXKtCQz9kYT6kofWm3naaReKTpn0 qao c3rIZB7o nL0gbEPh7tyTm9RLhyyPbWq3m9XO7afnQukrjJsIQ8Vpl3kgiXzT2cYT/7k5yEBt215cO1hOz LzXd4rCENv1NV79 ddv6fC4Nsj968OAd9Z o8Y tTx7mQTdA1JvugVeBgBF5bQODVIo4lcMeqevupByofChnDm/Xjn3OsE5qOm2CSB9LyAdXm1T2VGQ/6sJvAdLcjWzn86wqk/STkpv3Mp4jLmOt 68dg5 upTzNrLLtV9TMwpCRZ3TC/P/TqLrtenf0AAgLvAJWoCDsTSEhJ2M2H1qk9BJae3KdMJRV2d1blO9vRvDc3O84t7MzocVGIzVLbbVxsei4/b2dnY0eHFsjFcbtQzkWPqQEPXQOOR AKAYFXEyFQ9RFV9ZVT0M3MDwkp XNKW1ZgykNEGYLxjqd0Ymd8Lgk595x68NoDb6395Pb1Zauhffx0R6PxZT PP2PLpRZ9fkcoF8rpuT 13x9L9XXeBHYmIPDujNKOFiiQXrn0ymS83fOn1eBOcWWy9Oymh/eFVfVZVfVjC7Qe6ZRzJyABNe0mW0JOAm6mmVpnSMKnVtVjqirTe2X7mqr6kpGAzqQsaQeZaqyN0xV0z6TiFXOZAgLvMuvNWW8nkKCSD6o2xvKYSwJfVZJ nOd9qurGq97g 3sRWDU2N0MWEnSvs4BKwlEeOuyneTN2dy9Vtpedph186LQqXuowPfqp/za/7l4OaqcECGwvIPBub2gPyxDIB1V65RIg2wdVeuROsUe3F33V9J/vqKpPXwb1UGeZuwBt2EIKloCTdpM/lw1ZuAghPcAf1H0zS2z/8FBi4xYmbSEzL RC fem1SI3bQfjKikZgRMVEHhPtGKc1s4EEm7bilYJvQksCb3X6ZXb2clcc0dt3G7edoeqyhLNtv0LpJ18QFV9xXRxlN TCaqXPYC2zln1S1Ln9VmWWs/gOnLHfc38jtCxlxM/roajE1iogMC70Ipz2pcKrLr9/OQpsCxlLsx KMMSV5daYhNty/0m4ORC6bnTWNurHkBbp6wZ7/nY7oVpjzmO6arW0TvOa1I/GeOfnt1sGcKSC5RNevaPUwJHJUDgrwUEXo1hJIE2NVTCRbZtbz8fyyZLvT59OnhuoT5wjyfyplPvcWaq MEz/DDPxVGGGCTItGCTMJqQu6sn7ecLTOQht4RrwWmPDXuLXacdZIx/H3RzAfpLW zTWwkQOLKAwHvkCnD4rQVab24CS/8QScbWLfUDKqtvtYea9vkzOr9ASGXcMPVqbl0xJ76DNp1UevHaw4tXzZu7SZFWPaR2L6tubUK59/fMe3TNpbt3cgcgcDiBfX6YHq4UjnSOAm2d vTm5t/tifkE3aVu6W39gekhqZuqKrMyrDPN1Sbl/fCqeuKKN46 qEXCbVsgoBU/q2GlN3cfF0jpKc5Db20zbneT1rq/98zn0c2R0sOfHt19/eztrzT2TIDAhQICr8axNIH5U/MJEAkrI9wezkpb3zhVyCOq6sF7qpz5ogf/qaoyW0C2BO232dNxj7nbttxvu02dc9n3sq/zh9SM2z1mC3jtY6c3NxcibfhTaw/rzqV8OiVxJgQIrCUg8K7F5EUnIJCemHwYZbxlW81qyb25c9I7VtWzpy/uo5f1ZlX17lX1oKpK4M32tKp62LSk7T8aMPDOh7s08zwEuO/ppBKsM99u24zbPf4vkXax3O4K5YyWOs7/ JrOgMDCBATehVXYGZ5uvxpabsF/66DjH9t8u8 oqvfZcT2nN sLqioLHLSthep5b 8vVtV77fj4h97dfCq6HD Bsy0Zve ZEVY9pJY6cIv80C3hNeOz26p4bax22kIueDLcRJ0cvk4ckcBRBATeo7A76BoCbe7cfEjl4ZGElZF6dBvB/InwhN2E3m23i3o3f7Sqvqdbse1JVXX37mDfMI1x3fb4x3j/qvG57W7ArmZcuKpccc9FQ7 SmmnlrlLb7fdjnyE6nz N70 dtJCbgLuUqQl3q2JvBM5cQOA98wZwgsXPA0VtxoVzeEo6c7O2cYS7WGK2jU3M3/mgb9sLqirB6z9W1cumL/Zz/eZLL6yq251gm7jqlNpKaP343LbAyKEvkuYrqeVhytSFbb8CbbhC/m49uS a2ruQu197eyewCAGBdxHVdBYnmaCbAJaQNnKPbl Zfdi9cZqVYZPKbrfwE5z7nsXsK5ZtZbl 3/OhDPne11bVQzY5gSO9p784aqdwzCfsE65zZ6I/F4tL7KdxpJ3nQicBt7 gyIVOG6qgJ3c/9vZKYJECAu8iq22Yk25TAqVHty3724Yu7Huc5bER 8D5Y1WVhR uu83nDe3fnxkILnri/N9X1efODraU2 4JOm1asb4H 7LyXtd1k9enDWeRkLYleKWncfR2vInVJu J5Z2mgJuQ21/YGa6wiaj3EDgzAYH3zCr8RIo7D7r5wEovZALaOQSEzMiQ26y3msbSfnZVveQadZOe3IS duu2D1lXXTCkB3J mz 9y48 8Qd4Vg1baA i7XvGhauqJhcejxN2r2Ja /sJs2/fhdu08/7iJjvKnYv04ObPPuZPXvtkvZAAgWUICLzLqKdRzrItFpHesGwt6B7qgaJTcWwzMuR87jJND7bOuSVYpRdxPmxh3YUT8v48lNaP0/130wwO6xz/0K9ZtRpaziHDFhJyDz0 d1X5E8Yy/VgLZOnZTQ/kCPNCH6JPe24gAAAXKklEQVS 4xav1nubtj1v363Oc5GYcJu/z HC BD jkHgbAQE3rOp6qMWtAWX9OL2QfdcenR7/ISj9nDVujMy5ALh06rqPbodXXearQyheGRV3bbbxxOq6h5HbRmrD55g/glV9Ymz8qa9nNIiI/MZGRJ2c 56HC9uVAmzCbe5UGjz4a7qvU2ozUVDC7kn2EydEgECSxIQeJdUW8s711VDFxJaEnzPsYcm04F9ylSNN1TVY66o0gTdh85u527SK579ZOW21  OlzG76e29zlCKfbbAi2aXSG9ubluf2l2AVWFXz 7rtpA29vYDq re07f7gJuhCa3XNn 7WNjnT5l9EzhjAYH3jCt/z0XvZ13Iofa9jOuei7P17vspwH6gqj7pgj22 XPbjBX9y76mqr76mhcLq2ZjyEVHZmPIMsLH3C4Kua29pEf6mcc8wUvqKGN2W099QlvKcu7DGFrvbZsarJ8mLpSvqKosY52L3Tb29hwvfE wSTslAuMLCLzj1/GhSzifKirzkCa8nXPPTR864/D3L6iU9MTGbz6GMYb53iaB6llV9W7d8Y45Zjdhvq16lTA0v5XdLxl9ykGon37sXMfspu6yzHd6cPNnVX2m2aXt9mNvD/37yPEIECDwagGBV0PYlUB6uHL7vc0ckFvRCWnnHHRjmyCQcbttW/UzF7PMyTufdeGiOXTXrbOHV9WDuhd/R1V9 rpv3tHr2nypGa85L18OkSEabcjCqbeVN50W7/iiyeacenbbg2Ut3K56sCx1mXDb/px6fe6oidsNAQJLEBB4l1BLp32O SDMzAF90M14S5O V71fVT3lkrA7n7WivbQ9kNYe8tukBaRevq qbt29 SOr6omb7Oya72nDMq4KuW1aqWvu/mgv73vqE3ZjfMo90ZtCJcy23tt 5bL5/tK73YdbAXdTce8jQGDvAgLv3omHPUACbnp02ypH2/ZGjgb1T6rqUdNcuynbfGGHi3p10zOeoLjJ8IXecL64xCEWlkg4ypCMi4YrLHkFrD7sPr2q/sFADTZtMQE3P8ur5rxtPfEt3LbZE0YM wNVq6IQINALCLzaw3UF0nuXHt2EsmxLGXd53XJu /ofqqqEpGzPr6rbT/9uvZ/zWQfSqxvTXfSMJ2x/f1eAZ1RVpkDbx/be0/RhGZt7h9kBljRc4TKbb6mqz5pe8KNV9dH7gDzQPvsVy9Im73rBcXPh1c esO0F2IGK5zAECBBYLSDwahnrCuQ2Z1bpMpfu5WJZPe1Lq oB3cs rKp Yuo9y8XC/On1PNiTsLuLHrOE7Kyadsvp H9QVent3WZ4xKoS5zh374Jge00bx5lAnx7BJW8pY8rRhoWkPHdbUIH6B8vS5ubtrhWlDU3oA 6CiulUCRAgcLWAwHu1kVe8ZuhCHkBrT9Xn9niCwC4C2mi nzsFzFauz6uq750CZx C8/0Ejbjuolc3 8st6Ux31nqW87VvXRFKtzHPvhOgE z77eVVlbJnMYult4sEw7T5PiDmQuWB28Ad4L0t4LahCaseEmztrk0Ldgqr1R2AxiEIEDh3AYH33FvAxeXPh fHVlWe9M /2 3pNpSB3OsKzIPSs6vq86cg2IfQvHPX8xKnXh48m4IsPb3pbX7ZDiorAXBVL/GN01K/CcEjbKmnzHX8TlNhfr6q/k1V/diKwuWuxzFv9fdL8ibcrpo5Iafdz56QoHvMcx6hjSgDAQILFBB4F1hpBzjlfj7YP6mqr62q9AT5oLwcP0Hpi7uXpBf8Q2Yh9KVV9SVrrLJ2nWr qKr6ptmywQmi97nOTla89s7TMrAZwzrfcns/Pf1LH7bQl u/VNVHTF9IPWWoSS5M5mXMxUV66//e9DORXvx9zn6RINsvyZt/XzQ8oZUnD5G2hwRHqqMtm7S3EyBwrgIC77nW/Opyz5eyzSwDCW2C7tXt5JOr6tur6o2nlz5peoir73VLj  7X72rtV ROXYTdudP1ifgZBnXhLbrbu9cVR86DYu4KFTllnnC4ChbG9 aXuy2Jfj2vbrp c3FTB7Sm2/fVlWfWVX3qKq3m8b8Zsz271XVb3Qvzp2SO3X1lf vGnaQr/d/1nHOQ2b9Ag9LH1ayTpm9hgABAmsLCLxrUw39wvRYZYxiG6Ob3qF8zbya61X7/EGxV1bV785uMafHNUMMdtXb9piq rSqeoPZKf6vC0LZqpK0QPsuU0hLyLtouq0c77nTBdB6Kst5VT jxounWSdeMF3o5Wfif66YgaIvXS4s3qiqbraiyH8xLY98i0uGHFxHKsMT8nPZ/rQpwq6zD68lQIDA2QkIvGdX5a9V4PlStubSvX57SGjMw1r9GN0/noWfXQwv6M9svnpbvpfgkyEGj6 ql8yKkbD1/lNou11V/eOqSihf1VvZvzU90gnpv1hVGcs64tbPr7uqfH/W9dofo/z5mUy4/dmq il3W45RBY5JgMAIAgLvCLV4/TKk9za3b9vt9l3PFnD9M1rmO64KSylVVjv7FzsOKlmquB9ukHl2P6Prkc/3UrdZ6S2zKdzrGrwJuWkPGZc6 lCWj6uqXIwcY0tPbXzb0IPW85//J C2v49xbo5JgACB4QQE3uGq9NICZexlhi60oKtHd/P6f0hV/esrev/2tbpZwtJbdKeeBQQydvhTq oTNrh1ftM01CLh71gBcPOa2Pydf1hV6f3e95ZZMh47BdmE3BZo931c ydAgACBSUDgPY mkAdj gUP0oOXKabMwblZ/adnN2Na25jnVXvJA2zpdd31louWx22x04Tbp1bVb1dVC7q7Gle8xWkd/K0Z1pEHy67aMgb3V6YLgmdV1dOqKhc7Wc3usu3Pq qHq qRVfULVx3E9wkQIEBgvwIC7359j733BLL0LCUkZUvPYAu6nuLerHZWjdmd72lfPbs5ToZIZHGJdbc8PJdpxdKzmIevnrPuGwd/3UWB93eq6gOr6i nnvL5xUB6hNMzfNGWi4iMe049/drghopHgACBxQgIvIupqmufaD/FWIJuenMTdgXda1O 1hvSy/dul yizU27r17Tr5rm8b2sFHloLVNqZVo5vYsXS2UFvEwn17Y8bJiH 555Ce5FgTcPt XnK2F3Fwt9bNdKvZsAAQIEXktA4B2vQaQHMsMX2vyemTg/H8SjP4C075pM0HleVb31JQc6xPKzeQgtD63NQ3eGqaQHN/PjJuzOZ2rYt89S93 bqrpnVeVhvcxlu86WB/qyAuGbTMNCMmwhi47YCBAgQOBEBQTeE62YDU8rvbj58M5QBjMvbIi44m3/cAqSb3XJLrOq2SEf LrjNL1Y6vp7qur5uyuuPa0pcAfDFtaU8jICBAgcWUDgPXIF7ODwCTwfO/U4taCb1dHyx7adQHp184BYxnRetGXRgcyO8ITtDuXdBAgQIECAwL4EBN59yR5mv3kY7f7TnKx/Os0cYCng3dn/86r6yhW7y3jNLMTw/VX1rbs7nD0RIECAAAEC xAQePehuv99zqcZy3y6Cb/G6e7WPlNQve9sl s82LTbs7A3AgQIECBAYCsBgXcrvoO/OUMW8mBUVkpr2z6nwDp4AU/kgFmYI8sF3zBb4OFVVfVp5i8 kVpyGgQIECBAYE0BgXdNqBN4WYYu9ONy06ub4JtVm2y7E3hAVeXP7VbsMvOv3nJ3h7InAgQIECBA4BACAu8hlLc7xnw54LZ4hIfStnPt390e/Lt7VX3iJbv97qq67 4Oa08ECBAgQIDAIQQE3kMob3aM Tjd7CVzrGZBCWN1NzO96F15AO0uV wyS8zeo6p fLeHtjcCBAgQIEBg3wIC776Fr7//VeN0M6duWxL4 nv0jssELlpidv6e xm7qyERIECAAIFlCgi8p1VvGaebYJvQ27YsD2tJ4P3V01WBN8vEZvlZ8 zurw7smQABAgQI7FVA4N0r79o7ny8HnDemVzcPpf3M2nvxwk0FnlRVGb/bb3kYMEv0PrqqXrjpjr2PAAECBAgQOL6AwHvcOsj0Vw dTTOWM8pUY3ko7Y Oe3pndfTbVNXNq r1q o5Z1VyhSVAgAABAoMLCLzHq DMvvDY2fAFU40drz4cmQABAgQIEBhUQOA9fMWmVzeLRyTwts1UY4evB0ckQIAAAQIEzkRA4D1sRa96KO3J01RjFpA4bF04GgECBAgQIHAmAgLvYSo6vboZvpCH0/TqHsbcUQgQIECAAAECrxYQePffEFaN1U2vbmZgsIDE/v0dgQABAgQIEDhzAYF3fw0gc mmV9dY3f0Z2zMBAgQIECBA4EoBgfdKoo1ekKELCbsZytC2zMCQ8KtXdyNSbyJAgAABAgQIbCYg8G7mdtm7Mq9uVkbrt8yrO//a7o9sjwQIECBAgAABAq8jIPDurlFkCMNPV9V7znp1M1bXDAy7c7YnAgQIECBAgMC1BATea3Fd OIMVXjc7LuPmnp1rZa2G2N7IUCAAAECBAhsJCDwbsT2129atTTwb03z6v7Idrv2bgIECBAgQIAAgV0ICLybK2bowpOq6pbdLr5r6tX1YNrmrt5JgAABAgQIENipgMC7Gee3VdW9q qturc/oKq frPdeRcBAgQIECBAgMC BATe68nevqr bVV9fPe2Z1fVp3gw7XqQXk2AAAECBAgQOJSAwLu dGZbyNy6/faYqrph/V14JQECBAgQIECAwKEFBN71xDOHbubX7bcMX8gwBhsBAgQIECBAgMAJCwi8V1dOenXTu9tv96mqG69 q1cQIECAAAECBAgcW0DgvbwGvm6aYqy9KuN1H15V33nsinN8AgQIECBAgACB9QQE3oud8mDaD82 fbeq pn1aL2KAAECBAgQIEDgFAQE3tW18MHTMsH9d798mmP3FOrNORAgQIAAAQIECKwpIPC LlTC7uOr6ubTt15YVd8u7K7ZoryMAAECBAgQIHBiAgLva1fIx1RVxu1myeBsN1XVo4XdE2u1TocAAQIECBAgcA0Bgff/Y31UVX33bPU0szFcozF5KQECBAgQIEDgFAUE3tfUyodXVRaRuG1XSRmz 6iqeukpVpxzIkCAAAECBAgQWE9A4H2N0292wxjy/zaMIUMabAQIECBAgAABAgsWEHhfs1xwv7DET1XVhyy4Tp06AQIECBAgQIBAJ3DugXc /VgWlrh3VT1PKyFAgAABAgQIEBhD4JwD7y2q6pdn43ZvmMbyjlG7SkGAAAECBAgQIFDnHHjnQxlurKr7V9WLtQsCBAgQIECAAIFxBM418H7hNN9uX5OmIBunXSsJAQIECBAgQOCvBc4x8H5ZVT101gay2MQDtQsCBAgQIECAAIHxBM4t8M4fUkuNvrKqblVVrxivepWIAAECBAgQIEDg3ALvfNxuWsDXV9UDNAUCBAgQIECAAIExBc4p8L7DtMBEX5NPq6q7jFm1SkWAAAECBAgQIBCBcwq8D6 qB82qPcsHZ0yvjQABAgQIECBAYFCBcwq8/6qqEnDb9vtV9Z6mIRu0ZSsWAQIECBAgQGASOKfAe7eq m9dzX9zVX2OlkCAAAECBAgQIDC2wDkF3tTkU6vqzlX1sqq6fVXdNHb1Kh0BAgQIECBAgMC5Bd5vqqrPPsPebS2dAAECBAgQIHC2AucWeFPRn1FV/6GqXn62ta7gBAgQIECAAIEzEjjHwHtG1auoBAgQIECAAAECAq82QIAAAQIECBAgMLSAwDt09SocAQIECBAgQICAwKsNECBAgAABAgQIDC0g8A5dvQpHgAABAgQIECAg8GoDBAgQIECAAAECQwsIvENXr8IRIECAAAECBAgIvNoAAQIECBAgQIDA0AIC79DVq3AECBAgQIAAAQICrzZAgAABAgQIECAwtIDAO3T1KhwBAgQIECBAgIDAqw0QIECAAAECBAgMLSDwDl29CkeAAAECBAgQICDwagMECBAgQIAAAQJDCwi8Q1evwhEgQIAAAQIECAi82gABAgQIECBAgMDQAgLv0NWrcAQIECBAgAABAgKvNkCAAAECBAgQIDC0gMA7dPUqHAECBAgQIECAgMCrDRAgQIAAAQIECAwtIPAOXb0KR4AAAQIECBAgIPBqAwQIECBAgAABAkMLCLxDV6/CESBAgAABAgQICLzaAAECBAgQIECAwNACAu/Q1atwBAgQIECAAAECAq82QIAAAQIECBAgMLSAwDt09SocAQIECBAgQICAwKsNECBAgAABAgQIDC0g8A5dvQpHgAABAgQIECAg8GoDBAgQIECAAAECQwsIvENXr8IRIECAAAECBAgIvNoAAQIECBAgQIDA0AIC79DVq3AECBAgQIAAAQICrzZAgAABAgQIECAwtIDAO3T1KhwBAgQIECBAgIDAqw0QIECAAAECBAgMLSDwDl29CkeAAAECBAgQICDwagMECBAgQIAAAQJDCwi8Q1evwhEgQIAAAQIECAi82gABAgQIECBAgMDQAgLv0NWrcAQIECBAgAABAgKvNkCAAAECBAgQIDC0gMA7dPUqHAECBAgQIECAgMCrDRAgQIAAAQIECAwtIPAOXb0KR4AAAQIECBAgIPBqAwQIECBAgAABAkMLCLxDV6/CESBAgAABAgQICLzaAAECBAgQIECAwNACAu/Q1atwBAgQIECAAAECAq82QIAAAQIECBAgMLSAwDt09SocAQIECBAgQICAwKsNECBAgAABAgQIDC0g8A5dvQpHgAABAgQIECAg8GoDBAgQIECAAAECQwsIvENXr8IRIECAAAECBAgIvNoAAQIECBAgQIDA0AIC79DVq3AECBAgQIAAAQICrzZAgAABAgQIECAwtIDAO3T1KhwBAgQIECBAgIDAqw0QIECAAAECBAgMLSDwDl29CkeAAAECBAgQICDwagMECBAgQIAAAQJDCwi8Q1evwhEgQIAAAQIECAi82gABAgQIECBAgMDQAgLv0NWrcAQIECBAgAABAgKvNkCAAAECBAgQIDC0gMA7dPUqHAECBAgQIECAgMCrDRAgQIAAAQIECAwtIPAOXb0KR4AAAQIECBAgIPBqAwQIECBAgAABAkMLCLxDV6/CESBAgAABAgQICLzaAAECBAgQIECAwNACAu/Q1atwBAgQIECAAAECAq82QIAAAQIECBAgMLSAwDt09SocAQIECBAgQICAwKsNECBAgAABAgQIDC0g8A5dvQpHgAABAgQIECAg8GoDBAgQIECAAAECQwsIvENXr8IRIECAAAECBAgIvNoAAQIECBAgQIDA0AIC79DVq3AECBAgQIAAAQICrzZAgAABAgQIECAwtIDAO3T1KhwBAgQIECBAgIDAqw0QIECAAAECBAgMLSDwDl29CkeAAAECBAgQICDwagMECBAgQIAAAQJDCwi8Q1evwhEgQIAAAQIECAi82gABAgQIECBAgMDQAgLv0NWrcAQIECBAgAABAgKvNkCAAAECBAgQIDC0gMA7dPUqHAECBAgQIECAgMCrDRAgQIAAAQIECAwtIPAOXb0KR4AAAQIECBAgIPBqAwQIECBAgAABAkMLCLxDV6/CESBAgAABAgQICLzaAAECBAgQIECAwNACAu/Q1atwBAgQIECAAAECAq82QIAAAQIECBAgMLSAwDt09SocAQIECBAgQICAwKsNECBAgAABAgQIDC0g8A5dvQpHgAABAgQIECAg8GoDBAgQIECAAAECQwsIvENXr8IRIECAAAECBAgIvNoAAQIECBAgQIDA0AIC79DVq3AECBAgQIAAAQICrzZAgAABAgQIECAwtIDAO3T1KhwBAgQIECBAgIDAqw0QIECAAAECBAgMLSDwDl29CkeAAAECBAgQICDwagMECBAgQIAAAQJDCwi8Q1evwhEgQIAAAQIECAi82gABAgQIECBAgMDQAgLv0NWrcAQIECBAgAABAv8PViGv1/tIiuwAAAAASUVORK5CYII='),
(201, 'Cherry ', '21232f297a57a5a743894a0e4a801fc3', 'Cherry Mae', 'Tabugon', 'Umacob', '19-10406', '27', 'None', '2023', 'First Semester', 'Student', ''),
(202, '22-10309', '21232f297a57a5a743894a0e4a801fc3', 'Alyza', 'Suico', 'Cambaya', '22-10309', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(203, '22-10803', '21232f297a57a5a743894a0e4a801fc3', 'Darsy', 'Escobal', 'Abad', '22-10803', '24', 'None', '2023', 'First Semester', 'Student', ''),
(204, '19-10192', '21232f297a57a5a743894a0e4a801fc3', 'Rosemarie', '', 'Canico', '19-10192', '27', 'None', '2023', 'First Semester', 'Student', ''),
(205, '19-10573', '21232f297a57a5a743894a0e4a801fc3', 'Jocel', '', 'Antigo', '19-10573', '25', 'None', '2023', 'First Semester', 'Student', ''),
(206, '19-10580', '21232f297a57a5a743894a0e4a801fc3', 'Jona', 'Astillo', 'Sajut', '19-10580', '25', 'None', '2023', 'First Semester', 'Student', ''),
(211, '20-10237', '21232f297a57a5a743894a0e4a801fc3', 'Ueriel', 'A', 'Basco', '20-10237', '24', 'None', '2023', 'First Semester', 'Student', ''),
(213, '19-10117', '21232f297a57a5a743894a0e4a801fc3', 'Jhariza', 'Biton', 'Sampang', '19-10117', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(214, '19-10802', '21232f297a57a5a743894a0e4a801fc3', 'Jennifer', '', 'Sumalinog', '19-10802', '27', 'None', '2023', 'First Semester', 'Student', ''),
(215, '22-10604', '21232f297a57a5a743894a0e4a801fc3', 'Mervin John', 'Doming', 'Buemia', '22-10604', '25', 'None', '2023', 'First Semester', 'Student', ''),
(216, '22-10707', '21232f297a57a5a743894a0e4a801fc3', 'Sheena Mae', '', 'AÃ±ora', '22-10707', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(217, '22-10494', '21232f297a57a5a743894a0e4a801fc3', 'Nicole', '', 'Abonita', '22-10494', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(218, '22-10817', '21232f297a57a5a743894a0e4a801fc3', 'Shandy Mark', '', 'Alcordo', '22-10817', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(219, '22-10706', '21232f297a57a5a743894a0e4a801fc3', 'Athia', '', 'Alvarez', '22-10706', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(220, '22-10708', '21232f297a57a5a743894a0e4a801fc3', 'Jamica', '', 'Alvarez', '22-10708', '27', 'None', '2023', 'First Semester', 'Student', ''),
(221, '22-10498', '21232f297a57a5a743894a0e4a801fc3', 'John Marvin', '', 'Amolo', '22-10498', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(222, '21-10340', '21232f297a57a5a743894a0e4a801fc3', 'Louie Jim', '', 'Amolo', '21-10340', '27', 'None', '2023', 'First Semester', 'Student', ''),
(223, '22-10627', '21232f297a57a5a743894a0e4a801fc3', 'Jheno', '', 'Amora', '22-10627', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(224, '21-10279', '21232f297a57a5a743894a0e4a801fc3', 'Rosbelle', '', 'Anajao', '21-10279', '27', 'None', '2023', 'First Semester', 'Student', ''),
(225, '22-10182', '21232f297a57a5a743894a0e4a801fc3', 'Emilson', '', 'BaiÃ±o', '22-10182', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(226, '22-10269', '21232f297a57a5a743894a0e4a801fc3', 'Aresh', '', 'Balabis', '22-10269', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(227, '22-10781', '21232f297a57a5a743894a0e4a801fc3', 'Nico', '', 'Balili', '22-10781', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(228, '19-10794', '21232f297a57a5a743894a0e4a801fc3', 'Vince Kyle', '', 'Berondo', '19-10794', '27', 'None', '2023', 'First Semester', 'Student', ''),
(229, '21-10500', '21232f297a57a5a743894a0e4a801fc3', 'Christian Jay', '', 'Bulilan', '21-10500', '27', 'None', '2023', 'First Semester', 'Student', ''),
(230, '19-10487', '21232f297a57a5a743894a0e4a801fc3', 'Emma', '', 'Bungcaras', '19-10487', '27', 'None', '2023', 'First Semester', 'Student', ''),
(231, '21-20002', '21232f297a57a5a743894a0e4a801fc3', 'Royal Hanz Efren', '', 'Caca', '21-20002', '27', 'None', '2023', 'First Semester', 'Student', ''),
(232, '18-10343', '21232f297a57a5a743894a0e4a801fc3', 'Marco Lino', '', 'Calas', '18-10343', '27', 'None', '2023', 'First Semester', 'Student', ''),
(233, '19-10055', '21232f297a57a5a743894a0e4a801fc3', 'Jezrael', '', 'Calonia', '19-10055', '27', 'None', '2023', 'First Semester', 'Student', ''),
(234, '22-10662', '21232f297a57a5a743894a0e4a801fc3', 'Danica', '', 'Campado', '22-10662', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(235, '22-10092', '21232f297a57a5a743894a0e4a801fc3', 'Althea Marianne', '', 'CariÃ±o', '22-10092', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(236, '22-10375', '21232f297a57a5a743894a0e4a801fc3', 'Allan Dave', '', 'Cincollagas', '22-10375', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(237, '20-10114', '21232f297a57a5a743894a0e4a801fc3', 'Iven Christian', '', 'Comanda', '20-10114', '27', 'None', '2023', 'First Semester', 'Student', ''),
(238, '22-10444', '21232f297a57a5a743894a0e4a801fc3', 'Merrynel', '', 'Conson', '22-10444', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(239, '22-10220', '21232f297a57a5a743894a0e4a801fc3', 'Arem-Paul', '', 'Costillas', '22-10220', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(240, '22-10572', '21232f297a57a5a743894a0e4a801fc3', 'Jhun Carl', '', 'Daguplo', '22-10572', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(241, '22-20004', '21232f297a57a5a743894a0e4a801fc3', 'Mona Arabella', '', 'Dangate', '22-20004', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(242, '22-10032', '21232f297a57a5a743894a0e4a801fc3', 'Zyira Mae', '', 'Dawat', '22-10032', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(243, '22-10509', '21232f297a57a5a743894a0e4a801fc3', 'Ma.Stella', '', 'Dayok', '22-10509', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(244, '21-10034', '21232f297a57a5a743894a0e4a801fc3', 'Krisna Mae', '', 'Dellosa', '21-10034', '27', 'None', '2023', 'First Semester', 'Student', ''),
(245, '22-10376', '21232f297a57a5a743894a0e4a801fc3', 'Rusty', '', 'Diaz', '22-10376', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(246, '22-10694', '21232f297a57a5a743894a0e4a801fc3', 'Mellyville John', '', 'Edera', '22-10694', '27', 'None', '2023', 'First Semester', 'Student', ''),
(247, '22-10640', '21232f297a57a5a743894a0e4a801fc3', 'Mharlou', '', 'Escobido', '22-10640', '27', 'None', '2023', 'First Semester', 'Student', ''),
(248, '22-10041', '21232f297a57a5a743894a0e4a801fc3', 'Cleaford', '', 'Espedilla', '22-10041', '27', 'None', '2023', 'First Semester', 'Student', ''),
(249, '22-10278', '21232f297a57a5a743894a0e4a801fc3', 'Earl', '', 'Espina', '22-10278', '27', 'None', '2023', 'First Semester', 'Student', ''),
(250, '22-10387', '21232f297a57a5a743894a0e4a801fc3', 'Marjorie', '', 'Espino', '22-10387', '27', 'None', '2023', 'First Semester', 'Student', ''),
(251, '22-10234', '21232f297a57a5a743894a0e4a801fc3', 'Crystal Jade', '', 'Esteban', '22-10234', '27', 'None', '2023', 'First Semester', 'Student', ''),
(252, '22-20021', '21232f297a57a5a743894a0e4a801fc3', 'Raniel', '', 'Fajardo', '22-20021', '27', 'None', '2023', 'First Semester', 'Student', ''),
(253, '19-10388', '21232f297a57a5a743894a0e4a801fc3', 'Dane Clyde', '', 'Fegi', '19-10388', '27', 'None', '2023', 'First Semester', 'Student', ''),
(254, '22-10040', '21232f297a57a5a743894a0e4a801fc3', 'Alexis Aizel', '', 'Figueroa', '22-10040', '27', 'None', '2023', 'First Semester', 'Student', ''),
(255, '22-10179', '21232f297a57a5a743894a0e4a801fc3', 'Emmanuel', '', 'Flores', '22-10179', '27', 'None', '2023', 'First Semester', 'Student', ''),
(256, '22-10175', '21232f297a57a5a743894a0e4a801fc3', 'NiÃ±a Jane', '', 'Gabon', '22-10175', '27', 'None', '2023', 'First Semester', 'Student', ''),
(257, '22-10511', '21232f297a57a5a743894a0e4a801fc3', 'Jennelyn', '', 'Gamo', '22-10511', '27', 'None', '2023', 'First Semester', 'Student', ''),
(258, '19-10514', '21232f297a57a5a743894a0e4a801fc3', 'Jerameel', '', 'Gamo', '19-10514', '27', 'None', '2023', 'First Semester', 'Student', ''),
(259, '22-10768', '21232f297a57a5a743894a0e4a801fc3', 'Leoralph Von', '', 'Gases', '22-10768', '27', 'None', '2023', 'First Semester', 'Student', ''),
(260, '22-10492', '21232f297a57a5a743894a0e4a801fc3', 'Amelyn', '', 'Gatab', '22-10492', '27', 'None', '2023', 'First Semester', 'Student', ''),
(261, '22-10497', '21232f297a57a5a743894a0e4a801fc3', 'Maria Antonette', '', 'Gilla', '22-10497', '27', 'None', '2023', 'First Semester', 'Student', ''),
(262, '22-10050', '21232f297a57a5a743894a0e4a801fc3', 'Carl Bryll', '', 'Gonzaga', '22-10050', '27', 'None', '2023', 'First Semester', 'Student', ''),
(263, '22-10557', '21232f297a57a5a743894a0e4a801fc3', 'Jireh Lean', '', 'Gonzales', '22-10557', '27', 'None', '2023', 'First Semester', 'Student', ''),
(264, '20-10021', '21232f297a57a5a743894a0e4a801fc3', 'Cres Zuriel', '', 'Goring', '20-10021', '27', 'None', '2023', 'First Semester', 'Student', ''),
(265, '22-10523', '21232f297a57a5a743894a0e4a801fc3', 'Regina Carmel', '', 'Gorzon', '22-10523', '27', 'None', '2023', 'First Semester', 'Student', ''),
(267, '21-10341', '21232f297a57a5a743894a0e4a801fc3', 'Jefrey', '', 'Hatud', '21-10341', '27', 'None', '2023', 'First Semester', 'Student', ''),
(268, '22-10577', '21232f297a57a5a743894a0e4a801fc3', 'Jessa Rae', '', 'Humamoy', '22-10577', '27', 'None', '2023', 'First Semester', 'Student', ''),
(269, '22-10012', '21232f297a57a5a743894a0e4a801fc3', 'Leah', '', 'Ignacio', '22-10012', '27', 'None', '2023', 'First Semester', 'Student', ''),
(270, '19-10236', '21232f297a57a5a743894a0e4a801fc3', 'Rey James', '', 'Jamelo', '19-10236', '27', 'None', '2023', 'First Semester', 'Student', ''),
(271, '22-10463', '21232f297a57a5a743894a0e4a801fc3', 'Cyrel John', '', 'Lacano', '22-10463', '27', 'None', '2023', 'First Semester', 'Student', ''),
(272, '22-10712', '21232f297a57a5a743894a0e4a801fc3', 'Roland', '', 'Laplap', '22-10712', '27', 'None', '2023', 'First Semester', 'Student', ''),
(273, '22-10615', '21232f297a57a5a743894a0e4a801fc3', 'Jeralden', '', 'Lavistra', '22-10615', '27', 'None', '2023', 'First Semester', 'Student', ''),
(274, '22-10205', '21232f297a57a5a743894a0e4a801fc3', 'Gleneece', '', 'Libot', '22-10205', '27', 'None', '2023', 'First Semester', 'Student', ''),
(275, '22-10650', '21232f297a57a5a743894a0e4a801fc3', 'Jherson', '', 'Ligas', '22-10650', '27', 'None', '2023', 'First Semester', 'Student', ''),
(276, '22-10570', '21232f297a57a5a743894a0e4a801fc3', 'Hannah Joyce', '', 'Lombres', '22-10570', '27', 'None', '2023', 'First Semester', 'Student', ''),
(277, '22-10005', '21232f297a57a5a743894a0e4a801fc3', 'Vienne Zenia', '', 'Luego', '22-10005', '27', 'None', '2023', 'First Semester', 'Student', ''),
(278, '22-10484', '21232f297a57a5a743894a0e4a801fc3', 'Mark Aron', '', 'Magboo', '22-10484', '27', 'None', '2023', 'First Semester', 'Student', ''),
(279, '20-10169', '21232f297a57a5a743894a0e4a801fc3', 'Barry Neil', '', 'Magcosta', '20-10169', '27', 'None', '2023', 'First Semester', 'Student', ''),
(280, '22-10384', '21232f297a57a5a743894a0e4a801fc3', 'Mark Allen', '', 'Magcosta', '22-10384', '27', 'None', '2023', 'First Semester', 'Student', ''),
(281, '19-10243', '21232f297a57a5a743894a0e4a801fc3', 'Paul', '', 'Malaki', '19-10243', '27', 'None', '2023', 'First Semester', 'Student', ''),
(282, '21-10027', '21232f297a57a5a743894a0e4a801fc3', 'Dynafe', '', 'Malubay', '21-10027', '27', 'None', '2023', 'First Semester', 'Student', ''),
(283, '22-10333', '21232f297a57a5a743894a0e4a801fc3', 'Mark John Dave', '', 'Mamac', '22-10333', '27', 'None', '2023', 'First Semester', 'Student', ''),
(284, '22-10531', '21232f297a57a5a743894a0e4a801fc3', 'James Kim Philip', '', 'Managa', '22-10531', '27', 'None', '2023', 'First Semester', 'Student', ''),
(285, '22-10733', '21232f297a57a5a743894a0e4a801fc3', 'Joel', '', 'Manlao', '22-10733', '27', 'None', '2023', 'First Semester', 'Student', ''),
(286, '18-20003', '21232f297a57a5a743894a0e4a801fc3', 'Jonathan', '', 'Mantilla', '18-20003', '27', 'None', '2023', 'First Semester', 'Student', ''),
(287, '22-10773', '21232f297a57a5a743894a0e4a801fc3', 'Angelica', '', 'Mecate', '22-10773', '27', 'None', '2023', 'First Semester', 'Student', ''),
(288, '21-10222', '21232f297a57a5a743894a0e4a801fc3', 'Catherine', '', 'Medilo', '21-10222', '27', 'None', '2023', 'First Semester', 'Student', ''),
(289, '22-10021', '21232f297a57a5a743894a0e4a801fc3', 'Jerald', '', 'Mernilo', '22-10021', '27', 'None', '2023', 'First Semester', 'Student', ''),
(290, '22-10020', '21232f297a57a5a743894a0e4a801fc3', 'Jerold', '', 'Mernilo', '22-10020', '27', 'None', '2023', 'First Semester', 'Student', ''),
(291, '22-10172', '21232f297a57a5a743894a0e4a801fc3', 'Nathalie Jean', '', 'Misa', '22-10172', '27', 'None', '2023', 'First Semester', 'Student', ''),
(292, '22-10657', '21232f297a57a5a743894a0e4a801fc3', 'Rain Lou', '', 'MuÃ±ez', '22-10657', '27', 'None', '2023', 'First Semester', 'Student', ''),
(294, '22-10287', '21232f297a57a5a743894a0e4a801fc3', 'Hester', '', 'Mulig', '22-10287', '27', 'None', '2023', 'First Semester', 'Student', ''),
(295, '22-10418', '21232f297a57a5a743894a0e4a801fc3', 'Mark Leo', '', 'Nantes', '22-10418', '27', 'None', '2023', 'First Semester', 'Student', ''),
(296, '22-10495', '21232f297a57a5a743894a0e4a801fc3', 'Deither', '', 'Niegas', '22-10495', '27', 'None', '2023', 'First Semester', 'Student', ''),
(297, '22-10081', '21232f297a57a5a743894a0e4a801fc3', 'Ermalyn', '', 'NuÃ±ez', '22-10081', '27', 'None', '2023', 'First Semester', 'Student', ''),
(298, '20-10357', '21232f297a57a5a743894a0e4a801fc3', 'Rolyn', '', 'Odarbe', '20-10357', '27', 'None', '2023', 'First Semester', 'Student', ''),
(299, '22-10746', '21232f297a57a5a743894a0e4a801fc3', 'Shane', '', 'Olarte', '22-10746', '27', 'None', '2023', 'First Semester', 'Student', ''),
(300, '18-10332', '21232f297a57a5a743894a0e4a801fc3', 'Rodney', '', 'Omega', '18-10332', '27', 'None', '2023', 'First Semester', 'Student', ''),
(301, '22-10575', '21232f297a57a5a743894a0e4a801fc3', 'Aljay', '', 'Orellano', '22-10575', '27', 'None', '2023', 'First Semester', 'Student', ''),
(302, '22-10142', '21232f297a57a5a743894a0e4a801fc3', 'Robin', '', 'Padilla', '22-10142', '27', 'None', '2023', 'First Semester', 'Student', ''),
(303, '22-10275', '21232f297a57a5a743894a0e4a801fc3', 'Kenn', '', 'Palco', '22-10275', '27', 'None', '2023', 'First Semester', 'Student', ''),
(304, '22-10510', '21232f297a57a5a743894a0e4a801fc3', 'Ivan', '', 'Quigao', '22-10510', '27', 'None', '2023', 'First Semester', 'Student', ''),
(305, '22-10696', '21232f297a57a5a743894a0e4a801fc3', 'Darren', '', 'Ramos', '22-10696', '27', 'None', '2023', 'First Semester', 'Student', ''),
(306, '22-10349', '21232f297a57a5a743894a0e4a801fc3', 'Mirasol', '', 'Resadas', '22-10349', '27', 'None', '2023', 'First Semester', 'Student', ''),
(307, '22-10316', '21232f297a57a5a743894a0e4a801fc3', 'Kier Spencer', '', 'Reyes', '22-10316', '27', 'None', '2023', 'First Semester', 'Student', ''),
(308, '22-10738', '21232f297a57a5a743894a0e4a801fc3', 'Nikka Gbabe', '', 'Riveral', '22-10738', '27', 'None', '2023', 'First Semester', 'Student', ''),
(309, '21-20016', '21232f297a57a5a743894a0e4a801fc3', 'Nikko Lance', '', 'Riveral', '21-20016', '27', 'None', '2023', 'First Semester', 'Student', ''),
(310, '22-10211', '21232f297a57a5a743894a0e4a801fc3', 'Gerel', '', 'Rocat', '22-10211', '27', 'None', '2023', 'First Semester', 'Student', ''),
(311, '22-10496', '21232f297a57a5a743894a0e4a801fc3', 'Lyka Pearl', '', 'Romero', '22-10496', '27', 'None', '2023', 'First Semester', 'Student', ''),
(312, '22-10011', '21232f297a57a5a743894a0e4a801fc3', 'Jemerson', '', 'Rufin', '22-10011', '27', 'None', '2023', 'First Semester', 'Student', ''),
(313, '22-10686', '21232f297a57a5a743894a0e4a801fc3', 'John Mark', '', 'Rufin', '22-10686', '27', 'None', '2023', 'First Semester', 'Student', ''),
(314, '22-10055', '21232f297a57a5a743894a0e4a801fc3', 'Mary Jane', '', 'Sabanal', '22-10055', '27', 'None', '2023', 'First Semester', 'Student', ''),
(315, '22-10748', '21232f297a57a5a743894a0e4a801fc3', 'Francis', '', 'Saliente', '22-10748', '27', 'None', '2023', 'First Semester', 'Student', ''),
(316, '22-10724', '21232f297a57a5a743894a0e4a801fc3', 'Lance Garett', '', 'Saliente', '22-10724', '27', 'None', '2023', 'First Semester', 'Student', ''),
(317, '22-10078', '21232f297a57a5a743894a0e4a801fc3', 'Jhenifer', '', 'Salvador', '22-10078', '27', 'None', '2023', 'First Semester', 'Student', ''),
(318, '22-10204', '21232f297a57a5a743894a0e4a801fc3', 'Jolie', '', 'San Juan', '22-10204', '27', 'None', '2023', 'First Semester', 'Student', ''),
(319, '20-10214', '21232f297a57a5a743894a0e4a801fc3', 'Algean', '', 'Sibay', '20-10214', '27', 'None', '2023', 'First Semester', 'Student', ''),
(320, '19-10793', '21232f297a57a5a743894a0e4a801fc3', 'Rolando', '', 'Sida', '19-10793', '27', 'None', '2023', 'First Semester', 'Student', ''),
(321, '21-10241', '21232f297a57a5a743894a0e4a801fc3', 'June Lian Jazle', '', 'Tampos', '21-10241', '27', 'None', '2023', 'First Semester', 'Student', ''),
(322, '22-10639', '21232f297a57a5a743894a0e4a801fc3', 'Wilfred', '', 'Tampus', '22-10639', '27', 'None', '2023', 'First Semester', 'Student', ''),
(323, '22-10553', '21232f297a57a5a743894a0e4a801fc3', 'Joshua', '', 'Tan', '22-10553', '27', 'None', '2023', 'First Semester', 'Student', ''),
(324, '19-10646', '21232f297a57a5a743894a0e4a801fc3', 'Junner', '', 'Patual', '19-10646', '27', 'None', '2023', 'First Semester', 'Student', ''),
(325, '22-10486', '21232f297a57a5a743894a0e4a801fc3', 'Sesheil Mae', '', 'Tanilon', '22-10486', '27', 'None', '2023', 'First Semester', 'Student', ''),
(326, '18-10664', '21232f297a57a5a743894a0e4a801fc3', 'Joshua', '', 'Tayor', '18-10664', '27', 'None', '2023', 'First Semester', 'Student', ''),
(327, '22-20002', '21232f297a57a5a743894a0e4a801fc3', 'David', '', 'Tero', '22-20002', '27', 'None', '2023', 'First Semester', 'Student', ''),
(328, '22-20003', '21232f297a57a5a743894a0e4a801fc3', 'Jhon Gabriel', '', 'Tero', '22-20003', '27', 'None', '2023', 'First Semester', 'Student', ''),
(329, '22-10756', '21232f297a57a5a743894a0e4a801fc3', 'Jamaica', '', 'Togonon', '22-10756', '27', 'None', '2023', 'First Semester', 'Student', ''),
(330, '21-10035', '21232f297a57a5a743894a0e4a801fc3', 'Jimrose', '', 'Togonon', '21-10035', '27', 'None', '2023', 'First Semester', 'Student', ''),
(331, '20-10381', '21232f297a57a5a743894a0e4a801fc3', 'Irene Charisse', '', 'Tolibas', '20-10381', '27', 'None', '2023', 'First Semester', 'Student', ''),
(332, '22-10279', '21232f297a57a5a743894a0e4a801fc3', 'John Paul', '', 'Tomada', '22-10279', '27', 'None', '2023', 'First Semester', 'Student', ''),
(333, '22-10031', '21232f297a57a5a743894a0e4a801fc3', 'Ginalyn', '', 'Tumolin', '22-10031', '27', 'None', '2023', 'First Semester', 'Student', ''),
(334, '22-10186', '21232f297a57a5a743894a0e4a801fc3', 'Marvin', '', 'Veluz', '22-10186', '27', 'None', '2023', 'First Semester', 'Student', ''),
(335, '22-10076', '21232f297a57a5a743894a0e4a801fc3', 'James Kharl', '', 'Vero', '22-10076', '27', 'None', '2023', 'First Semester', 'Student', ''),
(336, '21-20010', '21232f297a57a5a743894a0e4a801fc3', 'Nicole', '', 'Vero', '21-20010', '27', 'None', '2023', 'First Semester', 'Student', ''),
(337, '22-10171', '21232f297a57a5a743894a0e4a801fc3', 'Jherylou', '', 'Villada', '22-10171', '27', 'None', '2023', 'First Semester', 'Student', ''),
(338, '22-10703', '21232f297a57a5a743894a0e4a801fc3', 'Raymond', '', 'Villasorda', '22-10703', '27', 'None', '2023', 'First Semester', 'Student', ''),
(339, '22-10415', '21232f297a57a5a743894a0e4a801fc3', 'Mark Lloyd', '', 'Viloria', '22-10415', '27', 'None', '2023', 'First Semester', 'Student', ''),
(340, '20-10389', '21232f297a57a5a743894a0e4a801fc3', 'Froilan', '', 'Yumang', '20-10389', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(341, '21-10170', '21232f297a57a5a743894a0e4a801fc3', 'Ceriaco John', '', 'Acayen', '21-10170', '27', 'None', '2022', 'Second Semester', 'Student', ''),
(343, '21-10143', '21232f297a57a5a743894a0e4a801fc3', 'Rhina Mae', '', 'Alcala', '21-10143', '27', 'None', '2023', 'First Semester', 'Student', ''),
(344, '21-10103', '21232f297a57a5a743894a0e4a801fc3', 'Mary Grace', '', 'Almosa', '21-10103', '27', 'None', '2023', 'First Semester', 'Student', ''),
(345, '21-10275', '21232f297a57a5a743894a0e4a801fc3', 'Leah', '', 'Alvarez', '21-10275', '27', 'None', '2023', 'First Semester', 'Student', ''),
(346, '21-10087', '21232f297a57a5a743894a0e4a801fc3', 'Maria Erica', '', 'Balagon', '21-10087', '27', 'None', '2023', 'First Semester', 'Student', ''),
(347, '21-10029', '21232f297a57a5a743894a0e4a801fc3', 'Hanna', '', 'Barroa', '21-10029', '27', 'None', '2023', 'First Semester', 'Student', ''),
(348, '21-10281', '21232f297a57a5a743894a0e4a801fc3', 'Justin Ann', '', 'Bernante', '21-10281', '27', 'None', '2023', 'First Semester', 'Student', ''),
(349, '21-10187', '21232f297a57a5a743894a0e4a801fc3', 'Maegan', '', 'Besas', '21-10187', '27', 'None', '2023', 'First Semester', 'Student', ''),
(350, '19-10097', '21232f297a57a5a743894a0e4a801fc3', 'Nhemuel', '', 'Buctot', '19-10097', '27', 'None', '2023', 'First Semester', 'Student', ''),
(351, '21-10070', '21232f297a57a5a743894a0e4a801fc3', 'Quieny', '', 'Cagasan', '21-10070', '27', 'None', '2023', 'First Semester', 'Student', ''),
(352, '21-10235', '21232f297a57a5a743894a0e4a801fc3', 'Noemae', '', 'Castronuevo', '21-10235', '27', 'None', '2023', 'First Semester', 'Student', ''),
(353, '21-10163', '21232f297a57a5a743894a0e4a801fc3', 'Jessica Anne', '', 'Castulo', '21-10163', '27', 'None', '2023', 'First Semester', 'Student', ''),
(354, '21-10123', '21232f297a57a5a743894a0e4a801fc3', 'Ymmanuel', '', 'Casundo', '21-10123', '27', 'None', '2023', 'First Semester', 'Student', ''),
(355, '21-10439', '21232f297a57a5a743894a0e4a801fc3', 'Nargel', '', 'Catalonia', '21-10439', '27', 'None', '2023', 'First Semester', 'Student', ''),
(356, '21-10307', '21232f297a57a5a743894a0e4a801fc3', 'Sheena May', '', 'Cobero', '21-10307', '27', 'None', '2023', 'First Semester', 'Student', ''),
(357, '18-20044', '21232f297a57a5a743894a0e4a801fc3', 'Ryan', '', 'Codera', '18-20044', '27', 'None', '2023', 'First Semester', 'Student', ''),
(358, '20-10045', '21232f297a57a5a743894a0e4a801fc3', 'Justine Anne', '', 'Dadap', '20-10045', '27', 'None', '2023', 'First Semester', 'Student', ''),
(359, '21-10387', '21232f297a57a5a743894a0e4a801fc3', 'Ma. April Joy', '', 'Datoy', '21-10387', '27', 'None', '2023', 'First Semester', 'Student', ''),
(360, '21-10472', '21232f297a57a5a743894a0e4a801fc3', 'Mylene', '', 'De Jose', '21-10472', '27', 'None', '2023', 'First Semester', 'Student', ''),
(361, '21-10043', '21232f297a57a5a743894a0e4a801fc3', 'Jacob', '', 'EmpeÃ±o', '21-10043', '27', 'None', '2023', 'First Semester', 'Student', ''),
(362, '21-10268', '21232f297a57a5a743894a0e4a801fc3', 'Aime Rose', '', 'Enide', '21-10268', '27', 'None', '2023', 'First Semester', 'Student', ''),
(363, '21-10024', '21232f297a57a5a743894a0e4a801fc3', 'Leo', '', 'Espedilla', '21-10024', '27', 'None', '2023', 'First Semester', 'Student', ''),
(364, '21-10106', '21232f297a57a5a743894a0e4a801fc3', 'Ariane', '', 'Gerona', '21-10106', '27', 'None', '2023', 'First Semester', 'Student', ''),
(365, '21-10044', '21232f297a57a5a743894a0e4a801fc3', 'ReÃ±eil', '', 'Gludo', '21-10044', '27', 'None', '2023', 'First Semester', 'Student', ''),
(366, '21-10124', '21232f297a57a5a743894a0e4a801fc3', 'Joshua', '', 'Guadalquiver', '21-10124', '27', 'None', '2023', 'First Semester', 'Student', ''),
(367, '22-10770', '21232f297a57a5a743894a0e4a801fc3', 'Jay-Ann', '', 'Haguimit', '22-10770', '27', 'None', '2023', 'First Semester', 'Student', ''),
(368, '21-10141', '21232f297a57a5a743894a0e4a801fc3', 'Rodwen', '', 'Inso', '21-10141', '27', 'None', '2023', 'First Semester', 'Student', ''),
(369, '21-10102', '21232f297a57a5a743894a0e4a801fc3', 'Ronalyn', '', 'Labarite', '21-10102', '27', 'None', '2023', 'First Semester', 'Student', ''),
(370, '21-10277', '21232f297a57a5a743894a0e4a801fc3', 'Jomari', '', 'Lacano', '21-10277', '27', 'None', '2023', 'First Semester', 'Student', ''),
(371, '21-10216', '21232f297a57a5a743894a0e4a801fc3', 'Keziah Blanche', '', 'Lastimosa', '21-10216', '27', 'None', '2023', 'First Semester', 'Student', ''),
(372, '20-10074', '21232f297a57a5a743894a0e4a801fc3', 'Angelo', '', 'Licmoan', '20-10074', '27', 'None', '2023', 'First Semester', 'Student', ''),
(373, '21-10194', '21232f297a57a5a743894a0e4a801fc3', 'Dexter', '', 'Manlao', '21-10194', '27', 'None', '2023', 'First Semester', 'Student', ''),
(374, '20-10104', '21232f297a57a5a743894a0e4a801fc3', 'Jericho', '', 'Manliguez', '20-10104', '27', 'None', '2023', 'First Semester', 'Student', ''),
(375, '21-10111', '21232f297a57a5a743894a0e4a801fc3', 'Arnel', '', 'Mesido', '21-10111', '27', 'None', '2023', 'First Semester', 'Student', ''),
(376, '21-10077', '21232f297a57a5a743894a0e4a801fc3', 'Lester', '', 'Ordiz', '21-10077', '27', 'None', '2023', 'First Semester', 'Student', ''),
(377, '21-20009', '21232f297a57a5a743894a0e4a801fc3', 'Celjane', '', 'Ouano', '21-20009', '27', 'None', '2023', 'First Semester', 'Student', ''),
(378, '21-10168', '21232f297a57a5a743894a0e4a801fc3', 'Rae Staniel', '', 'Pakiding', '21-10168', '27', 'None', '2023', 'First Semester', 'Student', ''),
(379, '21-10064', '21232f297a57a5a743894a0e4a801fc3', 'Julius', '', 'Pelegrino', '21-10064', '27', 'None', '2023', 'First Semester', 'Student', ''),
(380, '18-10617', '21232f297a57a5a743894a0e4a801fc3', 'Marjhun', '', 'Puliran', '18-10617', '27', 'None', '2023', 'First Semester', 'Student', ''),
(381, '21-10385', '21232f297a57a5a743894a0e4a801fc3', 'Maria Lyn', '', 'Pusa', '21-10385', '27', 'None', '2023', 'First Semester', 'Student', ''),
(382, '21-10198', '21232f297a57a5a743894a0e4a801fc3', 'Roland', '', 'Respecia', '21-10198', '27', 'None', '2023', 'First Semester', 'Student', ''),
(383, '21-10042', '21232f297a57a5a743894a0e4a801fc3', 'Shela', '', 'Salon', '21-10042', '27', 'None', '2023', 'First Semester', 'Student', ''),
(384, '21-10145', '21232f297a57a5a743894a0e4a801fc3', 'Mark Christian', '', 'Sayson', '21-10145', '27', 'None', '2023', 'First Semester', 'Student', ''),
(385, '21-10178', '21232f297a57a5a743894a0e4a801fc3', 'Aiyana', '', 'Sibay', '21-10178', '27', 'None', '2023', 'First Semester', 'Student', ''),
(386, '21-10200', '21232f297a57a5a743894a0e4a801fc3', 'Justine', '', 'Tisbe', '21-10200', '27', 'None', '2023', 'First Semester', 'Student', ''),
(387, '21-10306', '21232f297a57a5a743894a0e4a801fc3', 'Crichelle Ann', '', 'Uy', '21-10306', '27', 'None', '2023', 'First Semester', 'Student', ''),
(388, '21-10299', '21232f297a57a5a743894a0e4a801fc3', 'Richard Marx', '', 'Yu', '21-10299', '27', 'None', '2023', 'First Semester', 'Student', ''),
(389, '20-10105', '21232f297a57a5a743894a0e4a801fc3', 'Glemark', '', 'Ballespin', '20-10105', '27', 'None', '2023', 'First Semester', 'Student', ''),
(390, '20-10003', '21232f297a57a5a743894a0e4a801fc3', 'Marverick', '', 'Bastes', '20-10003', '27', 'None', '2023', 'First Semester', 'Student', ''),
(391, '20-10069', '21232f297a57a5a743894a0e4a801fc3', 'Chris Kenth', '', 'Cadayona', '20-10069', '27', 'None', '2023', 'First Semester', 'Student', ''),
(392, '20-10073', '21232f297a57a5a743894a0e4a801fc3', 'Frances Eric', '', 'Carbonilla', '20-10073', '27', 'None', '2023', 'First Semester', 'Student', ''),
(393, '20-10070', '21232f297a57a5a743894a0e4a801fc3', 'Brixx Steven', '', 'Dumaguing', '20-10070', '27', 'None', '2023', 'First Semester', 'Student', ''),
(394, '20-10078', '21232f297a57a5a743894a0e4a801fc3', 'Jomalyn', '', 'Enriquez', '20-10078', '27', 'None', '2023', 'First Semester', 'Student', ''),
(395, '20-10068', '21232f297a57a5a743894a0e4a801fc3', 'Dave', '', 'Fegi', '20-10068', '27', 'None', '2023', 'First Semester', 'Student', ''),
(396, '20-10006', '21232f297a57a5a743894a0e4a801fc3', 'Charmie', '', 'Hinautan', '20-10006', '27', 'None', '2023', 'First Semester', 'Student', ''),
(397, '18-10415', '21232f297a57a5a743894a0e4a801fc3', 'Arvin James', '', 'Malubay', '18-10415', '27', 'None', '2023', 'First Semester', 'Student', ''),
(398, '18-10542', '21232f297a57a5a743894a0e4a801fc3', 'Plejhon', '', 'Medilo', '18-10542', '27', 'None', '2023', 'First Semester', 'Student', ''),
(399, '20-10166', '21232f297a57a5a743894a0e4a801fc3', 'Philip', '', 'Mondala', '20-10166', '27', 'None', '2023', 'First Semester', 'Student', ''),
(400, '19-10297', '21232f297a57a5a743894a0e4a801fc3', 'Angelito', '', 'Parejo', '19-10297', '27', 'None', '2023', 'First Semester', 'Student', ''),
(401, '20-10002', '21232f297a57a5a743894a0e4a801fc3', 'Mary Rose', '', 'Quigao', '20-10002', '27', 'None', '2023', 'First Semester', 'Student', ''),
(402, '20-10019', '21232f297a57a5a743894a0e4a801fc3', 'Jillou', '', 'Quiliope', '20-10019', '27', 'None', '2023', 'First Semester', 'Student', ''),
(403, '20-10071', '21232f297a57a5a743894a0e4a801fc3', 'Alexis', '', 'Sagusay', '20-10071', '27', 'None', '2023', 'First Semester', 'Student', ''),
(404, '20-10010', '21232f297a57a5a743894a0e4a801fc3', 'Dejay', '', 'Serojales', '20-10010', '27', 'None', '2023', 'First Semester', 'Student', ''),
(405, '20-10081', '21232f297a57a5a743894a0e4a801fc3', 'Charlie', '', 'Sobrio', '20-10081', '27', 'None', '2023', 'First Semester', 'Student', ''),
(406, '18-10304', '21232f297a57a5a743894a0e4a801fc3', 'Pableus Joseph', '', 'Suspa', '18-10304', '27', 'None', '2023', 'First Semester', 'Student', ''),
(407, '19-10411', '21232f297a57a5a743894a0e4a801fc3', 'Mikee', '', 'Tapao', '19-10411', '27', 'None', '2023', 'First Semester', 'Student', ''),
(408, '20-10077', '21232f297a57a5a743894a0e4a801fc3', 'Jhosua', '', 'Timkang', '20-10077', '27', 'None', '2023', 'First Semester', 'Student', ''),
(409, '20-10016', '21232f297a57a5a743894a0e4a801fc3', 'John Vincent', '', 'Valencia', '20-10016', '27', 'None', '2023', 'First Semester', 'Student', ''),
(410, '19-10329', '21232f297a57a5a743894a0e4a801fc3', 'Marloun', '', 'Abordo', '19-10329', '27', 'None', '2023', 'First Semester', 'Student', ''),
(411, '19-10294', '21232f297a57a5a743894a0e4a801fc3', 'Alsen', '', 'Abrenilla', '19-10294', '27', 'None', '2023', 'First Semester', 'Student', ''),
(412, '19-10460', '21232f297a57a5a743894a0e4a801fc3', 'Froilan Nino', '', 'Acdal', '19-10460', '27', 'None', '2023', 'First Semester', 'Student', ''),
(413, '19-10234', '21232f297a57a5a743894a0e4a801fc3', 'Rowell', '', 'Amolo', '19-10234', '27', 'None', '2023', 'First Semester', 'Student', ''),
(414, '19-10369', '21232f297a57a5a743894a0e4a801fc3', 'Marie Cris', '', 'Basco', '19-10369', '27', 'None', '2023', 'First Semester', 'Student', ''),
(415, '18-20001', '21232f297a57a5a743894a0e4a801fc3', 'Charlie Magne', '', 'Berido', '18-20001', '27', 'None', '2023', 'First Semester', 'Student', '');
INSERT INTO `student` (`row`, `user`, `pass`, `fn`, `mn`, `ln`, `id`, `dept`, `image`, `ay`, `sem`, `position`, `signature`) VALUES
(416, '19-10226', '21232f297a57a5a743894a0e4a801fc3', 'Marilyn', '', 'Bernardo', '19-10226', '27', 'None', '2023', 'First Semester', 'Student', ''),
(417, '19-10352', '21232f297a57a5a743894a0e4a801fc3', 'Jezreel', '', 'Buletin', '19-10352', '27', 'None', '2023', 'First Semester', 'Student', ''),
(418, '18-10215', '21232f297a57a5a743894a0e4a801fc3', 'Reymark', '', 'Bulilan', '18-10215', '27', 'None', '2023', 'First Semester', 'Student', ''),
(419, '19-10464', '21232f297a57a5a743894a0e4a801fc3', 'Reggie', '', 'Cagorol', '19-10464', '27', 'None', '2023', 'First Semester', 'Student', ''),
(420, '19-10666', '21232f297a57a5a743894a0e4a801fc3', 'John Paul', '', 'Cajate', '19-10666', '27', 'None', '2023', 'First Semester', 'Student', ''),
(421, '19-10578', '21232f297a57a5a743894a0e4a801fc3', 'Jovaney', '', 'Calapre', '19-10578', '27', 'None', '2023', 'First Semester', 'Student', ''),
(422, '19-10291', '21232f297a57a5a743894a0e4a801fc3', 'Angelo', '', 'Casangcapan', '19-10291', '27', 'None', '2023', 'First Semester', 'Student', ''),
(423, '19-10136', '21232f297a57a5a743894a0e4a801fc3', 'Jericho', '', 'Casimsiman', '19-10136', '27', 'None', '2023', 'First Semester', 'Student', ''),
(424, '19-10812', '21232f297a57a5a743894a0e4a801fc3', 'Loriel', '', 'Comabig', '19-10812', '27', 'None', '2023', 'First Semester', 'Student', ''),
(425, '19-10191', '21232f297a57a5a743894a0e4a801fc3', 'Lyka Mae', '', 'Cuevas', '19-10191', '27', 'None', '2023', 'First Semester', 'Student', ''),
(426, '19-10650', '21232f297a57a5a743894a0e4a801fc3', 'Jessa Lyn', '', 'Debalucos', '19-10650', '27', 'None', '2023', 'First Semester', 'Student', ''),
(427, '19-10647', '21232f297a57a5a743894a0e4a801fc3', 'Jaidelyn', '', 'Espina', '19-10647', '27', 'None', '2023', 'First Semester', 'Student', ''),
(428, '19-10704', '21232f297a57a5a743894a0e4a801fc3', 'Rose Mae', '', 'Garces', '19-10704', '27', 'None', '2023', 'First Semester', 'Student', ''),
(429, '19-10133', '21232f297a57a5a743894a0e4a801fc3', 'Janeth', '', 'Garcia', '19-10133', '27', 'None', '2023', 'First Semester', 'Student', ''),
(430, '19-10522', '21232f297a57a5a743894a0e4a801fc3', 'Juven', '', 'Garcia', '19-10522', '27', 'None', '2023', 'First Semester', 'Student', ''),
(431, '19-10731', '21232f297a57a5a743894a0e4a801fc3', 'Rosalinda', '', 'Gazo', '19-10731', '27', 'None', '2023', 'First Semester', 'Student', ''),
(432, '19-10303', '21232f297a57a5a743894a0e4a801fc3', 'Gloriedel', '', 'Gloriane', '19-10303', '27', 'None', '2023', 'First Semester', 'Student', ''),
(433, '19-10105', '21232f297a57a5a743894a0e4a801fc3', 'Julius Caesar', '', 'Godoyo', '19-10105', '27', 'None', '2023', 'First Semester', 'Student', ''),
(434, '19-10339', '21232f297a57a5a743894a0e4a801fc3', 'Jefone', '', 'Gorme', '19-10339', '27', 'None', '2023', 'First Semester', 'Student', ''),
(435, '18-10595', '21232f297a57a5a743894a0e4a801fc3', 'Marianne', '', 'Juave', '18-10595', '27', 'None', '2023', 'First Semester', 'Student', ''),
(436, '19-10525', '21232f297a57a5a743894a0e4a801fc3', 'Donna Lyn', '', 'Lemit', '19-10525', '27', 'None', '2023', 'First Semester', 'Student', ''),
(437, '18-20029', '21232f297a57a5a743894a0e4a801fc3', 'April Jay', '', 'Libato', '18-20029', '27', 'None', '2023', 'First Semester', 'Student', ''),
(438, '19-10128', '21232f297a57a5a743894a0e4a801fc3', 'Macapanas', '', 'Mary Kris', '19-10128', '27', 'None', '2023', 'First Semester', 'Student', ''),
(439, '19-10195', '21232f297a57a5a743894a0e4a801fc3', 'Mitchie', '', 'Malubay', '19-10195', '27', 'None', '2023', 'First Semester', 'Student', ''),
(440, '19-10304', '21232f297a57a5a743894a0e4a801fc3', 'Paul Jay', '', 'Mendoza', '19-10304', '27', 'None', '2023', 'First Semester', 'Student', ''),
(441, '19-10296', '21232f297a57a5a743894a0e4a801fc3', 'Christyl Anne', '', 'Pacilan', '19-10296', '27', 'None', '2023', 'First Semester', 'Student', ''),
(442, '19-10401', '21232f297a57a5a743894a0e4a801fc3', 'Vinson', '', 'Paja', '19-10401', '27', 'None', '2023', 'First Semester', 'Student', ''),
(444, '19-10137', '21232f297a57a5a743894a0e4a801fc3', 'Kenneth', '', 'Kenneth', '19-10137', '27', 'None', '2023', 'First Semester', 'Student', ''),
(445, '19-10248', '21232f297a57a5a743894a0e4a801fc3', 'John Mark', '', 'Petate', '19-10248', '27', 'None', '2023', 'First Semester', 'Student', ''),
(446, '19-10811', '21232f297a57a5a743894a0e4a801fc3', 'Jerwin', '', 'Piga', '19-10811', '27', 'None', '2023', 'First Semester', 'Student', ''),
(447, '19-10093', '21232f297a57a5a743894a0e4a801fc3', 'Ericah', '', 'Quiban', '19-10093', '27', 'None', '2023', 'First Semester', 'Student', ''),
(448, '18-10320', '21232f297a57a5a743894a0e4a801fc3', 'Rheymark', '', 'Quinones', '18-10320', '27', 'None', '2023', 'First Semester', 'Student', ''),
(449, '19-10472', '21232f297a57a5a743894a0e4a801fc3', 'Marielle', '', 'Saga', '19-10472', '27', 'None', '2023', 'First Semester', 'Student', ''),
(450, '19-10209', '21232f297a57a5a743894a0e4a801fc3', 'Leslie', '', 'Seciban', '19-10209', '27', 'None', '2023', 'First Semester', 'Student', ''),
(452, '19-10315', '21232f297a57a5a743894a0e4a801fc3', 'Mark Jason', '', 'Tampus', '19-10315', '27', 'None', '2023', 'First Semester', 'Student', ''),
(453, '19-10221', '21232f297a57a5a743894a0e4a801fc3', 'Christopher', '', 'Tolibas', '19-10221', '27', 'None', '2023', 'First Semester', 'Student', ''),
(454, '19-10227', '21232f297a57a5a743894a0e4a801fc3', 'Sheendie Mae', '', 'Venales', '19-10227', '27', 'None', '2023', 'First Semester', 'Student', ''),
(456, '21-10137', '21232f297a57a5a743894a0e4a801fc3', 'Alexander', '', 'Junio', '21-10137', '24', 'None', '2023', 'First Semester', 'Student', ''),
(457, '22-10010', '21232f297a57a5a743894a0e4a801fc3', 'Mary Ann', '', 'Napuli', '22-10010', '25', 'None', '2023', 'First Semester', 'Student', ''),
(458, '22-10014', '21232f297a57a5a743894a0e4a801fc3', 'Princess Nicole', '', 'Sida', '22-10014', '25', 'None', '2023', 'First Semester', 'Student', ''),
(459, '22-10405', '21232f297a57a5a743894a0e4a801fc3', 'Kyla', '', 'Ricaborda', '22-10405', '25', 'None', '2023', 'First Semester', 'Student', ''),
(460, '20-10480', '21232f297a57a5a743894a0e4a801fc3', 'Maria Elina', '', 'Bagohin', '20-10480', '25', 'None', '2023', 'First Semester', 'Student', ''),
(461, '21-10231', '21232f297a57a5a743894a0e4a801fc3', 'Vincent', '', 'Piloton', '21-10231', '25', 'None', '2023', 'First Semester', 'Student', '');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `row` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `fn` text NOT NULL,
  `mn` text NOT NULL,
  `ln` text NOT NULL,
  `image` text NOT NULL,
  `ay` text NOT NULL,
  `sem` text NOT NULL,
  `period` text NOT NULL,
  `department` text NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`row`, `user`, `pass`, `fn`, `mn`, `ln`, `image`, `ay`, `sem`, `period`, `department`, `position`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Marc Crisald', '', 'Cancio', 'photo/MAC_1683179153.jpg', '2022', 'Second Semester', '2020', '27', 'Super Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `row` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `fac_no` text NOT NULL,
  `image` text NOT NULL,
  `ay` text NOT NULL,
  `sem` text NOT NULL,
  `period` text NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`row`, `user`, `pass`, `fac_no`, `image`, `ay`, `sem`, `period`, `position`) VALUES
(5, 'info', '1952a01898073d1e561b9b4f2e42cbd7', '100', 'None', '2022', 'Second Semester', '2020', 'Supervisor'),
(6, 'bsed', '1952a01898073d1e561b9b4f2e42cbd7', '170', 'None', '2022', 'Second Semester', '', 'Supervisor'),
(7, 'btled', '1952a01898073d1e561b9b4f2e42cbd7', '137', 'None', '2022', 'Second Semester', '', 'Supervisor'),
(8, 'da', '1952a01898073d1e561b9b4f2e42cbd7', '135', 'None', '2023', 'First Semester', '', 'Supervisor'),
(9, 'indu', '1952a01898073d1e561b9b4f2e42cbd7', '128', 'None', '2023', 'First Semester', '', 'Supervisor'),
(10, 'dbm', '1952a01898073d1e561b9b4f2e42cbd7', '161', 'None', '2023', 'First Semester', '', 'Supervisor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `committee`
--
ALTER TABLE `committee`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `evaluate`
--
ALTER TABLE `evaluate`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `evaluation_form`
--
ALTER TABLE `evaluation_form`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`row`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `committee`
--
ALTER TABLE `committee`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `evaluate`
--
ALTER TABLE `evaluate`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `evaluation_form`
--
ALTER TABLE `evaluation_form`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=730;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1027;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
