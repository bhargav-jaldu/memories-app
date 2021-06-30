<?php

session_start();
include "dbcon.php";

if(isset($_POST['to_id'])) {
    $toId = $_POST['to_id'];

    // want from id (that is sender)
    $sessionName = $_SESSION['email'];
    $query = "SELECT id FROM memoriesapp WHERE email='$sessionName'";
    $result = mysqli_query($conn, $query);

    $fromIdArray = mysqli_fetch_assoc($result);
    $fromId = $fromIdArray['id'];

    $sql = "SELECT * FROM chat WHERE (from_address='$fromId' AND to_address='$toId') OR (from_address='$toId' AND to_address='$fromId') ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);

    $output = '';

    if(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            if($row['from_address'] === $fromId) { // sender
                $output .= "
                <div class='sender'>
                    <p>{$row['message']}</p>
                </div>
                ";
            } else {
                $output .= "
                <div class='reciever'>
                    <p>{$row['message']}</p>
                </div>
                ";
            } // reciever
        }
    echo $output;
    }

}

?>