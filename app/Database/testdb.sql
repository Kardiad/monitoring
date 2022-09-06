drop database if exists monitoringtest;
create database monitoringtest;
use monitoringtest;

create table users (
  id int unsigned primary key auto_increment,
  username varchar(20),
  pwd varchar(20)
);

INSERT INTO users(username, pwd) VALUES ('user1', 'Aqwe1!');