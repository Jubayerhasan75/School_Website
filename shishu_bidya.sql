-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2026 at 12:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shishu_bidya`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_info`
--

CREATE TABLE `admission_info` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_info`
--

INSERT INTO `admission_info` (`id`, `content`) VALUES
(1, 'আমাদের স্কুলে নার্সারি থেকে পঞ্চম শ্রেণি পর্যন্ত সরাসরি স্কুলে এসে সশরীরে আবেদনের মাধ্যমে ভর্তি হওয়া যায়।');

-- --------------------------------------------------------

--
-- Table structure for table `class_parties`
--

CREATE TABLE `class_parties` (
  `id` int(11) NOT NULL,
  `class_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_parties`
--

INSERT INTO `class_parties` (`id`, `class_name`, `description`, `image`) VALUES
(4, '5', '\"শিশু বিদ্যা নিকেতনের পঞ্চম শ্রেণির শিক্ষার্থীদের অংশগ্রহণে অত্যন্ত আনন্দঘন পরিবেশে বার্ষিক ক্লাস পার্টি অনুষ্ঠিত হয়েছে। দিনব্যাপী এই আয়োজনে শিক্ষার্থীদের পরিবেশনায় মনোজ্ঞ সাংস্কৃতিক অনুষ্ঠান, খেলাধুলা এবং মজাদার খাবারের ব্যবস্থা ছিল। সম্মানিত শিক্ষকবৃন্দ ও শিক্ষার্থীদের স্বতঃস্ফূর্ত অংশগ্রহণে দিনটি সবার জন্য এক চমৎকার স্মৃতি হয়ে থাকবে।\"', 'OIP (6).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `image`, `category`) VALUES
(5, 'Class Party', 'OIP (5).jpg', 'Class Party');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `contact`, `message`, `date`) VALUES
(1, 'Ariful Islam', 'ariful@gmail.com', 'I want to admit my son in your school so please give me all the information for admission ..\r\n', '2026-04-12 21:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `description`, `date`) VALUES
(1, 'শুভ নববর্ষ ১৪৩৩! আগামী ১৪ই এপ্রিল স্কুল বন্ধ থাকার বিজ্ঞপ্তি', '\"সম্মানিত অভিভাবক ও স্নেহের শিক্ষার্থীবৃন্দ,\r\nসবাইকে জানাই বাংলা নববর্ষের প্রাণঢালা শুভেচ্ছা! শুভ নববর্ষ ১৪৩৩!\r\n\r\nআনন্দের সাথে জানানো যাচ্ছে যে, পহেলা বৈশাখ উপলক্ষে আগামী ১৪ই এপ্রিল (বৃহস্পতিবার) শিশু বিদ্যা নিকেতনের সকল প্রকার শ্রেণি কার্যক্রম ও দাপ্তরিক কাজ বন্ধ থাকবে।\r\n\r\nনতুন বছর আপনাদের সবার জীবনে বয়ে আনুক অনাবিল আনন্দ, শান্তি ও সমৃদ্ধি। আগামী ১৫ই এপ্রিল (শুক্রবার) থেকে স্কুলের স্বাভাবিক কার্যক্রম পুনরায় শুরু হবে।\r\n\r\nধন্যবাদান্তে,\r\nপ্রধান শিক্ষিকা,\r\nশিশু বিদ্যা নিকেতন।\"', '2026-04-12 18:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `image`) VALUES
(1, '', 'slide2.png'),
(2, '', 'arts-advocacy.jpg'),
(3, 'SHAGOTOM', 'slide1.png');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `class`, `roll_no`, `image`) VALUES
(3, 'Rohan', '5', '1', 'OIP.jpg'),
(4, 'Hasanul Fahim', '5', '2', '1_MxYW_j29KRGKr4VpEdnBCw.png'),
(5, 'Sf Tonmoy', '5', '3', '06b37e0b-42ef-464d-aca8-48a147507868.jpg'),
(7, 'Fardin Hossain', '3', '1', '360_F_125821215_yoIIsTPyiXFdnH9DA2GOeId3fv4b8FNw.jpg'),
(8, 'Sakif Muhtasim', '4', '2', '1_MxYW_j29KRGKr4VpEdnBCw.png'),
(9, 'Pollob Nath', '4', '1', 'passport-photo-portrait-young-man-white-background_1028938-330512.avif'),
(10, 'Humayra Fahmida', '1', '1', 'photo-smiling-teenage-girl-face-260nw-1059230255.webp');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `qualification` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `joggota` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `designation`, `phone`, `email`, `qualification`, `image`, `joggota`) VALUES
(5, 'Jubayer Hasan', 'Head Master', '01305315805', 'jubayerhasanrohan@gmail.com', '', 'model.png.jpg', 'PHD from Australia'),
(6, 'Md.Sarwar Jahan', 'Assistant Head Master', '01256544888', 'sj.jahan@gmail.com', 'PHD from USA', 'OIP (1).jpg', 'PHD from USA'),
(8, 'Ajay Devgan', 'Lecturer', '01354589655', 'devgan@gmail.com', NULL, 'OIP (4).jpg', 'PHD from India'),
(9, 'Ummey Kulsum', 'Head Mistress', '0135365485621', 'ummey@gmail.com', NULL, 'OIP (3).jpg', 'PHD from Japan'),
(11, 'Md.Abul Bashar Sarkar', 'Lecturer', '01356655887', 'abul.bashar@gmail.com', NULL, '1_MxYW_j29KRGKr4VpEdnBCw.png', 'PHD from Germany ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_info`
--
ALTER TABLE `admission_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_parties`
--
ALTER TABLE `class_parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_info`
--
ALTER TABLE `admission_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_parties`
--
ALTER TABLE `class_parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
