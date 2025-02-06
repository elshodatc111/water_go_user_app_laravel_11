-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 06 2025 г., 20:35
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `water_go`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `tarif` double NOT NULL,
  `description` longtext NOT NULL,
  `balans` int(11) NOT NULL,
  `reyting` double NOT NULL DEFAULT 5,
  `reyting_count` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status_admin` tinyint(1) NOT NULL DEFAULT 1,
  `status_drektor` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `companies`
--

INSERT INTO `companies` (`id`, `name`, `phone`, `time`, `price`, `tarif`, `description`, `balans`, `reyting`, `reyting_count`, `image_url`, `status_admin`, `status_drektor`, `created_at`, `updated_at`) VALUES
(2, 'Water Go', '+998908830450', '08:00 - 20:00', 12000, 200, 'discription', 30000, 5, 0, 'image/banner/1738866011.png', 1, 1, '2025-02-06 12:49:55', '2025-02-06 14:14:38'),
(3, 'Lorem Ipsum two', '+998908830450', '08:00 - 20:00', 10000, 200, 'Quisque ullamcorper, quam et ornare condimentum, libero ante condimentum enim, vitae tincidunt dolor ex vitae quam. Sed gravida vulputate nisl, sed dapibus ex pulvinar id. Nullam non arcu magna. Etiam elementum felis sem, ut maximus velit aliquet sit amet. Maecenas mattis fermentum diam eu eleifend. Nam nec mi ultricies, tristique turpis quis, viverra tellus. Nullam id magna justo. In ultrices sodales mi vitae consectetur. Proin nec turpis accumsan, rhoncus ex venenatis, elementum est. Sed efficitur ex vitae auctor efficitur. Mauris hendrerit neque ex. Nunc placerat molestie lacus, commodo scelerisque felis venenatis quis. Nulla massa odio, eleifend sit amet diam non, condimentum hendrerit tellus. Sed vehicula, urna sed vulputate maximus, nisi velit dictum ex, sit amet ullamcorper urna metus id urna.', 0, 4.8, 0, 'image/banner/1738864213.png', 1, 1, '2025-02-06 12:50:13', '2025-02-06 12:50:13'),
(4, 'Lorem Ipsum there', '+998908830450', '08:00 - 20:00', 10000, 150, 'Praesent condimentum ullamcorper quam a fermentum. Vestibulum ullamcorper mattis odio tempus cursus. Nulla malesuada, tortor id posuere euismod, lectus est imperdiet augue, egestas tincidunt tortor nisl vitae neque. Proin finibus, lectus nec pharetra viverra, sapien mi condimentum purus, non aliquet felis sem eget ex. Praesent a ex quis augue tempus tristique id sit amet nulla. Maecenas et nibh felis. Pellentesque semper finibus dignissim. Curabitur luctus finibus est, sed tempus velit eleifend nec. Maecenas vitae orci laoreet nibh rutrum viverra ac sit amet erat. Nulla congue condimentum mauris, a ullamcorper nulla molestie eget. Aenean luctus elit quis accumsan vulputate. Nulla facilisi. Maecenas aliquet ultrices justo in eleifend. In hac habitasse platea dictumst.', 0, 3.2, 0, 'image/banner/1738864229.png', 1, 1, '2025-02-06 12:50:29', '2025-02-06 12:50:29'),
(5, 'Lorem Ipsum four', '+998908830450', '08:00 - 20:00', 10000, 300, 'Fusce ornare neque eu malesuada maximus. Ut venenatis eros ut ex laoreet ullamcorper. Mauris mi ipsum, consequat at elit ac, facilisis consequat felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere risus quis eros sollicitudin auctor. Ut eu est eu nulla laoreet viverra. Mauris et maximus odio.', 0, 5, 0, 'image/banner/1738864247.png', 1, 1, '2025-02-06 12:50:47', '2025-02-06 12:50:47'),
(6, 'Lorem Ipsum five', '+998908830450', '08:00 - 20:00', 10000, 100, 'Pellentesque pulvinar volutpat risus nec dignissim. Donec eget sapien mi. In malesuada sodales pellentesque. Quisque dignissim lacus sed turpis dapibus, egestas tincidunt nisl blandit. Cras at tellus ornare, commodo eros quis, egestas nulla. Donec nec dapibus elit. Maecenas ultrices massa dui, eget suscipit urna interdum et.', 0, 5, 0, 'image/banner/1738864261.png', 1, 1, '2025-02-06 12:51:01', '2025-02-06 12:51:01'),
(7, 'Lorem Ipsum seven', '+998908830450', '08:00 - 20:00', 10000, 50, 'Pellentesque pulvinar volutpat risus nec dignissim. Donec eget sapien mi. In malesuada sodales pellentesque. Quisque dignissim lacus sed turpis dapibus, egestas tincidunt nisl blandit. Cras at tellus ornare, commodo eros quis, egestas nulla. Donec nec dapibus elit. Maecenas ultrices massa dui, eget suscipit urna interdum et.', 0, 5, 0, 'image/banner/1738864596.png', 1, 1, '2025-02-06 12:56:36', '2025-02-06 12:56:36'),
(8, 'Lorem Ipsum seven', '+998908830450', '08:00 - 20:00', 10000, 120, 'Pellentesque pulvinar volutpat risus nec dignissim. Donec eget sapien mi. In malesuada sodales pellentesque. Quisque dignissim lacus sed turpis dapibus, egestas tincidunt nisl blandit. Cras at tellus ornare, commodo eros quis, egestas nulla. Donec nec dapibus elit. Maecenas ultrices massa dui, eget suscipit urna interdum et.', 0, 5, 0, 'image/banner/1738865012.png', 1, 1, '2025-02-06 13:03:32', '2025-02-06 13:03:32'),
(9, 'Lorem Ipsum seven', '+998908830450', '08:00 - 20:00', 10000, 120, 'Pellentesque pulvinar volutpat risus nec dignissim. Donec eget sapien mi. In malesuada sodales pellentesque. Quisque dignissim lacus sed turpis dapibus, egestas tincidunt nisl blandit. Cras at tellus ornare, commodo eros quis, egestas nulla. Donec nec dapibus elit. Maecenas ultrices massa dui, eget suscipit urna interdum et.', 0, 5, 0, 'image/banner/1738869175.png', 1, 1, '2025-02-06 14:12:55', '2025-02-06 14:12:55');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
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
-- Структура таблицы `jobs`
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
-- Структура таблицы `job_batches`
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
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_02_064510_create_personal_access_tokens_table', 1),
(5, '2025_02_02_154739_create_companies_table', 1),
(6, '2025_02_06_184841_create_paymarts_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `paymarts`
--

CREATE TABLE `paymarts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `paymarts`
--

