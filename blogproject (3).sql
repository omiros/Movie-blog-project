-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 10, 2014 at 11:36 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blogproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
`admin_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `email`, `access`) VALUES
(1, 'Elias', 'test', 'omiros76@gmail.com', 1),
(10, 'Marcus', 'test', 'nn@nn.com', 2),
(11, 'Lisa', 'test', 'lisa@hotmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
`post_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `image_path` text NOT NULL,
  `post_content` text NOT NULL,
  `visible` int(11) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`post_id`, `admin_id`, `username`, `category_name`, `post_title`, `image_path`, `post_content`, `visible`, `post_date`) VALUES
(95, 1, 'Elias', 'comedy', 'Another favorite', 'http://localhost/blog_project/uploads/achilles.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '2014-11-30 08:51:07'),
(102, 1, 'Elias', 'drama', 'Icarus2', 'http://localhost/blog_project/uploads/icarus2.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '2014-11-30 09:04:08'),
(104, 1, 'Elias', 'animate', 'Akilles', 'http://localhost/blog_project/uploads/achilles.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '2014-11-30 09:06:43'),
(105, 1, 'Elias', 'romance', 'Movie 1', 'http://localhost/blog_project/uploads/screenshot-lrg-02 (2).png', 'Lorem i saw beyonces tizzles and my pizzle went crizzle crazy sit amet, for sure adipiscing pimpin''. Break yo neck, yall sapizzle velizzle, pimpin'' volutpizzle, suscipit quizzle, gravida things, arcu. Pellentesque eget tortizzle. Sed erizzle. Fizzle shut the shizzle up yo mamma sure brizzle tempizzle dawg.', 1, '2014-11-30 19:27:34'),
(111, 1, 'Elias', 'comedy', 'Movie 2', 'http://localhost/blog_project/uploads/screenshot-lrg-10.png', 'Lorem i saw beyonces tizzles and my pizzle went crizzle crazy sit amet, for sure adipiscing pimpin''. Break yo neck, yall sapizzle velizzle, pimpin'' volutpizzle, suscipit quizzle, gravida things, arcu. Pellentesque eget tortizzle. Sed erizzle. Fizzle shut the shizzle up yo mamma sure brizzle tempizzle dawg.', 1, '2014-11-30 19:47:49'),
(113, 1, 'Elias', 'action', 'Movie 3', 'http://localhost/blog_project/uploads/screenshot-lrg-10 (2).png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '2014-11-30 19:51:53'),
(114, 1, 'Elias', 'action', 'Movie 4', 'http://localhost/blog_project/uploads/screenshot-lrg-10 (1).png', 'Lorem i saw beyonces tizzles and my pizzle went crizzle crazy sit amet, for sure adipiscing pimpin''. Break yo neck, yall sapizzle velizzle, pimpin'' volutpizzle, suscipit quizzle, gravida things, arcu. Pellentesque eget tortizzle. Sed erizzle. Fizzle shut the shizzle up yo mamma sure brizzle tempizzle dawg.', 1, '2014-11-30 19:56:32'),
(116, 1, 'Elias', 'comedy', 'Movie 5', 'http://localhost/blog_project/uploads/screenshot-lrg-05.png', 'Lorem i saw beyonces tizzles and my pizzle went crizzle crazy sit amet, for sure adipiscing pimpin''. Break yo neck, yall sapizzle velizzle, pimpin'' volutpizzle, suscipit quizzle, gravida things, arcu. Pellentesque eget tortizzle. Sed erizzle. Fizzle shut the shizzle up yo mamma sure brizzle tempizzle dawg.', 1, '2014-11-30 20:01:27'),
(123, 1, 'Elias', 'scifi', 'Test 5', 'http://localhost/blog_project/uploads/screenshot-lrg-07.png', 'Lorem i saw beyonces tizzles and my pizzle went crizzle crazy sit amet, for sure adipiscing pimpin''. Break yo neck, yall sapizzle velizzle, pimpin'' volutpizzle, suscipit quizzle, gravida things, arcu. Pellentesque eget tortizzle. Sed erizzle. Fizzle shut the shizzle up yo mamma sure brizzle tempizzle dawg.', 1, '2014-11-30 20:37:02'),
(133, 1, 'Elias', 'scifi', 'Some movie 2', 'http://localhost/blog_project/uploads/m00602_lrg_05.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '2014-12-01 15:42:35'),
(134, 1, 'Elias', 'scifi', 'Oblivion', 'http://localhost/blog_project/uploads/oblivion-blu-ray-screenshot-0019357-I-1920.jpg', 'Good movie\r\nLorem i saw beyonces tizzles and my pizzle went crizzle crazy sit amet, for sure adipiscing pimpin''. Break yo neck, yall sapizzle velizzle, pimpin'' volutpizzle, suscipit quizzle, gravida things, arcu. Pellentesque eget tortizzle. Sed erizzle. Fizzle shut the shizzle up yo mamma sure brizzle tempizzle dawg', 0, '2014-12-01 16:00:30'),
(147, 1, 'Elias', 'comedy', 'Comedy', 'http://localhost/blog_project/uploads/screenshot-0009698-I.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 0, '2014-12-02 16:31:46'),
(150, 10, 'Marcus', 'scifi', 'Jurassic-world', 'http://localhost/blog_project/uploads/jurassic-world.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quis non odit sordidos, vanos, leves, futtiles? Equidem etiam Epicurum, in physicis quidem, Democriteum puto. Nam memini etiam quae nolo, oblivisci non possum quae volo. Ego vero volo in virtute vim esse quam maximam; Hic ambiguo ludimur.', 1, '2014-12-03 00:25:48'),
(151, 10, 'Marcus', 'drama', 'Some nice movie', 'http://localhost/blog_project/uploads/m00602_lrg_12.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quis non odit sordidos, vanos, leves, futtiles? Equidem etiam Epicurum, in physicis quidem, Democriteum puto. Nam memini etiam quae nolo, oblivisci non possum quae volo. Ego vero volo in virtute vim esse quam maximam; Hic ambiguo ludimur. ', 1, '2014-12-03 00:28:45'),
(152, 1, 'Elias', 'comedy', 'Bild', 'http://localhost/blog_project/uploads/screenshot-0001864-I.png', 'asdsdsad', 0, '2014-12-03 10:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
`comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `post_title` varchar(30) NOT NULL,
  `author_name` varchar(30) NOT NULL,
  `author_email` varchar(30) NOT NULL,
  `comment_text` text NOT NULL,
  `reply` text,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `admin_id`, `post_title`, `author_name`, `author_email`, `comment_text`, `reply`, `comment_time`) VALUES
(58, 69, 1, 'Watch this movie twice!', 'Marcus', 'nn@nn.com', 'Väldigt bra film!', 'Best movie ever!', '2014-11-29 22:46:12'),
(68, 77, 1, 'Test345', 'Lasse', 'lars@gmail.com', 'Sämsta filmen', 'Tack f?r ditt svar', '2014-12-02 22:03:53'),
(70, 73, 1, 'The best tv-series', 'Lisa', 'lisa@hotmail.com', 'Hej', 'Tack f?r ditt svar Lisa', '2014-12-03 08:41:24'),
(73, 73, 1, 'The best tv-series', 'asadasdasd', 'test@test.com', 'test', 'Test success', '2014-12-04 11:10:02'),
(76, 150, 10, 'Jurassic-world', 'Elasi', 'asd@gmail', 'sadsadasdas', NULL, '2014-12-05 13:59:38'),
(77, 150, 10, 'Jurassic-world', 'asdds', '', 'ssadad', NULL, '2014-12-05 14:00:35'),
(78, 150, 10, 'Jurassic-world', 'as', '', 'asa', NULL, '2014-12-05 14:06:10'),
(79, 150, 10, 'Jurassic-world', '', '', '', NULL, '2014-12-05 14:06:18'),
(80, 150, 10, 'Jurassic-world', 'Asle', '', 'Hej!', NULL, '2014-12-05 14:07:23'),
(81, 95, 1, 'Another favorite', 'Elias', 'nn@nn.com', 'My favorite', 'tack', '2014-12-06 21:16:08'),
(82, 152, 1, 'Bild', 'elias', 'omiros76@gmail.com', 'Hej', NULL, '2014-12-06 21:37:05'),
(83, 102, 1, 'Icarus2', 'Elias', 'omir76@gmail.com', 'Film när den är som bäst!', 'Tack f?r ditt svar Elias!', '2014-12-06 21:53:45'),
(84, 104, 1, 'Akilles', 'Lars', 'lars@gmail.com', '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', NULL, '2014-12-07 14:00:20'),
(85, 95, 1, 'Another favorite', 'Andrea', 'andrea@gmail.com', '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', NULL, '2014-12-07 14:02:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`admin_id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
 ADD PRIMARY KEY (`post_id`), ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
