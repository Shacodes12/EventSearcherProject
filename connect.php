<?php

// credential..
$host = 'localhost';
$user ='root';
$database='project';
$pass="";


$_SESSION['errors'] = [];
$_SESSION['success'] = [];




// $errors
$errors =[];
$success =[];


// create a connection variable
$conn  =mysqli_connect($host , $user , $pass);
// check if connection was successfully
if(!$conn){
  echo "Cannot connect to db ".mysqli_connect_error();
}
else{

  // create database
  $cat1 = "CREATE DATABASE  IF NOT EXISTS project";

  if (!mysqli_query($conn , $cat1)){
    echo "Unable to create db <br>";
  }
  else{
    // select database
    mysqli_select_db($conn , $database);

    // create table
    $tbl1 = "CREATE TABLE IF NOT EXISTS Users(id int auto_increment,phone varchar(100),lastOnline TIMESTAMP ,dob TIMESTAMP DEFAULT CURRENT_TIMESTAMP , username varchar(200) UNIQUE, address varchar(250) not null ,email varchar(100) UNIQUE,country varchar(100) not null ,gender varchar(25) not null , password varchar(255) not null,created TIMESTAMP DEFAULT CURRENT_TIMESTAMP , isAdmin int DEFAULT 0 ,primary key(id))";

    // execute
    if (!mysqli_query($conn , $tbl1)){
      echo "Unable to create table <br>".mysqli_error($conn);
      die("Unable to create thge database");
    }


// // event1
    $tbl_event = "CREATE TABLE IF NOT EXISTS Events(eventId varchar(200) not null, likes int not null DEFAULT 0, title varchar(240) not null , description varchar(1000) not null ,organizer_name varchar(200) not null , postedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP , eventAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP , location varchar(100) , image BLOB ,total_tickets int DEFAULT 100 ,primary key(eventId))";

    // execute
    if (!mysqli_query($conn , $tbl_event)){
      echo "Unable to create event table <br>".mysqli_error($conn);
      die("Unable to create thge database");
    }

    // attendees'
    $tbl_attendee = "CREATE table if not EXISTS Atendee(ticket_number varchar(200) not null , eventId varchar(200) not null , userId varchar(200) not null , time_booked datetime DEFAULT CURRENT_TIMESTAMP , primary key(ticket_number))";


    // execute
    if (!mysqli_query($conn , $tbl_attendee)){
      echo "Unable to create Atendees table <br>".mysqli_error($conn);
      die("Unable to create thge database");
    }


    // create FAQS table
    $tbl5 = "CREATE TABLE IF NOT EXISTS Faqs(id int unique auto_increment , name varchar(100) not null, email varchar(100)  , message varchar(500) , answer varchar(500) ,addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,primary key(id))";

    // execute
    if (!mysqli_query($conn , $tbl5)){
      echo "Unable to create FAQs table <br>".mysqli_error($conn);
      die("Unable to create thge database");
      return;
    }


    $tbl6 = "CREATE TABLE IF NOT EXISTS Testimonies(id int unique auto_increment , name varchar(300) , testimony varchar(1000) ,primary key(id) )";
    // execute
    if (!mysqli_query($conn , $tbl6)){
      echo "Unable to create testimonies table table <br>".mysqli_error($conn);
      die("Unable to create thge database");
      return;
    }

  }


}
