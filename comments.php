<?php

include "dbcon.php";
include "fetchComments.php";

session_start();

if(isset($_POST['postId']) && isset($_POST['uComment'])) {

    if(strlen($_POST['uComment']) == 0) {
        echo "Please fill this field";
    } else {
        $sessionName = $_SESSION['email'];
        $getSessionName = "SELECT username FROM memoriesapp WHERE email='$sessionName'";
        $run = mysqli_query($conn, $getSessionName);
        $name = mysqli_fetch_assoc($run);
    
        $userName = $name['username'];
    
        $postId = $_POST['postId'];
    
        $comments = $_POST['uComment'];
    
        $insert = "INSERT INTO comments (sessionName, post_id, comment) VALUES ('$userName', '$postId', '$comments')";
        $results = mysqli_query($conn, $insert);
    
        if(!$results) {
            echo "not inserted";
        }
    
        fetchComments(($postId));
    }
}