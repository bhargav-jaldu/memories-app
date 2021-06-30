<?php

session_start();
include "dbcon.php";


if(isset($_GET['action'])){
    if($_GET['action']=="logout") {
      //do whatever you wanna do
      $email = $_SESSION['email'];
      $update = "UPDATE memoriesapp SET `status`='not-active' WHERE email='$email'";
      $exec = mysqli_query($conn, $update);
  
      session_destroy();

      echo "logout";exit;
    }
  }

// if(isset($_POST['email'])) {
//     $email = $_SESSION['email'];
//     $update = "UPDATE memoriesapp SET `status`='not-active' WHERE email='$email'";
//     $exec = mysqli_query($conn, $update);

//     session_destroy();


//     header('location: index.php');
// }