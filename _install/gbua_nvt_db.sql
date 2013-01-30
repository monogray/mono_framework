-- phpMyAdmin SQL Dump
-- version 2.6.2
-- http://www.phpmyadmin.net
-- 
-- ����: mysql302.1gb.ua:3306
-- ����� ��������: ��� 12 2012 �., 13:23
-- ������ �������: 5.1.51
-- ������ PHP: 5.2.10
-- 
-- ��: `gbua_nvt_db`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `web_audio_storage`
-- 

CREATE TABLE `web_audio_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_link` text,
  `order_by` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT '1',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- ��������� ������� `web_file_storage`
-- 

CREATE TABLE `web_file_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_link` text,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- ��������� ������� `web_issue`
-- 

CREATE TABLE `web_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `summary` text NOT NULL,
  `description` longtext NOT NULL,
  `menu` int(11) DEFAULT '0',
  `lang` int(11) NOT NULL DEFAULT '1',
  `img_1` text NOT NULL,
  `img_2` text NOT NULL,
  `img_3` text NOT NULL,
  `order_by` int(11) NOT NULL,
  `css_class` int(11) NOT NULL,
  `css_id` int(11) NOT NULL,
  `tags` text NOT NULL,
  `php_file` text NOT NULL,
  `css_file` text NOT NULL,
  `is_visible` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- ��������� ������� `web_localization`
-- 

CREATE TABLE `web_localization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- ��������� ������� `web_main_menu`
-- 

CREATE TABLE `web_main_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `chapter` text NOT NULL,
  `lang` int(11) NOT NULL,
  `order_by` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `img_1` text NOT NULL,
  `img_2` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- ��������� ������� `web_users`
-- 

CREATE TABLE `web_users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- ���� ������ ������� `web_users`
-- 

INSERT INTO `web_users` VALUES (1, 'admin', 'Admin', 'admin', '', '', '', '', '', '0000-00-00 00:00:00');
