<?php

session_start();
include "dbcon.php";

if(isset($_POST['to_id']) && isset($_POST['message'])) {
    $toId = $_POST['to_id'];

    // want from id (that is sender)
    $sessionName = $_SESSION['email'];
    $query = "SELECT id FROM memoriesapp WHERE email='$sessionName'";
    $result = mysqli_query($conn, $query);

    $fromIdArray = mysqli_fetch_assoc($result);
    $fromId = $fromIdArray['id'];

    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // insert into the table (chat)
    $insert = "INSERT INTO chat (from_address, to_address, `message`) VALUES ('$fromId', '$toId', '$message')";
    $insertResult = mysqli_query($conn, $insert);

    if($insertResult) {
        echo "success";
    } else {
        echo "nope not inserted chat" . mysqli_error($conn);
    }
}