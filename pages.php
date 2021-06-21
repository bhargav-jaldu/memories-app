<?php


// PAGENATION
$results_per_page = 6;

$query = "SELECT * from cards";
$results = mysqli_query($conn, $query);

$number_of_results = mysqli_num_rows($results);

$number_of_pages = ceil($number_of_results / $results_per_page);
$_SESSION['num_of_pages'] = ceil($number_of_results / $results_per_page);