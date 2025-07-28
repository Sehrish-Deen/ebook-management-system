-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2025 at 09:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Mehwish', 'mehwish@gmail.com', 'admin', 'e6e061838856bf47e1de730719fb2609', '2024-06-30 22:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `studentId` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `sub_price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `studentId`, `name`, `price`, `sub_price`, `quantity`, `image`) VALUES
(1, NULL, 'The 7 Habits Of Highly Effective Teens', 500, 10, 1, 'cover1.jfif'),
(2, NULL, 'Application and Interpretation', 500, 20, 1, 'cover4.jfif'),
(3, NULL, 'Application and Interpretation', 500, 20, 1, 'cover4.jfif'),
(4, NULL, 'The 7 Habits Of Highly Effective Teens', 500, 10, 1, 'cover1.jfif'),
(5, NULL, 'An Illustrated Book Of Poetry', 500, 10, 1, 'cover11.jpg'),
(6, NULL, 'Application and Interpretation', 500, 20, 1, 'cover4.jfif'),
(7, NULL, 'The Stencil Of Life', 400, 20, 1, 'cover9.jpg'),
(8, NULL, 'An Illustrated Book Of Poetry', 500, 10, 1, 'cover11.jpg'),
(9, NULL, 'An Illustrated Book Of Poetry', 500, 10, 2, 'cover11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `Competition_ID` int(11) NOT NULL,
  `Title` varchar(222) DEFAULT NULL,
  `comp_img` varchar(1000) NOT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Competition_Type` varchar(222) DEFAULT NULL,
  `status` enum('active','completed') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`Competition_ID`, `Title`, `comp_img`, `Description`, `StartDate`, `EndDate`, `Competition_Type`, `status`) VALUES
