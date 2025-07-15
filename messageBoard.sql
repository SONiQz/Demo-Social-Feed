/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.13-MariaDB-1:10.4.13+maria~focal : Database - messageBoard
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`s1902834_messageBoard` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `s1902834_messageBoard`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `articleId` int(8) NOT NULL AUTO_INCREMENT,
  `articleSubject` varchar(64) NOT NULL,
  `articleDate` datetime NOT NULL,
  `articleCategory` int(8) NOT NULL,
  `articleUser` int(8) NOT NULL,
  PRIMARY KEY (`articleId`),
  KEY `articleCategory` (`articleCategory`),
  KEY `articleUser` (`articleUser`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`articleCategory`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `article_ibfk_2` FOREIGN KEY (`articleUser`) REFERENCES `users` (`userId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `categoryId` int(8) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(64) NOT NULL,
  `categoryDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`categoryId`),
  UNIQUE KEY `categoryName_unique` (`categoryName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `postId` int(8) NOT NULL AUTO_INCREMENT,
  `postContent` text NOT NULL,
  `postLocation` varchar(255) DEFAULT NULL,
  `postDate` datetime NOT NULL,
  `postArticle` int(8) NOT NULL,
  `postUser` int(8) NOT NULL,
  PRIMARY KEY (`postId`),
  KEY `postArticle` (`postArticle`),
  KEY `postUser` (`postUser`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`postArticle`) REFERENCES `article` (`articleId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`postUser`) REFERENCES `users` (`userId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userId` int(8) NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `userEmail` varchar(64) NOT NULL,
  `userDate` datetime NOT NULL,
  `userLevel` int(8) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userName_unique` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
