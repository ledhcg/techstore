-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2021 at 06:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `htphodatviet`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name_vi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name_vi`, `category_name_ru`, `category_image`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'Đồ ăn', 'Еда', 'htphodatviet-1.jpg', 'ACTIVE', '2021-10-14 12:20:03', '2021-10-14 12:20:03'),
(2, 'Đồ uống', 'Напитки', 'htphodatviet-2.jpg', 'ACTIVE', '2021-10-14 12:20:03', '2021-10-14 12:20:03'),
(3, 'Tạp hóa', 'Бакалея', 'htphodatviet-3.jpg', 'ACTIVE', '2021-10-14 12:20:03', '2021-10-14 12:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_16_115901_create_products_table', 1),
(6, '2021_09_16_115920_create_categories_table', 1),
(7, '2021_09_28_212425_create_shoppingcart_table', 1),
(8, '2021_10_01_021535_create_orders_table', 1),
(9, '2021_10_01_022901_create_order_details_table', 1),
(10, '2021_10_05_120026_create_shipping_fees_table', 1),
(11, '2021_10_05_205918_create_payment_methods_table', 1),
(12, '2021_10_08_143209_add_description_to_orders', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` enum('CREATED','RECEIVED','DELIVERING','DELIVERED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CREATED',
  `order_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_total` double(8,2) NOT NULL,
  `order_discount` double(8,2) NOT NULL,
  `order_payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_payment_status` enum('CREATED','CANCELED','SUCCEEDED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CREATED',
  `order_ship` double(8,2) NOT NULL,
  `order_tracking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
    (1, 'Pay by cash on delivery', '2021-10-14 11:09:16', '2021-10-14 11:09:16'),
    (2, 'Pay with Credit Card', '2021-10-14 11:09:16', '2021-10-14 11:09:16');


--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name_vi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description_vi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description_ru` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_unit_vi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_unit_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price_last` double(8,2) NOT NULL,
  `product_price_fix` double(8,2) NOT NULL,
  `product_price_discount` double(8,2) NOT NULL,
  `product_quantity_to_discount` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name_vi`, `product_name_ru`, `product_description_vi`, `product_description_ru`, `product_image`, `product_unit_vi`, `product_unit_ru`, `product_price_last`, `product_price_fix`, `product_price_discount`, `product_quantity_to_discount`, `category_id`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-1.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(2, 'Bún Chả', 'Том Ям', '(Nothing)', 'Креветки, кокосовое молоко гриби, кинза, рис', 'htphodatviet-2.jpg', '600ml', '600мл', 399.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(3, 'Bún Chả', 'Том чиен су', '(Nothing)', 'Жареные креветки в темпуре', 'htphodatviet-3.jpg', '6 cái', '6 шт.', 350.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(4, 'Bún Chả', 'Бун ча', '(Nothing)', '(Nothing)', 'htphodatviet-4.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(5, 'Bún Chả', 'Бань бао', '(Nothing)', 'Мука, грибы, Фучоза, снивина', 'htphodatviet-5.jpg', '200gr', '200гр', 150.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(6, 'Bún Chả', 'Бо бит тет', '(Nothing)', 'Говядина, яйцо, паштет, колбаса, хлеб', 'htphodatviet-6.jpg', '500gr', '500гр', 399.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(7, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-7.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(8, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-8.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(9, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-9.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(10, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-10.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(11, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-11.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(12, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-12.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(13, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-13.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(14, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-14.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(15, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-15.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(16, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-16.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(17, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-17.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(18, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-18.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(19, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-19.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(20, 'Bún Chả', 'Гой куон', '(Nothing)', 'Креветки, рисовая папша, рисовая бумага, манго, салат, соус', 'htphodatviet-20.jpg', '2 cái', '2 шт.', 220.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(21, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-21.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(22, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-22.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(23, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-23.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(24, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-24.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(25, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-25.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(26, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-26.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(27, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-27.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(28, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-28.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(29, 'Bún Chả', 'Бун Ча', '(Nothing)', '(Nothing)', 'htphodatviet-29.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(30, 'Phở bò', 'Фо бо с говядиной', '(Nothing)', '(Nothing)', 'htphodatviet-30.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(31, 'Bún Chả', 'Ком шот ванг', '(Nothing)', '(Nothing)', 'htphodatviet-31.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(32, 'Phở bò với tôm', 'Фо бо с креветками', '(Nothing)', '(Nothing)', 'htphodatviet-32.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(33, 'Cơm Tôm Yum', 'Том ям с рисом', '(Nothing)', '(Nothing)', 'htphodatviet-33.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(34, 'Phở bò sốt vang', 'Фо бо шот ванг', '(Nothing)', '(Nothing)', 'htphodatviet-34.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(35, 'Ramen Tôm Yum', 'Рамен том ям', '(Nothing)', '(Nothing)', 'htphodatviet-35.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(36, 'Cơm xào gà', 'Ком сао га', '(Nothing)', '(Nothing)', 'htphodatviet-36.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(37, 'Cơm xào bò', 'Ком сао бо', '(Nothing)', '(Nothing)', 'htphodatviet-37.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(38, 'Cơm xào hải sản', 'Ком сао хай шан', '(Nothing)', '(Nothing)', 'htphodatviet-38.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(39, 'Bún nem', 'Бун нем', '(Nothing)', '(Nothing)', 'htphodatviet-39.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(40, 'Bún nem cua', 'Бун нем куа', '(Nothing)', '(Nothing)', 'htphodatviet-40.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(41, 'Phở xào gà', 'Фо сао га', '(Nothing)', '(Nothing)', 'htphodatviet-41.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(42, 'Phở xào bò', 'Фо сао бо', '(Nothing)', '(Nothing)', 'htphodatviet-42.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(43, 'Phở xào hải sản', 'Фо сао хай шан', '(Nothing)', '(Nothing)', 'htphodatviet-43.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(44, 'Miến xào gà', 'Миен сао га', '(Nothing)', '(Nothing)', 'htphodatviet-44.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(45, 'Bún chả', 'Бун ча', '(Nothing)', '(Nothing)', 'htphodatviet-45.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(46, 'Cơm rang', 'Ком ранг', '(Nothing)', '(Nothing)', 'htphodatviet-46.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(47, 'Gỏi tôm', 'Гой том', '(Nothing)', '(Nothing)', 'htphodatviet-47.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(48, 'Nem gà', 'Нем га', '(Nothing)', '(Nothing)', 'htphodatviet-48.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(49, 'Nem cua', 'Нем куа', '(Nothing)', '(Nothing)', 'htphodatviet-49.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(50, 'Miến xào hải sản', 'Миен сао хай шан', '(Nothing)', '(Nothing)', 'htphodatviet-50.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(51, 'Miến xào bò', 'Миен сао бо', '(Nothing)', '(Nothing)', 'htphodatviet-51.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(52, 'Nộm xoài', 'Ном соай', '(Nothing)', '(Nothing)', 'htphodatviet-52.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(53, 'Mì tôm xào gà', 'Ми том сао га', '(Nothing)', '(Nothing)', 'htphodatviet-53.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(54, 'Mì tôm xào bò', 'Ми том сао бо', '(Nothing)', '(Nothing)', 'htphodatviet-54.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(55, 'Mì tôm xào hải sản', 'Ми том сао хай шан', '(Nothing)', '(Nothing)', 'htphodatviet-55.jpg', 'bát', 'миска', 300.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(56, 'Cà phê Việt', 'Кофе по-вьетнамски', '(Nothing)', '(Nothing)', 'htphodatviet-56.jpg', 'cốc', 'чашка', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(57, 'Nước chanh leo', 'Маракуйя сок', '(Nothing)', '(Nothing)', 'htphodatviet-57.jpg', 'cốc', 'чашка', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(58, 'Cà phê Việt Nam', 'Кофе вьетнамский', '(Nothing)', '(Nothing)', 'htphodatviet-58.jpg', 'cốc', 'чашка', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(59, 'Sinh tố bơ', 'Авокадо шейк', '(Nothing)', '(Nothing)', 'htphodatviet-59.jpg', 'cốc', 'чашка', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(60, 'Nước chanh', 'Лимонад лайма', '(Nothing)', '(Nothing)', 'htphodatviet-60.jpg', 'cốc', 'чашка', 300.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),

(61, 'Vinut 330ml - Xoài', 'Vinut 330ml - Mango', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(62, 'Vinut 330ml - Măng cụt', 'Vinut 330ml - Mangosteen', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00,  6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(63, 'Vinut 330ml - Bơ', 'Vinut 330ml - Avocado', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(64, 'Vinut 330ml - Thanh long', 'Vinut 330ml - Dragon fruit', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(65, 'Vinut 330ml - Mít', 'Vinut 330ml - Jack fruit', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(66, 'Vinut 330ml - Ổi', 'Vinut 330ml - Guava', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(67, 'Vinut 330ml - Dưa hấu', 'Vinut 330ml - Watermelon', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(68, 'Vinut 330ml - Dừa', 'Vinut 330ml - Coconut water', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(69, 'Vinut 330ml - Đu đủ', 'Vinut 330ml - Papaya', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(70, 'Vinut 330ml - Dứa', 'Vinut 330ml - Pineapple', '(Nothing)', '(Nothing)', 'htphodatviet-66.jpg', 'lon', 'шт.', 99.00, 0.00, 79.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),

(71, 'Vinut 490ml - Xoài', 'Vinut 490ml - Mango', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(72, 'Vinut 490ml - Măng cụt', 'Vinut 490ml - Mangosteen', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00,  6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(73, 'Vinut 490ml - Bơ', 'Vinut 490ml - Avocado', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(74, 'Vinut 490ml - Thanh long', 'Vinut 490ml - Dragon fruit', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(75, 'Vinut 490ml - Mít', 'Vinut 490ml - Jack fruit', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(76, 'Vinut 490ml - Ổi', 'Vinut 490ml - Guava', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(77, 'Vinut 490ml - Dưa hấu', 'Vinut 490ml - Watermelon', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(78, 'Vinut 490ml - Dừa', 'Vinut 490ml - Coconut water', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(79, 'Vinut 490ml - Đu đủ', 'Vinut 490ml - Papaya', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(80, 'Vinut 490ml - Dứa', 'Vinut 490ml - Pineapple', '(Nothing)', '(Nothing)', 'htphodatviet-67.jpg', 'lon', 'шт.', 150.00, 0.00, 120.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),

(81, 'Bò húc Redbull Thái', 'Redbull Thailand', '(Nothing)', '(Nothing)', 'htphodatviet-65.jpg', 'lon', 'шт.', 160.00, 0.00, 130.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(82, 'Bia Sài Gòn', 'Пиво Saigon', '(Nothing)', '(Nothing)', 'htphodatviet-63.jpg', 'lon', 'шт.', 200.00, 0.00, 170.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(83, 'Bia Hà Nội', 'Пиво Hanoi', '(Nothing)', '(Nothing)', 'htphodatviet-64.jpg', 'lon', 'шт.', 180.00, 0.00, 150.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),

(84, 'Nước lọc (Không ga)', 'Aqua Minerale - Негазированная', '(Nothing)', '(Nothing)', 'htphodatviet-62.jpg', 'lon', 'шт.', 60.00, 0.00, 45.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10'),
(85, 'Nước lọc (Có ga)', 'Aqua Minerale - Газированная', '(Nothing)', '(Nothing)', 'htphodatviet-70.jpg', 'lon', 'шт.', 60.00, 0.00, 45.00, 6, 3, 'ACTIVE', '2021-10-14 12:26:10', '2021-10-14 12:26:10');


-- --------------------------------------------------------

--
-- Table structure for table `shipping_fees`
--

CREATE TABLE `shipping_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MINIMUM_COST` double(8,2) NOT NULL,
  `SHIPPING_CHARGES` double(8,2) NOT NULL,
  `MIN_TOTAL_TO_GET_FREE` double(8,2) NOT NULL,
  `MAX_DISTANCE_TO_GET_FREE` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Dumping data for table `shipping_fees`
--

INSERT INTO `shipping_fees` (`id`, `MINIMUM_COST`, `SHIPPING_CHARGES`, `MIN_TOTAL_TO_GET_FREE`, `MAX_DISTANCE_TO_GET_FREE`, `created_at`, `updated_at`) VALUES
   (1, 100.00, 50.00, 2000.00, 10.00,'2021-10-14 11:09:16', '2021-10-14 11:09:16');

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('MALE','FEMALE','OTHER') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MALE',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `phone`, `address`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Le Dinh Cuong', 'MALE', '+79837336161', 'Казахстан, Актобе, 11-й микрорайон', 'default/avatar_default.png', 'mail@dinhcuong.me', NULL, '$2y$10$GEzCf.JwXA5aNJZGZIqdzeu0iTMYXDyLQaeAgGctcnfZujYSWfpbi', NULL, '2021-10-14 11:09:16', '2021-10-14 11:09:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_fees`
--
ALTER TABLE `shipping_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `shipping_fees`
--
ALTER TABLE `shipping_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
