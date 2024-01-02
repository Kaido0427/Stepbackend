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