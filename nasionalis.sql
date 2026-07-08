-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 07, 2025 at 10:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nasionalis`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-11-20 21:40:29', '2025-11-20 21:40:29'),
(2, 1, '2025-11-21 20:26:17', '2025-11-21 20:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(13, 1, 1, 1, '359000.00', '2025-11-24 19:56:18', '2025-11-24 19:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Lensa Kacamata', 'lensa-kacamata', 'Berbagai jenis lensa kacamata berkualitas', 1, '2025-11-12 06:24:54', '2025-11-12 06:24:54'),
(2, 'Lensa Optik', 'lensa-optik', 'Lensa fotokromik, plus, minus, dan progresif', 1, '2025-11-12 06:24:54', '2025-11-12 06:24:54'),
(3, 'Frame Kacamata', 'frame-kacamata', 'Koleksi frame kacamata modern dan klasik', 1, '2025-11-12 06:24:54', '2025-11-12 06:24:54'),
(4, 'Kacamata Hitam', 'kacamata-hitam', 'Kacamata hitam stylish dan protective', 1, '2025-11-12 06:24:54', '2025-11-12 06:24:54'),
(5, 'Aksesoris & Fashion', 'aksesoris-fashion', 'Aksesoris pelengkap kacamata Anda', 1, '2025-11-12 06:24:54', '2025-11-12 06:24:54'),
(6, 'Lensa Kontak', 'lensa-kontak', 'Lensa kontak berkualitas dan nyaman', 1, '2025-11-12 06:24:54', '2025-11-12 06:24:54'),
(7, 'Pembersih Kacamata', 'pembersih-kacamata', 'Produk pembersih dan perawatan kacamata', 1, '2025-11-12 06:24:54', '2025-11-12 06:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_12_130432_create_categories_table', 2),
(5, '2025_11_12_130603_create_products_table', 2),
(6, '2025_11_12_130658_create_product_image_table', 2),
(7, '2025_11_12_130750_create_services_table', 2),
(8, '2025_11_12_130849_add_role_to_users_table', 2),
(9, '2025_11_21_031354_add_phone_to_users_table', 3),
(10, '2025_11_21_033353_create_carts_table', 4),
(11, '2025_11_21_033405_create_cart_items_table', 4),
(12, '2025_11_21_035910_create_orders_table', 5),
(13, '2025_11_21_035915_create_order_items_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('bank_transfer','e_wallet','credit_card') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bank_transfer',
  `payment_status` enum('pending','paid','failed','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `xendit_invoice_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `xendit_invoice_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `city`, `postal_code`, `subtotal`, `shipping_cost`, `total`, `payment_method`, `payment_status`, `payment_proof`, `status`, `xendit_invoice_id`, `xendit_invoice_url`, `paid_at`, `notes`, `created_at`, `updated_at`) VALUES
(8, 'ORD202511221933', 2, 'Yoralph', 'alphrenoorz@gmail.com', '082143476748', 'dasdff', 'fsadfsd', 'a645645', '359000.00', '0.00', '359000.00', 'e_wallet', 'paid', NULL, 'shipped', '692130a9e2f44a210c6a6f62', 'https://checkout-staging.xendit.co/web/692130a9e2f44a210c6a6f62', '2025-11-21 20:40:57', 'sfdgdf', '2025-11-21 20:40:25', '2025-11-22 01:31:38'),
(9, 'ORD202511229439', 2, 'Yoralph', 'alphrenoorz@gmail.com', '082143476748', 'Jalan Malang', 'Malang', '67355', '359000.00', '0.00', '359000.00', 'e_wallet', 'paid', NULL, 'shipped', '69216d53e2f44a210c6aa231', 'https://checkout-staging.xendit.co/web/69216d53e2f44a210c6aa231', '2025-11-22 00:59:35', 'Haloooo', '2025-11-22 00:59:14', '2025-11-22 01:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(6, 8, 1, 'PureLite Slim 710', 1, '359000.00', '359000.00', '2025-11-21 20:40:25', '2025-11-21 20:40:25'),
(7, 9, 1, 'PureLite Slim 710', 1, '359000.00', '359000.00', '2025-11-22 00:59:14', '2025-11-22 00:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL,
  `discount_price` decimal(12,2) DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('pria','wanita','anak','unisex') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unisex',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shape` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `review_count` int NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `is_new` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `discount_price`, `brand`, `gender`, `color`, `shape`, `material`, `rating`, `review_count`, `stock`, `is_new`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 3, 'PureLite Slim 710', 'purelite-slim-710', 'Frame tipis dan ringan untuk penggunaan jangka panjang.', '530000.00', '359000.00', 'PureLite', 'unisex', 'Coklat', 'Kotak', 'Plastik', '0.0', 0, 5, 1, 0, 1, '2025-11-12 07:06:21', '2025-11-22 00:59:14'),