(23, 'Technology', 'comp.jfif', 'Essay must be between 100-300 words ..', '2024-07-01', '2024-07-02', 'Essay Writing', ''),
(24, 'Science', 'short-short-story.jpg', 'Stories must be between 100-200 words', '2024-07-02', '2024-07-04', 'Short Story', ''),
(25, 'Nature and Beauty', 'images (1).jfif', 'Poems must be no longer than 40 lines', '2024-07-02', '2024-07-05', 'Poetry Contest', 'active'),
(30, 'sad', 'comp.jfif', 'jdhsjxhj', '2024-07-02', '2024-07-02', 'Essay Writing', '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `number`, `message`) VALUES
(12, 'Shiza', 'shiza@gmail.com', '03245678908', 'Brilliant Work'),
(14, 'Shiza', 'shiza@gmail.com', '034532532', 'kmckmxkfd');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `StudentId` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `StudentId`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(23, 'SID013', 'Shiza', '223276182718', 'shiza@gmail.com', 'paypal', 'north nazimabad', 'An Illustrated Book Of Poetry (1)', 500, '2024-06-27 16:25:10', 'completed'),
(31, 'SID028', 'sehrish', '03245678987', 'sehrish@gmail.com', 'paypal', 'nazimabad', 'An Illustrated Book Of Poetry (1)', 500, '2024-07-01 14:35:04', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `Competition_ID` int(11) NOT NULL,
  `Student_ID` int(11) NOT NULL,
  `Submission_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Submission_File` varchar(255) DEFAULT NULL,
  `Submission_Details` text DEFAULT NULL,
  `prize` enum('1st prize','2nd prize','3rd prize','passed') DEFAULT 'passed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `Competition_ID`, `Student_ID`, `Submission_Date`, `Submission_File`, `Submission_Details`, `prize`) VALUES
(27, 30, 31, '2024-07-01 12:17:06', '026-THE-HIKE-Free-Childrens-Book-By-Monkey-Pen (1).pdf', 'jdhjdwiwijdjhd', '1st prize');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `time_period` varchar(50) NOT NULL,
  `charges` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `sub_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`sub_id`, `sub_name`, `time_period`, `charges`, `description`, `sub_img`) VALUES
(5, 'Basic', '2 month', 10.00, 'Explore the world of literature with unlimited access to eBooks and exclusive author events, tailored for the discerning reader.', '64a03c658092ea145e7aec3fe84f9bcf.png'),
(6, 'Premium', '6 month', 20.00, 'Experience a premium reading journey with unlimited eBooks and exclusive author events.', '37e1850dcd0b3ab054bc12af21de7a9c.jpg'),
(7, 'Advanced', '1 year', 30.00, 'Dive deeper into the realm of literature with our advanced subscription, offering unlimited eBooks and exclusive access to premier author events.', '59b7d5f78925e37f3804009f720d395d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(11, 'DR. STEPHEN R. COVEY', '2024-06-23 13:22:06', NULL),
(12, 'RICHARD DENNY', '2024-06-23 13:51:28', NULL),
(13, 'David Liu', '2024-06-23 13:58:05', NULL),
(14, 'Shriram Krishnamurthi', '2024-06-23 14:02:05', NULL),
(15, 'T. Albert', '2024-06-23 14:08:40', NULL),
(16, 'Henry Koske', '2024-06-23 14:12:11', NULL),
(17, ' Raina Telgemeier', '2024-06-23 14:16:42', NULL),
(18, 'Fabricio RivasMar', '2024-06-23 14:31:20', NULL),
(19, 'Ian Billingsley', '2024-06-23 14:33:36', NULL),
(20, 'Don Wireman, Sr.', '2024-06-23 14:47:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `BookPrice` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `cover_img` varchar(255) DEFAULT NULL,
  `book_pdf` varchar(255) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `RegDate`, `UpdationDate`, `cover_img`, `book_pdf`, `sub_id`) VALUES
(1, 'The 7 Habits Of Highly Effective Teens', 9, 11, 12345, 500, '2024-06-23 13:50:13', NULL, 'cover1.jfif', '7-Habits-Of-Higly-Effective-Teens-PDFdrive.pdf', 5),
(2, 'Succeed For Yourself', 9, 12, 67890, 550, '2024-06-23 13:53:58', NULL, 'cover2.jpg', 'succeed-for-yourself-PDFdrive.pdf', 6),
(3, 'Principles of Programming Languages', 10, 13, 546721, 600, '2024-06-23 14:00:54', NULL, 'cover3.jpg', 'Principles of Programming Languages, David Liu.pdf', 7),
(4, 'Application and Interpretation', 10, 14, 6737432, 500, '2024-06-23 14:03:45', NULL, 'cover4.jfif', '02. Programming Languages Application and Interpretation author Shriram Krishnamurthi.pdf', 6),
(6, 'The Battle Of The Villages', 11, 16, 564732, 350, '2024-06-23 14:14:50', NULL, 'cover6.jpg', 'icrc_battle_villages.pdf', 6),
(7, 'Ghosts', 13, 17, 8743523, 400, '2024-06-23 14:24:32', NULL, 'cover 7.jpg', 'Ghosts Book 1 Excerpt.pdf', 6),
(8, 'Zonk', 13, 18, 53676252, 600, '2024-06-23 14:32:18', NULL, 'cover 8.jfif', 'zonk_2_full_v1.pdf', 7),
(9, 'The Stencil Of Life', 14, 19, 8674532, 400, '2024-06-23 14:40:20', NULL, 'cover9.jpg', 'a-stencil-of-life-obooko.pdf', 6),
(10, 'Don\'t Spit On Yer Anky', 14, 19, 9875445, 400, '2024-06-23 14:45:10', NULL, 'cover10.jpg', 'dont-spit-on-yer-anky-obooko.pdf', 7),
(11, 'An Illustrated Book Of Poetry', 14, 20, 76899043, 500, '2024-06-23 14:48:07', NULL, 'cover11.jpg', 'IllustratedPoetry_obooko-poetry0027.pdf', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(9, 'Novels', 1, '2024-06-23 13:19:11', '0000-00-00 00:00:00'),
(10, 'Programming', 1, '2024-06-23 13:58:30', '0000-00-00 00:00:00'),
(11, 'Story Book', 1, '2024-06-23 14:09:15', '0000-00-00 00:00:00'),
(13, 'Comics', 1, '2024-06-23 14:23:34', '0000-00-00 00:00:00'),
(14, 'Poetry Book', 1, '2024-06-23 14:34:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`) VALUES
(7, 1, 'SID014', '2024-06-27 07:58:17', '2024-06-27 07:58:46', 1, 30),
(8, 11, 'SID013', '2024-06-27 09:18:56', NULL, NULL, NULL),
(9, 6, 'SID009', '2024-06-27 09:20:35', NULL, NULL, NULL),
(10, 11, 'SID013', '2024-06-27 14:18:27', NULL, NULL, NULL),
(11, 11, 'SID013', '2024-06-27 14:26:09', NULL, NULL, NULL),
(12, 4, 'SID023', '2024-06-27 18:32:01', NULL, NULL, NULL),
(13, 9, 'SID024', '2024-06-28 15:45:27', NULL, NULL, NULL),
(14, 3, 'SID025', '2024-06-28 16:05:43', NULL, NULL, NULL),
(15, 3, 'SID027', '2024-06-30 22:31:00', NULL, NULL, NULL),
(16, 1, 'SID028', '2024-07-01 12:32:47', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(11, 'SID013', 'Shiza', 'shiza@gmail.com', '0312456777', '7a76d2dedbcc6dbd171566ba3b2bd810', 1, '2024-06-23 13:12:45', '2024-06-28 16:12:31'),
(23, 'SID020', 'Maryam', 'maryam@gmail.com', '0323242455', 'c354aa2f2570a81e967de89d9985c998', 1, '2024-06-26 15:37:30', NULL),
(31, 'SID028', 'Sehrish', 'sehrish@gmail.com', '0324567890', 'ed91996f56e0b1f82f6d13b393c352c7', 1, '2024-07-01 01:17:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`Competition_ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Competition_ID` (`Competition_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_id` (`sub_id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `Competition_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`Competition_ID`) REFERENCES `competitions` (`Competition_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`Student_ID`) REFERENCES `tblstudents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD CONSTRAINT `fk_sub_id` FOREIGN KEY (`sub_id`) REFERENCES `subscription` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
