-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2021 at 08:07 PM
-- Server version: 5.7.33-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `huuhieuc_hstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `level`, `name`, `password`, `email`) VALUES
(1, 'admin', 2, 'Nguyễn Hữu Hiếu', '827ccb0eea8a706c4c34a16891f84e7b', 'huuhieu1711@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Gucci'),
(4, 'Dolce & Gabana'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `categorizes`
--

CREATE TABLE `categorizes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorizes`
--

INSERT INTO `categorizes` (`id`, `name`) VALUES
(0, 'Shirt'),
(2, 'Hoodies & Sweatshirts'),
(3, 'T-Shirts'),
(4, 'Jackets & Coats'),
(6, 'Jeans'),
(8, 'Shorts'),
(9, 'Paints');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `name`, `email`, `password`, `gender`, `phone`, `address`) VALUES
(1, 'demo', 'Nguyen Huu Hieu', 'huuhieu1711@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, '0971600284', 'hanoi, 1'),
(2, 'guest', 'Guest', 'guest@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, '', ''),
(17, 'huuhieu17', 'Hiếu Nguyễn Hữu', 'huuhieu17111@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, '', ''),
(18, 'hieuchuymbe', 'daicagialam', 'duy9ath@gmail.com', 'dc647eb65e6711e155375218212b3964', 0, '', ''),
(19, 'taolahieu', 'Bo la Hieu duoc chua', 'bohieuday@gmail.com', '6ff9f11bc42c247b18cfec1557b030ab', 0, '', ''),
(21, 'aaa', 'aaa', 'aa@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `total_amounts` float NOT NULL,
  `receiver` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `note` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `create_at`, `total_amounts`, `receiver`, `phone`, `address`, `status`, `id_customer`, `id_admin`, `note`) VALUES
(1, '2021-03-08 06:46:24', 780, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(2, '2021-02-27 18:07:32', 780, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(3, '2021-02-27 18:08:22', 780, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(4, '2021-02-27 18:09:27', 3120, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(5, '2021-02-27 18:17:21', 0, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(6, '2021-02-27 18:54:27', 2720, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(7, '2021-02-27 19:12:02', 8160, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(8, '2021-02-27 19:25:26', 9730, 'Nguyen Huu Hieu', '123123213', '12321', 1, 1, NULL, '12321'),
(9, '2021-02-27 19:27:37', 4865, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(10, '2021-03-03 09:08:39', 9730, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(11, '2021-02-27 20:31:58', 11230, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(12, '2021-02-27 21:08:45', 4865, 'Guest', '123213', '1232131', 3, 2, 1, '123213'),
(13, '2021-04-05 08:25:03', 1300, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 2, 1, 1, ''),
(14, '2020-03-09 09:37:50', 6800, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 3, 1, NULL, ''),
(15, '2021-03-10 18:34:29', 1700, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 3, 1, 1, ''),
(16, '2021-03-10 20:34:05', 3400, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(17, '2021-03-12 19:38:20', 4865, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(18, '2021-03-12 19:38:20', 4865, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(19, '2021-03-12 19:38:21', 4865, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(20, '2021-03-12 19:38:51', 3400, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(21, '2021-03-12 19:38:52', 3400, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(22, '2021-03-12 19:40:20', 9800, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(23, '2021-03-12 19:42:35', 5100, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(24, '2021-03-12 19:42:35', 5100, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(25, '2021-03-12 19:42:55', 9730, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(26, '2021-03-12 19:45:17', 3400, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(27, '2021-03-16 08:33:00', 1700, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(28, '2021-03-16 09:39:16', 85705, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(29, '2021-03-17 07:26:15', 1700, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 2, 1, 1, ''),
(30, '2021-03-17 17:48:08', 5100, 'Hà Nội', '', '', 1, 17, NULL, ''),
(31, '2021-03-17 17:48:42', 3640, 'Hi?u Nguy?n H?u', '', '', 1, 17, NULL, ''),
(32, '2021-03-18 08:36:14', 40055, 'daicagialam', '0352806324', 'Ha Noi', 3, 18, 1, 'Sale 50% thi mua khong thi cat di'),
(33, '2021-03-22 07:50:20', 15600, 'Bo la Hieu duoc chua', '113', 'Dubai', 1, 19, NULL, 'Gui cho 1000 cai khong deo lay'),
(34, '2021-03-22 07:50:59', 1700, 'Bo la Hieu duoc chua', '113', 'Han Quoc', 1, 19, NULL, 'Cho k'),
(35, '2021-03-22 07:52:26', 155680, 'Tao l', '115', 'nam ??nh', 3, 19, 1, 'b'),
(36, '2021-03-22 17:17:41', 2600, 'nguyễn hữu hiếu', '', 'Hà Nội', 1, 2, NULL, ''),
(37, '2021-03-22 17:55:02', 1300, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(38, '2021-03-26 16:15:02', 6860, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 0, 1, NULL, ''),
(39, '2021-03-26 18:14:10', 980, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, NULL, ''),
(40, '2021-03-26 18:14:10', 980, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 1, 1, 1, ''),
(41, '2021-03-27 02:39:16', 980, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 2, 1, 1, ''),
(42, '2021-03-27 02:56:10', 3260, 'Nguyen Huu Hieu', '0971600284', 'hanoi, 1', 3, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_detail`
--