(2, 2, 'VisionPro Classic 101', 'visionpro-classic-101', 'Frame ringan dengan desain minimalis cocok untuk aktivitas harian.', '450000.00', '299000.00', 'VisionPro', 'unisex', 'Hitam', 'Kotak', 'Plastik', '0.0', 0, 13, 1, 1, 1, '2025-11-20 02:57:20', '2025-11-21 20:34:45'),
(3, 2, 'OptiLux AirLite 220', 'optilux-airlite-220', 'Material fleksibel dan nyaman dipakai seharian.', '520000.00', '349000.00', 'OptiLux', 'unisex', 'Biru Navy', 'Bulat', 'Plastik', '0.0', 0, 8, 1, 0, 1, '2025-11-20 02:59:01', '2025-11-20 02:59:01'),
(4, 2, 'TitanEdge S1', 'titanedge-s1', 'Frame titanium premium dengan daya tahan tinggi.', '890000.00', '659000.00', 'TitanEdge', 'pria', 'Silver', 'Kotak', 'Titanium', '0.0', 0, 5, 1, 0, 1, '2025-11-20 03:01:21', '2025-11-20 03:01:21'),
(5, 5, 'BellaEyes Retro Chic', 'bellaeyes-retro-chic', 'Frame cat-eye stylish untuk tampilan elegan.', '600000.00', '429000.00', 'BellaEyes', 'wanita', 'Merah Maroon', 'Cat Eye', 'Plastik', '0.0', 0, 10, 1, 1, 1, '2025-11-20 03:03:43', '2025-11-20 03:03:43'),
(6, 2, 'AeroMetal Flex 330', 'aerometal-flex-330', 'Frame metal ringan dengan nosepad adjustable.', '480000.00', '339000.00', 'AeroMetal', 'unisex', 'Gold', 'Aviator', 'Metal', '0.0', 0, 10, 1, 0, 1, '2025-11-20 03:12:32', '2025-11-20 03:12:32'),
(7, 2, 'UrbanSquare Pro', 'urbansquare-pro', 'Frame kotak modern cocok untuk pekerja kantoran.', '430000.00', '289000.00', 'UrbanOptic', 'unisex', 'Hitam Doff', 'Kotak', 'Plastik', '0.0', 0, 7, 1, 1, 1, '2025-11-20 03:14:36', '2025-11-20 03:14:36'),
(8, 2, 'LunaSoft Eyewear', 'lunasoft-eyewear', 'Warna kalem dan frame ringan untuk tampilan kasual.', '390000.00', '259000.00', 'LunaSoft', 'wanita', 'Pink Rose', 'Bulat', 'Plastik', '0.0', 0, 14, 1, 0, 1, '2025-11-20 03:15:59', '2025-11-20 03:15:59'),
(9, 1, 'SteelFrame Pro 550', 'steelframe-pro-550', 'Desain kokoh berbahan metal dengan kesan profesional.', '650000.00', '479000.00', 'SteelFrame', 'pria', 'Gunmetal', 'Kotak', 'Metal', '0.0', 0, 6, 1, 0, 1, '2025-11-20 03:17:41', '2025-11-20 03:17:41'),
(10, 2, 'AirFlex Mini', 'airflex-mini', 'Cocok untuk wajah kecil dengan frame super ringan.', '350000.00', '219000.00', 'AirFlex', 'unisex', 'Transparan', 'Bulat', 'Plastik', '0.0', 0, 16, 1, 0, 1, '2025-11-20 03:25:49', '2025-11-20 03:25:49'),
(11, 2, 'Classic Aviato X', 'classic-aviato-x', 'Model aviator klasik yang tidak lekang waktu.', '580000.00', '429000.00', 'Aviato', 'unisex', 'Silver', 'Aviator', 'Metal', '0.0', 0, 10, 1, 0, 1, '2025-11-20 03:27:46', '2025-11-20 03:27:46'),
(12, 2, 'CatVision Elegance', 'catvision-elegance', 'Model cat eye dengan sentuhan glossy.', '620000.00', '449000.00', 'CatVision', 'wanita', 'Hitam', 'Cat Eye', 'Plastik', '0.0', 0, 14, 1, 1, 1, '2025-11-20 04:49:19', '2025-11-20 04:49:19'),
(13, 2, 'OptiSteel Urban', 'optisteel-urban', 'Frame metal urban style cocok untuk pekerja muda.', '520000.00', '379000.00', 'OptiSteel', 'pria', 'Silver Doff', 'Bulat', 'Metal', '0.0', 0, 16, 1, 0, 1, '2025-11-20 04:54:17', '2025-11-20 04:54:17'),
(14, 2, 'FlexyFrame Kids', 'flexyframe-kids', 'Kacamata aman dan lentur untuk anak-anak.', '300000.00', '189000.00', 'FlexyKids', 'unisex', 'Baru', 'Kotak', 'Plastik', '0.0', 0, 20, 1, 0, 1, '2025-11-20 04:56:14', '2025-11-20 04:56:14'),
(15, 2, 'SkyLens Breeze', 'skylens-breeze', 'Frame ringan dengan warna pastel modern.', '450000.00', '299000.00', 'SkyLens', 'wanita', 'Lavender', 'Bulat', 'Plastik', '0.0', 0, 8, 1, 1, 1, '2025-11-20 05:00:50', '2025-11-20 05:00:50'),
(16, 2, 'TitanMax Pro 900', 'titanmax-pro-900', 'Full titanium untuk ketahanan premium.', '950000.00', '699000.00', 'TitanMax', 'pria', 'Dark Silver', 'Kotak', 'Titanium', '0.0', 0, 4, 1, 1, 1, '2025-11-20 05:09:44', '2025-11-20 05:09:44'),
(17, 5, 'RetroRound Classic', 'retroround-classic', 'Model vintage bulat yang timeless.', '500000.00', '349000.00', 'RetroRound', 'unisex', 'Brown Tortoise', 'Bulat', 'Plastik', '0.0', 0, 8, 1, 0, 1, '2025-11-20 05:11:40', '2025-11-20 05:11:40'),
(18, 2, 'AeroLite Aviator', 'aerolite-aviator', 'Frame metal aviator ringan untuk tampilan stylish.', '620000.00', '439000.00', 'AeroLite', 'unisex', 'Hitam', 'Aviator', 'Metal', '0.0', 0, 12, 1, 0, 1, '2025-11-20 05:17:34', '2025-11-20 05:17:34'),
(19, 5, 'VelvetEye SoftPink', 'velveteye-softpink', 'Frame feminin dengan warna soft pink yang elegan.', '420000.00', '279000.00', 'VelvetEye', 'wanita', 'Soft Pink', 'Cat Eye', 'Metal', '0.0', 0, 10, 1, 0, 1, '2025-11-20 05:21:08', '2025-11-20 05:21:08'),
(20, 2, 'SteelEdge Minimal', 'steeledge-minimal', 'Minimalis berbahan metal dengan tampilan profesional.', '530000.00', '389000.00', 'SteelEdge', 'pria', 'Silver', 'Kotak', 'Metal', '0.0', 0, 14, 1, 1, 1, '2025-11-20 05:22:34', '2025-11-20 05:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `is_primary`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 2, 'products/FGTFvNzCB8fNDPeyCkuiUNUwfi8mxcXtdDphgEyi.png', 1, 0, '2025-11-20 02:57:20', '2025-11-20 02:57:20'),
(3, 3, 'products/lCliAsBlRO9VCYYtFEwOobLQgBA9F89ij8VLQWgz.png', 1, 0, '2025-11-20 02:59:01', '2025-11-20 02:59:01'),
(4, 4, 'products/TZl2URBkbta0hl6HNasxegRxWW1MVVJ8IapfTlqE.png', 1, 0, '2025-11-20 03:01:21', '2025-11-20 03:01:21'),
(5, 5, 'products/G6HpgRyFrwKrAjTZsalVk8Gbv3kZH0GJOmNJfXTv.png', 1, 0, '2025-11-20 03:03:43', '2025-11-20 03:03:43'),
(6, 6, 'products/oIyk8h25Sf2giYexlpUQiHeBaTpVu5SwKVcLp9T3.png', 1, 0, '2025-11-20 03:12:32', '2025-11-20 03:12:32'),
(7, 7, 'products/jpJ9A2EgAWbICD8uWLeueDeJMqlVBlnL2Zkzam2T.png', 1, 0, '2025-11-20 03:14:36', '2025-11-20 03:14:36'),
(8, 8, 'products/omv17xC94UMpWtzBIA1qiefq9zSLBFuxebGbuCVV.png', 1, 0, '2025-11-20 03:15:59', '2025-11-20 03:15:59'),
(9, 9, 'products/CGJobMvwAKzbeK6auQCHwVKpWkcyO3a9QXzDUfqx.png', 1, 0, '2025-11-20 03:17:41', '2025-11-20 03:17:41'),
(10, 10, 'products/rdVz7Qawimzpjd7Wc7qEWR4NthFdwJ4dQNxVxlr1.png', 1, 0, '2025-11-20 03:25:49', '2025-11-20 03:25:49'),
(11, 11, 'products/Az2nIEDfGxzvuNRuVSR8V9PCVDkU7zmwyobCpW6W.png', 1, 0, '2025-11-20 03:27:46', '2025-11-20 03:27:46'),
(12, 1, 'products/w8qOiYBGB9c1eZOOmw9SUZcPiMniCOoEvW2dHXSx.png', 1, 0, '2025-11-20 03:31:28', '2025-11-20 03:31:28'),
(13, 12, 'products/GYh3qn4l9JxQHcBV44dODY8Oj44vijFlz62DmWmX.png', 1, 0, '2025-11-20 04:49:19', '2025-11-20 04:49:19'),
(14, 13, 'products/8g3t2IW9bbSJIHq1TPKfblXFCzZJAaIwaAepXJWF.png', 1, 0, '2025-11-20 04:54:17', '2025-11-20 04:54:17'),
(15, 14, 'products/qpxGlnJjqlYh2LbU157APvqEvtdMbVZbExuZt2jq.png', 1, 0, '2025-11-20 04:56:14', '2025-11-20 04:56:14'),
(16, 15, 'products/XKmeNPdgTbdYLfqNHphvkXWd3Uk6Ng9ofko3We12.png', 1, 0, '2025-11-20 05:00:50', '2025-11-20 05:00:50'),
(17, 16, 'products/rM06ROL8A2Kd3HMRBYogjNO8RWkhnvWaycUJEYrJ.png', 1, 0, '2025-11-20 05:09:44', '2025-11-20 05:09:44'),
(18, 17, 'products/9YlukmPdiK8W9NjPtw2ETsgEIsSIcIyZsdbuUa2b.png', 1, 0, '2025-11-20 05:11:40', '2025-11-20 05:11:40'),
(19, 18, 'products/o6884qAkXohb8aZOtWU1fR7PlS5hMxIdtMUtkoR3.png', 1, 0, '2025-11-20 05:17:34', '2025-11-20 05:17:34'),
(20, 19, 'products/KTM55VAFPS6Ywaj7v7pWOajmWN28LPA9G2MB9CMz.png', 1, 0, '2025-11-20 05:21:08', '2025-11-20 05:21:08'),
(21, 20, 'products/W8mzXwMG2GWS35O6jBP9U2XUgBG1Q1DstXuED5pX.png', 1, 0, '2025-11-20 05:22:34', '2025-11-20 05:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image_path`, `link`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Pemeriksaan Mata', 'Dapatkan pemeriksaan mata gratis', 'services/jd2tWmMmrkstai3P8LknudkY2x0FTEsSsLYbnYOh.png', NULL, 1, 1, '2025-11-17 08:23:36', '2025-11-20 02:24:36'),
(2, 'Pembersihan dan Perawatan Kacamata Gratis', 'Membersihkan lensa, mengecek baut frame, dan menyesuaikan kacamata agar lebih nyaman digunakan.', 'services/mLRPmLD9DuZ9YfMlCu1EGjtfpRl2UuwFCHx1AHdS.png', NULL, 2, 1, '2025-11-17 08:29:30', '2025-11-20 02:19:39'),
(3, 'Penyesuaian Frame Kacamata', 'Membantu memperbaiki posisi dan kenyamanan frame yang longgar, miring, atau tidak pas di wajah pelanggan.', 'services/0yBUmxHiA61evv2PHwVLRtnE8ro4YHl2iEX7KW1m.png', NULL, 3, 1, '2025-11-17 08:30:46', '2025-11-20 02:28:29'),
(4, 'Konsultasi Pemilihan Lensa & Frame', 'Memberikan rekomendasi lensa dan frame sesuai kebutuhan, aktivitas, dan bentuk wajah pelanggan agar hasil lebih optimal.', 'services/nHAPE1b79Ugpab7yo7flZH63wzRWq0QdtsmMJke2.png', NULL, 4, 1, '2025-11-17 08:31:54', '2025-11-20 02:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('IoHsRuulkzxIDdWFoFneodiAH0Z3uKQt2GzRujQY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWFidW1HNm9NbUlhbHdnb0pHZ0VyRG1PdEZxSndlWXR0N2VFQW1JUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765101943),
('yHkXyuznKk6dTIIuPtouamh4rDJxCgrYJgLfD1BD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVJmZUZ6bzA2WUd0ZGM3RTdaQ21vQkJPM3lWaE1nZ0E5ZGo2SUxUVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYm91dCI7fX0=', 1765032058);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Optik Nasionalis', 'admin@optiknasionalis.com', NULL, 'admin', NULL, '$2y$12$ipBSLHwEGxweOTaOoRkICuGJeqFAACH/pBotKWe.aEy5jcYl3r/fa', NULL, '2025-11-12 06:25:01', '2025-11-12 06:25:01'),
(2, 'Yoralph', 'alphrenoorz@gmail.com', '082143476748', 'user', NULL, '$2y$12$Bcrt44TNz4KTEOQCEFySQe3BO8ztTCWHdor/hZwNuxLlNLA7dhtJy', NULL, '2025-11-20 20:20:56', '2025-11-20 20:28:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
