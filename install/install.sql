drop table if exists `categories`, `news`, `page`, `users`, `user_groups`;

CREATE TABLE `categories` (
    `id` int not null AUTO_INCREMENT PRIMARY KEY ,
    `title` varchar(65) NOT NULL,
    `parent_id` INT NULL default null
) DEFAULT CHARSET=utf8 COMMENT='Categories Table';

CREATE TABLE `navigation` (
    `id` int not null AUTO_INCREMENT PRIMARY KEY ,
    `name` varchar(65) NOT NULL,
    `parent_id` INT NULL default null
) DEFAULT CHARSET=utf8 COMMENT='Navigation Table';


CREATE TABLE `news` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` varchar(65) NOT NULL,
    `slug` varchar(256) NOT NULL,
    `author` varchar(65) NOT NULL,
    `status` varchar(65) NOT NULL,
    `category` varchar(65) NOT NULL,
    `excerpt` TEXT NOT NULL,  
    `content` TEXT NOT NULL,
    `published_date` DATETIME NOT NULL, 
    `modified_date` DATETIME NOT NULL
) DEFAULT CHARSET=utf8 COMMENT='News Table';

CREATE TABLE `page` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` varchar(65) NOT NULL,
    `slug` varchar(256) NOT NULL,
    `author` varchar(65) NOT NULL,
    `status` varchar(65) NOT NULL,
    `content` TEXT NOT NULL,
    `published_date` DATETIME NOT NULL, 
    `modified_date` DATETIME NOT NULL
) DEFAULT CHARSET=utf8 COMMENT='Pages Table';

CREATE TABLE `users` (
    `username` VARCHAR(65) NOT NULL PRIMARY KEY default '',
    `password` VARCHAR(32) NOT NULL default '',
    `realname` varchar(256) NOT NULL default '',
    `email` varchar(256) NOT NULL default '',
    `activated` int(1) NOT NULL default '0',
    `permission_level` int(1) NOT NULL default '0'
) DEFAULT CHARSET=utf8 COMMENT='User Table';

CREATE TABLE `user_groups` (
    `group_id` int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
    `group_name` varchar(255) NOT NULL default '',
    `group_description` text NOT NULL
) DEFAULT CHARSET=utf8 COMMENT='User Groups Table';

INSERT INTO `categories` VALUES(1,'Uncategorized',NULL);
INSERT INTO `user_groups` VALUES( 1,'Administrator','Site Administrator''s Group'),
                                ( 2,'Developer', 'The power to create, but not destroy'),
                                ( 3,'Editor', 'Basic access. Create and edits own articles' );
