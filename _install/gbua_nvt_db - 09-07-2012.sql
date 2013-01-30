-- phpMyAdmin SQL Dump
-- version 2.6.2
-- http://www.phpmyadmin.net
-- 
-- Хост: mysql302.1gb.ua:3306
-- Время создания: Июл 09 2012 г., 14:22
-- Версия сервера: 5.1.51
-- Версия PHP: 5.2.10
-- 
-- БД: `gbua_nvt_db`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `new_vision_audio_storage`
-- 

CREATE TABLE `new_vision_audio_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_link` text,
  `order_by` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT '1',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `new_vision_file_storage`
-- 

CREATE TABLE `new_vision_file_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_link` text,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `new_vision_issue`
-- 

CREATE TABLE `new_vision_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `summary` text NOT NULL,
  `description` longtext NOT NULL,
  `description_2` longtext NOT NULL,
  `menu` int(11) DEFAULT '0',
  `lang` int(11) NOT NULL DEFAULT '1',
  `img_1` text NOT NULL,
  `img_2` text NOT NULL,
  `img_3` text NOT NULL,
  `img_arr` longtext NOT NULL,
  `file_arr` longtext NOT NULL,
  `order_by` int(11) NOT NULL,
  `css_class` int(11) NOT NULL,
  `css_id` int(11) NOT NULL,
  `tags` text NOT NULL,
  `php_file` longtext NOT NULL,
  `css_file` text NOT NULL,
  `is_visible` int(1) DEFAULT '1',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `new_vision_issue_properties`
-- 

CREATE TABLE `new_vision_issue_properties` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text,
  `value` text,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `new_vision_localization`
-- 

CREATE TABLE `new_vision_localization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `new_vision_main_menu`
-- 

CREATE TABLE `new_vision_main_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `chapter` text NOT NULL,
  `lang` int(11) NOT NULL,
  `order_by` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `img_1` text NOT NULL,
  `img_2` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `html_title` text NOT NULL,
  `is_visible` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `new_vision_users`
-- 

CREATE TABLE `new_vision_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `name` text NOT NULL,
  `pass` text NOT NULL,
  `mail` text NOT NULL,
  `skype` text NOT NULL,
  `icq` text NOT NULL,
  `phone` text NOT NULL,
  `personal_data` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;
        