CREATE TABLE `invoices_detail` (
  `id_product` int(11) NOT NULL,
  `id_invoices` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices_detail`
--

INSERT INTO `invoices_detail` (`id_product`, `id_invoices`, `quantity`) VALUES
(1, 6, 4),
(2, 7, 12),
(3, 16, 5),
(8, 11, 2),
(8, 32, 8),
(19, 4, 4),
(19, 31, 3),
(25, 10, 2),
(25, 12, 1),
(26, 8, 1),
(26, 25, 2),
(26, 32, 7),
(27, 9, 1),
(27, 11, 2),
(27, 35, 32),
(28, 8, 1),
(28, 17, 1),
(28, 28, 25),
(32, 13, 1),
(32, 31, 1),
(32, 36, 2),
(32, 37, 1),
(32, 42, 1),
(33, 22, 1),
(33, 28, 1),
(34, 33, 12),
(37, 22, 5),
(37, 23, 3),
(38, 14, 4),
(38, 27, 1),
(38, 29, 1),
(39, 15, 1),
(39, 28, 1),
(40, 34, 1),
(42, 20, 2),
(42, 26, 2),
(42, 30, 3),
(45, 41, 1),
(45, 42, 2),
(46, 39, 1),
(47, 38, 7);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `content` varchar(255) NOT NULL,
  `time` varchar(50) NOT NULL,
  `editor` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `img`, `content`, `time`, `editor`) VALUES
(1, 'The Long Sleeved Shirt - New Products', 'ee28d22c60e803ee1ea5a339b24acbf8.jpg', '<p>Redirect</p>\r\n', '2021-03-11 23:31:49', 'Nguyễn Hữu Hiếu'),
(6, 'Casua Tee - New Arrival', '37f42d11a6a7cc6c5de07f50e98c9127411b5ec2f92d28da51dda7dd.jpg', '<p>abc123</p>\r\n', '2021-03-12 00:48:43', 'Nguyễn Hữu Hiếu');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_gender` tinyint(4) NOT NULL,
  `product_price` float DEFAULT NULL,
  `product_description` text,
  `product_brand` int(11) NOT NULL,
  `product_type` int(11) NOT NULL,
  `product_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_gender`, `product_price`, `product_description`, `product_brand`, `product_type`, `product_status`) VALUES
