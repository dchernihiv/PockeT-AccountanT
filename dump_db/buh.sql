-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 30 2023 г., 13:47
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `buh`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `transaction`, `category`, `subcategory`, `created_at`, `updated_at`) VALUES
(1, 'income', 'стипендія', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(2, 'income', 'пенсійні виплати', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(3, 'income', 'заробітня плата', 'аванс', '2023-06-02 16:37:07', '2023-06-05 14:10:11'),
(4, 'income', 'заробітня плата', 'ставка', '2023-06-02 16:37:07', '2023-06-05 14:10:11'),
(5, 'income', 'заробітня плата', 'премія', '2023-06-02 16:37:07', '2023-06-05 14:10:11'),
(6, 'income', 'заробітня плата', 'відсоткова частина', '2023-06-02 16:37:07', '2023-06-05 14:10:11'),
(7, 'income', 'дохід з банківських вкладів', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(8, 'income', 'дохід з операцій оренди', 'оренда квартири/будинку', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(9, 'income', 'дохід з операцій оренди', 'авто', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(10, 'income', 'дохід від надання земельного паю в лізінг', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(11, 'income', 'виграші/призи', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(12, 'income', 'інвестиційний дохід', 'цінні папери', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(13, 'income', 'інвестиційний дохід', 'дорогоційні метали', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(14, 'income', 'інвестиційний дохід', 'крипта', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(15, 'income', 'страхові виплати', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(17, 'income', 'фінансова допомога', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(18, 'income', 'доходи від продажу власної продукції', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(19, 'income', 'доходи від надання послуг', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(20, 'income', 'доходи з валютних операцій', NULL, '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(21, 'expenses', 'квартплата', 'газ', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(22, 'expenses', 'квартплата', 'світло', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(23, 'expenses', 'квартплата', 'вода', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(24, 'expenses', 'квартплата', 'опалення', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(25, 'expenses', 'квартплата', 'ЖЕК', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(26, 'expenses', 'продукти харчування', 'хліб', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(27, 'expenses', 'продукти харчування', 'молоко', '2023-06-02 16:37:07', '2023-06-02 16:37:07'),
(28, 'expenses', 'продукти харчування', 'м\'ясо', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(29, 'expenses', 'продукти харчування', 'крупи', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(30, 'expenses', 'продукти харчування', 'овочі', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(31, 'expenses', 'продукти харчування', 'фрукти', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(32, 'expenses', 'медицина', 'ліки', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(33, 'expenses', 'медицина', 'медичні послуги', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(34, 'expenses', 'авто', 'паливо', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(35, 'expenses', 'авто', 'технічне обслуговування', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(36, 'expenses', 'авто', 'ремонтні роботи', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(37, 'expenses', 'авто', 'запасні частини', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(38, 'expenses', 'транспорт', 'таксі', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(39, 'expenses', 'транспорт', 'автобус', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(40, 'expenses', 'транспорт', 'метро', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(41, 'expenses', 'одяг', NULL, '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(42, 'expenses', 'спорт', 'абонемент', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(43, 'expenses', 'спорт', 'спортивне харчування', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(44, 'expenses', 'хоббі', NULL, '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(45, 'expenses', 'дозвілля', 'кафе', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(46, 'expenses', 'дозвілля', 'кіно', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(47, 'expenses', 'дозвілля', 'подорож', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(48, 'expenses', 'витрати на дитину', 'харчування', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(49, 'expenses', 'витрати на дитину', 'одяг', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(50, 'expenses', 'витрати на дитину', 'медичний догляд', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(51, 'expenses', 'витрати на дитину', 'дит. садок', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(52, 'expenses', 'витрати на дитину', 'школа', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(53, 'expenses', 'витрати на дитину', 'хоббі', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(54, 'expenses', 'кредитні платежі', NULL, '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(55, 'expenses', 'орендні платежі', NULL, '2023-06-02 16:37:08', '2023-06-02 16:37:08');

-- --------------------------------------------------------

--
-- Структура таблицы `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `currencies`
--

INSERT INTO `currencies` (`id`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'HRN', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(2, 'USD', '2023-06-02 16:37:08', '2023-06-02 16:37:08'),
(3, 'EUR', '2023-06-02 16:37:08', '2023-06-02 16:37:08');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
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
-- Структура таблицы `jobs`
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

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(58, 'default', '{\"uuid\":\"67bfbe50-1f37-46a6-a60f-820ae975b58e\",\"displayName\":\"App\\\\Jobs\\\\SendEmailConfirmEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailConfirmEmail\",\"command\":\"O:30:\\\"App\\\\Jobs\\\\SendEmailConfirmEmail\\\":1:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1688121736, 1688121736);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2017_09_17_125801_create_notifications_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_05_20_082831_create_categories_table', 1),
(7, '2023_06_01_131842_create_currencies_table', 1),
(8, '2023_06_01_132055_create-transaction-table', 1),
(10, '2023_06_27_161844_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('dchernihiv@gmail.com', '$2y$10$YpBQtTuSJ.uRUKQ.MnsT7esqk8XKAsGLJaqnjbpT3pGgqLG1LqLHy', '2023-06-29 11:38:35');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `transaction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `sum` int NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currencies`
--
ALTER TABLE `currencies`
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
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_category_id_foreign` (`category_id`),
  ADD KEY `transactions_currency_id_foreign` (`currency_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT для таблицы `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `transactions_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
