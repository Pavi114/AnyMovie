<?php
 $servername = 'localhost';
 $username = 'root';
 $password = 'idc1234';
 $database = 'omdb';

 $conn = mysqli_connect($servername,$username,$password);
 if($conn->connect_error){
 	die("Connection failed");
 }

 $query = 'CREATE DATABASE '.$database;
 $con = $conn->query($query);

 $con = mysqli_connect($servername,$username,$password,$database);
 
 $query = 'CREATE TABLE IF NOT EXISTS user(
           id INT AUTO_INCREMENT PRIMARY KEY,
           username VARCHAR(60) NOT NULL,
           password VARCHAR(150) NOT NULL,
           name VARCHAR(60) NOT NULL
       )';
 if(!mysqli_query($con,$query)){
 	die('connection error');
 }
 

 $query = 'CREATE TABLE IF NOT EXISTS favourites(
           id INT AUTO_INCREMENT PRIMARY KEY,
           userId INT NOT NULL,
           imdbId VARCHAR(20) NOT NULL,
           FOREIGN KEY (userId) REFERENCES user(id)
       )';

  if(!mysqli_query($con,$query)){
 	die('connection error');
 }

 $query = 'CREATE TABLE IF NOT EXISTS marks(
           id INT AUTO_INCREMENT PRIMARY KEY,
           user_id INT NOT NULL,
           imdb_id VARCHAR(20) NOT NULL,
           FOREIGN KEY (user_id) REFERENCES user(id)
       )';

 if(!mysqli_query($con,$query)){
 	die('connection error');
 }

 $query = 'CREATE TABLE IF NOT EXISTS watched(
           id INT AUTO_INCREMENT PRIMARY KEY,
           user_id INT NOT NULL,
           imdb_id VARCHAR(20) NOT NULL,
           FOREIGN KEY (user_id) REFERENCES user(id)
         )';
         
if(!mysqli_query($con,$query)){
  die('connection error');
 }  

 $query = 'CREATE TABLE IF NOT EXISTS activity(
           id INT AUTO_INCREMENT PRIMARY KEY,
           user_id INT NOT NULL,
           message VARCHAR(120) NOT NULL,
           FOREIGN KEY (user_id) REFERENCES user(id)
           )';
if(!mysqli_query($con,$query)){
  die('connection error');
 }  