(1, 'Cotton shirt', 1, 680, '<p>Adding a subtle logo connotation, the Double G embroidery inspired by the &#39;70s archives enriches the front of this tailored shirt, crafted from white cotton and finished with a point collar.</p>\r\n\r\n<ul>\r\n	<li>White cotton</li>\r\n	<li>Mother of pearl buttons</li>\r\n	<li>Point collar</li>\r\n	<li>Chest patch pocket with Double G embroidery</li>\r\n	<li>Long sleeves</li>\r\n	<li>Length: 30.5&quot;</li>\r\n	<li>Sleeve length: 35.5&quot;</li>\r\n	<li>Measurements are based on a size 15+</li>\r\n	<li>100% Cotton</li>\r\n	<li>Made in Italy</li>\r\n</ul>\r\n', 1, 0, 1),
(2, 'Striped cotton shirt', 1, 750, '<p>Adding a subtle logo connotation, the Gucci label stitched at the cuff plays with the idea of sartorial tags and reimagines it through a contemporary lens. The detail defines a cream and blue striped cotton shirt, designed with a &#39;70s inspired point collar and chest patch pocket.</p>\r\n\r\n<ul>\r\n	<li>Cream and blue striped cotton</li>\r\n	<li>Stitched Gucci label on the cuff</li>\r\n	<li>&#39;70s inspired point collar</li>\r\n	<li>Chest patch pocket</li>\r\n	<li>Long sleeves</li>\r\n	<li>100% Cotton</li>\r\n	<li>Made in Italy</li>\r\n</ul>\r\n', 1, 0, 1),
(4, 'Cotton t-shirt with camouflage-print pocket', 1, 780, '<p>Camouflage, a signature Dolce&amp;Gabbana print, has been given a contemporary makeover. Coming in burgundy, black/white and pure white, it pairs perfectly with the floral, stripe and iconic polka dot motifs.<br />\r\nCotton jersey T-shirt with nylon patch pocket featuring the camouflage print:<br />\r\n&bull; Loose fit<br />\r\n&bull; Short sleeves<br />\r\n&bull; The piece measures 73 cm - 28.7 inches from the rear collar seam on a size M<br />\r\n&bull; The model is 185 cm - 72.8 inches tall and wears a size M<br />\r\n&bull; Made in Italy</p>\r\n', 4, 3, 1),
(5, 'Lambskin jacket', 1, 4865, '<p>In the Dolce&amp;Gabbana collection, our Sicilian roots and tailoring expertise mix with layering and new volume to create a sophisticated and contemporary update on our signature aesthetic. Lambskin jacket:<br />\r\n&bull; Regular fit<br />\r\n&bull; Shirt-style collar<br />\r\n&bull; Front zipper fastening<br />\r\n&bull; Zipped welt pockets<br />\r\n&bull; Cuffs with zipper<br />\r\n&bull; Two inner welt pockets with zipper<br />\r\n&bull; Lined<br />\r\n&bull; The piece measures 62 cm - 24.4 inches from the rear collar seam on a size IT 48<br />\r\n&bull; The model is 185 cm - 72.8 inches tall and wears a size IT 48<br />\r\n&bull; Made in Italy</p>\r\n', 4, 4, 1),
(6, 'G jacquard wool flare pant', 0, 1300, '<p>A new play on the classic G logo animates this wool flare pant, imagined to be worn with its coordinating jacket and vest. The House name is reinterpreted in new ways each season with a different play on its lettering. Pieces with versatile ways to wear and style embrace each person who is part of the House&rsquo;s individual spirit.</p>\r\n\r\n<ul>\r\n	<li>Brown and beige G jacquard wool grisaille</li>\r\n	<li>Self-covered buttons</li>\r\n	<li>Half-lined</li>\r\n	<li>Interior tape belt</li>\r\n	<li>Front on-seam pockets</li>\r\n	<li>Back button-through besom pockets</li>\r\n	<li>Hook and zip closure</li>\r\n	<li>Sits high on the waist; flared leg</li>\r\n	<li>Leg opening: 25.2&quot; based on a size 40 (IT)</li>\r\n	<li>Length: 41&quot; based on a size 40 (IT)</li>\r\n	<li>100% Wool</li>\r\n	<li>Made in Italy</li>\r\n</ul>\r\n', 1, 9, 1),
(7, 'Doraemon x Gucci wool sweater', 0, 1700, '<p>This wool sweater is part of a special collaboration between Doraemon and Gucci. Born on September 3rd, 2112, a cat-type robot was sent from the 22nd century to help a young boy called Nobita with secret gadgets from his four-dimensional pouch. A playful character, Doraemon hates mice and loves Dorayaki, a sweet pancake.</p>\r\n\r\n<ul>\r\n	<li>Pink wool</li>\r\n	<li>Doraemon and rose intarsia &copy; Fujiko-Pro</li>\r\n	<li>Gucci label on the back</li>\r\n	<li>Doraemon x Gucci &copy; Fujiko-Pro</li>\r\n	<li>Crewneck</li>\r\n	<li>100% Wool</li>\r\n	<li>Made in Italy</li>\r\n	<li>The product shown in this image is a size small</li>\r\n</ul>\r\n', 1, 2, 1),
(8, 'Ken Scott print silk shorts', 0, 980, '<p>The Epilogue collection takes shape in silhouettes inspired by the &lsquo;70s, featuring oversized botanical prints and rainbow stripes sourced from Ken Scott&rsquo;s archive. Nicknamed the &lsquo;Fashion Gardener,&rsquo; Ken Scott was an American designer who lived in Milan in the &lsquo;60s and &lsquo;70s and whose colorful floral drawings were reflective of his eclectic personality. A vivid print inspired by the world of nature decorates these silk cr&ecirc;pe shorts.</p>\r\n\r\n<ul>\r\n	<li>Print taken from Ken Scott archives</li>\r\n	<li>Green silk cr&ecirc;pe with light green and pink daisy print by Ken Scott&mdash;Ken Scott is brand of Mantero</li>\r\n	<li>Contrast piping</li>\r\n	<li>Back &#39;George Kenneth Scott Gucci&#39; label</li>\r\n	<li>Elastic waistband</li>\r\n	<li>Front on-seam pockets</li>\r\n	<li>Back patch pockets</li>\r\n	<li>100% Silk</li>\r\n	<li>Made in Italy</li>\r\n</ul>\r\n', 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `url`) VALUES
(1, 'product_1_0.jpg'),
(1, 'product_1_1.jpg'),
(1, 'product_1_2.jpg'),
(1, 'product_1_3.jpg'),
(1, 'product_1_4.jpg'),
(2, 'product_2_0.jpg'),
(2, 'product_2_1.jpg'),
(2, 'product_2_2.jpg'),
(2, 'product_2_3.jpg'),
(2, 'product_2_4.jpg'),
(4, 'product_4_0.jpg'),
(4, 'product_4_1.jpg'),
(4, 'product_4_2.jpg'),
(4, 'product_4_3.jpg'),
(4, 'product_4_4.jpg'),
(5, 'product_5_0.jpg'),
(5, 'product_5_1.jpg'),
(5, 'product_5_2.jpg'),
(5, 'product_5_3.jpg'),
(6, 'product_6_0.jpg'),
(6, 'product_6_1.jpg'),
(6, 'product_6_2.jpg'),
(6, 'product_6_3.jpg'),
(7, 'product_7_0.jpg'),
(7, 'product_7_1.jpg'),
(7, 'product_7_2.jpg'),
(7, 'product_7_3.jpg'),
(7, 'product_7_4.jpg'),
(8, 'product_8_0.jpg'),
(8, 'product_8_1.jpg'),
(8, 'product_8_2.jpg'),
(8, 'product_8_3.jpg'),
(8, 'product_8_4.jpg'),
(8, 'product_8_5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_variant_value_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `product_variant_value_id`, `status`) VALUES
(23, 1, 1, 0),
(24, 1, 2, 0),
(25, 1, 3, 0),
(26, 1, 4, 0),
(27, 1, 5, 0),
(28, 1, 6, 0),
(29, 1, 7, 0),
(30, 1, 8, 0),
(31, 1, 9, 1),
(32, 1, 10, 0),
(33, 1, 11, 0),
(34, 2, 1, 0),
(35, 2, 2, 0),
(36, 2, 3, 0),
(37, 2, 4, 0),
(38, 2, 5, 0),
(39, 2, 6, 0),
(40, 2, 7, 0),
(41, 2, 8, 0),
(42, 2, 9, 1),
(43, 2, 10, 0),
(44, 2, 11, 0),
(56, 4, 1, 1),
(57, 4, 2, 0),
(58, 4, 3, 0),
(59, 4, 4, 0),
(60, 4, 5, 0),
(61, 4, 6, 0),
(62, 4, 7, 0),
(63, 4, 8, 0),
(64, 4, 9, 0),
(65, 4, 10, 0),
(66, 4, 11, 0),
(67, 5, 1, 1),
(68, 5, 2, 0),
(69, 5, 3, 0),
(70, 5, 4, 0),
(71, 5, 5, 0),
(72, 5, 6, 0),
(73, 5, 7, 0),
(74, 5, 8, 0),
(75, 5, 9, 0),
(76, 5, 10, 0),
(77, 5, 11, 0),
(78, 6, 1, 0),
(79, 6, 2, 0),
(80, 6, 3, 0),
(81, 6, 4, 0),
(82, 6, 5, 0),
(83, 6, 6, 0),
(84, 6, 7, 0),
(85, 6, 8, 0),
(86, 6, 9, 0),
(87, 6, 10, 1),
(88, 6, 11, 0),
(89, 7, 1, 0),
(90, 7, 2, 0),
(91, 7, 3, 0),
(92, 7, 4, 0),
(93, 7, 5, 0),
(94, 7, 6, 0),
(95, 7, 7, 0),
(96, 7, 8, 1),
(97, 7, 9, 0),
(98, 7, 10, 0),
(99, 7, 11, 0),
(100, 8, 1, 0),
(101, 8, 2, 0),
(102, 8, 3, 0),
(103, 8, 4, 0),
(104, 8, 5, 0),
(105, 8, 6, 1),
(106, 8, 7, 0),
(107, 8, 8, 0),
(108, 8, 9, 0),
(109, 8, 10, 0),
(110, 8, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sku`
--

CREATE TABLE `sku` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sku`
--

INSERT INTO `sku` (`id`, `product_id`, `sku`, `color_id`, `size_id`, `quantity`) VALUES
(1, 1, 'P1C9S12', 9, 12, 9),
(2, 1, 'P1C9S13', 9, 13, 87),
(3, 1, 'P1C9S14', 9, 14, 118),
(4, 1, 'P1C9S15', 9, 15, 1),
(5, 1, 'P1C9S16', 9, 16, 1),
(6, 1, 'P1C9S17', 9, 17, 1),
(7, 2, 'P2C9S12', 9, 12, 12),
(8, 2, 'P2C9S13', 9, 13, 0),
(9, 2, 'P2C9S14', 9, 14, 0),
(10, 2, 'P2C9S15', 9, 15, 0),
(11, 2, 'P2C9S16', 9, 16, 0),
(12, 2, 'P2C9S17', 9, 17, 0),
(19, 4, 'P4C1S12', 1, 12, 98),
(20, 4, 'P4C1S13', 1, 13, 0),
(21, 4, 'P4C1S14', 1, 14, 12),
(22, 4, 'P4C1S15', 1, 15, 12),
(23, 4, 'P4C1S16', 1, 16, 10),
(24, 4, 'P4C1S17', 1, 17, 0),
(25, 5, 'P5C1S12', 1, 12, 97),
(26, 5, 'P5C1S13', 1, 13, 0),
(27, 5, 'P5C1S14', 1, 14, 220),
(28, 5, 'P5C1S15', 1, 15, 99),
(29, 5, 'P5C1S16', 1, 16, 0),
(30, 5, 'P5C1S17', 1, 17, 0),
(31, 6, 'P6C10S12', 10, 12, 12),
(32, 6, 'P6C10S13', 10, 13, 6),
(33, 6, 'P6C10S14', 10, 14, 10),
(34, 6, 'P6C10S15', 10, 15, 0),
(35, 6, 'P6C10S16', 10, 16, 0),
(36, 6, 'P6C10S17', 10, 17, 0),
(37, 7, 'P7C8S12', 8, 12, 103),
(38, 7, 'P7C8S13', 8, 13, 105),
(39, 7, 'P7C8S14', 8, 14, 109),
(40, 7, 'P7C8S15', 8, 15, 110),
(41, 7, 'P7C8S16', 8, 16, 111),
(42, 7, 'P7C8S17', 8, 17, 104),
(43, 8, 'P8C6S12', 6, 12, 12),
(44, 8, 'P8C6S13', 6, 13, 12),
(45, 8, 'P8C6S14', 6, 14, 9),
(46, 8, 'P8C6S15', 6, 15, 11),
(47, 8, 'P8C6S16', 6, 16, 1205),
(48, 8, 'P8C6S17', 6, 17, 12);

-- --------------------------------------------------------

--
-- Table structure for table `variant_group`
--

CREATE TABLE `variant_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variant_group`
--

INSERT INTO `variant_group` (`id`, `name`) VALUES
(1, 'color'),
(2, 'size');

-- --------------------------------------------------------

--
-- Table structure for table `variant_value`
--

CREATE TABLE `variant_value` (
  `id` int(11) NOT NULL,
  `variant_group_id` int(11) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variant_value`
--

INSERT INTO `variant_value` (`id`, `variant_group_id`, `value`) VALUES
(1, 1, 'Black'),
(2, 1, 'Blue'),
(3, 1, 'Red'),
(4, 1, 'Yellow'),
(5, 1, 'Gray'),
(6, 1, 'Green'),
(7, 1, 'Orange'),
(8, 1, 'Pink'),
(9, 1, 'White'),
(10, 1, 'Brown'),
(11, 1, 'Purple'),
(12, 2, 'S'),
(13, 2, 'M'),
(14, 2, 'L'),
(15, 2, 'XL'),
(16, 2, 'XXL'),
(17, 2, 'XXXL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorizes`
--
ALTER TABLE `categorizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `phone` (`phone`) USING BTREE;

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `invoices_detail`
--
ALTER TABLE `invoices_detail`
  ADD PRIMARY KEY (`id_product`,`id_invoices`),
  ADD KEY `id_invoices` (`id_invoices`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_brand` (`product_brand`),
  ADD KEY `product_type` (`product_type`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`,`url`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_variant_value_id` (`product_variant_value_id`);

--
-- Indexes for table `sku`
--
ALTER TABLE `sku`
  ADD PRIMARY KEY (`id`,`color_id`,`size_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Indexes for table `variant_group`
--
ALTER TABLE `variant_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant_value`
--
ALTER TABLE `variant_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variant_group_id` (`variant_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categorizes`
--
ALTER TABLE `categorizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `sku`
--
ALTER TABLE `sku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `variant_group`
--
ALTER TABLE `variant_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `variant_value`
--
ALTER TABLE `variant_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`);

--
-- Constraints for table `invoices_detail`
--
ALTER TABLE `invoices_detail`
  ADD CONSTRAINT `invoices_detail_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `sku` (`id`),
  ADD CONSTRAINT `invoices_detail_ibfk_2` FOREIGN KEY (`id_invoices`) REFERENCES `invoices` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`product_type`) REFERENCES `categorizes` (`id`);

--
-- Constraints for table `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_ibfk_1` FOREIGN KEY (`id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_variants_ibfk_2` FOREIGN KEY (`product_variant_value_id`) REFERENCES `variant_value` (`id`);

--
-- Constraints for table `sku`
--
ALTER TABLE `sku`
  ADD CONSTRAINT `sku_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sku_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `variant_value` (`id`),
  ADD CONSTRAINT `sku_ibfk_4` FOREIGN KEY (`color_id`) REFERENCES `variant_value` (`id`);

--
-- Constraints for table `variant_value`
--
ALTER TABLE `variant_value`
  ADD CONSTRAINT `variant_value_ibfk_1` FOREIGN KEY (`variant_group_id`) REFERENCES `variant_group` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