INSERT INTO `paymarts` (`id`, `company_id`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 10000, 'Test Uchun', '2025-02-06 14:00:13', '2025-02-06 14:00:13'),
(2, 2, 20000, 'Test Uchun', '2025-02-06 14:02:29', '2025-02-06 14:02:29'),
(3, 2, 5000, 'Test Uchun', '2025-02-06 14:02:44', '2025-02-06 14:02:44'),
(4, 2, 5000, 'Test Uchun', '2025-02-06 14:14:38', '2025-02-06 14:14:38');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 2, 'Admin', '4617e787c5ced7d79db064933c58ebfdfa490c1529b31cf5c25bb2f630ee39bc', '[\"*\"]', NULL, NULL, '2025-02-06 12:12:30', '2025-02-06 12:12:30'),
(7, 'App\\Models\\User', 1, 'Admin', '15152acc74afbed38009615f6b55c927c9615eb27e61f98b5255ef21702907ba', '[\"*\"]', '2025-02-06 14:32:36', NULL, '2025-02-06 12:38:14', '2025-02-06 14:32:36');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT 'name',
  `phone` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'user',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `reyting` double NOT NULL DEFAULT 5,
  `reyting_count` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_token` varchar(255) NOT NULL DEFAULT 'null',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `company_id`, `name`, `phone`, `type`, `status`, `reyting`, `reyting_count`, `email`, `email_verified_at`, `password`, `mobile_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alisher Qalandarov', '+998945206005', 'admin', 1, 5, 0, 'elshodatc@gmail.com', NULL, '$2y$12$ty7fL0eHlHR.oQLWJ1WT3uM5ncljM2RrkADM4.o0eIuo72KSA69Oi', 'Mobile Token', NULL, '2025-02-06 12:04:07', '2025-02-06 12:33:38'),
(2, 1, 'Alisher Qalandarov', '+998945206003', 'admin', 1, 5, 0, 'elshodatc1116@gmail.com', NULL, '$2y$12$KFaJxfvg2omeOXD3/HexMevXIXnGjLMQartDIKTiQpNGE02eCmK6m', 'null', NULL, '2025-02-06 12:06:16', '2025-02-06 12:06:16'),
(3, 2, 'Alimov Salim', '+998954854540', 'drektor', 1, 5, 0, 'test@test', NULL, '$2y$12$B1t3mU/qMhmAU.ZeuQxszOKhx/3RLCP.oNLPnzfZQhQKLcQcst3Zq', 'null', NULL, '2025-02-06 14:32:36', '2025-02-06 14:32:36');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `paymarts`
--
ALTER TABLE `paymarts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `paymarts`
--
ALTER TABLE `paymarts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
