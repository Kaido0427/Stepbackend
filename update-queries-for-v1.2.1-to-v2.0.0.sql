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
COMMIT;

ALTER TABLE `subscription` ADD `max_space_limit` INT(11) NOT NULL DEFAULT '0' AFTER `plan`;