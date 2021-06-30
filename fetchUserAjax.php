<?php

session_start();
include "dbcon.php";

$email = $_SESSION['email'];

// fetch all users
$fetch = "SELECT * FROM memoriesapp WHERE email!='$email'";
$users = mysqli_query($conn, $fetch);

if(mysqli_num_rows($users) > 0) {
    while($row = mysqli_fetch_assoc($users)) {

        if($row['status'] == 'Active') {
            echo "
            <div class='user d-flex justify-content-between align-items-center' name='user' data-id='{$row['id']}'>
            <div>
                <h3> {$row['username']}</h3>
                <small>This is text message</small>
            </div>
            <a href='user.php?userId={$row['id']}' class='chatBtn'>CHAT</a>
            <div class='greenDot' title='online'></div>
            </div>
            <hr>";
        } else {
            echo "
            <div class='user d-flex justify-content-between align-items-center' name='user' data-id='{$row['id']}'>
            <div>
                <h3> {$row['username']}</h3>
                <small>This is text message</small>
            </div>
            <a href='user.php?userId={$row['id']}'  class='chatBtn'>CHAT</a>
            <div class='greyDot' title='offline'></div>
            </div>
            <hr>";
        }
    }
} else {
    echo "No users";
}