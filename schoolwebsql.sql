-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 11:01 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolwebsql`
--

-- --------------------------------------------------------

--
-- Table structure for table `ann`
--

CREATE TABLE `ann` (
  `annID` int(10) NOT NULL,
  `username` text NOT NULL,
  `p1` text NOT NULL,
  `p2` text NOT NULL,
  `p` text NOT NULL,
  `img` text NOT NULL,
  `annLink` text NOT NULL,
  `annView` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ann`
--

INSERT INTO `ann` (`annID`, `username`, `p1`, `p2`, `p`, `img`, `annLink`, `annView`) VALUES
(5, 'طاها مهدویان', 'امتحانات میان ترم برای افزایش امادگی دانش اموزان در نوبت دوم', 'امتحانات میان ترم برای امادگی دانش اموزان در امتحانات نوبت دوم', 'امتحانات میان ترم', 'Data/3.png', 'f8efb48fcb090af3f393d9ca35742222', 0),
(6, 'طاها مهدویان', 'تغییر مدیر مدرسه', 'شیمصشینشهی \nعاشسخشینمشسیتشهیاشهینمشمستیخه بشیاصشعیخشهسی منصتش هسیاصش خیشتیشتسشص', 'مدیریت جدید', 'Data/4.png', 'e75828b1d1f1cfadf2e8ff116975a47f', 1),
(12, 'طاها مهدویان', 'امتحانات میان ترم برای افزایش امادگی دانش اموزان در نوبت دوم', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus cupiditate, laborum quidem quae inventore dignissimos harum dolorem cum labore accusamus voluptatibus minima sit ut sunt ab fugit non corrupti, vitae porro nemo quia. Enim voluptatum totam, quia, quasi iste debitis magnam illo dignissimos unde ducimus aperiam sequi eius veritatis asperiores perferendis id temporibus esse tempora impedit distinctio eum laudantium. Eaque, incidunt qui! Error, praesentium cupiditate! Sequi, accusamus dolores. Recusandae incidunt quaerat perspiciatis ullam fugiat maiores id omnis. Laudantium perspiciatis, veritatis suscipit nihil nisi consequuntur optio delectus, eum autem deserunt molestias voluptas. Eius quo alias ut distinctio mollitia impedit consequuntur minus numquam quos fugit repellat quibusdam, adipisci facere libero quae nostrum ducimus quas accusantium. Laborum ipsum facilis vero recusandae omnis quidem aspernatur ullam et, dicta nobis commodi illum maiores reprehenderit voluptatum consectetur, odit blanditiis cumque nemo soluta delectus. Modi culpa magni doloribus placeat nostrum, tenetur aliquam numquam provident accusamus dignissimos odit optio asperiores maiores quisquam laudantium, saepe assumenda excepturi ex aspernatur, unde officiis dolorum est! Adipisci alias vel eveniet inventore minus eum magni expedita reprehenderit harum ex at, quas quo rem beatae voluptates cupiditate perspiciatis enim non eaque! Nostrum magnam perspiciatis quae vitae deserunt ducimus quam nemo quidem, distinctio, dolores minima.', 'همینطوری تست میکنیم', 'Data/background.jpg', '8e0b03cdff0b1886db65a19fb2b9061d', 2);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `link` text NOT NULL,
  `link2` text NOT NULL,
  `class` varchar(100) NOT NULL,
  `dars` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `ID` int(10) NOT NULL,
  `title` text NOT NULL,
  `subject` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`ID`, `title`, `subject`, `link`) VALUES
(1, 'شازده کوچولو', 'داستان', 'Data/8524372669392402.jpg'),
(2, 'خیلی سبز علوم نهم', 'درسی', 'Data/download.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `title` text NOT NULL,
  `title2` text NOT NULL,
  `desc` text NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'false',
  `who` text DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user`, `title`, `title2`, `desc`, `status`, `who`, `answer`) VALUES
(6, 'طاها مهدویان', 'test', '098f6bcd4621d373cade4e832627b4f6', 'test', 'false', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `ID` int(10) NOT NULL,
  `username` text NOT NULL,
  `tedad` int(10) NOT NULL,
  `type` text NOT NULL,
  `reason` text NOT NULL,
  `giver` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`ID`, `username`, `tedad`, `type`, `reason`, `giver`) VALUES
(21, 'طاها مهدویان', 20, 'افزایش', 'جشنواره خوارزمی', 'مسعود مباشری'),
(22, 'طاها مهدویان', 5, 'کاهش', 'غیبت', 'مسعود مباشری');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `question` text DEFAULT NULL,
  `Qkey` text DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `rank`, `question`, `Qkey`, `score`) VALUES
(1, '3921199689', 'طاها مهدویان', '111111', 4, 'سن شما ؟', '15', 15),
(2, '3931199689', 'مسعود مباشری', '111111', 3, NULL, NULL, 0),
(5, '3921111689', 'مجتبی میرزایی', '300712', 2, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ann`
--
ALTER TABLE `ann`
  ADD PRIMARY KEY (`annID`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ann`
--
ALTER TABLE `ann`
  MODIFY `annID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
