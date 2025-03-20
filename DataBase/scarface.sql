-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 04:54 PM
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
-- Database: `scarface`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_token` varchar(255) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `category_desc` text NOT NULL,
  `category_img` varchar(255) NOT NULL,
  `created_by_token` varchar(255) NOT NULL,
  `is_public` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_token`, `category_name`, `category_desc`, `category_img`, `created_by_token`, `is_public`) VALUES
(32, '250319050320200', 'Medicine', 'Discover AI-powered medicine tools—faster diagnoses, personalized treatments, and better care. Embrace the future of health today!', 'naser-67daeac80f6bb4.10627546.jpeg', '250318013449100', 1),
(34, '250319050835110', 'Video', 'Transform your videos with AI editing tools—effortless cuts, stunning effects, and professional results. Create like a pro in minutes!', 'naser-67daec03d7ddc2.99554427.jpeg', '250318013449100', 1),
(35, '250319051548159', 'Writing', 'Boost your writing with AI tools—craft smarter content, save time, and unlock your creativity. Write better, faster, and with ease!', 'naser-67daedb46098f8.63409395.jpeg', '250318013449100', 1),
(36, '250319051930179', 'Design', 'Unleash your creativity with AI design tools—smarter ideas, faster workflows, and stunning results. Elevate your designs effortlessly!', 'naser-67daee9226aee0.45905543.jpeg', '250318013449100', 1),
(37, '250319052101171', 'Coding', 'Supercharge your coding with AI tools—write cleaner code, debug faster, and build smarter. Code like a pro with ease!', 'naser-67daeeed15b298.07567752.png', '250318013449100', 1),
(38, '250319052249190', 'Content Creator', 'Elevate your content with AI tools—create faster, engage better, and grow your audience. Unlock your full creative potential!', 'naser-67daef59d9d7b4.38888722.webp', '250318013449100', 1),
(39, '250319054215162', 'MY video editing tools', 'All my tools and websites for video editng ', 'naser-67daf3e73cb7e0.18735489.webp', '250318014634183', 0),
(40, '250319054438106', 'css', 'Css websites and tools for my journey', 'naser-67daf47688dbe6.61962970.png', '250318014634183', 0),
(41, '250319054552134', 'javascript tools', 'my javascript website for learning ', 'naser-67daf4c00b1a72.01417797.png', '250318014634183', 0),
(42, '250319061252184', 'Success people', 'My websites that talking about reach people', 'naser-67dafb14952653.10047284.png', '250319060848163', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `tool_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `user_token`, `tool_token`) VALUES
(17, '250319060848163', '250320052637109'),
(18, '250319060848163', '250320052221190'),
(19, '250318014634183', '250319113337121');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `tool_id` int(11) NOT NULL,
  `tool_token` varchar(255) NOT NULL,
  `tool_name` varchar(150) NOT NULL,
  `category_token` varchar(255) NOT NULL,
  `tool_desc` text NOT NULL,
  `tool_img` varchar(255) NOT NULL,
  `tool_link` varchar(255) NOT NULL,
  `added_by_token` varchar(255) NOT NULL,
  `is_public` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`tool_id`, `tool_token`, `tool_name`, `category_token`, `tool_desc`, `tool_img`, `tool_link`, `added_by_token`, `is_public`) VALUES
(1, '250319072324128', 'success for people', '250319061252184', 'This is for successful people', 'naser-67db0b9cda5f70.67540961.jpeg', 'https://www.peopleforsuccess.eu/en-us/home', '250319060848163', 0),
(3, '250319081532132', 'Cursor', '250319052101171', 'An AI-powered integrated development environment (IDE) that enhances coding productivity by integrating advanced AI features directly into the coding environment.', 'naser-67db17d4339630.38916841.jpeg', 'https://www.cursor.com/', '250318013449100', 1),
(4, '250319113337121', 'talking avatars', '250319052249190', 'Creates AI-generated talking avatars from images and text.', 'naser-67db46412ea1c2.59725160.jpg', 'https://www.d-id.com/', '250318013449100', 1),
(5, '250320020528120', 'hack with js', '250319054552134', 'this webiste teach how to hack with js ', 'naser-67db69d85e2a55.66769096.jpeg', 'https://www.imperva.com/blog/javascript-drive-by-hacking-without-0days/', '250318014634183', 0),
(7, '250320020719184', 'Hack with js', '250319054552134', 'this hereldfkjklj jkdjflksd kdjlkfj ', 'naser-67db6a47645ec3.23631624.jpeg', 'https://www.peopleforsuccess.eu/en-us/home', '250318014634183', 0),
(8, '250320051244180', 'Jasper AI', '250319052249190', 'Jasper AI – AI-powered copywriting tool for marketing and social media.', 'naser-67db95bc4cb357.43005301.jpg', 'https://www.jasper.ai/', '250318013449100', 1),
(10, '250320051744133', 'Writesonic AI', '250319052249190', 'Writesonic – AI that helps generate high-quality marketing content.', 'naser-67db96e887c741.39603572.png', 'https://writesonic.com/', '250318013449100', 1),
(12, '250320052006178', 'Copy-AI', '250319052249190', 'Copy.ai – AI writing assistant for blog posts, ads, and product descriptions.', 'naser-67db9776a56544.89489528.jpg', 'https://www.copy.ai/', '250318013449100', 1),
(13, '250320052221190', 'Rytr-AI', '250319052249190', 'Rytr – Affordable AI writer for emails, captions, and blog content.', 'naser-67db97fdb63287.23094798.jpeg', 'https://rytr.me/', '250318013449100', 1),
(14, '250320052443153', 'Buffers.ai', '250319052249190', 'Buffer AI – AI-powered social media post scheduling and analytics.', 'naser-67db988be79d59.67883583.jpeg', 'https://buffer.com/', '250318013449100', 1),
(15, '250320052637109', 'Predis.ai', '250319052249190', 'Predis.ai – AI-based content generator for social media posts.', 'naser-67db98fd229756.43277581.jpg', 'https://predis.ai/', '250318013449100', 1),
(16, '250320052927160', 'Ocoya AI', '250319052249190', 'Ocoya – AI-driven marketing content creation and scheduling.', 'naser-67db99a76345b8.78835535.png', 'https://www.ocoya.com/', '250318013449100', 1),
(17, '250320055728105', 'success', '250319061252184', 'Success for new dreams will start from here ????.', 'naser-67dba038af9713.89188094.jpeg', 'https://www.success.com/', '250319060848163', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_token`, `user_name`, `user_email`, `user_phone`, `user_pass`, `is_admin`) VALUES
(1, '250318013449100', 'naser', 'naser@gmail.com', '324324', '1111', 101),
(2, '250318014634183', 'ahmed', 'ahmed@gmail.com', '222222222', '222', 0),
(3, '250319060848163', 'jamal', 'jamal@gmail.com', '78988798', 'jjj', 0),
(4, '250320055014113', 'Mirza', 'mirza@gmail.com', '32323', '333', 0),
(5, '250320055203188', 'Ala', 'ala@gmail.com', '99999', '555', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_token` (`category_token`),
  ADD KEY `category_token_2` (`category_token`),
  ADD KEY `created_by_token` (`created_by_token`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_token` (`user_token`),
  ADD KEY `tool_token` (`tool_token`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`tool_id`),
  ADD UNIQUE KEY `tool_token` (`tool_token`),
  ADD KEY `tool_token_2` (`tool_token`),
  ADD KEY `category_token` (`category_token`),
  ADD KEY `added_by_token` (`added_by_token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_token` (`user_token`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_email_2` (`user_email`),
  ADD KEY `user_token_2` (`user_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `tool_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`created_by_token`) REFERENCES `users` (`user_token`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_token`) REFERENCES `users` (`user_token`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`tool_token`) REFERENCES `tools` (`tool_token`) ON DELETE CASCADE;

--
-- Constraints for table `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_ibfk_1` FOREIGN KEY (`category_token`) REFERENCES `categories` (`category_token`),
  ADD CONSTRAINT `tools_ibfk_2` FOREIGN KEY (`added_by_token`) REFERENCES `users` (`user_token`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
