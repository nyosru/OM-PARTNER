<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $this->execute("
CREATE TABLE IF NOT EXISTS `partners_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `partners_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `partners_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1434540546, 1434540546),
('author', 1, NULL, NULL, NULL, 1434540546, 1434540546),
('createPost', 2, 'Create a post', NULL, NULL, 1434540546, 1434540546),
('register', 1, NULL, NULL, NULL, 1434540546, 1434540546),
('updatePost', 2, 'Update post', NULL, NULL, 1434540546, 1434540546);

CREATE TABLE IF NOT EXISTS `partners_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `partners_auth_item_child` (`parent`, `child`) VALUES
('admin', 'author'),
('author', 'createPost'),
('admin', 'updatePost');

CREATE TABLE IF NOT EXISTS `partners_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `partners_auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`);

ALTER TABLE `partners_auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `type` (`type`);

ALTER TABLE `partners_auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

ALTER TABLE `partners_auth_rule`
 ADD PRIMARY KEY (`name`);

ALTER TABLE `partners_auth_assignment`
ADD CONSTRAINT `partners_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `partners_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `partners_auth_item`
ADD CONSTRAINT `partners_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `partners_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `partners_auth_item_child`
ADD CONSTRAINT `partners_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `partners_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `partners_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `partners_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE IF NOT EXISTS `partners` (
`id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `domain` varchar(145) DEFAULT NULL,
  `template` varchar(45) DEFAULT NULL,
  `allow_cat` blob,
  `allow_prod` blob,
  `customers_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для партнеров';

CREATE TABLE IF NOT EXISTS `partners_catalog` (
  `prod` int(11) NOT NULL,
  `cat` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Партнеры. Соответствие товаров категориям';

CREATE TABLE IF NOT EXISTS `partners_categories` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Партнеры. Пользовательские каталоги';

CREATE TABLE IF NOT EXISTS `partners_config` (
  `id` int(11) NOT NULL,
  `partners_id` int(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `partners_orders` (
`id` int(11) NOT NULL,
  `partners_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order` longblob,
  `status` int(11) DEFAULT NULL,
  `delivery` longblob,
  `orders_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `partners_users` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `id_partners` int(11) DEFAULT NULL,
  `role` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Партнеры. Пользователи магазинов';

CREATE TABLE IF NOT EXISTS `partners_users_info` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `secondname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `city` varchar(75) NOT NULL,
  `state` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `postcode` varchar(45) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `pasportser` varchar(45) DEFAULT NULL,
  `pasportnum` varchar(45) DEFAULT NULL,
  `pasportdate` datetime DEFAULT NULL,
  `pasportwhere` varchar(45) DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Партнеры. Дополнительная информация о пользователях';

ALTER TABLE `partners`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `partners_categories`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `partners_config`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `partners_orders`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `partners_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username_UNIQUE` (`username`);

ALTER TABLE `partners_users_info`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

ALTER TABLE `partners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `partners_orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `partners_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orders_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `orders_status` (`orders_status_id`, `language_id`, `orders_status_name`) VALUES ('100', '1', 'Ожидает оплаты от партнера');
");
    }
        public function down()
    {
        $this->execute("
            DROP TABLE IF EXISTS `partners_auth_assignment` , `partners_auth_item` , `partners_auth_item_child` , `partners_auth_rule` ,
            `partners` , `partners_catalog` , `partners_categories` , `partners_config` , `partners_orders` , `partners_users`, `partners_users_info` ;
            ");
    }
}
