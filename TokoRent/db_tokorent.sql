-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2026 at 10:58 AM
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
-- Database: `db_tokorent`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_name`, `username`, `password`, `admin_telp`, `admin_email`, `admin_address`) VALUES
(1, 'Darrent Martinerry Amanullah', 'admin', '21232f297a57a5a743894a0e4a801fc3', '087786431300', 'darrent.martin10@gmail.com', 'Jl. Subur, Susukan, Ciracas, Jakarta Timur');

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`) VALUES
(5, 'Handphone'),
(6, 'Laptop'),
(14, 'TABLET'),
(17, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_status`, `data_created`) VALUES
(28, 14, 'Samsung Galaxy Tab S11 Ultra', 22999000, '<p>Samsung Galaxy Tab S11 Ultra (rilis akhir 2025) adalah&nbsp;tablet Android premium 14,6 inci yang ditenagai chipset&nbsp;<a href=\"https://www.google.com/search?q=MediaTek+Dimensity+9400%2B&amp;sca_esv=5059277f5112fa93&amp;biw=1366&amp;bih=641&amp;sxsrf=ANbL-n6bcQJmssGgz-Q1VuhvDUOFcjFjaw%3A1770606751273&amp;ei=n1CJaa64EIqgnesPt4SNwQs&amp;oq=tablet+ter&amp;gs_lp=Egxnd3Mtd2l6LXNlcnAiCnRhYmxldCB0ZXIqAggAMgUQABiABDIFEAAYgAQyBRAAGIAEMgUQABiABDIHEAAYgAQYCjIFEAAYgAQyBRAAGIAEMgUQABiABDIFEAAYgAQyBRAAGIAESOUqUABY3h9wAHgBkAEAmAFToAGoBaoBAjEwuAEByAEA-AEBmAIKoALlBcICBxAjGPAFGCfCAgQQIxgnwgIKECMYgAQYJxiKBcICCxAAGIAEGJECGIoFwgIKEAAYgAQYQxiKBcICEBAAGIAEGLEDGEMYgwEYigXCAgsQABiABBixAxiDAcICERAuGIAEGLEDGNEDGMcBGIoFwgIQEC4YgAQY0QMYQxjHARiKBcICDhAAGIAEGLEDGIMBGIoFwgIIEC4YgAQYsQPCAggQABiABBixA8ICDRAAGIAEGLEDGEMYigXCAgoQLhiABBhDGIoFwgIOEC4YgAQYsQMY0QMYxwHCAgsQLhiABBjHARivAcICCBAAGIAEGMsBwgIOEC4YgAQY0QMYxwEYywHCAgoQABiABBgKGMsBmAMAkgcCMTCgB_lTsgcCMTC4B-UFwgcEMi0xMMgHLYAIAA&amp;sclient=gws-wiz-serp&amp;ved=2ahUKEwjxyeSvuMuSAxW_WHADHUfkNdMQgK4QegYIAQgAEAQ\">MediaTek Dimensity 9400+</a>&nbsp;dan layar Dynamic AMOLED 2X 120Hz. Tablet tertipis (5,1 mm) dan tercanggih ini mengunggulkan integrasi Galaxy AI, baterai 11.600 mAh, serta S Pen bawaan, menjadikannya pesaing laptop yang tangguh.&nbsp;</p>\r\n', 'produk1770869019.jpg', 1, '2026-02-05 02:53:28'),
(29, 5, 'Samsung S25', 18599000, '<p>smartphone flagship premium yang menonjolkan chipset Snapdragon 8 Elite, layar Dynamic LTPO AMOLED 6,9 inci 120Hz yang terang, dan kemampuan kamera canggih beresolusi 8K dengan sensor ultrawide 50MP.</p>\r\n', 'produk1770271960.jpg', 1, '2026-02-05 06:11:24'),
(30, 5, 'HP ASUS ROG7', 8000000, '<p>ASUS ROG Phone 7 adalah HP gaming premium yang ditenagai&nbsp;chipset Qualcomm Snapdragon 8 Gen 2 (4 nm), RAM LPDDR5X hingga 16GB, dan penyimpanan UFS 4.0 512GB. Layarnya AMOLED 6,78 inci 165Hz, baterai jumbo 6000mAh dengan&nbsp;<em>fast charging</em>&nbsp;65W, serta sistem pendingin GameCool 7, menjadikannya salah satu HP tercepat untuk gaming.&nbsp;</p>\r\n', 'produk1770271922.jpg', 1, '2026-02-05 06:12:02'),
(31, 6, 'laptop ASUS ROG', 18000000, '<p>Laptop ASUS ROG (Republic of Gamers) terbaru (2025/2026) menawarkan spesifikasi performa tinggi, ditenagai&nbsp;prosesor&nbsp;<a href=\"https://www.google.com/search?q=Intel%C2%AE+Core%E2%84%A2+Ultra+9+275HX&amp;biw=1366&amp;bih=641&amp;sca_esv=5059277f5112fa93&amp;sxsrf=ANbL-n7cAjmcy2gXmv-K_2qPlJBM4ENEyg%3A1770607046467&amp;ei=xlGJaYqdHKOXwcsPwOGTCA&amp;ved=2ahUKEwitrvGlucuSAxVcTWwGHTlIIPcQgK4QegQIARAC&amp;uact=5&amp;oq=laptop+asus+rog+spek&amp;gs_lp=Egxnd3Mtd2l6LXNlcnAiFGxhcHRvcCBhc3VzIHJvZyBzcGVrMgUQABiABDIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHki0FFCNBVi-EnABeAGQAQCYAaEBoAH9BKoBAzguMbgBA8gBAPgBAZgCCqACrwXCAgoQABiwAxjWBBhHwgINEAAYgAQYsAMYQxiKBcICChAjGIAEGCcYigWYAwCIBgGQBgqSBwM5LjGgB8A_sgcDOC4xuAeqBcIHBDItMTDIByWACAA&amp;sclient=gws-wiz-serp\">Intel&reg; Core&trade; Ultra 9 275HX</a>&nbsp;atau&nbsp;<a href=\"https://www.google.com/search?q=AMD+Ryzen%E2%84%A2+AI+9%2F7&amp;biw=1366&amp;bih=641&amp;sca_esv=5059277f5112fa93&amp;sxsrf=ANbL-n7cAjmcy2gXmv-K_2qPlJBM4ENEyg%3A1770607046467&amp;ei=xlGJaYqdHKOXwcsPwOGTCA&amp;ved=2ahUKEwitrvGlucuSAxVcTWwGHTlIIPcQgK4QegQIARAD&amp;uact=5&amp;oq=laptop+asus+rog+spek&amp;gs_lp=Egxnd3Mtd2l6LXNlcnAiFGxhcHRvcCBhc3VzIHJvZyBzcGVrMgUQABiABDIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHki0FFCNBVi-EnABeAGQAQCYAaEBoAH9BKoBAzguMbgBA8gBAPgBAZgCCqACrwXCAgoQABiwAxjWBBhHwgINEAAYgAQYsAMYQxiKBcICChAjGIAEGCcYigWYAwCIBgGQBgqSBwM5LjGgB8A_sgcDOC4xuAeqBcIHBDItMTDIByWACAA&amp;sclient=gws-wiz-serp\">AMD Ryzen&trade; AI 9/7</a>. Didukung kartu grafis hingga&nbsp;<a href=\"https://www.google.com/search?q=NVIDIA%C2%AE+GeForce+RTX%E2%84%A2+5080%2F5090&amp;biw=1366&amp;bih=641&amp;sca_esv=5059277f5112fa93&amp;sxsrf=ANbL-n7cAjmcy2gXmv-K_2qPlJBM4ENEyg%3A1770607046467&amp;ei=xlGJaYqdHKOXwcsPwOGTCA&amp;ved=2ahUKEwitrvGlucuSAxVcTWwGHTlIIPcQgK4QegQIARAE&amp;uact=5&amp;oq=laptop+asus+rog+spek&amp;gs_lp=Egxnd3Mtd2l6LXNlcnAiFGxhcHRvcCBhc3VzIHJvZyBzcGVrMgUQABiABDIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHki0FFCNBVi-EnABeAGQAQCYAaEBoAH9BKoBAzguMbgBA8gBAPgBAZgCCqACrwXCAgoQABiwAxjWBBhHwgINEAAYgAQYsAMYQxiKBcICChAjGIAEGCcYigWYAwCIBgGQBgqSBwM5LjGgB8A_sgcDOC4xuAeqBcIHBDItMTDIByWACAA&amp;sclient=gws-wiz-serp\">NVIDIA&reg; GeForce RTX&trade; 5080/5090</a>, RAM DDR5 32GB-64GB, serta&nbsp;<a href=\"https://www.google.com/search?q=layar+ROG+Nebula+Display+2.5K%2F3K+240Hz+OLED&amp;biw=1366&amp;bih=641&amp;sca_esv=5059277f5112fa93&amp;sxsrf=ANbL-n7cAjmcy2gXmv-K_2qPlJBM4ENEyg%3A1770607046467&amp;ei=xlGJaYqdHKOXwcsPwOGTCA&amp;ved=2ahUKEwitrvGlucuSAxVcTWwGHTlIIPcQgK4QegQIARAF&amp;uact=5&amp;oq=laptop+asus+rog+spek&amp;gs_lp=Egxnd3Mtd2l6LXNlcnAiFGxhcHRvcCBhc3VzIHJvZyBzcGVrMgUQABiABDIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHki0FFCNBVi-EnABeAGQAQCYAaEBoAH9BKoBAzguMbgBA8gBAPgBAZgCCqACrwXCAgoQABiwAxjWBBhHwgINEAAYgAQYsAMYQxiKBcICChAjGIAEGCcYigWYAwCIBgGQBgqSBwM5LjGgB8A_sgcDOC4xuAeqBcIHBDItMTDIByWACAA&amp;sclient=gws-wiz-serp\">layar ROG Nebula Display 2.5K/3K 240Hz OLED</a>, menjadikannya laptop andalan untuk&nbsp;<em>gaming</em>&nbsp;berat dan kreator konten.&nbsp;</p>\r\n', 'produk1770271942.jpg', 1, '2026-02-05 06:12:22'),
(33, 14, 'iPad Pro M4', 18000000, '<p>iPad Pro M4 (2024) adalah tablet ultra-tipis dengan&nbsp;chip M4 super kencang (9/10-core CPU, 10-core GPU, Neural Engine 16-core), layar Ultra Retina XDR OLED tandem, RAM 8GB/16GB, serta opsi penyimpanan 256GB hingga 2TB. Dilengkapi dukungan Apple Pencil Pro, kamera 12MP (wide &amp; selfie), serta opsi layar Nano-texture, menjadikannya pengganti laptop premium.&nbsp;</p>\r\n', 'produk1770869050.jpg', 1, '2026-02-09 03:15:48'),
(34, 6, 'Lenovo Legion Slim 5', 23000000, '<p>Lenovo Legion Slim 5&nbsp;adalah laptop gaming tangguh yang menyeimbangkan performa tinggi dengan desain ringkas, ditenagai oleh prosesor AMD Ryzen atau Intel Core terbaru dan GPU NVIDIA GeForce RTX. Spesifikasi detail bervariasi tergantung pada konfigurasi model yang dipilih.</p>\r\n', 'produk1770607185.jpg', 1, '2026-02-09 03:19:45'),
(36, 17, 'Sony Bravia 8 II OLED', 30000000, '<p>TV SONY TERBARU</p>\r\n', 'produk1771062783.jpg', 1, '2026-02-14 09:53:03'),
(37, 17, 'LG OLED evo G4', 32000000, '<p>TV TERBAIK</p>\r\n', 'produk1771062839.jpg', 1, '2026-02-14 09:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase`
--

CREATE TABLE `tb_purchase` (
  `purchase_id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `purchase_name` varchar(100) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `purchase_quantity` int(11) NOT NULL,
  `purchase_address` text NOT NULL,
  `purchase_method` varchar(50) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `purchase_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_purchase`
--

INSERT INTO `tb_purchase` (`purchase_id`, `order_id`, `product_id`, `product_name`, `purchase_name`, `purchase_price`, `purchase_quantity`, `purchase_address`, `purchase_method`, `purchase_date`, `purchase_status`) VALUES
(33, 'ORD1770612735915', 30, 'HP ASUS ROG7', 'darrent', 8000000, 1, 'subur', 'e-wallet', '2026-02-09 04:52:15', 1),
(39, 'ORD1771062605905', 34, 'Lenovo Legion Slim 5', 'Nazwa', 23000000, 1, 'Saluran', 'Transfer Bank', '2026-02-14 09:50:05', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tb_purchase`
--
ALTER TABLE `tb_purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `idx_order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_purchase`
--
ALTER TABLE `tb_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
