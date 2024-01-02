-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2023 at 10:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `step_blank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_setting`
--

CREATE TABLE `admin_setting` (
  `id` int(11) NOT NULL,
  `color` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `white_logo` text DEFAULT NULL,
  `favicon` text DEFAULT NULL,
  `bg_img` text DEFAULT NULL,
  `name` text NOT NULL,
  `pp` text NOT NULL,
  `timezone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country_code` varchar(11) NOT NULL DEFAULT '+91',
  `currency_id` int(11) NOT NULL,
  `currency` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_symbol` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_key` text DEFAULT NULL,
  `verification` int(11) NOT NULL DEFAULT 1,
  `notification` int(11) NOT NULL DEFAULT 1,
  `license_code` text DEFAULT NULL,
  `client_name` text DEFAULT NULL,
  `license_status` text DEFAULT NULL,
  `mail_driver` varchar(20) DEFAULT NULL,
  `mail_host` varchar(20) DEFAULT NULL,
  `mail_port` varchar(20) DEFAULT NULL,
  `mail_username` varchar(50) DEFAULT NULL,
  `mail_password` varchar(50) DEFAULT NULL,
  `mail_encryption` varchar(20) DEFAULT NULL,
  `mail_from_address` varchar(20) DEFAULT NULL,
  `mail_from_name` varchar(20) DEFAULT NULL,
  `twilio_id` varchar(40) DEFAULT NULL,
  `twilio_auth_token` varchar(255) DEFAULT NULL,
  `twilio_number` varchar(50) DEFAULT NULL,
  `app_id` varchar(255) DEFAULT NULL,
  `rest_api_key` varchar(255) DEFAULT NULL,
  `user_auth_key` varchar(255) DEFAULT NULL,
  `project_number` varchar(255) DEFAULT NULL,
  `owner_app_id` varchar(255) DEFAULT NULL,
  `owner_rest_api_key` varchar(255) DEFAULT NULL,
  `owner_auth_key` varchar(255) DEFAULT NULL,
  `guard_app_id` varchar(255) DEFAULT NULL,
  `guard_rest_api_key` varchar(255) DEFAULT NULL,
  `guard_auth_key` varchar(255) DEFAULT NULL,
  `stripe_public` varchar(255) DEFAULT NULL,
  `stripe_status` tinyint(1) NOT NULL,
  `stripe_secret` varchar(255) DEFAULT NULL,
  `razorpay_status` tinyint(1) DEFAULT 0,
  `razorpay_key` text DEFAULT NULL,
  `paypal_status` tinyint(1) NOT NULL DEFAULT 0,
  `paypal_sandbox` text DEFAULT NULL,
  `paypal_production` text DEFAULT NULL,
  `paypal_client_id` text DEFAULT NULL,
  `paypal_secret_key` text DEFAULT NULL,
  `flutterwave_status` tinyint(1) NOT NULL DEFAULT 0,
  `flutterwave_key` text DEFAULT NULL,
  `isLiveMode` tinyint(1) NOT NULL DEFAULT 0,
  `trial_days` int(20) DEFAULT 30,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`id`, `color`, `logo`, `white_logo`, `favicon`, `bg_img`, `name`, `pp`, `timezone`, `country_code`, `currency_id`, `currency`, `currency_symbol`, `map_key`, `verification`, `notification`, `license_code`, `client_name`, `license_status`, `mail_driver`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from_address`, `mail_from_name`, `twilio_id`, `twilio_auth_token`, `twilio_number`, `app_id`, `rest_api_key`, `user_auth_key`, `project_number`, `owner_app_id`, `owner_rest_api_key`, `owner_auth_key`, `guard_app_id`, `guard_rest_api_key`, `guard_auth_key`, `stripe_public`, `stripe_status`, `stripe_secret`, `razorpay_status`, `razorpay_key`, `paypal_status`, `paypal_sandbox`, `paypal_production`, `paypal_client_id`, `paypal_secret_key`, `flutterwave_status`, `flutterwave_key`, `isLiveMode`, `trial_days`, `created_at`, `updated_at`) VALUES
(1, '#003165', 'logo.png', 'whitelogo.jpg', 'favicon.png', 'background-image.jpg', 'step', '<blockquote class=\"blockquote\"><h2 style=\"margin: 24px 0px; line-height: 48px; font-size: 45px; padding: 0px; font-family: Roboto, Helvetica, Arial, sans-serif; color: rgb(97, 97, 97);\">Privacy Policy</h2><p style=\"margin-right: 0px; margin-bottom: 16px; margin-left: 0px; line-height: 24px; font-family: Nunito, &quot;Segoe UI&quot;, arial; font-size: 14px; padding: 0px;\"><font color=\"#616161\" face=\"Roboto, Helvetica, sans-serif\">Privacy Policy[Developer/Company name] built the [App Name] app as [open source/free/freemium/ad-supported/commercial] app. This SERVICE is provided by [Developer/Company name] [at no cost] and is intended for use. This page is used to inform visitors regarding [my/our] policies regarding the collection, use, and disclosure of Personal Information if anyone decides to use [my/our] Service. If you choose to use [my/our] Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that [I/We] collect is used for providing and improving the Service. [I/We] will not use or share your information with anyone except as described in this Privacy Policy. The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which are accessible at [App Name] unless otherwise defined in this Privacy Policy. Information Collection and UseFor a better experience, while using our Service, [I/We] may require you to provide us with certain personally identifiable information[add whatever else you collect here, e.g. users name, address, location, pictures] The information that [I/We] request will be [retained on your device and is not collected by [me/us] in any way]/[retained by us and used as described in this privacy policy]. The app does use third-party services that may collect information used to identify you. Link to the privacy policy of third-party service providers used by the app</font></p><p style=\"margin-right: 0px; margin-bottom: 16px; margin-left: 0px; line-height: 24px; font-family: Nunito, &quot;Segoe UI&quot;, arial; font-size: 14px; padding: 0px;\"><font color=\"#616161\" face=\"Roboto, Helvetica, sans-serif\">• Google Play ServicesLog Data[I/We] want to inform you that whenever you use [my/our] Service, in a case of an error in the app [I/We] collect data and information (through third-party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (“IP”) address, device name, operating system version, the configuration of the app when utilizing [my/our] Service, the time and date of your use of the Service, and other statistics.</font></p></blockquote>', 'Asia/Kolkata', '+91', 2, '', '', '', 0, 1, NULL, NULL, '0', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, '', '', '', '', 0, '', 1, 30, '2022-10-14 10:44:44', '2022-11-02 11:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `OTP` varchar(6) DEFAULT NULL,
  `password` varchar(254) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT 'default.jpg',
  `device_token` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '؋'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'Afl'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '₼'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', 'Лв.'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£\r\n'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '៛'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '₡'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '₱'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', 'GH₵'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', '₹'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '﷼'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '₪'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '₸'),
(64, 'Korea (North)', 'Won', 'KPW', '₩'),
(65, 'Korea (South)', 'Won', 'KRW', '₩'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'Лв'),
(67, 'Laos', 'Kips', 'LAK', '	₭'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', 'Ден\r\n'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '₹'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '₹'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '₦'),
(88, 'North Korea', 'Won', 'KPW', '₩'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '﷼'),
(91, 'Pakistan', 'Rupees', 'PKR', '₹'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'zł'),
(97, 'Qatar', 'Rials', 'QAR', '﷼'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', '₽'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼'),
(102, 'Serbia', 'Dinars', 'RSD', 'ع.د'),
(103, 'Seychelles', 'Rupees', 'SCR', '₹'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '₩'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₹'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '฿'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '₺'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '₫\r\n'),
(130, 'Yemen', 'Rials', 'YER', '﷼'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `direction` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `json_file` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `direction`, `image`, `json_file`, `status`, `created_at`) VALUES
(2, 'arabic', 'rtl', 'arabic.png', 'arabic.json', 1, '2022-04-06 04:50:24'),
(6, 'german', 'ltr', 'german.png', 'german.json', 1, '2022-04-05 05:34:37'),
(7, 'english', 'ltr', 'english.png', 'english.json', 1, '2022-04-06 04:50:38'),
(8, 'gujarati', 'ltr', 'gujarati.png', 'gujarati.json', 1, '2022-04-06 12:58:24'),
(9, 'hindi', 'ltr', 'hindi.png', 'hindi.json', 1, '2022-04-06 13:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(7, '2016_06_01_000004_create_oauth_clients_table', 2),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'zkSaR2657atCqET8UAuwGCzf3823Kd4ZiRLtqTjq', 'http://localhost', 1, 0, 0, '2019-11-07 01:01:57', '2019-11-07 01:01:57'),
(2, NULL, 'Laravel Password Grant Client', 'g0wO8v5pKZJjaPPSQuOIQn3b0o0ro7NYznZWL3Cc', 'http://localhost', 0, 1, 0, '2019-11-07 01:01:57', '2019-11-07 01:01:57');

-- --------------------------------------------------------

CREATE TABLE `notification_template` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `msg_content` text NOT NULL,
  `mail_content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `notification_template` (`id`, `subject`, `title`, `msg_content`, `mail_content`, `created_at`, `updated_at`) VALUES
(1, 'create appointment', 'create appointment', 'dear  {User_Name} has booked a parking slot from {StartTime} to {EndTime} via {Payment_Method} from {{App_Name}}', 'dear&nbsp; {User_Name} has booked a parking slot from {StartTime} to {EndTime} via {Payment_Method}&nbsp;from {{App_Name}}', NULL, NULL),
(2, 'cancel appointment', 'cancel appointment', 'Your parking slot at {spaceName} has canceled by you', 'Your parking slot at {spaceName} has canceled by you', NULL, NULL);

ALTER TABLE `notification_template`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `notification_template`
MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-11-07 01:01:57', '2019-11-07 01:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_booking`
--

CREATE TABLE `parking_booking` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `payment_type` varchar(10) NOT NULL DEFAULT 'ONLINE',
  `payment_token` varchar(255) DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = remaining , 1 complate 2 = cancel',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 waiting , 1 = approved , 2 = complate ,3 cancel',
  `arriving_time` datetime NOT NULL,
  `leaving_time` datetime NOT NULL,
  `total_amount` float NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_guard`
--

CREATE TABLE `parking_guard` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `space_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT 'default.jpg',
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `device_token` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_image`
--

CREATE TABLE `parking_image` (
  `id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_owner`
--

CREATE TABLE `parking_owner` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.jpg',
  `password` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `device_token` text DEFAULT NULL,
  `subscription_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_owner_setting`
--

CREATE TABLE `parking_owner_setting` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `stripe_status` tinyint(1) NOT NULL DEFAULT 0,
  `cod` tinyint(1) NOT NULL DEFAULT 0,
  `stripe_secret` text DEFAULT NULL,
  `stripe_public` text DEFAULT NULL,
  `razorpay_status` tinyint(1) NOT NULL DEFAULT 0,
  `razorpay_key` text DEFAULT NULL,
  `paypal_status` tinyint(1) NOT NULL DEFAULT 0,
  `paypal_client_key` text DEFAULT NULL,
  `paypal_secret_key` text DEFAULT NULL,
  `flutterwave_status` tinyint(1) NOT NULL DEFAULT 0,
  `flutterwave_key` text DEFAULT NULL,
  `isLiveMode` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_space`
--

CREATE TABLE `parking_space` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `vehicle_types` text DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `facilities` text DEFAULT NULL,
  `address` varchar(254) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `price_par_hour` float NOT NULL DEFAULT 0,
  `phone_number` varchar(20) DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `available_all_day` int(11) NOT NULL,
  `offline_payment` int(11) NOT NULL DEFAULT 0,
  `verified` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `star` float NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `space_slot`
--

CREATE TABLE `space_slot` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `space_zone`
--

CREATE TABLE `space_zone` (
  `id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_name` varchar(255) NOT NULL,
  `plan` text DEFAULT NULL,
  `max_space_limit` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `subscription_name`, `plan`, `max_space_limit`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free', '[{\"month\":null,\"price\":null}]',2,1, '2022-10-12 04:08:44', '2022-10-12 04:08:44'),
(2, 'Basic', '[{\"month\":\"1\",\"price\":\"150\"},{\"month\":\"6\",\"price\":\"800\"}]',3,1, '2022-10-12 04:11:09', '2022-10-12 04:11:09'),
(3, 'Advanced', '[{\"month\":\"50\",\"price\":\"50\"}]',5,1, '2022-10-12 06:35:33', '2022-10-14 11:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_buy`
--

CREATE TABLE `subscription_buy` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `price` float DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `payment_token` text DEFAULT NULL,
  `payment_type` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `CountryCode` char(2) NOT NULL,
  `Coordinates` char(15) NOT NULL,
  `TimeZone` char(32) NOT NULL,
  `Comments` varchar(85) NOT NULL,
  `UTC_offset` char(8) NOT NULL,
  `UTC_DST_offset` char(8) NOT NULL,
  `Notes` varchar(79) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`CountryCode`, `Coordinates`, `TimeZone`, `Comments`, `UTC_offset`, `UTC_DST_offset`, `Notes`) VALUES
('CI', '+0519-00402', 'Africa/Abidjan', '', '+00:00', '+00:00', ''),
('GH', '+0533-00013', 'Africa/Accra', '', '+00:00', '+00:00', ''),
('ET', '+0902+03842', 'Africa/Addis_Ababa', '', '+03:00', '+03:00', ''),
('DZ', '+3647+00303', 'Africa/Algiers', '', '+01:00', '+01:00', ''),
('ER', '+1520+03853', 'Africa/Asmara', '', '+03:00', '+03:00', ''),
('', '', 'Africa/Asmera', '', '+03:00', '+03:00', 'Link to Africa/Asmara'),
('ML', '+1239-00800', 'Africa/Bamako', '', '+00:00', '+00:00', ''),
('CF', '+0422+01835', 'Africa/Bangui', '', '+01:00', '+01:00', ''),
('GM', '+1328-01639', 'Africa/Banjul', '', '+00:00', '+00:00', ''),
('GW', '+1151-01535', 'Africa/Bissau', '', '+00:00', '+00:00', ''),
('MW', '-1547+03500', 'Africa/Blantyre', '', '+02:00', '+02:00', ''),
('CG', '-0416+01517', 'Africa/Brazzaville', '', '+01:00', '+01:00', ''),
('BI', '-0323+02922', 'Africa/Bujumbura', '', '+02:00', '+02:00', ''),
('EG', '+3003+03115', 'Africa/Cairo', '', '+02:00', '+02:00', 'DST has been canceled since 2011'),
('MA', '+3339-00735', 'Africa/Casablanca', '', '+00:00', '+01:00', ''),
('ES', '+3553-00519', 'Africa/Ceuta', 'Ceuta & Melilla', '+01:00', '+02:00', ''),
('GN', '+0931-01343', 'Africa/Conakry', '', '+00:00', '+00:00', ''),
('SN', '+1440-01726', 'Africa/Dakar', '', '+00:00', '+00:00', ''),
('TZ', '-0648+03917', 'Africa/Dar_es_Salaam', '', '+03:00', '+03:00', ''),
('DJ', '+1136+04309', 'Africa/Djibouti', '', '+03:00', '+03:00', ''),
('CM', '+0403+00942', 'Africa/Douala', '', '+01:00', '+01:00', ''),
('EH', '+2709-01312', 'Africa/El_Aaiun', '', '+00:00', '+00:00', ''),
('SL', '+0830-01315', 'Africa/Freetown', '', '+00:00', '+00:00', ''),
('BW', '-2439+02555', 'Africa/Gaborone', '', '+02:00', '+02:00', ''),
('ZW', '-1750+03103', 'Africa/Harare', '', '+02:00', '+02:00', ''),
('ZA', '-2615+02800', 'Africa/Johannesburg', '', '+02:00', '+02:00', ''),
('SS', '+0451+03136', 'Africa/Juba', '', '+03:00', '+03:00', ''),
('UG', '+0019+03225', 'Africa/Kampala', '', '+03:00', '+03:00', ''),
('SD', '+1536+03232', 'Africa/Khartoum', '', '+03:00', '+03:00', ''),
('RW', '-0157+03004', 'Africa/Kigali', '', '+02:00', '+02:00', ''),
('CD', '-0418+01518', 'Africa/Kinshasa', 'west Dem. Rep. of Congo', '+01:00', '+01:00', ''),
('NG', '+0627+00324', 'Africa/Lagos', '', '+01:00', '+01:00', ''),
('GA', '+0023+00927', 'Africa/Libreville', '', '+01:00', '+01:00', ''),
('TG', '+0608+00113', 'Africa/Lome', '', '+00:00', '+00:00', ''),
('AO', '-0848+01314', 'Africa/Luanda', '', '+01:00', '+01:00', ''),
('CD', '-1140+02728', 'Africa/Lubumbashi', 'east Dem. Rep. of Congo', '+02:00', '+02:00', ''),
('ZM', '-1525+02817', 'Africa/Lusaka', '', '+02:00', '+02:00', ''),
('GQ', '+0345+00847', 'Africa/Malabo', '', '+01:00', '+01:00', ''),
('MZ', '-2558+03235', 'Africa/Maputo', '', '+02:00', '+02:00', ''),
('LS', '-2928+02730', 'Africa/Maseru', '', '+02:00', '+02:00', ''),
('SZ', '-2618+03106', 'Africa/Mbabane', '', '+02:00', '+02:00', ''),
('SO', '+0204+04522', 'Africa/Mogadishu', '', '+03:00', '+03:00', ''),
('LR', '+0618-01047', 'Africa/Monrovia', '', '+00:00', '+00:00', ''),
('KE', '-0117+03649', 'Africa/Nairobi', '', '+03:00', '+03:00', ''),
('TD', '+1207+01503', 'Africa/Ndjamena', '', '+01:00', '+01:00', ''),
('NE', '+1331+00207', 'Africa/Niamey', '', '+01:00', '+01:00', ''),
('MR', '+1806-01557', 'Africa/Nouakchott', '', '+00:00', '+00:00', ''),
('BF', '+1222-00131', 'Africa/Ouagadougou', '', '+00:00', '+00:00', ''),
('BJ', '+0629+00237', 'Africa/Porto-Novo', '', '+01:00', '+01:00', ''),
('ST', '+0020+00644', 'Africa/Sao_Tome', '', '+00:00', '+00:00', ''),
('', '', 'Africa/Timbuktu', '', '+00:00', '+00:00', 'Link to Africa/Bamako'),
('LY', '+3254+01311', 'Africa/Tripoli', '', '+01:00', '+02:00', ''),
('TN', '+3648+01011', 'Africa/Tunis', '', '+01:00', '+01:00', ''),
('NA', '-2234+01706', 'Africa/Windhoek', '', '+01:00', '+02:00', ''),
('', '', 'AKST9AKDT', '', 'âˆ’09:00', 'âˆ’08:00', 'Link to America/Anchorage'),
('US', '+515248-1763929', 'America/Adak', 'Aleutian Islands', 'âˆ’10:00', 'âˆ’09:00', ''),
('US', '+611305-1495401', 'America/Anchorage', 'Alaska Time', 'âˆ’09:00', 'âˆ’08:00', ''),
('AI', '+1812-06304', 'America/Anguilla', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('AG', '+1703-06148', 'America/Antigua', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('BR', '-0712-04812', 'America/Araguaina', 'Tocantins', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-3436-05827', 'America/Argentina/Buenos_Aires', 'Buenos Aires (BA, CF)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2828-06547', 'America/Argentina/Catamarca', 'Catamarca (CT), Chubut (CH)', 'âˆ’03:00', 'âˆ’03:00', ''),
('', '', 'America/Argentina/ComodRivadavia', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Catamarca'),
('AR', '-3124-06411', 'America/Argentina/Cordoba', 'most locations (CB, CC, CN, ER, FM, MN, SE, SF)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2411-06518', 'America/Argentina/Jujuy', 'Jujuy (JY)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2926-06651', 'America/Argentina/La_Rioja', 'La Rioja (LR)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-3253-06849', 'America/Argentina/Mendoza', 'Mendoza (MZ)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-5138-06913', 'America/Argentina/Rio_Gallegos', 'Santa Cruz (SC)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2447-06525', 'America/Argentina/Salta', '(SA, LP, NQ, RN)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-3132-06831', 'America/Argentina/San_Juan', 'San Juan (SJ)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-3319-06621', 'America/Argentina/San_Luis', 'San Luis (SL)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2649-06513', 'America/Argentina/Tucuman', 'Tucuman (TM)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-5448-06818', 'America/Argentina/Ushuaia', 'Tierra del Fuego (TF)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AW', '+1230-06958', 'America/Aruba', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('PY', '-2516-05740', 'America/Asuncion', '', 'âˆ’04:00', 'âˆ’03:00', ''),
('CA', '+484531-0913718', 'America/Atikokan', 'Eastern Standard Time - Atikokan, Ontario and Southampton I, Nunavut', 'âˆ’05:00', 'âˆ’05:00', ''),
('', '', 'America/Atka', '', 'âˆ’10:00', 'âˆ’09:00', 'Link to America/Adak'),
('BR', '-1259-03831', 'America/Bahia', 'Bahia', 'âˆ’03:00', 'âˆ’03:00', ''),
('MX', '+2048-10515', 'America/Bahia_Banderas', 'Mexican Central Time - Bahia de Banderas', 'âˆ’06:00', 'âˆ’05:00', ''),
('BB', '+1306-05937', 'America/Barbados', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('BR', '-0127-04829', 'America/Belem', 'Amapa, E Para', 'âˆ’03:00', 'âˆ’03:00', ''),
('BZ', '+1730-08812', 'America/Belize', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('CA', '+5125-05707', 'America/Blanc-Sablon', 'Atlantic Standard Time - Quebec - Lower North Shore', 'âˆ’04:00', 'âˆ’04:00', ''),
('BR', '+0249-06040', 'America/Boa_Vista', 'Roraima', 'âˆ’04:00', 'âˆ’04:00', ''),
('CO', '+0436-07405', 'America/Bogota', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('US', '+433649-1161209', 'America/Boise', 'Mountain Time - south Idaho & east Oregon', 'âˆ’07:00', 'âˆ’06:00', ''),
('', '', 'America/Buenos_Aires', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Buenos_Aires'),
('CA', '+690650-1050310', 'America/Cambridge_Bay', 'Mountain Time - west Nunavut', 'âˆ’07:00', 'âˆ’06:00', ''),
('BR', '-2027-05437', 'America/Campo_Grande', 'Mato Grosso do Sul', 'âˆ’04:00', 'âˆ’03:00', ''),
('MX', '+2105-08646', 'America/Cancun', 'Central Time - Quintana Roo', 'âˆ’06:00', 'âˆ’05:00', ''),
('VE', '+1030-06656', 'America/Caracas', '', 'âˆ’04:30', 'âˆ’04:30', ''),
('', '', 'America/Catamarca', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Catamarca'),
('GF', '+0456-05220', 'America/Cayenne', '', 'âˆ’03:00', 'âˆ’03:00', ''),
('KY', '+1918-08123', 'America/Cayman', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('US', '+415100-0873900', 'America/Chicago', 'Central Time', 'âˆ’06:00', 'âˆ’05:00', ''),
('MX', '+2838-10605', 'America/Chihuahua', 'Mexican Mountain Time - Chihuahua away from US border', 'âˆ’07:00', 'âˆ’06:00', ''),
('', '', 'America/Coral_Harbour', '', 'âˆ’05:00', 'âˆ’05:00', 'Link to America/Atikokan'),
('', '', 'America/Cordoba', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Cordoba'),
('CR', '+0956-08405', 'America/Costa_Rica', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('CA', '+4906-11631', 'America/Creston', 'Mountain Standard Time - Creston, British Columbia', 'âˆ’07:00', 'âˆ’07:00', ''),
('BR', '-1535-05605', 'America/Cuiaba', 'Mato Grosso', 'âˆ’04:00', 'âˆ’03:00', ''),
('CW', '+1211-06900', 'America/Curacao', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('GL', '+7646-01840', 'America/Danmarkshavn', 'east coast, north of Scoresbysund', '+00:00', '+00:00', ''),
('CA', '+6404-13925', 'America/Dawson', 'Pacific Time - north Yukon', 'âˆ’08:00', 'âˆ’07:00', ''),
('CA', '+5946-12014', 'America/Dawson_Creek', 'Mountain Standard Time - Dawson Creek & Fort Saint John, British Columbia', 'âˆ’07:00', 'âˆ’07:00', ''),
('US', '+394421-1045903', 'America/Denver', 'Mountain Time', 'âˆ’07:00', 'âˆ’06:00', ''),
('US', '+421953-0830245', 'America/Detroit', 'Eastern Time - Michigan - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('DM', '+1518-06124', 'America/Dominica', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+5333-11328', 'America/Edmonton', 'Mountain Time - Alberta, east British Columbia & west Saskatchewan', 'âˆ’07:00', 'âˆ’06:00', ''),
('BR', '-0640-06952', 'America/Eirunepe', 'W Amazonas', 'âˆ’04:00', 'âˆ’04:00', ''),
('SV', '+1342-08912', 'America/El_Salvador', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('', '', 'America/Ensenada', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Tijuana'),
('BR', '-0343-03830', 'America/Fortaleza', 'NE Brazil (MA, PI, CE, RN, PB)', 'âˆ’03:00', 'âˆ’03:00', ''),
('', '', 'America/Fort_Wayne', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Indiana/Indianapolis'),
('CA', '+4612-05957', 'America/Glace_Bay', 'Atlantic Time - Nova Scotia - places that did not observe DST 1966-1971', 'âˆ’04:00', 'âˆ’03:00', ''),
('GL', '+6411-05144', 'America/Godthab', 'most locations', 'âˆ’03:00', 'âˆ’02:00', ''),
('CA', '+5320-06025', 'America/Goose_Bay', 'Atlantic Time - Labrador - most locations', 'âˆ’04:00', 'âˆ’03:00', ''),
('TC', '+2128-07108', 'America/Grand_Turk', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('GD', '+1203-06145', 'America/Grenada', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('GP', '+1614-06132', 'America/Guadeloupe', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('GT', '+1438-09031', 'America/Guatemala', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('EC', '-0210-07950', 'America/Guayaquil', 'mainland', 'âˆ’05:00', 'âˆ’05:00', ''),
('GY', '+0648-05810', 'America/Guyana', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+4439-06336', 'America/Halifax', 'Atlantic Time - Nova Scotia (most places), PEI', 'âˆ’04:00', 'âˆ’03:00', ''),
('CU', '+2308-08222', 'America/Havana', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('MX', '+2904-11058', 'America/Hermosillo', 'Mountain Standard Time - Sonora', 'âˆ’07:00', 'âˆ’07:00', ''),
('US', '+394606-0860929', 'America/Indiana/Indianapolis', 'Eastern Time - Indiana - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+411745-0863730', 'America/Indiana/Knox', 'Central Time - Indiana - Starke County', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+382232-0862041', 'America/Indiana/Marengo', 'Eastern Time - Indiana - Crawford County', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+382931-0871643', 'America/Indiana/Petersburg', 'Eastern Time - Indiana - Pike County', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+375711-0864541', 'America/Indiana/Tell_City', 'Central Time - Indiana - Perry County', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+384452-0850402', 'America/Indiana/Vevay', 'Eastern Time - Indiana - Switzerland County', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+384038-0873143', 'America/Indiana/Vincennes', 'Eastern Time - Indiana - Daviess, Dubois, Knox & Martin Counties', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+410305-0863611', 'America/Indiana/Winamac', 'Eastern Time - Indiana - Pulaski County', 'âˆ’05:00', 'âˆ’04:00', ''),
('', '', 'America/Indianapolis', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Indiana/Indianapolis'),
('CA', '+682059-1334300', 'America/Inuvik', 'Mountain Time - west Northwest Territories', 'âˆ’07:00', 'âˆ’06:00', ''),
('CA', '+6344-06828', 'America/Iqaluit', 'Eastern Time - east Nunavut - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('JM', '+1800-07648', 'America/Jamaica', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('', '', 'America/Jujuy', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Jujuy'),
('US', '+581807-1342511', 'America/Juneau', 'Alaska Time - Alaska panhandle', 'âˆ’09:00', 'âˆ’08:00', ''),
('US', '+381515-0854534', 'America/Kentucky/Louisville', 'Eastern Time - Kentucky - Louisville area', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+364947-0845057', 'America/Kentucky/Monticello', 'Eastern Time - Kentucky - Wayne County', 'âˆ’05:00', 'âˆ’04:00', ''),
('', '', 'America/Knox_IN', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Indiana/Knox'),
('BQ', '+120903-0681636', 'America/Kralendijk', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Curacao'),
('BO', '-1630-06809', 'America/La_Paz', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('PE', '-1203-07703', 'America/Lima', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('US', '+340308-1181434', 'America/Los_Angeles', 'Pacific Time', 'âˆ’08:00', 'âˆ’07:00', ''),
('', '', 'America/Louisville', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Kentucky/Louisville'),
('SX', '+180305-0630250', 'America/Lower_Princes', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Curacao'),
('BR', '-0940-03543', 'America/Maceio', 'Alagoas, Sergipe', 'âˆ’03:00', 'âˆ’03:00', ''),
('NI', '+1209-08617', 'America/Managua', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('BR', '-0308-06001', 'America/Manaus', 'E Amazonas', 'âˆ’04:00', 'âˆ’04:00', ''),
('MF', '+1804-06305', 'America/Marigot', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Guadeloupe'),
('MQ', '+1436-06105', 'America/Martinique', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('MX', '+2550-09730', 'America/Matamoros', 'US Central Time - Coahuila, Durango, Nuevo LeÃ³n, Tamaulipas near US border', 'âˆ’06:00', 'âˆ’05:00', ''),
('MX', '+2313-10625', 'America/Mazatlan', 'Mountain Time - S Baja, Nayarit, Sinaloa', 'âˆ’07:00', 'âˆ’06:00', ''),
('', '', 'America/Mendoza', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Mendoza'),
('US', '+450628-0873651', 'America/Menominee', 'Central Time - Michigan - Dickinson, Gogebic, Iron & Menominee Counties', 'âˆ’06:00', 'âˆ’05:00', ''),
('MX', '+2058-08937', 'America/Merida', 'Central Time - Campeche, YucatÃ¡n', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+550737-1313435', 'America/Metlakatla', 'Metlakatla Time - Annette Island', 'âˆ’08:00', 'âˆ’08:00', ''),
('MX', '+1924-09909', 'America/Mexico_City', 'Central Time - most locations', 'âˆ’06:00', 'âˆ’05:00', ''),
('PM', '+4703-05620', 'America/Miquelon', '', 'âˆ’03:00', 'âˆ’02:00', ''),
('CA', '+4606-06447', 'America/Moncton', 'Atlantic Time - New Brunswick', 'âˆ’04:00', 'âˆ’03:00', ''),
('MX', '+2540-10019', 'America/Monterrey', 'Mexican Central Time - Coahuila, Durango, Nuevo LeÃ³n, Tamaulipas away from US border', 'âˆ’06:00', 'âˆ’05:00', ''),
('UY', '-3453-05611', 'America/Montevideo', '', 'âˆ’03:00', 'âˆ’02:00', ''),
('CA', '+4531-07334', 'America/Montreal', 'Eastern Time - Quebec - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('MS', '+1643-06213', 'America/Montserrat', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('BS', '+2505-07721', 'America/Nassau', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+404251-0740023', 'America/New_York', 'Eastern Time', 'âˆ’05:00', 'âˆ’04:00', ''),
('CA', '+4901-08816', 'America/Nipigon', 'Eastern Time - Ontario & Quebec - places that did not observe DST 1967-1973', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+643004-1652423', 'America/Nome', 'Alaska Time - west Alaska', 'âˆ’09:00', 'âˆ’08:00', ''),
('BR', '-0351-03225', 'America/Noronha', 'Atlantic islands', 'âˆ’02:00', 'âˆ’02:00', ''),
('US', '+471551-1014640', 'America/North_Dakota/Beulah', 'Central Time - North Dakota - Mercer County', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+470659-1011757', 'America/North_Dakota/Center', 'Central Time - North Dakota - Oliver County', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+465042-1012439', 'America/North_Dakota/New_Salem', 'Central Time - North Dakota - Morton County (except Mandan area)', 'âˆ’06:00', 'âˆ’05:00', ''),
('MX', '+2934-10425', 'America/Ojinaga', 'US Mountain Time - Chihuahua near US border', 'âˆ’07:00', 'âˆ’06:00', ''),
('PA', '+0858-07932', 'America/Panama', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('CA', '+6608-06544', 'America/Pangnirtung', 'Eastern Time - Pangnirtung, Nunavut', 'âˆ’05:00', 'âˆ’04:00', ''),
('SR', '+0550-05510', 'America/Paramaribo', '', 'âˆ’03:00', 'âˆ’03:00', ''),
('US', '+332654-1120424', 'America/Phoenix', 'Mountain Standard Time - Arizona', 'âˆ’07:00', 'âˆ’07:00', ''),
('HT', '+1832-07220', 'America/Port-au-Prince', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('', '', 'America/Porto_Acre', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Rio_Branco'),
('BR', '-0846-06354', 'America/Porto_Velho', 'Rondonia', 'âˆ’04:00', 'âˆ’04:00', ''),
('TT', '+1039-06131', 'America/Port_of_Spain', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('PR', '+182806-0660622', 'America/Puerto_Rico', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+4843-09434', 'America/Rainy_River', 'Central Time - Rainy River & Fort Frances, Ontario', 'âˆ’06:00', 'âˆ’05:00', ''),
('CA', '+624900-0920459', 'America/Rankin_Inlet', 'Central Time - central Nunavut', 'âˆ’06:00', 'âˆ’05:00', ''),
('BR', '-0803-03454', 'America/Recife', 'Pernambuco', 'âˆ’03:00', 'âˆ’03:00', ''),
('CA', '+5024-10439', 'America/Regina', 'Central Standard Time - Saskatchewan - most locations', 'âˆ’06:00', 'âˆ’06:00', ''),
('CA', '+744144-0944945', 'America/Resolute', 'Central Standard Time - Resolute, Nunavut', 'âˆ’06:00', 'âˆ’05:00', ''),
('BR', '-0958-06748', 'America/Rio_Branco', 'Acre', 'âˆ’04:00', 'âˆ’04:00', ''),
('', '', 'America/Rosario', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Cordoba'),
('BR', '-0226-05452', 'America/Santarem', 'W Para', 'âˆ’03:00', 'âˆ’03:00', ''),
('MX', '+3018-11452', 'America/Santa_Isabel', 'Mexican Pacific Time - Baja California away from US border', 'âˆ’08:00', 'âˆ’07:00', ''),
('CL', '-3327-07040', 'America/Santiago', 'most locations', 'âˆ’04:00', 'âˆ’03:00', ''),
('DO', '+1828-06954', 'America/Santo_Domingo', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('BR', '-2332-04637', 'America/Sao_Paulo', 'S & SE Brazil (GO, DF, MG, ES, RJ, SP, PR, SC, RS)', 'âˆ’03:00', 'âˆ’02:00', ''),
('GL', '+7029-02158', 'America/Scoresbysund', 'Scoresbysund / Ittoqqortoormiit', 'âˆ’01:00', '+00:00', ''),
('US', '+364708-1084111', 'America/Shiprock', 'Mountain Time - Navajo', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Denver'),
('US', '+571035-1351807', 'America/Sitka', 'Alaska Time - southeast Alaska panhandle', 'âˆ’09:00', 'âˆ’08:00', ''),
('BL', '+1753-06251', 'America/St_Barthelemy', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Guadeloupe'),
('CA', '+4734-05243', 'America/St_Johns', 'Newfoundland Time, including SE Labrador', 'âˆ’03:30', 'âˆ’02:30', ''),
('KN', '+1718-06243', 'America/St_Kitts', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('LC', '+1401-06100', 'America/St_Lucia', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('VI', '+1821-06456', 'America/St_Thomas', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('VC', '+1309-06114', 'America/St_Vincent', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+5017-10750', 'America/Swift_Current', 'Central Standard Time - Saskatchewan - midwest', 'âˆ’06:00', 'âˆ’06:00', ''),
('HN', '+1406-08713', 'America/Tegucigalpa', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('GL', '+7634-06847', 'America/Thule', 'Thule / Pituffik', 'âˆ’04:00', 'âˆ’03:00', ''),
('CA', '+4823-08915', 'America/Thunder_Bay', 'Eastern Time - Thunder Bay, Ontario', 'âˆ’05:00', 'âˆ’04:00', ''),
('MX', '+3232-11701', 'America/Tijuana', 'US Pacific Time - Baja California near US border', 'âˆ’08:00', 'âˆ’07:00', ''),
('CA', '+4339-07923', 'America/Toronto', 'Eastern Time - Ontario - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('VG', '+1827-06437', 'America/Tortola', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+4916-12307', 'America/Vancouver', 'Pacific Time - west British Columbia', 'âˆ’08:00', 'âˆ’07:00', ''),
('', '', 'America/Virgin', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/St_Thomas'),
('CA', '+6043-13503', 'America/Whitehorse', 'Pacific Time - south Yukon', 'âˆ’08:00', 'âˆ’07:00', ''),
('CA', '+4953-09709', 'America/Winnipeg', 'Central Time - Manitoba & west Ontario', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+593249-1394338', 'America/Yakutat', 'Alaska Time - Alaska panhandle neck', 'âˆ’09:00', 'âˆ’08:00', ''),
('CA', '+6227-11421', 'America/Yellowknife', 'Mountain Time - central Northwest Territories', 'âˆ’07:00', 'âˆ’06:00', ''),
('AQ', '-6617+11031', 'Antarctica/Casey', 'Casey Station, Bailey Peninsula', '+11:00', '+08:00', ''),
('AQ', '-6835+07758', 'Antarctica/Davis', 'Davis Station, Vestfold Hills', '+05:00', '+07:00', ''),
('AQ', '-6640+14001', 'Antarctica/DumontDUrville', 'Dumont-d\'Urville Station, Terre Adelie', '+10:00', '+10:00', ''),
('AQ', '-5430+15857', 'Antarctica/Macquarie', 'Macquarie Island Station, Macquarie Island', '+11:00', '+11:00', ''),
('AQ', '-6736+06253', 'Antarctica/Mawson', 'Mawson Station, Holme Bay', '+05:00', '+05:00', ''),
('AQ', '-7750+16636', 'Antarctica/McMurdo', 'McMurdo Station, Ross Island', '+12:00', '+13:00', ''),
('AQ', '-6448-06406', 'Antarctica/Palmer', 'Palmer Station, Anvers Island', 'âˆ’04:00', 'âˆ’03:00', ''),
('AQ', '-6734-06808', 'Antarctica/Rothera', 'Rothera Station, Adelaide Island', 'âˆ’03:00', 'âˆ’03:00', ''),
('AQ', '-9000+00000', 'Antarctica/South_Pole', 'Amundsen-Scott Station, South Pole', '+12:00', '+13:00', 'Link to Antarctica/McMurdo'),
('AQ', '-690022+0393524', 'Antarctica/Syowa', 'Syowa Station, E Ongul I', '+03:00', '+03:00', ''),
('AQ', '-7824+10654', 'Antarctica/Vostok', 'Vostok Station, Lake Vostok', '+06:00', '+06:00', ''),
('SJ', '+7800+01600', 'Arctic/Longyearbyen', '', '+01:00', '+02:00', 'Link to Europe/Oslo'),
('YE', '+1245+04512', 'Asia/Aden', '', '+03:00', '+03:00', ''),
('KZ', '+4315+07657', 'Asia/Almaty', 'most locations', '+06:00', '+06:00', ''),
('JO', '+3157+03556', 'Asia/Amman', '', '+03:00', '+03:00', ''),
('RU', '+6445+17729', 'Asia/Anadyr', 'Moscow+08 - Bering Sea', '+12:00', '+12:00', ''),
('KZ', '+4431+05016', 'Asia/Aqtau', 'Atyrau (Atirau, Gur\'yev), Mangghystau (Mankistau)', '+05:00', '+05:00', ''),
('KZ', '+5017+05710', 'Asia/Aqtobe', 'Aqtobe (Aktobe)', '+05:00', '+05:00', ''),
('TM', '+3757+05823', 'Asia/Ashgabat', '', '+05:00', '+05:00', ''),
('', '', 'Asia/Ashkhabad', '', '+05:00', '+05:00', 'Link to Asia/Ashgabat'),
('IQ', '+3321+04425', 'Asia/Baghdad', '', '+03:00', '+03:00', ''),
('BH', '+2623+05035', 'Asia/Bahrain', '', '+03:00', '+03:00', ''),
('AZ', '+4023+04951', 'Asia/Baku', '', '+04:00', '+05:00', ''),
('TH', '+1345+10031', 'Asia/Bangkok', '', '+07:00', '+07:00', ''),
('LB', '+3353+03530', 'Asia/Beirut', '', '+02:00', '+03:00', ''),
('KG', '+4254+07436', 'Asia/Bishkek', '', '+06:00', '+06:00', ''),
('BN', '+0456+11455', 'Asia/Brunei', '', '+08:00', '+08:00', ''),
('', '', 'Asia/Calcutta', '', '+05:30', '+05:30', 'Link to Asia/Kolkata'),
('MN', '+4804+11430', 'Asia/Choibalsan', 'Dornod, Sukhbaatar', '+08:00', '+08:00', ''),
('CN', '+2934+10635', 'Asia/Chongqing', 'central China - Sichuan, Yunnan, Guangxi, Shaanxi, Guizhou, etc.', '+08:00', '+08:00', 'Covering historic Kansu-Szechuan time zone.'),
('', '', 'Asia/Chungking', '', '+08:00', '+08:00', 'Link to Asia/Chongqing'),
('LK', '+0656+07951', 'Asia/Colombo', '', '+05:30', '+05:30', ''),
('', '', 'Asia/Dacca', '', '+06:00', '+06:00', 'Link to Asia/Dhaka'),
('SY', '+3330+03618', 'Asia/Damascus', '', '+02:00', '+03:00', ''),
('BD', '+2343+09025', 'Asia/Dhaka', '', '+06:00', '+06:00', ''),
('TL', '-0833+12535', 'Asia/Dili', '', '+09:00', '+09:00', ''),
('AE', '+2518+05518', 'Asia/Dubai', '', '+04:00', '+04:00', ''),
('TJ', '+3835+06848', 'Asia/Dushanbe', '', '+05:00', '+05:00', ''),
('PS', '+3130+03428', 'Asia/Gaza', 'Gaza Strip', '+02:00', '+03:00', ''),
('CN', '+4545+12641', 'Asia/Harbin', 'Heilongjiang (except Mohe), Jilin', '+08:00', '+08:00', 'Covering historic Changpai time zone.'),
('PS', '+313200+0350542', 'Asia/Hebron', 'West Bank', '+02:00', '+03:00', ''),
('HK', '+2217+11409', 'Asia/Hong_Kong', '', '+08:00', '+08:00', ''),
('MN', '+4801+09139', 'Asia/Hovd', 'Bayan-Olgiy, Govi-Altai, Hovd, Uvs, Zavkhan', '+07:00', '+07:00', ''),
('VN', '+1045+10640', 'Asia/Ho_Chi_Minh', '', '+07:00', '+07:00', ''),
('RU', '+5216+10420', 'Asia/Irkutsk', 'Moscow+05 - Lake Baikal', '+09:00', '+09:00', ''),
('', '', 'Asia/Istanbul', '', '+02:00', '+03:00', 'Link to Europe/Istanbul'),
('ID', '-0610+10648', 'Asia/Jakarta', 'Java & Sumatra', '+07:00', '+07:00', ''),
('ID', '-0232+14042', 'Asia/Jayapura', 'west New Guinea (Irian Jaya) & Malukus (Moluccas)', '+09:00', '+09:00', ''),
('IL', '+3146+03514', 'Asia/Jerusalem', '', '+02:00', '+03:00', ''),
('AF', '+3431+06912', 'Asia/Kabul', '', '+04:30', '+04:30', ''),
('RU', '+5301+15839', 'Asia/Kamchatka', 'Moscow+08 - Kamchatka', '+12:00', '+12:00', ''),
('PK', '+2452+06703', 'Asia/Karachi', '', '+05:00', '+05:00', ''),
('CN', '+3929+07559', 'Asia/Kashgar', 'west Tibet & Xinjiang', '+08:00', '+08:00', 'Covering historic Kunlun time zone.'),
('NP', '+2743+08519', 'Asia/Kathmandu', '', '+05:45', '+05:45', ''),
('', '', 'Asia/Katmandu', '', '+05:45', '+05:45', 'Link to Asia/Kathmandu'),
('IN', '+2232+08822', 'Asia/Kolkata', '', '+05:30', '+05:30', 'Note: Different zones in history, see Time in India.'),
('RU', '+5601+09250', 'Asia/Krasnoyarsk', 'Moscow+04 - Yenisei River', '+08:00', '+08:00', ''),
('MY', '+0310+10142', 'Asia/Kuala_Lumpur', 'peninsular Malaysia', '+08:00', '+08:00', ''),
('MY', '+0133+11020', 'Asia/Kuching', 'Sabah & Sarawak', '+08:00', '+08:00', ''),
('KW', '+2920+04759', 'Asia/Kuwait', '', '+03:00', '+03:00', ''),
('', '', 'Asia/Macao', '', '+08:00', '+08:00', 'Link to Asia/Macau'),
('MO', '+2214+11335', 'Asia/Macau', '', '+08:00', '+08:00', ''),
('RU', '+5934+15048', 'Asia/Magadan', 'Moscow+08 - Magadan', '+12:00', '+12:00', ''),
('ID', '-0507+11924', 'Asia/Makassar', 'east & south Borneo, Sulawesi (Celebes), Bali, Nusa Tenggara, west Timor', '+08:00', '+08:00', ''),
('PH', '+1435+12100', 'Asia/Manila', '', '+08:00', '+08:00', ''),
('OM', '+2336+05835', 'Asia/Muscat', '', '+04:00', '+04:00', ''),
('CY', '+3510+03322', 'Asia/Nicosia', '', '+02:00', '+03:00', ''),
('RU', '+5345+08707', 'Asia/Novokuznetsk', 'Moscow+03 - Novokuznetsk', '+07:00', '+07:00', ''),
('RU', '+5502+08255', 'Asia/Novosibirsk', 'Moscow+03 - Novosibirsk', '+07:00', '+07:00', ''),
('RU', '+5500+07324', 'Asia/Omsk', 'Moscow+03 - west Siberia', '+07:00', '+07:00', ''),
('KZ', '+5113+05121', 'Asia/Oral', 'West Kazakhstan', '+05:00', '+05:00', ''),
('KH', '+1133+10455', 'Asia/Phnom_Penh', '', '+07:00', '+07:00', ''),
('ID', '-0002+10920', 'Asia/Pontianak', 'west & central Borneo', '+07:00', '+07:00', ''),
('KP', '+3901+12545', 'Asia/Pyongyang', '', '+09:00', '+09:00', ''),
('QA', '+2517+05132', 'Asia/Qatar', '', '+03:00', '+03:00', ''),
('KZ', '+4448+06528', 'Asia/Qyzylorda', 'Qyzylorda (Kyzylorda, Kzyl-Orda)', '+06:00', '+06:00', ''),
('MM', '+1647+09610', 'Asia/Rangoon', '', '+06:30', '+06:30', ''),
('SA', '+2438+04643', 'Asia/Riyadh', '', '+03:00', '+03:00', ''),
('', '', 'Asia/Saigon', '', '+07:00', '+07:00', 'Link to Asia/Ho_Chi_Minh'),
('RU', '+4658+14242', 'Asia/Sakhalin', 'Moscow+07 - Sakhalin Island', '+11:00', '+11:00', ''),
('UZ', '+3940+06648', 'Asia/Samarkand', 'west Uzbekistan', '+05:00', '+05:00', ''),
('KR', '+3733+12658', 'Asia/Seoul', '', '+09:00', '+09:00', ''),
('CN', '+3114+12128', 'Asia/Shanghai', 'east China - Beijing, Guangdong, Shanghai, etc.', '+08:00', '+08:00', 'Covering historic Chungyuan time zone.'),
('SG', '+0117+10351', 'Asia/Singapore', '', '+08:00', '+08:00', ''),
('TW', '+2503+12130', 'Asia/Taipei', '', '+08:00', '+08:00', ''),
('UZ', '+4120+06918', 'Asia/Tashkent', 'east Uzbekistan', '+05:00', '+05:00', ''),
('GE', '+4143+04449', 'Asia/Tbilisi', '', '+04:00', '+04:00', ''),
('IR', '+3540+05126', 'Asia/Tehran', '', '+03:30', '+04:30', ''),
('', '', 'Asia/Tel_Aviv', '', '+02:00', '+03:00', 'Link to Asia/Jerusalem'),
('', '', 'Asia/Thimbu', '', '+06:00', '+06:00', 'Link to Asia/Thimphu'),
('BT', '+2728+08939', 'Asia/Thimphu', '', '+06:00', '+06:00', ''),
('JP', '+353916+1394441', 'Asia/Tokyo', '', '+09:00', '+09:00', ''),
('', '', 'Asia/Ujung_Pandang', '', '+08:00', '+08:00', 'Link to Asia/Makassar'),
('MN', '+4755+10653', 'Asia/Ulaanbaatar', 'most locations', '+08:00', '+08:00', ''),
('', '', 'Asia/Ulan_Bator', '', '+08:00', '+08:00', 'Link to Asia/Ulaanbaatar'),
('CN', '+4348+08735', 'Asia/Urumqi', 'most of Tibet & Xinjiang', '+08:00', '+08:00', 'Covering historic Sinkiang-Tibet time zone.'),
('LA', '+1758+10236', 'Asia/Vientiane', '', '+07:00', '+07:00', ''),
('RU', '+4310+13156', 'Asia/Vladivostok', 'Moscow+07 - Amur River', '+11:00', '+11:00', ''),
('RU', '+6200+12940', 'Asia/Yakutsk', 'Moscow+06 - Lena River', '+10:00', '+10:00', ''),
('RU', '+5651+06036', 'Asia/Yekaterinburg', 'Moscow+02 - Urals', '+06:00', '+06:00', ''),
('AM', '+4011+04430', 'Asia/Yerevan', '', '+04:00', '+04:00', ''),
('PT', '+3744-02540', 'Atlantic/Azores', 'Azores', 'âˆ’01:00', '+00:00', ''),
('BM', '+3217-06446', 'Atlantic/Bermuda', '', 'âˆ’04:00', 'âˆ’03:00', ''),
('ES', '+2806-01524', 'Atlantic/Canary', 'Canary Islands', '+00:00', '+01:00', ''),
('CV', '+1455-02331', 'Atlantic/Cape_Verde', '', 'âˆ’01:00', 'âˆ’01:00', ''),
('', '', 'Atlantic/Faeroe', '', '+00:00', '+01:00', 'Link to Atlantic/Faroe'),
('FO', '+6201-00646', 'Atlantic/Faroe', '', '+00:00', '+01:00', ''),
('', '', 'Atlantic/Jan_Mayen', '', '+01:00', '+02:00', 'Link to Europe/Oslo'),
('PT', '+3238-01654', 'Atlantic/Madeira', 'Madeira Islands', '+00:00', '+01:00', ''),
('IS', '+6409-02151', 'Atlantic/Reykjavik', '', '+00:00', '+00:00', ''),
('GS', '-5416-03632', 'Atlantic/South_Georgia', '', 'âˆ’02:00', 'âˆ’02:00', ''),
('FK', '-5142-05751', 'Atlantic/Stanley', '', 'âˆ’03:00', 'âˆ’03:00', ''),
('SH', '-1555-00542', 'Atlantic/St_Helena', '', '+00:00', '+00:00', ''),
('', '', 'Australia/ACT', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3455+13835', 'Australia/Adelaide', 'South Australia', '+09:30', '+10:30', ''),
('AU', '-2728+15302', 'Australia/Brisbane', 'Queensland - most locations', '+10:00', '+10:00', ''),
('AU', '-3157+14127', 'Australia/Broken_Hill', 'New South Wales - Yancowinna', '+09:30', '+10:30', ''),
('', '', 'Australia/Canberra', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3956+14352', 'Australia/Currie', 'Tasmania - King Island', '+10:00', '+11:00', ''),
('AU', '-1228+13050', 'Australia/Darwin', 'Northern Territory', '+09:30', '+09:30', ''),
('AU', '-3143+12852', 'Australia/Eucla', 'Western Australia - Eucla area', '+08:45', '+08:45', ''),
('AU', '-4253+14719', 'Australia/Hobart', 'Tasmania - most locations', '+10:00', '+11:00', ''),
('', '', 'Australia/LHI', '', '+10:30', '+11:00', 'Link to Australia/Lord_Howe'),
('AU', '-2016+14900', 'Australia/Lindeman', 'Queensland - Holiday Islands', '+10:00', '+10:00', ''),
('AU', '-3133+15905', 'Australia/Lord_Howe', 'Lord Howe Island', '+10:30', '+11:00', ''),
('AU', '-3749+14458', 'Australia/Melbourne', 'Victoria', '+10:00', '+11:00', ''),
('', '', 'Australia/North', '', '+09:30', '+09:30', 'Link to Australia/Darwin'),
('', '', 'Australia/NSW', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3157+11551', 'Australia/Perth', 'Western Australia - most locations', '+08:00', '+08:00', ''),
('', '', 'Australia/Queensland', '', '+10:00', '+10:00', 'Link to Australia/Brisbane'),
('', '', 'Australia/South', '', '+09:30', '+10:30', 'Link to Australia/Adelaide'),
('AU', '-3352+15113', 'Australia/Sydney', 'New South Wales - most locations', '+10:00', '+11:00', ''),
('', '', 'Australia/Tasmania', '', '+10:00', '+11:00', 'Link to Australia/Hobart'),
('', '', 'Australia/Victoria', '', '+10:00', '+11:00', 'Link to Australia/Melbourne'),
('', '', 'Australia/West', '', '+08:00', '+08:00', 'Link to Australia/Perth'),
('', '', 'Australia/Yancowinna', '', '+09:30', '+10:30', 'Link to Australia/Broken_Hill'),
('', '', 'Brazil/Acre', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Rio_Branco'),
('', '', 'Brazil/DeNoronha', '', 'âˆ’02:00', 'âˆ’02:00', 'Link to America/Noronha'),
('', '', 'Brazil/East', '', 'âˆ’03:00', 'âˆ’02:00', 'Link to America/Sao_Paulo'),
('', '', 'Brazil/West', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Manaus'),
('', '', 'Canada/Atlantic', '', 'âˆ’04:00', 'âˆ’03:00', 'Link to America/Halifax'),
('', '', 'Canada/Central', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Winnipeg'),
('', '', 'Canada/East-Saskatchewan', '', 'âˆ’06:00', 'âˆ’06:00', 'Link to America/Regina'),
('', '', 'Canada/Eastern', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Toronto'),
('', '', 'Canada/Mountain', '', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Edmonton'),
('', '', 'Canada/Newfoundland', '', 'âˆ’03:30', 'âˆ’02:30', 'Link to America/St_Johns'),
('', '', 'Canada/Pacific', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Vancouver'),
('', '', 'Canada/Saskatchewan', '', 'âˆ’06:00', 'âˆ’06:00', 'Link to America/Regina'),
('', '', 'Canada/Yukon', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Whitehorse'),
('', '', 'CET', '', '+01:00', '+02:00', ''),
('', '', 'Chile/Continental', '', 'âˆ’04:00', 'âˆ’03:00', 'Link to America/Santiago'),
('', '', 'Chile/EasterIsland', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to Pacific/Easter'),
('', '', 'CST6CDT', '', 'âˆ’06:00', 'âˆ’05:00', ''),
('', '', 'Cuba', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Havana'),
('', '', 'EET', '', '+02:00', '+03:00', ''),
('', '', 'Egypt', '', '+02:00', '+02:00', 'Link to Africa/Cairo'),
('', '', 'Eire', '', '+00:00', '+01:00', 'Link to Europe/Dublin'),
('', '', 'EST', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('', '', 'EST5EDT', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('', '', 'Etc./GMT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./GMT+0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./UCT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./Universal', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./UTC', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./Zulu', '', '+00:00', '+00:00', 'Link to UTC'),
('NL', '+5222+00454', 'Europe/Amsterdam', '', '+01:00', '+02:00', ''),
('AD', '+4230+00131', 'Europe/Andorra', '', '+01:00', '+02:00', ''),
('GR', '+3758+02343', 'Europe/Athens', '', '+02:00', '+03:00', ''),
('', '', 'Europe/Belfast', '', '+00:00', '+01:00', 'Link to Europe/London'),
('RS', '+4450+02030', 'Europe/Belgrade', '', '+01:00', '+02:00', ''),
('DE', '+5230+01322', 'Europe/Berlin', '', '+01:00', '+02:00', 'In 1945, the Trizone did not follow Berlin\'s switch to DST, see Time in Germany'),
('SK', '+4809+01707', 'Europe/Bratislava', '', '+01:00', '+02:00', 'Link to Europe/Prague'),
('BE', '+5050+00420', 'Europe/Brussels', '', '+01:00', '+02:00', ''),
('RO', '+4426+02606', 'Europe/Bucharest', '', '+02:00', '+03:00', ''),
('HU', '+4730+01905', 'Europe/Budapest', '', '+01:00', '+02:00', ''),
('MD', '+4700+02850', 'Europe/Chisinau', '', '+02:00', '+03:00', ''),
('DK', '+5540+01235', 'Europe/Copenhagen', '', '+01:00', '+02:00', ''),
('IE', '+5320-00615', 'Europe/Dublin', '', '+00:00', '+01:00', ''),
('GI', '+3608-00521', 'Europe/Gibraltar', '', '+01:00', '+02:00', ''),
('GG', '+4927-00232', 'Europe/Guernsey', '', '+00:00', '+01:00', 'Link to Europe/London'),
('FI', '+6010+02458', 'Europe/Helsinki', '', '+02:00', '+03:00', ''),
('IM', '+5409-00428', 'Europe/Isle_of_Man', '', '+00:00', '+01:00', 'Link to Europe/London'),
('TR', '+4101+02858', 'Europe/Istanbul', '', '+02:00', '+03:00', ''),
('JE', '+4912-00207', 'Europe/Jersey', '', '+00:00', '+01:00', 'Link to Europe/London'),
('RU', '+5443+02030', 'Europe/Kaliningrad', 'Moscow-01 - Kaliningrad', '+03:00', '+03:00', ''),
('UA', '+5026+03031', 'Europe/Kiev', 'most locations', '+02:00', '+03:00', ''),
('PT', '+3843-00908', 'Europe/Lisbon', 'mainland', '+00:00', '+01:00', ''),
('SI', '+4603+01431', 'Europe/Ljubljana', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('GB', '+513030-0000731', 'Europe/London', '', '+00:00', '+01:00', ''),
('LU', '+4936+00609', 'Europe/Luxembourg', '', '+01:00', '+02:00', ''),
('ES', '+4024-00341', 'Europe/Madrid', 'mainland', '+01:00', '+02:00', ''),
('MT', '+3554+01431', 'Europe/Malta', '', '+01:00', '+02:00', ''),
('AX', '+6006+01957', 'Europe/Mariehamn', '', '+02:00', '+03:00', 'Link to Europe/Helsinki'),
('BY', '+5354+02734', 'Europe/Minsk', '', '+03:00', '+03:00', ''),
('MC', '+4342+00723', 'Europe/Monaco', '', '+01:00', '+02:00', ''),
('RU', '+5545+03735', 'Europe/Moscow', 'Moscow+00 - west Russia', '+04:00', '+04:00', ''),
('', '', 'Europe/Nicosia', '', '+02:00', '+03:00', 'Link to Asia/Nicosia'),
('NO', '+5955+01045', 'Europe/Oslo', '', '+01:00', '+02:00', ''),
('FR', '+4852+00220', 'Europe/Paris', '', '+01:00', '+02:00', ''),
('ME', '+4226+01916', 'Europe/Podgorica', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('CZ', '+5005+01426', 'Europe/Prague', '', '+01:00', '+02:00', ''),
('LV', '+5657+02406', 'Europe/Riga', '', '+02:00', '+03:00', ''),
('IT', '+4154+01229', 'Europe/Rome', '', '+01:00', '+02:00', ''),
('RU', '+5312+05009', 'Europe/Samara', 'Moscow+00 - Samara, Udmurtia', '+04:00', '+04:00', ''),
('SM', '+4355+01228', 'Europe/San_Marino', '', '+01:00', '+02:00', 'Link to Europe/Rome'),
('BA', '+4352+01825', 'Europe/Sarajevo', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('UA', '+4457+03406', 'Europe/Simferopol', 'central Crimea', '+02:00', '+03:00', ''),
('MK', '+4159+02126', 'Europe/Skopje', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('BG', '+4241+02319', 'Europe/Sofia', '', '+02:00', '+03:00', ''),
('SE', '+5920+01803', 'Europe/Stockholm', '', '+01:00', '+02:00', ''),
('EE', '+5925+02445', 'Europe/Tallinn', '', '+02:00', '+03:00', ''),
('AL', '+4120+01950', 'Europe/Tirane', '', '+01:00', '+02:00', ''),
('', '', 'Europe/Tiraspol', '', '+02:00', '+03:00', 'Link to Europe/Chisinau'),
('UA', '+4837+02218', 'Europe/Uzhgorod', 'Ruthenia', '+02:00', '+03:00', ''),
('LI', '+4709+00931', 'Europe/Vaduz', '', '+01:00', '+02:00', ''),
('VA', '+415408+0122711', 'Europe/Vatican', '', '+01:00', '+02:00', 'Link to Europe/Rome'),
('AT', '+4813+01620', 'Europe/Vienna', '', '+01:00', '+02:00', ''),
('LT', '+5441+02519', 'Europe/Vilnius', '', '+02:00', '+03:00', ''),
('RU', '+4844+04425', 'Europe/Volgograd', 'Moscow+00 - Caspian Sea', '+04:00', '+04:00', ''),
('PL', '+5215+02100', 'Europe/Warsaw', '', '+01:00', '+02:00', ''),
('HR', '+4548+01558', 'Europe/Zagreb', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('UA', '+4750+03510', 'Europe/Zaporozhye', 'Zaporozh\'ye, E Lugansk / Zaporizhia, E Luhansk', '+02:00', '+03:00', ''),
('CH', '+4723+00832', 'Europe/Zurich', '', '+01:00', '+02:00', ''),
('', '', 'GB', '', '+00:00', '+01:00', 'Link to Europe/London'),
('', '', 'GB-Eire', '', '+00:00', '+01:00', 'Link to Europe/London'),
('', '', 'GMT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT+0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT-0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Greenwich', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Hong Kong', '', '+08:00', '+08:00', 'Link to Asia/Hong_Kong'),
('', '', 'HST', '', 'âˆ’10:00', 'âˆ’10:00', ''),
('', '', 'Iceland', '', '+00:00', '+00:00', 'Link to Atlantic/Reykjavik'),
('MG', '-1855+04731', 'Indian/Antananarivo', '', '+03:00', '+03:00', ''),
('IO', '-0720+07225', 'Indian/Chagos', '', '+06:00', '+06:00', ''),
('CX', '-1025+10543', 'Indian/Christmas', '', '+07:00', '+07:00', ''),
('CC', '-1210+09655', 'Indian/Cocos', '', '+06:30', '+06:30', ''),
('KM', '-1141+04316', 'Indian/Comoro', '', '+03:00', '+03:00', ''),
('TF', '-492110+0701303', 'Indian/Kerguelen', '', '+05:00', '+05:00', ''),
('SC', '-0440+05528', 'Indian/Mahe', '', '+04:00', '+04:00', ''),
('MV', '+0410+07330', 'Indian/Maldives', '', '+05:00', '+05:00', ''),
('MU', '-2010+05730', 'Indian/Mauritius', '', '+04:00', '+04:00', ''),
('YT', '-1247+04514', 'Indian/Mayotte', '', '+03:00', '+03:00', ''),
('RE', '-2052+05528', 'Indian/Reunion', '', '+04:00', '+04:00', ''),
('', '', 'Iran', '', '+03:30', '+04:30', 'Link to Asia/Tehran'),
('', '', 'Israel', '', '+02:00', '+03:00', 'Link to Asia/Jerusalem'),
('', '', 'Jamaica', '', 'âˆ’05:00', 'âˆ’05:00', 'Link to America/Jamaica'),
('', '', 'Japan', '', '+09:00', '+09:00', 'Link to Asia/Tokyo'),
('', '', 'JST-9', '', '+09:00', '+09:00', 'Link to Asia/Tokyo'),
('', '', 'Kwajalein', '', '+12:00', '+12:00', 'Link to Pacific/Kwajalein'),
('', '', 'Libya', '', '+02:00', '+02:00', 'Link to Africa/Tripoli'),
('', '', 'MET', '', '+01:00', '+02:00', ''),
('', '', 'Mexico/BajaNorte', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Tijuana'),
('', '', 'Mexico/BajaSur', '', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Mazatlan'),
('', '', 'Mexico/General', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Mexico_City'),
('', '', 'MST', '', 'âˆ’07:00', 'âˆ’07:00', ''),
('', '', 'MST7MDT', '', 'âˆ’07:00', 'âˆ’06:00', ''),
('', '', 'Navajo', '', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Denver'),
('', '', 'NZ', '', '+12:00', '+13:00', 'Link to Pacific/Auckland'),
('', '', 'NZ-CHAT', '', '+12:45', '+13:45', 'Link to Pacific/Chatham'),
('WS', '-1350-17144', 'Pacific/Apia', '', '+13:00', '+14:00', ''),
('NZ', '-3652+17446', 'Pacific/Auckland', 'most locations', '+12:00', '+13:00', ''),
('NZ', '-4357-17633', 'Pacific/Chatham', 'Chatham Islands', '+12:45', '+13:45', ''),
('FM', '+0725+15147', 'Pacific/Chuuk', 'Chuuk (Truk) and Yap', '+10:00', '+10:00', ''),
('CL', '-2709-10926', 'Pacific/Easter', 'Easter Island & Sala y Gomez', 'âˆ’06:00', 'âˆ’05:00', ''),
('VU', '-1740+16825', 'Pacific/Efate', '', '+11:00', '+11:00', ''),
('KI', '-0308-17105', 'Pacific/Enderbury', 'Phoenix Islands', '+13:00', '+13:00', ''),
('TK', '-0922-17114', 'Pacific/Fakaofo', '', '+13:00', '+13:00', ''),
('FJ', '-1808+17825', 'Pacific/Fiji', '', '+12:00', '+13:00', ''),
('TV', '-0831+17913', 'Pacific/Funafuti', '', '+12:00', '+12:00', ''),
('EC', '-0054-08936', 'Pacific/Galapagos', 'Galapagos Islands', 'âˆ’06:00', 'âˆ’06:00', ''),
('PF', '-2308-13457', 'Pacific/Gambier', 'Gambier Islands', 'âˆ’09:00', 'âˆ’09:00', ''),
('SB', '-0932+16012', 'Pacific/Guadalcanal', '', '+11:00', '+11:00', ''),
('GU', '+1328+14445', 'Pacific/Guam', '', '+10:00', '+10:00', ''),
('US', '+211825-1575130', 'Pacific/Honolulu', 'Hawaii', 'âˆ’10:00', 'âˆ’10:00', ''),
('UM', '+1645-16931', 'Pacific/Johnston', 'Johnston Atoll', 'âˆ’10:00', 'âˆ’10:00', ''),
('KI', '+0152-15720', 'Pacific/Kiritimati', 'Line Islands', '+14:00', '+14:00', ''),
('FM', '+0519+16259', 'Pacific/Kosrae', 'Kosrae', '+11:00', '+11:00', ''),
('MH', '+0905+16720', 'Pacific/Kwajalein', 'Kwajalein', '+12:00', '+12:00', ''),
('MH', '+0709+17112', 'Pacific/Majuro', 'most locations', '+12:00', '+12:00', ''),
('PF', '-0900-13930', 'Pacific/Marquesas', 'Marquesas Islands', 'âˆ’09:30', 'âˆ’09:30', ''),
('UM', '+2813-17722', 'Pacific/Midway', 'Midway Islands', 'âˆ’11:00', 'âˆ’11:00', ''),
('NR', '-0031+16655', 'Pacific/Nauru', '', '+12:00', '+12:00', ''),
('NU', '-1901-16955', 'Pacific/Niue', '', 'âˆ’11:00', 'âˆ’11:00', ''),
('NF', '-2903+16758', 'Pacific/Norfolk', '', '+11:30', '+11:30', ''),
('NC', '-2216+16627', 'Pacific/Noumea', '', '+11:00', '+11:00', ''),
('AS', '-1416-17042', 'Pacific/Pago_Pago', '', 'âˆ’11:00', 'âˆ’11:00', ''),
('PW', '+0720+13429', 'Pacific/Palau', '', '+09:00', '+09:00', ''),
('PN', '-2504-13005', 'Pacific/Pitcairn', '', 'âˆ’08:00', 'âˆ’08:00', ''),
('FM', '+0658+15813', 'Pacific/Pohnpei', 'Pohnpei (Ponape)', '+11:00', '+11:00', ''),
('', '', 'Pacific/Ponape', '', '+11:00', '+11:00', 'Link to Pacific/Pohnpei'),
('PG', '-0930+14710', 'Pacific/Port_Moresby', '', '+10:00', '+10:00', ''),
('CK', '-2114-15946', 'Pacific/Rarotonga', '', 'âˆ’10:00', 'âˆ’10:00', ''),
('MP', '+1512+14545', 'Pacific/Saipan', '', '+10:00', '+10:00', ''),
('', '', 'Pacific/Samoa', '', 'âˆ’11:00', 'âˆ’11:00', 'Link to Pacific/Pago_Pago'),
('PF', '-1732-14934', 'Pacific/Tahiti', 'Society Islands', 'âˆ’10:00', 'âˆ’10:00', ''),
('KI', '+0125+17300', 'Pacific/Tarawa', 'Gilbert Islands', '+12:00', '+12:00', ''),
('TO', '-2110-17510', 'Pacific/Tongatapu', '', '+13:00', '+13:00', ''),
('', '', 'Pacific/Truk', '', '+10:00', '+10:00', 'Link to Pacific/Chuuk'),
('UM', '+1917+16637', 'Pacific/Wake', 'Wake Island', '+12:00', '+12:00', ''),
('WF', '-1318-17610', 'Pacific/Wallis', '', '+12:00', '+12:00', ''),
('', '', 'Pacific/Yap', '', '+10:00', '+10:00', 'Link to Pacific/Chuuk'),
('', '', 'Poland', '', '+01:00', '+02:00', 'Link to Europe/Warsaw'),
('', '', 'Portugal', '', '+00:00', '+01:00', 'Link to Europe/Lisbon'),
('', '', 'PRC', '', '+08:00', '+08:00', 'Link to Asia/Shanghai'),
('', '', 'PST8PDT', '', 'âˆ’08:00', 'âˆ’07:00', ''),
('', '', 'ROC', '', '+08:00', '+08:00', 'Link to Asia/Taipei'),
('', '', 'ROK', '', '+09:00', '+09:00', 'Link to Asia/Seoul'),
('', '', 'Singapore', '', '+08:00', '+08:00', 'Link to Asia/Singapore'),
('', '', 'Turkey', '', '+02:00', '+03:00', 'Link to Europe/Istanbul'),
('', '', 'UCT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Universal', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'US/Alaska', '', 'âˆ’09:00', 'âˆ’08:00', 'Link to America/Anchorage'),
('', '', 'US/Aleutian', '', 'âˆ’10:00', 'âˆ’09:00', 'Link to America/Adak'),
('', '', 'US/Arizona', '', 'âˆ’07:00', 'âˆ’07:00', 'Link to America/Phoenix'),
('', '', 'US/Central', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Chicago'),
('', '', 'US/East-Indiana', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Indiana/Indianapolis'),
('', '', 'US/Eastern', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/New_York'),
('', '', 'US/Hawaii', '', 'âˆ’10:00', 'âˆ’10:00', 'Link to Pacific/Honolulu'),
('', '', 'US/Indiana-Starke', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Indiana/Knox'),
('', '', 'US/Michigan', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Detroit'),
('', '', 'US/Mountain', '', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Denver'),
('', '', 'US/Pacific', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Los_Angeles'),
('', '', 'US/Pacific-New', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Los_Angeles'),
('', '', 'US/Samoa', '', 'âˆ’11:00', 'âˆ’11:00', 'Link to Pacific/Pago_Pago'),
('', '', 'UTC', '', '+00:00', '+00:00', ''),
('', '', 'W-SU', '', '+04:00', '+04:00', 'Link to Europe/Moscow'),
('', '', 'WET', '', '+00:00', '+01:00', ''),
('', '', 'Zulu', '', '+00:00', '+00:00', 'Link to UTC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'step Admin', 'step@saasmonks.in', NULL, '$2y$10$g/L/W4ID9zR6bB6QQPtmhOc6.jeMbT9gZx.Wy9dOMqRhSk6YOW3Qi', '1ykikMolUl2l3gexOzsxRydiVt6pDgmeRYln63PFkVWv5valpAjJxVkw25Pk', '2019-10-18 07:42:51', '2022-10-11 06:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_vehicle`
--

CREATE TABLE `user_vehicle` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `vehicle_no` varchar(50) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `default_vehicle` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_setting`
--
ALTER TABLE `admin_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `parking_booking`
--
ALTER TABLE `parking_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `space_id` (`space_id`,`user_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `slot_id` (`slot_id`);

--
-- Indexes for table `parking_guard`
--
ALTER TABLE `parking_guard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `space_id` (`space_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `parking_image`
--
ALTER TABLE `parking_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `space_id` (`space_id`);

--
-- Indexes for table `parking_owner`
--
ALTER TABLE `parking_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_owner_setting`
--
ALTER TABLE `parking_owner_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parking_owner_setting_ibfk_1` (`owner_id`);

--
-- Indexes for table `parking_space`
--
ALTER TABLE `parking_space`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`space_id`),
  ADD KEY `space_id` (`space_id`);

--
-- Indexes for table `space_slot`
--
ALTER TABLE `space_slot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zone_id` (`zone_id`,`space_id`),
  ADD KEY `space_id` (`space_id`);

--
-- Indexes for table `space_zone`
--
ALTER TABLE `space_zone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `space_id` (`space_id`,`owner_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_buy`
--
ALTER TABLE `subscription_buy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `subscription_id` (`subscription_id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`TimeZone`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_setting`
--
ALTER TABLE `admin_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parking_booking`
--
ALTER TABLE `parking_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking_guard`
--
ALTER TABLE `parking_guard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking_image`
--
ALTER TABLE `parking_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking_owner`
--
ALTER TABLE `parking_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking_owner_setting`
--
ALTER TABLE `parking_owner_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking_space`
--
ALTER TABLE `parking_space`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `space_slot`
--
ALTER TABLE `space_slot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `space_zone`
--
ALTER TABLE `space_zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscription_buy`
--
ALTER TABLE `subscription_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_booking`
--
ALTER TABLE `parking_booking`
  ADD CONSTRAINT `parking_booking_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parking_booking_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `parking_owner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parking_booking_ibfk_5` FOREIGN KEY (`vehicle_id`) REFERENCES `user_vehicle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parking_booking_ibfk_6` FOREIGN KEY (`space_id`) REFERENCES `parking_space` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parking_booking_ibfk_7` FOREIGN KEY (`slot_id`) REFERENCES `space_slot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parking_guard`
--
ALTER TABLE `parking_guard`
  ADD CONSTRAINT `parking_guard_ibfk_1` FOREIGN KEY (`space_id`) REFERENCES `parking_space` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parking_guard_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `parking_owner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parking_image`
--
ALTER TABLE `parking_image`
  ADD CONSTRAINT `parking_image_ibfk_1` FOREIGN KEY (`space_id`) REFERENCES `parking_space` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parking_owner_setting`
--
ALTER TABLE `parking_owner_setting`
  ADD CONSTRAINT `parking_owner_setting_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `parking_owner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parking_space`
--
ALTER TABLE `parking_space`
  ADD CONSTRAINT `parking_space_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `parking_owner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`space_id`) REFERENCES `parking_space` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `space_slot`
--
ALTER TABLE `space_slot`
  ADD CONSTRAINT `space_slot_ibfk_1` FOREIGN KEY (`zone_id`) REFERENCES `space_zone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `space_slot_ibfk_2` FOREIGN KEY (`space_id`) REFERENCES `parking_space` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `space_zone`
--
ALTER TABLE `space_zone`
  ADD CONSTRAINT `space_zone_ibfk_1` FOREIGN KEY (`space_id`) REFERENCES `parking_space` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `space_zone_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `parking_owner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription_buy`
--
ALTER TABLE `subscription_buy`
  ADD CONSTRAINT `subscription_buy_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `parking_owner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_buy_ibfk_2` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  ADD CONSTRAINT `user_vehicle_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Queries Required with v4.0.0+ -----------------------------
ALTER TABLE `admin_setting` ADD `about_us` VARCHAR(255) NOT NULL AFTER `name`;
ALTER TABLE `admin_setting` ADD `terms_condition` TEXT NOT NULL AFTER `pp`;

ALTER TABLE `admin_setting`
  ADD `email` VARCHAR(100) NULL DEFAULT NULL AFTER `trial_days`,
  ADD `phone` VARCHAR(100) NULL DEFAULT NULL AFTER `email`,
  ADD `address` TEXT NULL DEFAULT NULL AFTER `phone`,
  ADD `mail_receive_querie` TEXT NULL DEFAULT NULL AFTER `address`,
  ADD `facebook_url` VARCHAR(255) NOT NULL DEFAULT 'https://www.facebook.com' AFTER `mail_receive_querie`,
  ADD `linkdin_url` VARCHAR(255) NOT NULL DEFAULT 'https://www.linkedin.com' AFTER `facebook_url`,
  ADD `instagram_url` VARCHAR(255) NOT NULL DEFAULT 'https://www.instagram.com' AFTER `linkdin_url`,
  ADD `twitter_url` VARCHAR(255) NOT NULL DEFAULT 'https://www.twitter.com' AFTER `instagram_url`;

ALTER TABLE `admin_setting` ADD `email_verification` BOOLEAN NOT NULL DEFAULT FALSE AFTER `verification`;
ALTER TABLE `admin_setting` CHANGE `about_us` `website_content` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `admin_setting` CHANGE `website_content` `website_content` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `admin_setting` CHANGE `website_content` `about_us` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `admin_setting` CHANGE `mail_receive_querie` `queriemail` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `admin_setting` CHANGE `mail_from_address` `mail_from_address` VARCHAR(220) CHARACTER     SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

CREATE TABLE `faq` (`id` INT(11) NOT NULL , `question` VARCHAR(255) NOT NULL , `answer` TEXT NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL ) ENGINE = InnoDB;
ALTER TABLE `faq` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);

ALTER TABLE `app_users` ADD `email_otp` VARCHAR(6) NOT NULL DEFAULT '123456' AFTER `OTP`;
ALTER TABLE `app_users` ADD `email_verified` INT(1) NOT NULL DEFAULT '0' AFTER `verified`;
-- ---------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
