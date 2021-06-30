<?php
session_start();
include 'dbcon.php';

if(isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM memoriesapp WHERE email='$email' AND cpassword='$password'";
    $insertStatus = "UPDATE memoriesapp SET `status` = 'Active' WHERE email='$email' AND cpassword='$password'";
    $results = mysqli_query($conn, $sql);

    // execute insertStatus
    $exec = mysqli_query($conn, $insertStatus);

    if(mysqli_fetch_assoc($results)) {
        $_SESSION['email'] = $email;
        header('location: memories.php');
    } else {
        header('location: loginForm.php?Invalid=Invalid Login Credentails');
    }
} else {
    echo "Something went wrong";
}



if(isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password == $cpassword) {
       $query = "SELECT * FROM memoriesapp";
       $results = mysqli_query($conn, $query);
       while($row = mysqli_fetch_assoc($results)) {
           if($row['username'] == $username || $row['email'] == $email) {
               header("location: signUpForm.php?exit=Username or email is already exit");
               exit();
           }
       }

           $sql = "INSERT INTO memoriesapp (username, email, passwordd, cpassword) VALUES ('$username', '$email',' $password', '$cpassword')";
           $result = mysqli_query($conn,$sql);
           echo "<h3 class='success-register'>Successfully Registered!! Click On Login to login</h3>";
           header("location: signUpForm.php?exit=Successfully Registerd!! ");
       // if($result) {
       //     echo "Registed";
       // } else {
       //     echo "Something went wrong";
       // }
   } else {
       header("location: signUpForm.php?exit=Passwords doesn't match");
   }
}

?>