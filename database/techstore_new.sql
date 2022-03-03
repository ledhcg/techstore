-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2022 at 06:42 PM
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
-- Database: `techstore_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
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
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `gender`, `phone`, `address`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'TECHSTORE', 'MALE', '', '', 'avatar_default.png', 'mail@techstore.com', NULL, '$2y$10$GEzCf.JwXA5aNJZGZIqdzeu0iTMYXDyLQaeAgGctcnfZujYSWfpbi', NULL, NULL, NULL);

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
(1, 'Smatphones', 'Смартфоны', '1638281497.png', 'ACTIVE', '2021-11-30 08:11:37', '2021-11-30 08:11:37'),
(2, 'Tablets', 'Планшеты', '1638281336.png', 'ACTIVE', '2021-11-30 08:08:56', '2021-11-30 08:09:57'),
(3, 'Notebooks', 'Ноутбуки', '1638281381.png', 'ACTIVE', '2021-11-30 08:09:41', '2021-11-30 08:09:41'),
(4, 'Smart Watches', 'Умные часы', '1638281578.png', 'ACTIVE', '2021-11-30 08:12:58', '2021-11-30 08:13:40');

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
(12, '2021_10_08_143209_add_description_to_orders', 1),
(15, '2022_02_16_133028_admin', 2),
(16, '2021_10_17_150759_create_admins_table', 3),
(17, '2021_10_23_123447_create_notifications_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03f4f135-b83f-4682-9455-50c8a9084cc0', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"RECEIVED\"}', NULL, '2022-03-03 14:34:26', '2022-03-03 14:34:26'),
('05a11438-f32f-4daa-90f0-e7c7a9a5c850', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', '2022-03-03 14:01:51', '2022-03-01 18:10:05', '2022-03-03 14:01:51'),
('067dcb8e-4a44-4a11-8166-8181943fab19', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:40:21', '2022-03-01 17:40:21'),
('073e5a70-e2ba-4230-ae2c-d7bf62e50be8', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6165795489\",\"status\":\"RECEIVED\"}', NULL, '2022-03-01 17:17:50', '2022-03-01 17:17:50'),
('08637336-abfd-4305-a4ab-f572409264ac', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6165946481\",\"status\":\"CREATED\"}', NULL, '2022-03-01 17:20:27', '2022-03-01 17:20:27'),
('0ad027e7-6b45-429f-8698-e2c20b25f1c3', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"6166236907\"}', NULL, '2022-03-01 17:24:07', '2022-03-01 17:24:07'),
('0e3fe96e-1c3a-47e9-b5bd-5c0b274ad68e', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 2, '{\"user_id\":2,\"order_tracking\":\"5552629618\",\"status\":\"DELIVERED\"}', NULL, '2022-02-24 12:24:31', '2022-02-24 12:24:31'),
('0fa73717-7bb7-43fc-ae68-ede9f76a29d3', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5556412753\",\"status\":\"CREATED\"}', '2022-02-22 21:43:59', '2022-02-22 21:43:21', '2022-02-22 21:43:59'),
('0fc7ed5a-008d-4165-8ce7-de82553d1739', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:50:19', '2022-03-01 17:50:19'),
('165dab07-d5e0-446b-bf30-31cf2f4698ca', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5647595060\"}', NULL, '2022-02-23 17:20:05', '2022-02-23 17:20:05'),
('17fdf10e-5a4f-43b7-bd9a-8012a12fceb4', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:36:13', '2022-03-01 17:36:13'),
('1819c4d2-ae3e-4170-b7a1-517258c11949', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5542085809\",\"status\":\"DELIVERING\"}', '2022-02-22 19:42:38', '2022-02-22 19:40:27', '2022-02-22 19:42:38'),
('1af1e9eb-231b-4a33-8058-5bbf6d070d61', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5713312682\"}', NULL, '2022-02-24 11:35:38', '2022-02-24 11:35:38'),
('1c432535-e96c-46e8-a32f-39fd82a779ff', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5716373452\"}', NULL, '2022-02-24 12:26:33', '2022-02-24 12:26:33'),
('25b1f405-aef5-42ee-b625-c76be1083da1', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5556412753\",\"status\":\"RECEIVED\"}', '2022-03-01 17:09:36', '2022-02-23 15:58:38', '2022-03-01 17:09:36'),
('2a49df3a-7278-42a2-8ece-ec35e0a105cf', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"6165795489\"}', '2022-03-01 17:17:45', '2022-03-01 17:17:36', '2022-03-01 17:17:45'),
('2a970167-4beb-460a-b88c-13eb1c4da41a', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6165946481\",\"status\":\"RECEIVED\"}', NULL, '2022-03-01 17:20:18', '2022-03-01 17:20:18'),
('31b430bc-7ce4-49af-9e8b-7feb3a779ab0', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5542085809\",\"status\":\"RECEIVED\"}', '2022-02-22 21:44:10', '2022-02-22 21:43:12', '2022-02-22 21:44:10'),
('333f7b37-3889-4f39-a5b2-401b6b149e32', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5641828497\",\"status\":\"CREATED\"}', '2022-03-01 17:12:06', '2022-03-01 17:10:48', '2022-03-01 17:12:06'),
('3a692e5a-6d3a-4f16-bb5f-e365a7814221', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5716320610\"}', NULL, '2022-02-24 12:25:28', '2022-02-24 12:25:28'),
('3b769bb5-ce94-4ba2-b34a-1a2c83d77790', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"6166617748\"}', NULL, '2022-03-01 17:30:27', '2022-03-01 17:30:27'),
('3ff9a4f6-d560-48e8-a726-128d58f798c9', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166236907\",\"status\":\"RECEIVED\"}', NULL, '2022-03-01 17:29:46', '2022-03-01 17:29:46'),
('4502d367-8783-4bdf-afb9-945c6ef02db1', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5717257939\"}', '2022-03-01 16:29:38', '2022-02-24 12:41:08', '2022-03-01 16:29:38'),
('48574c7f-3836-4e57-a20d-1b447ef9cd4d', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"DELIVERED\"}', '2022-02-22 19:15:23', '2022-02-22 19:15:06', '2022-02-22 19:15:23'),
('48eb903f-aa6f-4d9c-ab5a-075b8d3c1b92', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6165946481\",\"status\":\"DELIVERED\"}', NULL, '2022-03-01 17:20:11', '2022-03-01 17:20:11'),
('4dba95b5-0673-4c21-a461-71c1126a2fc4', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5558877595\"}', '2022-02-22 21:50:27', '2022-02-22 16:41:27', '2022-02-22 21:50:27'),
('4dc70a60-36e5-4346-90e3-76a90884ff16', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166236907\",\"status\":\"CREATED\"}', NULL, '2022-03-01 17:53:44', '2022-03-01 17:53:44'),
('5c8c199e-5c45-4c91-8c29-0750f65fd0c7', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"DELIVERING\"}', '2022-02-22 19:37:51', '2022-02-22 19:37:20', '2022-02-22 19:37:51'),
('5e220140-42e2-4ee9-8227-33caa398d87b', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5642040276\"}', '2022-02-23 15:57:18', '2022-02-23 15:47:31', '2022-02-23 15:57:18'),
('5ecf0bef-b6e3-4702-b995-b64b0a04ad7b', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:47:35', '2022-03-01 17:47:35'),
('5f62c1f1-a5b4-4d48-97c1-bb0c7439e980', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5639252579\"}', '2022-02-23 15:18:25', '2022-02-23 15:01:06', '2022-02-23 15:18:25'),
('5f7fa700-e7f4-4bc9-ac71-3d73b82f83fe', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5556412753\",\"status\":\"DELIVERING\"}', '2022-02-23 15:58:56', '2022-02-23 15:57:59', '2022-02-23 15:58:56'),
('5fb235d4-562e-49f8-8689-aab9faa03764', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5542085809\",\"status\":\"RECEIVED\"}', '2022-02-22 19:43:26', '2022-02-22 19:43:23', '2022-02-22 19:43:26'),
('6068f93b-f173-4051-aaa3-28c3b66a118b', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5556412753\",\"status\":\"RECEIVED\"}', '2022-02-22 19:42:38', '2022-02-22 19:40:31', '2022-02-22 19:42:38'),
('60de5f64-108c-43ea-a88e-22c3b2eff0c3', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6165946481\",\"status\":\"RECEIVED\"}', NULL, '2022-03-01 17:21:01', '2022-03-01 17:21:01'),
('696f6fea-240b-4068-a56a-f50f7894eb76', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5556412753\",\"status\":\"DELIVERING\"}', '2022-02-22 19:40:15', '2022-02-22 19:39:56', '2022-02-22 19:40:15'),
('6a8b1aa5-b50d-44a3-a6f0-4fb0ae641233', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"RECEIVED\"}', '2022-02-22 19:10:22', '2022-02-22 19:10:04', '2022-02-22 19:10:22'),
('6b19ca17-6d6f-40ff-9ff1-10553c0b75d1', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5647534252\"}', NULL, '2022-02-23 17:19:16', '2022-02-23 17:19:16'),
('6bfa98e9-f766-4219-b8a1-4cf01da933a1', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"6165946481\"}', NULL, '2022-03-01 17:19:15', '2022-03-01 17:19:15'),
('6dcceeed-578b-47b0-8b56-a5545e82830e', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6165983060\",\"status\":\"CREATED\"}', NULL, '2022-03-01 17:22:07', '2022-03-01 17:22:07'),
('6e098c01-4ece-4ffa-bf26-580c9b46437b', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"6165983060\"}', NULL, '2022-03-01 17:19:53', '2022-03-01 17:19:53'),
('737eb1f1-da0b-463f-818e-fb77448b6f73', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 4, '{\"user_id\":4,\"order_tracking\":\"5716320610\",\"status\":\"DELIVERED\"}', NULL, '2022-02-24 12:27:38', '2022-02-24 12:27:38'),
('7515671a-82b0-4247-9cb6-5eb1b043abc8', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5642656624\"}', '2022-02-23 15:57:53', '2022-02-23 15:57:45', '2022-02-23 15:57:53'),
('758707dd-95ca-474d-95bc-ea2ca27649b2', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5641862459\"}', '2022-02-23 15:57:18', '2022-02-23 15:44:31', '2022-02-23 15:57:18'),
('766dd95b-93ca-41d9-9f19-3dd69dd4c1b8', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5639252579\",\"status\":\"DELIVERED\"}', '2022-03-01 17:09:36', '2022-03-01 16:29:43', '2022-03-01 17:09:36'),
('79fe5735-039f-49c4-878c-4a13e25a459f', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:36:07', '2022-03-01 17:36:07'),
('7aafa9bf-72fc-4679-8605-551b88a0291c', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 4, '{\"user_id\":4,\"order_tracking\":\"5716373452\",\"status\":\"RECEIVED\"}', NULL, '2022-02-24 12:26:56', '2022-02-24 12:26:56'),
('7c938c03-79ec-4411-bd7d-80dc1805a447', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 2, '{\"user_id\":2,\"order_tracking\":\"5552230650\",\"status\":\"DELIVERED\"}', NULL, '2022-02-22 21:43:17', '2022-02-22 21:43:17'),
('8384c11c-3f70-4824-a755-87419443620b', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"RECEIVED\"}', '2022-02-22 19:06:35', '2022-02-22 18:17:10', '2022-02-22 19:06:35'),
('83959abc-bef3-4d20-b06c-d69fdf81514d', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"CREATED\"}', '2022-02-22 19:37:51', '2022-02-22 19:37:26', '2022-02-22 19:37:51'),
('8551e8fb-20b5-4265-8444-90d52a8dc863', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5713169578\"}', NULL, '2022-02-24 11:34:59', '2022-02-24 11:34:59'),
('865a4c6e-959f-4bde-9cd3-1c837597803b', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 4, '{\"user_id\":4,\"order_tracking\":\"5716320610\",\"status\":\"RECEIVED\"}', NULL, '2022-02-24 12:27:20', '2022-02-24 12:27:20'),
('953eeeac-93ad-4b70-86ea-0199eac1de13', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"CREATED\"}', NULL, '2022-03-01 18:04:50', '2022-03-01 18:04:50'),
('956f7b0e-24b6-4fa8-9596-6e88f0b066c4', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 4, '{\"user_id\":4,\"order_tracking\":\"5713169578\",\"status\":\"RECEIVED\"}', NULL, '2022-02-24 12:40:17', '2022-02-24 12:40:17'),
('95b0d6c3-bced-4f4a-a8bb-360fc5817f63', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5642065748\"}', '2022-02-23 15:57:18', '2022-02-23 15:47:59', '2022-02-23 15:57:18'),
('95caa983-d62f-4be6-a75f-e7f9399fdb7d', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:43:26', '2022-03-01 17:43:26'),
('99e3565b-89cf-410e-8c09-009fedff5d3e', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5640401275\"}', '2022-02-23 15:33:56', '2022-02-23 15:20:13', '2022-02-23 15:33:56'),
('9a119559-9c14-4cf3-821b-09a3fd652aca', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 4, '{\"user_id\":4,\"order_tracking\":\"5716373452\",\"status\":\"DELIVERING\"}', NULL, '2022-02-24 12:53:07', '2022-02-24 12:53:07'),
('9b3db46a-c4d6-4b42-9594-648c5683bc9c', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:50:25', '2022-03-01 17:50:25'),
('9b8e7739-2ea4-4d8c-8272-115834274fa2', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"DELIVERING\"}', NULL, '2022-02-23 15:58:34', '2022-02-23 15:58:34'),
('9b9d1ea0-8b0a-4c18-9606-bdc1cfc29b56', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:46:07', '2022-03-01 17:46:07'),
('9e1449bb-34e4-4d07-bd8f-919473f50b5d', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 4, '{\"user_id\":4,\"order_tracking\":\"5713169578\",\"status\":\"DELIVERED\"}', NULL, '2022-02-24 12:40:26', '2022-02-24 12:40:26'),
('a647e72b-4c43-4260-a054-cff078c494e4', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"DELIVERING\"}', '2022-02-22 19:05:33', '2022-02-22 18:18:12', '2022-02-22 19:05:33'),
('aaeb2edf-f3fc-4e0c-a2e9-6c9ff77017a2', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"6328936817\"}', NULL, '2022-03-03 14:35:48', '2022-03-03 14:35:48'),
('ad7ff4b6-746f-426e-9d18-747214503a9e', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5782631737\"}', '2022-03-01 13:02:48', '2022-02-25 06:50:44', '2022-03-01 13:02:48'),
('ae9afa4e-d726-4e68-ae2c-abdfd5032fee', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5532128979\",\"status\":\"DELIVERING\"}', '2022-03-01 17:09:36', '2022-02-24 12:52:57', '2022-03-01 17:09:36'),
('afb5e870-bd3b-4b72-809b-655d9ab1c274', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5640401275\",\"status\":\"DELIVERING\"}', '2022-03-01 17:09:36', '2022-02-23 15:58:43', '2022-03-01 17:09:36'),
('b2cb8abf-d2d9-4a2d-9f2f-7af4227b2145', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166236907\",\"status\":\"CREATED\"}', NULL, '2022-03-01 18:04:28', '2022-03-01 18:04:28'),
('b6a9e5cb-3f39-4ce1-ab08-961d880f369d', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"DELIVERING\"}', '2022-02-22 19:06:07', '2022-02-22 18:16:47', '2022-02-22 19:06:07'),
('b71340d9-2379-4d55-a999-8d565f475d3b', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5556412753\",\"status\":\"DELIVERING\"}', '2022-02-22 19:43:26', '2022-02-22 19:43:18', '2022-02-22 19:43:26'),
('b8299bb3-6508-43b7-9432-d74b7a87cc43', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6165795489\",\"status\":\"DELIVERING\"}', '2022-03-01 17:18:44', '2022-03-01 17:18:19', '2022-03-01 17:18:44'),
('b8f15946-ec9c-4a73-b8af-8c0932ab50d6', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"DELIVERING\"}', '2022-02-22 19:15:37', '2022-02-22 19:13:50', '2022-02-22 19:15:37'),
('beaa943c-85bb-4ad2-b0bb-4cc66078c1f8', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:36:03', '2022-03-01 17:36:03'),
('c0d9d77f-9ffd-47b3-ae7d-5e298bdd25be', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5641828497\"}', '2022-02-23 15:57:18', '2022-02-23 15:44:00', '2022-02-23 15:57:18'),
('c11c636b-f12f-4f9a-bae4-0f10cd3966dc', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6165606026\",\"status\":\"CREATED\"}', '2022-03-01 19:16:24', '2022-03-01 17:15:00', '2022-03-01 19:16:24'),
('c6c3d6bb-fa45-4de6-b49f-fecd577097c3', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166236907\",\"status\":\"DELETE\"}', '2022-03-03 14:19:41', '2022-03-01 18:10:05', '2022-03-03 14:19:41'),
('c733ced7-8312-468b-bef9-fd13bf75d4fd', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"6165606026\"}', '2022-03-01 17:14:59', '2022-03-01 17:13:36', '2022-03-01 17:14:59'),
('cc1efc6a-0bff-4488-8790-19e747683d3d', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Admin', 1, '{\"order_tracking\":\"5717237952\"}', NULL, '2022-02-24 12:40:46', '2022-02-24 12:40:46'),
('d0b1f6e2-9d19-4291-b10d-41630a311476', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5557436499\",\"status\":\"DELIVERING\"}', '2022-02-22 19:36:51', '2022-02-22 19:36:22', '2022-02-22 19:36:51'),
('d8768619-5968-4697-b8f7-0a5dcefcd824', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:35:57', '2022-03-01 17:35:57'),
('df6d7ef7-496a-4a35-a3c5-384be9fb652e', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:40:16', '2022-03-01 17:40:16'),
('e1785187-b209-4715-abda-97e6c3e11d63', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:51:57', '2022-03-01 17:51:57'),
('e3d4d94f-bedb-427f-9d5f-6d68cd5537c8', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5556412753\",\"status\":\"DELIVERED\"}', '2022-03-01 17:09:36', '2022-02-23 15:58:16', '2022-03-01 17:09:36'),
('e4c50f7d-516b-47a0-9a60-bdd3907e58f3', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"5532128979\",\"status\":\"RECEIVED\"}', '2022-02-22 19:42:38', '2022-02-22 19:40:36', '2022-02-22 19:42:38'),
('edd942d0-2cb4-46cd-9e17-af6f36e1bbaa', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166236907\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:53:47', '2022-03-01 17:53:47'),
('ee4b0a75-46ab-4c4e-9963-7d30c3f44a01', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"RECEIVED\"}', '2022-02-22 19:07:00', '2022-02-22 18:14:30', '2022-02-22 19:07:00'),
('ff00b343-8a7d-4bf9-a384-2a72fa6d7ad6', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 3, '{\"user_id\":3,\"order_tracking\":\"5558877595\",\"status\":\"RECEIVED\"}', '2022-02-22 19:36:51', '2022-02-22 19:36:16', '2022-02-22 19:36:51'),
('ff2ed8ca-805e-4328-8783-b7e32ad0ce5e', 'App\\Notifications\\ChangeOrderStatusNotification', 'App\\Models\\User', 1, '{\"user_id\":1,\"order_tracking\":\"6166617748\",\"status\":\"DELETE\"}', NULL, '2022-03-01 17:45:40', '2022-03-01 17:45:40');

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
  `order_status` enum('CREATED','RECEIVED','DELIVERING','DELIVERED','DELETE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CREATED',
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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `client_name`, `client_email`, `client_phone`, `client_address`, `order_status`, `order_note`, `order_total`, `order_discount`, `order_payment`, `order_payment_status`, `order_ship`, `order_tracking`, `created_at`, `updated_at`, `order_description`) VALUES
(64, 1, 'Le Dinh Cuong', 'mail@dinhcuong.me', '+79837336161', 'Казахстан, Актобе, 11-й микрорайон', 'DELETE', 'Nothing', 86499.00, 0.00, '1', 'CREATED', 85750.00, '6166236907', '2022-03-01 17:24:07', '2022-03-01 18:10:05', 'Order ID: 6166236907'),
(65, 1, 'Le Dinh Cuong', 'mail@dinhcuong.me', '+79837336161', 'Казахстан, Актобе, 11-й микрорайон', 'RECEIVED', 'Nothing', 86300.00, 0.00, '1', 'CREATED', 85700.00, '6166617748', '2022-03-01 17:30:27', '2022-03-03 14:34:25', 'Order ID: 6166617748'),
(66, 1, 'Le Dinh Cuong', 'mail@dinhcuong.me', '+79837336161', 'Казахстан, Актобе, 11-й микрорайон', 'CREATED', 'Nothing', 89999.00, 0.00, '1', 'CREATED', 0.00, '6328936817', '2022-03-03 14:35:47', '2022-03-03 14:35:47', 'Order ID: 6328936817');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_price`, `product_quantity`, `created_at`, `updated_at`) VALUES
(26, '5100612553', 24, 300.00, 1, '2022-02-17 09:30:54', '2022-02-17 09:30:54'),
(27, '5100612553', 24, 300.00, 1, '2022-02-17 09:32:02', '2022-02-17 09:32:02'),
(28, '5102901150', 2, 399.00, 1, '2022-02-17 10:01:50', '2022-02-17 10:01:50'),
(29, '5102901150', 2, 399.00, 1, '2022-02-17 10:03:30', '2022-02-17 10:03:30'),
(30, '5103928433', 2, 399.00, 1, '2022-02-17 10:18:57', '2022-02-17 10:18:57'),
(31, '5103928433', 2, 399.00, 1, '2022-02-17 10:19:50', '2022-02-17 10:19:50'),
(32, '5103928433', 2, 399.00, 1, '2022-02-17 10:20:16', '2022-02-17 10:20:16'),
(33, '5106572411', 2, 399.00, 1, '2022-02-17 11:03:02', '2022-02-17 11:03:02'),
(34, '5106642871', 25, 300.00, 1, '2022-02-17 11:04:12', '2022-02-17 11:04:12'),
(35, '5106870403', 2, 399.00, 1, '2022-02-17 11:08:00', '2022-02-17 11:08:00'),
(36, '5108494401', 2, 399.00, 1, '2022-02-17 11:35:05', '2022-02-17 11:35:05'),
(37, '5137941965', 2, 399.00, 2, '2022-02-17 19:45:54', '2022-02-17 19:45:54'),
(38, '5137941965', 4, 300.00, 1, '2022-02-17 19:45:54', '2022-02-17 19:45:54'),
(39, '5137941965', 5, 150.00, 2, '2022-02-17 19:45:54', '2022-02-17 19:45:54'),
(40, '5137941965', 3, 350.00, 1, '2022-02-17 19:45:54', '2022-02-17 19:45:54'),
(41, '5138064880', 2, 399.00, 1, '2022-02-17 19:47:56', '2022-02-17 19:47:56'),
(42, '5138064880', 5, 150.00, 1, '2022-02-17 19:47:56', '2022-02-17 19:47:56'),
(43, '5138103942', 1, 300.00, 1, '2022-02-17 19:48:33', '2022-02-17 19:48:33'),
(44, '5138103942', 5, 150.00, 1, '2022-02-17 19:48:33', '2022-02-17 19:48:33'),
(45, '5138103942', 4, 300.00, 1, '2022-02-17 19:48:33', '2022-02-17 19:48:33'),
(46, '5532128979', 2, 399.00, 1, '2022-02-22 09:18:55', '2022-02-22 09:18:55'),
(47, '5532128979', 3, 350.00, 1, '2022-02-22 09:18:55', '2022-02-22 09:18:55'),
(48, '5542085809', 2, 399.00, 1, '2022-02-22 12:01:42', '2022-02-22 12:01:42'),
(49, '5542085809', 2, 399.00, 1, '2022-02-22 12:02:31', '2022-02-22 12:02:31'),
(50, '5552230650', 2, 399.00, 1, '2022-02-22 14:50:50', '2022-02-22 14:50:50'),
(51, '5552230650', 3, 350.00, 1, '2022-02-22 14:50:50', '2022-02-22 14:50:50'),
(52, '5552629618', 2, 399.00, 1, '2022-02-22 14:57:21', '2022-02-22 14:57:21'),
(53, '5556412753', 2, 399.00, 1, '2022-02-22 16:00:24', '2022-02-22 16:00:24'),
(54, '5556549059', 2, 399.00, 1, '2022-02-22 16:02:40', '2022-02-22 16:02:40'),
(55, '5556549059', 3, 350.00, 1, '2022-02-22 16:02:40', '2022-02-22 16:02:40'),
(56, '5557436499', 3, 350.00, 1, '2022-02-22 16:17:27', '2022-02-22 16:17:27'),
(57, '5558877595', 3, 350.00, 1, '2022-02-22 16:41:27', '2022-02-22 16:41:27'),
(58, '5639252579', 3, 350.00, 1, '2022-02-23 15:01:03', '2022-02-23 15:01:03'),
(59, '5640401275', 24, 300.00, 1, '2022-02-23 15:20:13', '2022-02-23 15:20:13'),
(60, '5641828497', 3, 350.00, 1, '2022-02-23 15:43:59', '2022-02-23 15:43:59'),
(61, '5641862459', 11, 300.00, 1, '2022-02-23 15:44:31', '2022-02-23 15:44:31'),
(62, '5642040276', 3, 350.00, 1, '2022-02-23 15:47:31', '2022-02-23 15:47:31'),
(63, '5642065748', 3, 350.00, 1, '2022-02-23 15:47:59', '2022-02-23 15:47:59'),
(64, '5642656624', 27, 300.00, 1, '2022-02-23 15:57:45', '2022-02-23 15:57:45'),
(65, '5647534252', 3, 350.00, 1, '2022-02-23 17:19:15', '2022-02-23 17:19:15'),
(66, '5647595060', 2, 399.00, 1, '2022-02-23 17:20:04', '2022-02-23 17:20:04'),
(67, '5713169578', 3, 350.00, 1, '2022-02-24 11:34:55', '2022-02-24 11:34:55'),
(68, '5713312682', 3, 350.00, 1, '2022-02-24 11:35:37', '2022-02-24 11:35:37'),
(69, '5716320610', 2, 399.00, 1, '2022-02-24 12:25:28', '2022-02-24 12:25:28'),
(70, '5716373452', 7, 399.00, 1, '2022-02-24 12:26:32', '2022-02-24 12:26:32'),
(71, '5717237952', 3, 350.00, 1, '2022-02-24 12:40:46', '2022-02-24 12:40:46'),
(72, '5717257939', 4, 399.00, 1, '2022-02-24 12:41:08', '2022-02-24 12:41:08'),
(73, '5782631737', 3, 350.00, 1, '2022-02-25 06:50:43', '2022-02-25 06:50:43'),
(74, '6165606026', 71, 150.00, 1, '2022-03-01 17:13:36', '2022-03-01 17:13:36'),
(75, '6165795489', 3, 350.00, 1, '2022-03-01 17:17:35', '2022-03-01 17:17:35'),
(76, '6165946481', 3, 350.00, 1, '2022-03-01 17:19:14', '2022-03-01 17:19:14'),
(77, '6165983060', 7, 399.00, 1, '2022-03-01 17:19:53', '2022-03-01 17:19:53'),
(78, '6166236907', 2, 399.00, 1, '2022-03-01 17:24:07', '2022-03-01 17:24:07'),
(79, '6166236907', 3, 350.00, 1, '2022-03-01 17:24:07', '2022-03-01 17:24:07'),
(80, '6166617748', 29, 300.00, 1, '2022-03-01 17:30:27', '2022-03-01 17:30:27'),
(81, '6166617748', 59, 300.00, 1, '2022-03-01 17:30:27', '2022-03-01 17:30:27'),
(82, '6328936817', 3, 89999.00, 1, '2022-03-03 14:35:47', '2022-03-03 14:35:47');

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

