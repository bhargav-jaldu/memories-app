<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="memories.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<style>
/* button */
body {
    font-family: "Poppins";
}

.button.back {
    border: none;
    outline: none;
    padding: 10px 20px;
    background-color: blue;
    color: #eee;
    border-radius: 3px;
    margin-top: 5px;
    cursor: pointer;
    display: block;
    overflow: hidden;
    position: relative;
    display: inline-block;
    width: 90px;
    margin-left: 100px;
}

span {
    position: absolute;
    background-color: #fff;
    transform: translate(-50%, -50%);
    pointer-events: none;
    border-radius: 50%;
    animation: animate 1s linear infinite;
}

@keyframes animate {
    0% {
        width: 0px;
        height: 0px;
        opacity: 0.5;
    }

    100% {
        width: 500px;
        height: 500px;
        opacity: 0;
    }
}

a {
    text-decoration: none;
}

.cards-c {
    max-width: 1350px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
}


.found {
    background-color: white;
    padding: 20px;
    box-shadow: 0 7px 30px -10px rgba(86, 110, 122, 0.5);
    text-align: center;
}
</style>

<body>

    <?php
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
?>

    <?php
include "memoriesHeader.php";

?>

    <a href="memories.php" class="button back">BACK</a>


    <div class="cards-c">


        <?php

include "dbcon.php";
$page = 1;




if(isset($_POST['search'])) {
    // echo "<script>alert('hello')</script>";

    $searchq = $_POST['search-title'];
    // $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

    $query = "SELECT * from cards WHERE title LIKE '%$searchq%'";
    $result = mysqli_query($conn, $query);

    // $re = mysqli_fetch_all($result);
    

    if(mysqli_num_rows($result) == 0) {
        ?>
        <h2 class="found">Nothing Found</h2>
        <?php
    } else {
        while($row = mysqli_fetch_assoc($result)) {
            ?>

        <?php include "card.php"; ?>

        <?php
        }
    }
}

include "update.php";
// include "like.php";

?>
</body>

</html>