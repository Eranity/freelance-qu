-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2020 at 08:55 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` enum('Грант','Автор','Университет') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('В ожиданий','Принят','Отказано','Доработка') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_remarks`
--

CREATE TABLE `application_remarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_answered` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{}', 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{}', 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"App\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 0, 1, 1, 1, 1, 1, '{}', 9),
(22, 4, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(23, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(24, 4, 'unit_type', 'text', 'Unit Type', 0, 1, 1, 1, 1, 1, '{}', 3),
(25, 4, 'unit_price', 'text', 'Unit Price', 1, 1, 1, 1, 1, 1, '{}', 4),
(26, 4, 'order', 'text', 'Order', 1, 1, 1, 1, 1, 1, '{}', 5),
(27, 4, 'work_type_belongstomany_position_relationship', 'relationship', 'positions', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Position\",\"table\":\"positions\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"work_type__positions\",\"pivot\":\"1\",\"taggable\":null}', 6),
(28, 5, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(29, 5, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(30, 5, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, '{}', 3),
(33, 1, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 1, 1, 1, 1, 1, '{}', 6);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2020-10-10 08:46:31', '2020-10-12 08:05:10'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(4, 'work_types', 'work-types', 'Work Type', 'Work Types', NULL, 'App\\WorkType', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"order\",\"order_display_column\":\"name\",\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-10-12 07:38:45', '2020-10-12 07:38:45'),
(5, 'positions', 'positions', 'Position', 'Positions', NULL, 'App\\Position', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-10-12 07:43:53', '2020-10-12 07:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `edition_types`
--

CREATE TABLE `edition_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edition_types`
--

INSERT INTO `edition_types` (`id`, `name`) VALUES
(20, 'Альбом'),
(16, 'Атлас'),
(22, 'Журнал'),
(17, 'Каталог'),
(15, 'Книга'),
(7, 'Лабораторная работа'),
(24, 'Методические рекомендации/указания/разработки'),
(6, 'Методическое пособие'),
(5, 'Монография'),
(14, 'Научно-популярные издания'),
(18, 'Практикум'),
(12, 'Сборник задач'),
(11, 'Сборник статей'),
(13, 'Сборник тестов'),
(10, 'Серийное издание'),
(8, 'Словарь'),
(19, 'Справочник'),
(23, 'Стереотипное издание'),
(1, 'Учебник'),
(4, 'Учебно-методическое пособие'),
(3, 'Учебно-практическое пособие'),
(2, 'Учебное пособие'),
(9, 'Хрестоматия'),
(21, 'Энциклопедия');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(2, 'project-manager-menu', '2020-10-27 10:04:09', '2020-10-27 10:04:09'),
(3, 'initator-menu', '2020-10-30 01:43:41', '2020-10-30 01:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2020-10-10 08:46:31', '2020-10-10 08:46:31', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 4, '2020-10-10 08:46:31', '2020-10-12 09:45:52', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 3, '2020-10-10 08:46:31', '2020-10-10 08:46:31', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 2, '2020-10-10 08:46:31', '2020-10-10 08:46:31', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 5, '2020-10-10 08:46:31', '2020-10-12 09:45:52', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2020-10-10 08:46:31', '2020-10-12 09:45:52', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2020-10-10 08:46:31', '2020-10-12 09:46:00', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2020-10-10 08:46:31', '2020-10-12 09:46:00', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2020-10-10 08:46:31', '2020-10-12 09:46:00', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 6, '2020-10-10 08:46:31', '2020-10-12 09:45:52', 'voyager.settings.index', NULL),
(11, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 5, '2020-10-10 08:46:32', '2020-10-12 09:46:00', 'voyager.hooks', NULL),
(12, 1, 'Work Types', '', '_self', NULL, NULL, NULL, 7, '2020-10-12 07:38:45', '2020-10-12 09:45:52', 'voyager.work-types.index', NULL),
(13, 1, 'Positions', '', '_self', NULL, NULL, NULL, 8, '2020-10-12 07:43:53', '2020-10-12 09:45:52', 'voyager.positions.index', NULL),
(14, 2, 'Тех карты', '/tech-cards', '_self', NULL, '#000000', NULL, 2, '2020-10-27 10:04:34', '2020-10-30 01:41:47', NULL, ''),
(15, 2, 'Мои проекты', '/project', '_self', NULL, '#000000', NULL, 1, '2020-10-28 13:15:00', '2020-10-30 01:41:58', NULL, ''),
(16, 2, 'Мой кошелек', '#', '_self', NULL, '#000000', NULL, 9, '2020-10-30 01:42:17', '2020-10-30 01:43:07', NULL, ''),
(17, 2, 'Мой рейтинг', '#', '_self', NULL, '#000000', NULL, 10, '2020-10-30 01:42:33', '2020-10-30 01:42:33', NULL, ''),
(18, 2, 'Моя занятость', '#', '_self', NULL, '#000000', NULL, 11, '2020-10-30 01:42:46', '2020-10-30 01:42:46', NULL, ''),
(19, 2, 'Портфолио', '#', '_self', NULL, '#000000', NULL, 12, '2020-10-30 01:43:01', '2020-10-30 01:43:01', NULL, ''),
(20, 3, 'Тех карты', '/tech-cards', '_self', NULL, '#000000', NULL, 13, '2020-10-30 01:44:21', '2020-10-30 01:44:21', NULL, ''),
(21, 3, 'ISBN', '#', '_self', NULL, '#000000', NULL, 14, '2020-10-30 01:44:33', '2020-10-30 01:44:33', NULL, ''),
(22, 3, 'Заявки авторов', '#', '_self', NULL, '#000000', NULL, 15, '2020-10-30 01:44:46', '2020-10-30 01:44:46', NULL, ''),
(23, 3, 'Уведомления', '#', '_self', NULL, '#000000', NULL, 16, '2020-10-30 01:45:49', '2020-10-30 01:45:49', NULL, '');

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
(2, '2016_01_01_000000_add_voyager_user_fields', 1),
(3, '2016_01_01_000000_create_data_types_table', 1),
(4, '2016_05_19_173453_create_menu_table', 1),
(5, '2016_10_21_190000_create_roles_table', 1),
(6, '2016_10_21_190000_create_settings_table', 1),
(7, '2016_11_30_135954_create_permission_table', 1),
(8, '2016_11_30_141208_create_permission_role_table', 1),
(9, '2016_12_26_201236_data_types__add__server_side', 1),
(10, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(11, '2017_01_14_005015_create_translations_table', 1),
(12, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(13, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(14, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(15, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(16, '2017_08_05_000000_add_group_to_settings_table', 1),
(17, '2017_11_26_013050_add_user_role_relationship', 1),
(18, '2017_11_26_015000_create_user_roles_table', 1),
(19, '2018_03_11_000000_add_user_settings', 1),
(20, '2018_03_14_000000_add_details_to_data_types_table', 1),
(21, '2018_03_16_000000_make_settings_value_nullable', 1),
(22, '2019_08_19_000000_create_failed_jobs_table', 1),
(23, '2020_10_09_040239_create_works_table', 1),
(24, '2020_10_09_040706_create_work_types_table', 1),
(25, '2020_10_10_150250_create_positions_table', 2),
(27, '2020_10_12_131929_create_work_type__positions_table', 3),
(28, '2020_10_12_135230_create_user__positions_table', 4),
(29, '2014_10_12_100000_create_password_resets_table', 5),
(30, '2020_10_16_062321_create_edition_types_table', 5),
(31, '2020_10_26_173530_create_tech_cards_table', 5),
(32, '2020_10_27_115214_create_tech_card__languages_table', 5),
(33, '2020_10_27_130856_create_applications_table', 5),
(34, '2020_10_27_131008_create_application_remarks_table', 5),
(35, '2020_10_27_135713_create_tech_card__authors_table', 5),
(36, '2020_10_27_141127_create_tech_card__work_types_table', 5),
(37, '2020_10_27_183758_create_stages_table', 6),
(38, '2020_10_19_081813_create_projects_table', 7);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(2, 'browse_bread', NULL, '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(3, 'browse_database', NULL, '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(4, 'browse_media', NULL, '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(5, 'browse_compass', NULL, '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(6, 'browse_menus', 'menus', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(7, 'read_menus', 'menus', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(8, 'edit_menus', 'menus', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(9, 'add_menus', 'menus', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(10, 'delete_menus', 'menus', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(11, 'browse_roles', 'roles', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(12, 'read_roles', 'roles', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(13, 'edit_roles', 'roles', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(14, 'add_roles', 'roles', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(15, 'delete_roles', 'roles', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(16, 'browse_users', 'users', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(17, 'read_users', 'users', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(18, 'edit_users', 'users', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(19, 'add_users', 'users', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(20, 'delete_users', 'users', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(21, 'browse_settings', 'settings', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(22, 'read_settings', 'settings', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(23, 'edit_settings', 'settings', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(24, 'add_settings', 'settings', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(25, 'delete_settings', 'settings', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(26, 'browse_hooks', NULL, '2020-10-10 08:46:32', '2020-10-10 08:46:32'),
(27, 'browse_work_types', 'work_types', '2020-10-12 07:38:45', '2020-10-12 07:38:45'),
(28, 'read_work_types', 'work_types', '2020-10-12 07:38:45', '2020-10-12 07:38:45'),
(29, 'edit_work_types', 'work_types', '2020-10-12 07:38:45', '2020-10-12 07:38:45'),
(30, 'add_work_types', 'work_types', '2020-10-12 07:38:45', '2020-10-12 07:38:45'),
(31, 'delete_work_types', 'work_types', '2020-10-12 07:38:45', '2020-10-12 07:38:45'),
(32, 'browse_positions', 'positions', '2020-10-12 07:43:53', '2020-10-12 07:43:53'),
(33, 'read_positions', 'positions', '2020-10-12 07:43:53', '2020-10-12 07:43:53'),
(34, 'edit_positions', 'positions', '2020-10-12 07:43:53', '2020-10-12 07:43:53'),
(35, 'add_positions', 'positions', '2020-10-12 07:43:53', '2020-10-12 07:43:53'),
(36, 'delete_positions', 'positions', '2020-10-12 07:43:53', '2020-10-12 07:43:53');

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
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `display_name`) VALUES
(1, 'designer', 'Дизайнер'),
(2, 'template_designer', 'Верстальщик'),
(3, 'editor', 'Редактор');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(2, 'user', 'Normal User', '2020-10-10 08:46:31', '2020-10-10 08:46:31'),
(3, 'initiator', 'Инициатор', '2020-10-10 09:00:43', '2020-10-10 09:00:43'),
(4, 'project_manager', 'Проект менеджер', '2020-10-10 09:00:43', '2020-10-10 09:00:43'),
(5, 'executor', 'Исполнитель', '2020-10-10 09:00:43', '2020-10-10 09:00:43'),
(6, 'sales_department', 'Отдел продаж', '2020-10-10 09:00:43', '2020-10-10 09:00:43'),
(7, 'marketing', 'Маркетинг', '2020-10-10 09:00:43', '2020-10-10 09:00:43'),
(8, 'supervisor', 'Руководства', '2020-10-10 09:00:43', '2020-10-10 09:00:43'),
(9, 'author', 'Автор', '2020-10-27 11:12:41', '2020-10-27 11:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', '', '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Voyager', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', '', '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tech_cards`
--

CREATE TABLE `tech_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ib_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` bigint(20) NOT NULL,
  `edition_id` bigint(20) NOT NULL,
  `payment` enum('Университет','Автор','Грант','Университет-Автор') COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `templan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `riso_protocol_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `riso_protocol_date` date NOT NULL,
  `ac_protocol_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_protocol_date` date NOT NULL,
  `rums_protocol_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rums_protocol_date` date NOT NULL,
  `manuscript` enum('Электронный вариант','Бумажный вариант','Электронный и бумажный','нет') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_pages` int(11) NOT NULL,
  `total_symbols` int(11) NOT NULL,
  `author_sheet_volume` int(11) NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `editing_complexity` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout_complexity` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ioot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conclusion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `circulation_author` int(11) NOT NULL,
  `circulation_university` int(11) NOT NULL,
  `circulation_library` int(11) NOT NULL,
  `project_manager_id` bigint(20) NOT NULL,
  `created_date` date NOT NULL,
  `appointment_date` date NOT NULL,
  `status` enum('Создано','Оформлена') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tech_cards`
--

INSERT INTO `tech_cards` (`id`, `order_number`, `ib_number`, `isbn`, `book_name`, `application_id`, `edition_id`, `payment`, `department`, `templan`, `riso_protocol_number`, `riso_protocol_date`, `ac_protocol_number`, `ac_protocol_date`, `rums_protocol_number`, `rums_protocol_date`, `manuscript`, `total_pages`, `total_symbols`, `author_sheet_volume`, `format`, `kegel`, `editing_complexity`, `layout_complexity`, `ioot`, `conclusion`, `circulation_author`, `circulation_university`, `circulation_library`, `project_manager_id`, `created_date`, `appointment_date`, `status`) VALUES
(14, 'gjhbkkj,jhblawwjkad', 'hbkn,m', 'bkjn', 'jnjh', 1, 20, 'Университет', 'awd', 'n,m', 'nm.', '2020-10-30', 'knjm', '2020-10-30', 'knkm', '2020-10-30', 'Электронный вариант', 54, 4, 4, 'hbjnm', '741', '1', '1', 'gjhbjn', 'bhkjnkm.', 41, 75421, 541, 3, '2020-10-30', '2020-10-30', 'Создано'),
(15, 'qwe', 'dfg', 'kjn', 'hkjn', 1, 20, 'Университет', 'awd', 'hgvjhb', 'jhbkj', '2020-10-30', 'fhgvjhb', '2020-10-30', 'jhbkj', '2020-10-30', 'Электронный вариант', 754, 754, 54, 'vgjhbj', '741', '1', '1', 'jhkjn', 'hkjn', 75421, 75421, 754, 3, '2020-10-30', '2020-10-30', 'Создано'),
(17, 'qwertyu', 'yuio;poih', 'yukjhnmnmn', 'jhjjhjhbjnhb', 1, 20, 'Университет', 'awd', 'hgvjhb', 'jhbkj', '2020-10-30', 'fhgvjhb', '2020-10-30', 'jhbkj', '2020-10-30', 'Электронный вариант', 754, 754, 54, 'vgjhbj', '741', '1', '1', 'jhkjn', 'hkjn', 75421, 75421, 754, 3, '2020-10-30', '2020-10-30', 'Создано'),
(28, '[poi', 'poi', 'poip', 'poi', 1, 20, 'Университет', 'awd', 'ffhgvbn', 'hvbn', '2020-10-30', 'fhgvjhb', '2020-10-30', 'hgjhbkjn', '2020-10-30', 'Электронный вариант', 7542, 754, 745, 'vbnm', '4521', '1', '1', 'hgbhn', 'hgvjhb', 754, 754, 217541, 3, '2020-10-30', '2020-10-30', 'Создано');

-- --------------------------------------------------------

--
-- Table structure for table `tech_card__authors`
--

CREATE TABLE `tech_card__authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tech_card_id` bigint(20) NOT NULL,
  `author_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tech_card__authors`
--

INSERT INTO `tech_card__authors` (`id`, `tech_card_id`, `author_id`) VALUES
(3, 17, 4),
(14, 28, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tech_card__languages`
--

CREATE TABLE `tech_card__languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tech_card_id` bigint(20) NOT NULL,
  `language` enum('Казахский','Русский','Английский','Другой') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tech_card__languages`
--

INSERT INTO `tech_card__languages` (`id`, `tech_card_id`, `language`) VALUES
(5, 28, 'Казахский'),
(6, 28, 'Русский');

-- --------------------------------------------------------

--
-- Table structure for table `tech_card__work_types`
--

CREATE TABLE `tech_card__work_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tech_card_id` bigint(20) NOT NULL,
  `work_type_id` bigint(20) NOT NULL,
  `start_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `unit_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tech_card__work_types`
--

INSERT INTO `tech_card__work_types` (`id`, `tech_card_id`, `work_type_id`, `start_date`, `deadline`, `hours`, `unit_count`) VALUES
(3, 14, 5, NULL, NULL, NULL, 7854),
(4, 14, 10, NULL, NULL, NULL, 41),
(5, 15, 6, NULL, NULL, NULL, 754),
(6, 15, 16, NULL, NULL, NULL, 845),
(7, 17, 6, NULL, NULL, NULL, 754),
(8, 17, 15, NULL, NULL, NULL, 8451),
(19, 28, 1, NULL, NULL, NULL, 5421);

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', NULL, 'users/default.png', NULL, '$2y$10$WHQbc/oTMEOwK/Uu583vW.Jye6qg0rLp3/B2HFH6bJKIE82k2jX.K', 'TaJFkg2lk1ZopbgP25j3x4p8zk2pkPpjTXLYydI8ohF5qu8U5CgF0Axtyd3E', '{\"locale\":\"en\"}', '2020-10-10 08:46:45', '2020-10-10 09:02:16'),
(2, 3, 'Инициатор', 'initiator@gmail.com', NULL, 'users/default.png', NULL, '$2y$10$qJ4LV0XZ70xVNkgXfvgOlOq0xYHE3Gc8EUQ63dS/sqQy8taQd7NV6', NULL, '{\"locale\":\"en\"}', '2020-10-12 08:07:22', '2020-10-30 01:48:18'),
(3, 4, 'Проект Менеджер', 'project.manager@gmail.com', NULL, 'users/default.png', NULL, '$2y$10$0Mx7UVPS.GkPcChQMHK.D..G/x/tCMWtCkCZT67QwwfqJsgHi7PQW', NULL, '{\"locale\":\"ru\"}', '2020-10-27 10:05:50', '2020-10-27 10:05:50'),
(4, 9, 'Автор 1', 'author1@gmail.com', NULL, 'users/default.png', NULL, '$2y$10$NESgL2XCE2Q/EEf19ZnUL.OB64klCPQW9Hl9yCTtuvPINY9LCH5h2', NULL, '{\"locale\":\"en\"}', '2020-10-27 11:13:12', '2020-10-27 11:13:12'),
(5, 9, 'Автор 2', 'author2@gmail.com', NULL, 'users/default.png', NULL, '$2y$10$3Y9ElPlCIaeMFLRvuF9o3uoIsvwOermF/MKiwwaudqc6bqxQVyKaS', NULL, '{\"locale\":\"en\"}', '2020-10-27 11:13:43', '2020-10-27 11:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user__positions`
--

CREATE TABLE `user__positions` (
  `user_id` bigint(20) NOT NULL,
  `position_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_types`
--

CREATE TABLE `work_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` int(11) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_types`
--

INSERT INTO `work_types` (`id`, `name`, `unit_type`, `unit_price`, `order`) VALUES
(1, 'Редактура', '3000 слов', 300, 16),
(2, 'Дизайн обложки книги / баннера / ролл-ап', 'Количество единиц', 6250, 1),
(3, 'Стандартный дизайн', 'Количество единиц', 2000, 2),
(4, 'Шаблонный дизайн', 'Количество единиц', 500, 3),
(5, 'Простая верстка(текст)', 'Количество страниц А4', 94, 4),
(6, 'Cредняя верстка(текст + таблица+рисунок)', 'Количество страниц А4', 125, 5),
(7, 'Cложная верстка(текст + формулы + таблицы + рисунок)', 'Количество страниц А4', 245, 6),
(8, 'Правка простая', 'Количество страниц А4', 40, 7),
(9, 'Правка средняя(с перенабором)', 'Количество страниц А4', 56, 8),
(10, 'Правка сложная(с перенабором и донабором)', 'Количество страниц А4', 80, 9),
(11, 'Набор текста/формул', '3000 слов', 100, 10),
(12, 'Подготовка к печати', 'Количество страниц А4', 25, 11),
(13, 'Обработка рисунков/фотографий', 'Количество единиц', 80, 12),
(14, 'Отрисовка рисунков/фотографий', 'Количество единиц', 120, 13),
(15, 'Сканирование вручную', 'Количество страниц', 50, 14),
(16, 'Автосканирование ', 'Количество страниц', 25, 15),
(17, 'Корректура', 'Количество слов(в 3000 слов)', 100, 17),
(18, 'Сверка', 'Количество слов(в 3000 слов)', 50, 18),
(19, 'Редактура переведенного текста с русского на казахский язык', 'Количество слов(в 3000 слов)', 660, 19),
(20, 'Редактура переведенного текста с казахского на русский язык', 'Количество слов(в 3000 слов)', 540, 20),
(21, 'Редактура текста на английском языке', 'Количество слов(в 3000 слов)', 1000, 21),
(22, 'Составление аннотации', NULL, 3000, 22),
(23, 'Подготовка выходных сведений', NULL, 2000, 23),
(24, 'Составление текста', 'Количество слов(в 3000 слов)', 3000, 24),
(25, 'Cредняя верстка(текст + таблица + рисунок)', 'Количество страниц А4', 125, 5);

-- --------------------------------------------------------

--
-- Table structure for table `work_type__positions`
--

CREATE TABLE `work_type__positions` (
  `work_type_id` bigint(20) NOT NULL,
  `position_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_type__positions`
--

INSERT INTO `work_type__positions` (`work_type_id`, `position_id`) VALUES
(17, 3),
(1, 3),
(2, 1),
(2, 3),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(17, 3),
(1, 3),
(2, 1),
(2, 3),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(3, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(5, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_remarks`
--
ALTER TABLE `application_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `edition_types`
--
ALTER TABLE `edition_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `edition_types_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_name_unique` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `tech_cards`
--
ALTER TABLE `tech_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tech_cards_order_number_unique` (`order_number`),
  ADD UNIQUE KEY `tech_cards_isbn_unique` (`isbn`);

--
-- Indexes for table `tech_card__authors`
--
ALTER TABLE `tech_card__authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_card__languages`
--
ALTER TABLE `tech_card__languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_card__work_types`
--
ALTER TABLE `tech_card__work_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_types`
--
ALTER TABLE `work_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `work_types_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `application_remarks`
--
ALTER TABLE `application_remarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `edition_types`
--
ALTER TABLE `edition_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tech_cards`
--
ALTER TABLE `tech_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tech_card__authors`
--
ALTER TABLE `tech_card__authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tech_card__languages`
--
ALTER TABLE `tech_card__languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tech_card__work_types`
--
ALTER TABLE `tech_card__work_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_types`
--
ALTER TABLE `work_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