-- --------------------------------------------------------

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
(1, 'Apple iPhone 11 128GB Black (MHDH3RU/A)', 'Apple iPhone 11 128GB Black (MHDH3RU/A)', '(Nothing)', '(Nothing)', 'sm1.jpg', 'cái', 'шт.', 54999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(2, 'Apple iPhone 12 Pro 128GB Pacific Blue (MGMN3RU/A)', 'Apple iPhone 12 Pro 128GB Pacific Blue (MGMN3RU/A)', '(Nothing)', '(Nothing)', 'sm2.jpg', 'cái', 'шт.', 89999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(3, 'Apple iPhone 12 Pro 128GB Graphite (MGMK3RU/A)', 'Apple iPhone 12 Pro 128GB Graphite (MGMK3RU/A)', '(Nothing)', '(Nothing)', 'sm3.jpg', 'cái', 'шт.', 89999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(4, 'Apple iPhone 12 Pro Max 256GB Pacific Blue (MGDF3RU/A)', 'Apple iPhone 12 Pro Max 256GB Pacific Blue (MGDF3RU/A)', '(Nothing)', '(Nothing)', 'sm2.jpg', 'cái', 'шт.', 109999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(5, 'Xiaomi Redmi 9T 4+128GB Gray', 'Xiaomi Redmi 9T 4+128GB Gray', '(Nothing)', '(Nothing)', 'sm4.jpg', 'cái', 'шт.', 16999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(6, 'Samsung Galaxy A32 128GB Awesome Black (SM-A325F)', 'Samsung Galaxy A32 128GB Awesome Black (SM-A325F)', '(Nothing)', '(Nothing)', 'sm5.jpg', 'cái', 'шт.', 21999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(7, 'Xiaomi Redmi 9C NFC 3+64GB Midnight Gray', 'Xiaomi Redmi 9C NFC 3+64GB Midnight Gray', '(Nothing)', '(Nothing)', 'sm6.jpg', 'cái', 'шт.', 10999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(8, 'Samsung Galaxy A12 64GB Black (SM-A125F)', 'Samsung Galaxy A12 64GB Black (SM-A125F)', '(Nothing)', '(Nothing)', 'sm7.jpg', 'cái', 'шт.', 11999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(9, 'Samsung Galaxy M12 64GB Black (SM-M127F)', 'Samsung Galaxy M12 64GB Black (SM-M127F)', '(Nothing)', '(Nothing)', 'sm8.jpg', 'cái', 'шт.', 11499.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(10, 'Samsung Galaxy M32 128GB Black (SM-M325F', 'Samsung Galaxy M32 128GB Black (SM-M325F)', '(Nothing)', '(Nothing)', 'sm9.jpg', 'cái', 'шт.', 22999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(11, 'Samsung Galaxy S21 128GB Phantom Gray (SM-G991B)', 'Samsung Galaxy S21 128GB Phantom Gray (SM-G991B)', '(Nothing)', '(Nothing)', 'sm10.jpg', 'cái', 'шт.', 64999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(12, 'Samsung Galaxy S21 Ultra 256GB Phantom Black (SM-G998B)', 'Samsung Galaxy S21 Ultra 256GB Phantom Black (SM-G998B)', '(Nothing)', '(Nothing)', 'sm11.jpg', 'cái', 'шт.', 101999.00, 0.00, 0.00, 0, 1, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(13, 'Apple MacBook Pro 16 i7 2,6/64/8T/RP 5600M 8Gb SG', 'Apple MacBook Pro 16 i7 2,6/64/8T/RP 5600M 8Gb SG', '(Nothing)', '(Nothing)', 'lt1.jpg', 'cái', 'шт.', 663999.00, 0.00, 0.00, 0, 3, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(14, 'ASUS TUF F15 FX506HE-HN011T', 'ASUS TUF F15 FX506HE-HN011T', '(Nothing)', '(Nothing)', 'lt2.jpg', 'cái', 'шт.', 89999.00, 0.00, 0.00, 0, 3, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(15, 'ASUS ROG Strix G15 G513IC-HN0133T', 'ASUS ROG Strix G15 G513IC-HN0133T', '(Nothing)', '(Nothing)', 'lt3.jpg', 'cái', 'шт.', 99999.00, 0.00, 0.00, 0, 3, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(16, 'ASUS TUF Dash F15 FX516PE-HN036T', 'ASUS TUF Dash F15 FX516PE-HN036T', '(Nothing)', '(Nothing)', 'lt4.jpg', 'cái', 'шт.', 86999.00, 0.00, 0.00, 0, 3, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(17, 'GARSline Smart Watch DT88 Pro', 'GARSline Smart Watch DT88 Pro', '(Nothing)', '(Nothing)', 'sw1.jpg', 'cái', 'шт.', 5500.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(18, 'Xiaomi Mi Watch Lite Black (BHR4704RU)', 'Xiaomi Mi Watch Lite Black (BHR4704RU)', '(Nothing)', '(Nothing)', 'sw2.jpg', 'cái', 'шт.', 4999.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(19, 'Samsung Galaxy Watch4 44mm черный (SM-R870N)', 'Samsung Galaxy Watch4 44mm черный (SM-R870N)', '(Nothing)', '(Nothing)', 'sw3.jpg', 'cái', 'шт.', 20499.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(20, 'Huawei Watch GT2 Matte Black, рем. Black (LTN-B19)', 'Huawei Watch GT2 Matte Black, рем. Black (LTN-B19)', '(Nothing)', '(Nothing)', 'sw4.jpg', 'cái', 'шт.', 11999.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(21, 'Huawei Watch Fit New Graphite Black (TIA-B09)', 'Huawei Watch Fit New Graphite Black (TIA-B09)', '(Nothing)', '(Nothing)', 'sw5.jpg', 'cái', 'шт.', 5999.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(22, 'Apple Watch S3 38mm Silver Al/White Sport Band', 'Apple Watch S3 38mm Silver Al/White Sport Band', '(Nothing)', '(Nothing)', 'sw6.jpg', 'cái', 'шт.', 16399.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(23, 'Apple Watch SE GPS 44mm Space Grey Alum/Midnight Sport', 'Apple Watch SE GPS 44mm Space Grey Alum/Midnight Sport', '(Nothing)', '(Nothing)', 'sw7.jpg', 'cái', 'шт.', 26149.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(24, 'Apple Watch Series 7 GPS 41mm Starlight Alum. Sport', 'Apple Watch Series 7 GPS 41mm Starlight Alum. Sport', '(Nothing)', '(Nothing)', 'sw8.jpg', 'cái', 'шт.', 36999.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(25, 'Apple Watch Series 7 GPS 45mm Green Al/Clover Sport', 'Apple Watch Series 7 GPS 45mm Green Al/Clover Sport', '(Nothing)', '(Nothing)', 'sw9.jpg', 'cái', 'шт.', 36499.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(26, 'Apple Watch Nike S7 GPS 45mm StarAl/PurePlat/BlackSport', 'Apple Watch Nike S7 GPS 45mm StarAl/PurePlat/BlackSport', '(Nothing)', '(Nothing)', 'sw10.jpg', 'cái', 'шт.', 39499.00, 0.00, 0.00, 0, 4, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(27, 'Apple 11\" iPad Pro Wi-Fi 128GB Space Grey', 'Apple 11\" iPad Pro Wi-Fi 128GB Space Grey', '(Nothing)', '(Nothing)', 'tl1.jpg', 'cái', 'шт.', 77999.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(28, 'Lenovo M10 FHD Plus TB-X606F (ZA5T0236RU)', 'Lenovo M10 FHD Plus TB-X606F (ZA5T0236RU)', '(Nothing)', '(Nothing)', 'tl2.jpg', 'cái', 'шт.', 16999.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(29, 'Samsung Galaxy Tab A7 32GB LTE Gold (SM-T505N)', 'Samsung Galaxy Tab A7 32GB LTE Gold (SM-T505N)', '(Nothing)', '(Nothing)', 'tl3.jpg', 'cái', 'шт.', 17999.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(30, 'Samsung Galaxy Tab S7 FE LTE 64GB Black (SM-T735N)', 'Samsung Galaxy Tab S7 FE LTE 64GB Black (SM-T735N)', '(Nothing)', '(Nothing)', 'tl4.jpg', 'cái', 'шт.', 41999.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(31, 'Samsung Galaxy Tab S7+ бронза LTE (SM-T975N)', 'Samsung Galaxy Tab S7+ бронза LTE (SM-T975N)', '(Nothing)', '(Nothing)', 'tl5.jpg', 'cái', 'шт.', 71999.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10'),
(32, 'Apple 12.9\' iPad Pro Wi-Fi+Cell 2TB Silver', 'Apple 12.9\' iPad Pro Wi-Fi+Cell 2TB Silver', '(Nothing)', '(Nothing)', 'tl6.jpg', 'cái', 'шт.', 214999.00, 0.00, 0.00, 0, 2, 'ACTIVE', '2021-10-14 09:26:10', '2021-10-14 09:26:10');

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

--
-- Dumping data for table `shipping_fees`
--

INSERT INTO `shipping_fees` (`id`, `MINIMUM_COST`, `SHIPPING_CHARGES`, `MIN_TOTAL_TO_GET_FREE`, `MAX_DISTANCE_TO_GET_FREE`, `created_at`, `updated_at`) VALUES
(1, 100.00, 50.00, 2000.00, 1.00, '2021-10-14 11:09:16', '2021-10-14 11:09:16');

-- --------------------------------------------------------

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

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`identifier`, `instance`, `content`, `created_at`, `updated_at`) VALUES
('dinhcuong.firewin99@gmail.com', 'cart', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-02-22 16:41:27', NULL),
('dinhcuong.firewin99@gmail.com', 'checkout', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-02-22 16:41:27', NULL),
('dinhcuong.firewin99@gmail.com', 'wishlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-02-22 17:57:48', NULL),
('hi@ledinhcuong.com', 'cart', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-02-22 16:02:41', NULL),
('hi@ledinhcuong.com', 'checkout', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-02-22 16:02:41', NULL),
('mail@dinhcuong.me', 'cart', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-03-03 14:35:48', NULL),
('mail@dinhcuong.me', 'checkout', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-03-03 14:35:48', NULL),
('mail@htphodatviet.com', 'cart', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-02-25 06:50:44', NULL),
('mail@htphodatviet.com', 'checkout', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', '2022-02-25 06:50:44', NULL);

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
(1, 'Le Dinh Cuong', 'MALE', '+79837336161', 'Казахстан, Актобе, 11-й микрорайон', 'default/avatar_default.png', 'mail@dinhcuong.me', NULL, '$2y$10$GEzCf.JwXA5aNJZGZIqdzeu0iTMYXDyLQaeAgGctcnfZujYSWfpbi', NULL, '2021-10-14 11:09:16', '2021-10-14 11:09:16'),
(2, 'Le', 'MALE', '+79857225151', 'Россия, Москва, 11-я Парковая улица', 'default/avatar_default.png', 'hi@ledinhcuong.com', NULL, '$2y$10$pMZbZf83FA0gdASw44EGMO/9Ps7KFqOcBbN3o58aYGZwT9wI.ouAu', NULL, '2022-02-22 14:49:04', '2022-02-22 14:49:04'),
(3, 'C', 'MALE', '+79857336161', 'Россия, Москва, 11-я Парковая улица', 'default/avatar_default.png', 'dinhcuong.firewin99@gmail.com', NULL, '$2y$10$Ae0mSsks3dX6eJT5mQLCPO/P5Dgt6FAETLieGYFn8new9nykOfdP.', NULL, '2022-02-22 16:16:50', '2022-02-22 16:16:50'),
(4, 'HT Pho Dat Viet', 'MALE', '+79857336161', 'Россия, Тула, Советская улица, 47', 'default/avatar_default.png', 'mail@htphodatviet.com', NULL, '$2y$10$eMryh5rX/TV2/.RH3YgtZ.ONVFkUbh5WWXI6Ew0cLJdPG4tVsxaDu', NULL, '2022-02-24 10:57:36', '2022-02-24 10:57:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `shipping_fees`
--
ALTER TABLE `shipping_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
