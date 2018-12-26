SETUP APPLICATION
1. rename env.sample to .env 
2. set connection db inside file .env in root with your db credentials
3. create database and table from create.sql

LIST FILE
cron.php        =>  File for execute cron and scrape url from twitter
preview.php     =>  File for preview data scrape with table layout     
scrape_form.php =>  File for input data target twitter profile

FLOW
1. input data twitter username target in url: scrape_form.php 
2. Set url : cron.php in crontab (1 minute duration -> 60 data twitter scraped per hour)
3. Preview data in url : preview.php

Server requirement:
- php curl library