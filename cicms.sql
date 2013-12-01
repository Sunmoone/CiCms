## phpMyAdmin SQL Dump
## version 4.0.4
## http://www.phpmyadmin.net
##
## 主机: localhost
## 生成日期: 2013 年 11 月 18 日 16:52
## 服务器版本: 5.6.12-log
## PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

##
## 数据库: `cicms`
##
CREATE DATABASE IF NOT EXISTS `cicms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cicms`;

## ########################################################

##
## 表的结构 `category`
##

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `desc` text,
  `sort` int(11) NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='分类表' AUTO_INCREMENT=1 ;

## ########################################################

##
## 表的结构 `content`
##

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `tags` varchar(45) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `allowComment` tinyint(4) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容表' AUTO_INCREMENT=1 ;

## ########################################################

##
## 表的结构 `node`
##

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `pid` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='节点表' AUTO_INCREMENT=29 ;

##
## 转存表中的数据 `node`
##

INSERT INTO `node` (`id`, `name`, `title`, `pid`, `level`) VALUES
(1, 'admin', '后台管理', 0, 1),
(2, 'user', '用户管理', 1, 2),
(3, 'index', '用户列表', 2, 3),
(4, 'create', '用户添加', 2, 3),
(5, 'update', '用户更新', 2, 3),
(6, 'delete', '用户删除', 2, 3),
(7, 'role', '角色管理', 1, 2),
(8, 'index', '角色列表', 7, 3),
(9, 'create', '角色添加', 7, 3),
(10, 'update', '角色更新', 7, 3),
(11, 'delete', '角色删除', 7, 3),
(12, 'node', '节点管理', 1, 2),
(13, 'index', '节点列表', 12, 3),
(14, 'create', '节点添加', 12, 3),
(15, 'update', '节点更新', 12, 3),
(16, 'delete', '节点删除', 12, 3),
(17, 'authorization', '角色授权', 7, 3),
(18, 'userlist', '角色用户列表', 7, 3),
(19, 'category', '分类管理', 1, 2),
(20, 'index', '分类列表', 19, 3),
(21, 'create', '分类添加', 19, 3),
(22, 'update', '分类更新', 19, 3),
(23, 'delete', '分类删除', 19, 3),
(24, 'content', '内容管理', 1, 2),
(25, 'index', '内容列表', 24, 3),
(26, 'create', '内容添加', 24, 3),
(27, 'update', '内容更新', 24, 3),
(28, 'delete', '内容删除', 24, 3);

## ########################################################

##
## 表的结构 `role`
##

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` text,
  `permission` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=3 ;

##
## 转存表中的数据 `role`
##

INSERT INTO `role` (`id`, `name`, `desc`, `permission`, `status`) VALUES
(1, '超级管理员', '', '1,24,28,27,26,25,19,23,22,21,20,12,16,15,14,13,7,18,17,11,10,9,8,2,6,5,4,3', 1),
(2, '普通管理员', '', '1,24,28,27,26,25,19,23,22,21,20,12,16,15,14,13,7,18,17,11,10,9,8,2,6,5,4,3', 1);

## ########################################################

##
## 表的结构 `user`
##

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL,
  `last_login` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `nickname_UNIQUE` (`nickname`),
  KEY `fk_roles_id` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=3 ;

##
## 转存表中的数据 `user`
##

INSERT INTO `user` (`id`, `role_id`, `username`, `password`, `nickname`, `email`, `status`, `created`, `last_login`) VALUES
(1, 1, 'admin', 'eaeb8c1250f18a13b72c212ceb85f4cfc100f817', 'admin', 'admin@admin.com', 1, 1347353245, 0),
(2, 2, 'leeyong', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'leeyong', 'leeyongit@163.com', 1, 1347540069, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
