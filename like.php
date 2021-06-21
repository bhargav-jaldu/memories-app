<?php

session_start();


include "dbcon.php";
include "pageNo.php";

if(isset($_GET['likeId'])) {
    $session_name = $_SESSION['email'];
    $postId = $_GET['likeId'];

    $select = "SELECT * from likes WHERE session_name='$session_name' AND post_id = '$postId' AND likes='1'";
    $re = mysqli_query($conn, $select);
    if(mysqli_num_rows($re) > 0) {
        $delete = "DELETE FROM likes WHERE session_name='$session_name' AND post_id = '$postId' AND likes='1'";
        $exe = mysqli_query($conn, $delete);
    } else {
        $sql = "INSERT INTO likes (session_name, post_id, likes) VALUES ('$session_name', '$postId', '1')";
        $result = mysqli_query($conn, $sql);
    }
}


header("location: memories.php?page=$page");

?>