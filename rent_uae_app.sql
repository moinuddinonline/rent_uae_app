-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 08:30 PM
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
-- Database: `rent_uae_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '2025_02_08_163311_create_users_table', 1),
(26, '2025_02_08_163349_create_cache_table', 1),
(27, '2025_02_08_163407_create_jobs_table', 1),
(28, '2025_02_08_163459_laratrust_setup_tables', 1),
(29, '2025_02_08_163557_create_rent_types_table', 1),
(30, '2025_02_08_163642_create_user_otps__table', 1),
(31, '2025_02_08_163703_create_rent_vendors_table', 1),
(32, '2025_02_08_163719_create_rents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin_dashboard', 'Admin dashboard', 'Admin dashboard', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(2, 'access', 'Access', 'Access', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(3, 'user_create', 'Create User', 'Create User', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(4, 'user_read', 'Read User', 'Read User', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(5, 'user_update', 'Update User', 'Update User', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(6, 'user_delete', 'Delete User', 'Delete User', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(7, 'role_create', 'Create Role', 'Create Role', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(8, 'role_read', 'Read Role', 'Read Role', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(9, 'role_update', 'Update Role', 'Update Role', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(10, 'role_delete', 'Delete Role', 'Delete Role', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(11, 'permission_create', 'Create Permission', 'Create Permission', '2025-03-09 06:09:49', '2025-03-09 06:09:49'),
(12, 'permission_read', 'Read Permission', 'Read Permission', '2025-03-09 06:09:50', '2025-03-09 06:09:50'),
(13, 'permission_update', 'Update Permission', 'Update Permission', '2025-03-09 06:09:50', '2025-03-09 06:09:50'),
(14, 'permission_delete', 'Delete Permission', 'Delete Permission', '2025-03-09 06:09:50', '2025-03-09 06:09:50'),
(15, 'user_profile', 'User profile', 'User profile', '2025-03-09 06:09:50', '2025-03-09 06:09:50'),
(16, 'rent_vendor_create', 'Rent Vendor Create', 'Allows a users to create a Rent Vendor', '2025-03-09 12:36:35', '2025-03-09 12:36:35'),
(17, 'rent_vendor_update', 'Rent Vendor Update', 'Allows a user to update a Rent Vendor', '2025-03-09 12:38:01', '2025-03-09 12:38:01'),
(18, 'rent_vendor_read', 'Rent Vendor Read', 'Allows a user to read a Rent Vendor', '2025-03-09 12:38:36', '2025-03-09 12:38:36'),
(19, 'rent_vendor_delete', 'Rent Vendor Delete', 'Allows a user to delete a Rent Vendor', '2025-03-09 12:39:40', '2025-03-09 12:39:40'),
(20, 'rent_create', 'Rent Create', 'Allows a user to create a Rent', '2025-03-09 12:40:23', '2025-03-09 12:40:23'),
(21, 'rent_update', 'Rent Update', 'Allows a user to update a Rent', '2025-03-09 12:40:52', '2025-03-09 12:40:52'),
(22, 'rent_read', 'Rent Read', 'Allows a user to read a Rent', '2025-03-09 12:41:13', '2025-03-09 12:41:13'),
(23, 'rent_delete', 'Rent Delete', 'Allows a user to delete a Rent', '2025-03-09 12:41:48', '2025-03-09 12:41:48'),
(24, 'rent_type_create', 'Rent Type Create', 'Allows a user to create a Rent Type', '2025-03-09 12:42:09', '2025-03-09 12:42:09'),
(25, 'rent_type_update', 'Rent Type Update', 'Allows a user to update a Rent Type', '2025-03-09 12:42:35', '2025-03-09 12:42:35'),
(26, 'rent_type_read', 'Rent Type Read', 'Allows a user to read a Rent Type', '2025-03-09 12:42:56', '2025-03-09 12:42:56'),
(27, 'rent_type_delete', 'Rent Type Delete', 'Allows a user to delete a Rent Type', '2025-03-09 12:43:20', '2025-03-09 12:43:20'),
(28, 'rent_module', 'Rent Module', 'Rent Module', '2025-03-09 12:43:44', '2025-03-09 12:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 2),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(20, 2),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rent_vendor_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_title` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`id`, `user_id`, `rent_vendor_id`, `amount`, `payment_title`, `payment_date`, `payment_status`, `payment_image`, `created_at`, `updated_at`) VALUES
(2, 2, 3, 2000.00, 'Annual Rent Payment	', '0000-00-00', 'Pending', 'public/1741548200_5556.png', '0000-00-00 00:00:00', '2025-03-09 13:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `rent_types`
--

CREATE TABLE `rent_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rent_types`
--

INSERT INTO `rent_types` (`id`, `name`, `slug`, `description`, `image`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Home Rental', 'home-rental', 'Find rental homes suited to your needs. Perfect for short or long-term stays.', NULL, 1, 1, NULL, NULL),
(2, 'Office Rental', 'office-rental', 'Discover fully equipped office spaces for rent. Ideal for businesses of all sizes.', NULL, 1, 2, NULL, NULL),
(3, 'Car Rental', 'car-rental', 'Rent cars for daily commutes or special trips. Affordable and reliable options.', NULL, 1, 3, NULL, NULL),
(4, 'Luxury Goods Rental', 'luxury-goods-rental', 'Access premium luxury items without ownership. Perfect for special occasions.', NULL, 1, 4, NULL, NULL),
(5, 'Electronics on Rent', 'electronics-on-rent', 'Get the latest electronics on rent. Ideal for temporary or project-based needs.', NULL, 1, 5, NULL, NULL),
(6, 'Furniture on Rent', 'furniture-on-rent', 'Stylish furniture rentals to furnish your space effortlessly. Flexible terms available.', NULL, 1, 6, NULL, NULL),
(7, 'Yachts on Rent', 'yachts-on-rent', 'Rent luxurious yachts for leisure or events. Tailored for a premium experience.', NULL, 1, 7, NULL, NULL),
(8, 'Medical Equipment on Rentals', 'medical-equipment-on-rentals', 'Access essential medical equipment on rent. Ensures affordability and convenience.', NULL, 1, 8, NULL, NULL),
(9, 'Industrial Equipment', 'industrial-equipment', 'Heavy-duty industrial equipment available for rent. Designed for various projects.', NULL, 1, 9, NULL, NULL),
(10, 'Parking Rental', 'parking-rental', 'Secure parking spaces for rent. Perfect for vehicles of all types.', NULL, 1, 10, NULL, NULL),
(11, 'Service Apartments & Short-Term Rentals', 'service-apartments-short-term-rentals', 'Fully furnished service apartments for short-term stays. Comfortable and convenient.', NULL, 1, 11, NULL, NULL),
(12, 'Warehouse & Storage Facilities', 'warehouse-storage-facilities', 'Secure storage and warehouse facilities available. Suitable for personal or business use.', NULL, 1, 12, NULL, NULL),
(13, 'Business License and Desk Rentals', 'business-license-and-desk-rentals', 'Professional desk rentals and business licenses. Ideal for startups and freelancers.', NULL, 1, 13, NULL, NULL),
(14, 'Equipment and Tool Rentals', 'equipment-and-tool-rentals', 'Rent tools and equipment for DIY projects or professional use. Affordable and convenient.', NULL, 1, 14, NULL, NULL),
(15, 'Bike and Scooter Rentals', 'bike-and-scooter-rentals', 'Eco-friendly bike and scooter rentals for easy commuting. Flexible rental periods.', NULL, 1, 15, NULL, NULL),
(16, 'Pet Services', 'pet-services', 'Convenient rental services for pet care and related needs. Tailored to pet lovers.', NULL, 1, 16, NULL, NULL),
(17, 'Marina Berths', 'marina-berths', 'Secure marina berths available for rent. Perfect for boat and yacht owners.', NULL, 1, 17, NULL, NULL),
(18, 'Education Fees', 'education-fees', 'Flexible rental solutions for education fees. Ensures easy access to learning.', NULL, 1, 18, NULL, NULL),
(19, 'Fashion and Accessories Rentals', 'fashion-and-accessories-rentals', 'Trendy fashion and accessories available on rent. Perfect for events and daily wear.', NULL, 1, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rent_vendors`
--

CREATE TABLE `rent_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rent_type_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `iban_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rent_vendors`
--

INSERT INTO `rent_vendors` (`id`, `user_id`, `rent_type_id`, `vendor_name`, `email`, `mobile`, `iban_number`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 'Rubel', 'rubel@gmail.com', '9064629116', 'AE070331234567890123456', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', '2025-03-09 06:09:49', '2025-03-09 13:17:57'),
(2, 'user', 'User', 'User', '2025-03-09 06:09:50', '2025-03-09 13:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(2, 2, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nQSL37Hd0ZUS9YeiXE1IVe3azwLEBmIbxB97vjTl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiTU9INzM4alNZR1FUUU96VlVvcGx3NEZYVG9qTm5DamJvS05xRGRkUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1741550479);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_prefix` varchar(255) NOT NULL DEFAULT '+91',
  `mobile` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `mobile_verified` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `mobile_prefix`, `mobile`, `email_verified`, `mobile_verified`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '6619QVPZV75K1978', 'Admin', 'admin@app.com', '+91', NULL, 1, 0, '$2y$12$GGPDnenpJV8081dPzRPcHe17qBpPMv27/2Wywi1jIjJ6xVcmNiZLe', NULL, 1, '8Oij8Ov3mPvXRK0lVWC57zbZR14QzuzApBkbIdqt4dgfprUBjRpSzDJaptok', '2025-03-09 06:09:50', '2025-03-09 06:09:50'),
(2, '580VG4ZEMTA1146', 'SK MOINUDDIN', 'skmoinuddin2k@gmail.com', '+91', '9064629116', 1, 1, '$2y$12$cbX01bqooBGbGCA2n3gj4u4Bo6gDB2xGJNlc0FV9aZ4idaoWVeRNq', NULL, 1, 'V7nbFqWFYLJKV0O0MoYDLxQwTPHRsij2wD3hTGxrwFxlIfnmeY9UItPTzEoM', '2025-03-09 12:45:56', '2025-03-09 13:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_otps`
--

CREATE TABLE `user_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('email','mobile') NOT NULL DEFAULT 'mobile',
  `email` varchar(255) DEFAULT NULL,
  `mobile_prefix` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `resend` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rents_rent_vendor_id_foreign` (`rent_vendor_id`),
  ADD KEY `rents_user_id_foreign` (`user_id`);

--
-- Indexes for table `rent_types`
--
ALTER TABLE `rent_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rent_types_name_unique` (`name`),
  ADD UNIQUE KEY `rent_types_slug_unique` (`slug`);

--
-- Indexes for table `rent_vendors`
--
ALTER TABLE `rent_vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_rent_vendor` (`rent_type_id`,`user_id`,`iban_number`),
  ADD KEY `rent_vendors_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

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
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `user_otps`
--
ALTER TABLE `user_otps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_otps_email_unique` (`email`),
  ADD UNIQUE KEY `user_otps_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rent_types`
--
ALTER TABLE `rent_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rent_vendors`
--
ALTER TABLE `rent_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_otps`
--
ALTER TABLE `user_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_rent_vendor_id_foreign` FOREIGN KEY (`rent_vendor_id`) REFERENCES `rent_vendors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rent_vendors`
--
ALTER TABLE `rent_vendors`
  ADD CONSTRAINT `rent_vendors_rent_type_id_foreign` FOREIGN KEY (`rent_type_id`) REFERENCES `rent_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rent_vendors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
