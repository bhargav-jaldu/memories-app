<?php
    include "dbcon.php";

    if(isset($_POST['userId'])) {
        $userId = $_POST['userId'];

        $fetch = "SELECT * FROM memoriesapp WHERE id='$userId'";
        $results = mysqli_query($conn, $fetch);

        $user = mysqli_fetch_assoc($results);

        echo "
        <h3> {$user['username']} </h3>
        <small> {$user['status']} </small>
        ";
    }
?>