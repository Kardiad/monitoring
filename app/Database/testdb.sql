drop database if exists monitoringtest;
create database monitoringtest;
use monitoringtest;

create table users (
  id int unsigned primary key auto_increment,
  username varchar(20),
  email VARCHAR(50),
  pwd varchar(20)
);

INSERT INTO users(username, email, pwd) VALUES ('asd', 'asd@mail.com', 'asd'), ('admin', 'ericapastorgracia@gmail.com', 'qwerty7');

SELECT * FROM users;