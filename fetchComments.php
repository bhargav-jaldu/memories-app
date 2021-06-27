<?php

include "dbcon.php";

function fetchComments($post_id) {
    global $conn;

    $fetch = "SELECT * FROM comments WHERE post_id='$post_id'";
    $fetchResults = mysqli_query($conn, $fetch);

    $data = array();

    if(mysqli_num_rows($fetchResults) > 0) {
        while($row = mysqli_fetch_assoc($fetchResults)) {
            $data[] = $row;
        }
    }

    // convert into json
    print_r(json_encode(end($data)));
}