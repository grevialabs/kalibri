CREATE DATABASE scrape;

USE scrape;

CREATE TABLE scr_group
(
group_id INT NOT NULL AUTO_INCREMENT,
name varchar(120) NULL DEFAULT NULL,
keyword_list varchar(220) NULL DEFAULT NULL,
total_keyword varchar(5) NULL DEFAULT NULL,
PRIMARY KEY(group_id)
)
COLLATE='utf8mb4_general_ci';

CREATE TABLE scr_username
(
username_id INT NOT NULL AUTO_INCREMENT,
username varchar(150) NULL DEFAULT NULL,
fullname text NULL DEFAULT NULL,
follower varchar(15) NULL DEFAULT NULL,
following varchar(15) NULL DEFAULT NULL,
biodata text NULL DEFAULT NULL,
location text NULL DEFAULT NULL,
join_date datetime NULL DEFAULT NULL,
profilepic varchar(220) NULL DEFAULT NULL,
sumlikes varchar(15) NULL DEFAULT NULL,
sumtweets varchar(15) NULL DEFAULT NULL,
url varchar(150) NULL DEFAULT NULL,
is_scrape tinyint NULL DEFAULT 0,
creator_date datetime NULL DEFAULT NULL,
PRIMARY KEY(username_id)
) 
COLLATE='utf8mb4_general_ci'
ENGINE=MyISAM;

CREATE TABLE scr_scrape
(
scrape_id BIGINT AUTO_INCREMENT,
username varchar(150) NULL DEFAULT NULL, 
post_content varchar(240) NULL DEFAULT NULL, 
post_gallery varchar(240) NULL DEFAULT NULL, 
post_date varchar(140) NULL DEFAULT NULL, 
post_link varchar(140) NULL DEFAULT NULL, 
post_tag varchar(140) NULL DEFAULT NULL, 
post_user varchar(140) NULL DEFAULT NULL,
is_scrape tinyint NULL DEFAULT 0,
creator_date datetime NULL DEFAULT NULL,
PRIMARY KEY(scrape_id)
) COLLATE='utf8mb4_general_ci';

CREATE TABLE scr_post_twitter
(
post_twitter_id BIGINT AUTO_INCREMENT,
url varchar(130) NULL DEFAULT NULL,
matched_keyword varchar(100) NULL DEFAULT NULL,
status tinyint NULL DEFAULT 0,
creator_date datetime NULL DEFAULT NULL,
PRIMARY KEY(post_twitter_id)
) COLLATE='utf8mb4_general_ci';