<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="delete.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php

include "dbcon.php";

include "pageNo.php";

session_start();

if(isset($_GET['id'])) {
    // echo "<script>alert('hello')</script>";

    $id = $_GET['id'];
    $sessionName = $_SESSION['email'];

    $sql = "SELECT * FROM `cards` WHERE id='$id' AND sessionName='$sessionName'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $delete = "DELETE from cards WHERE id = $id";
    
        $deleted = mysqli_query($conn, $delete);
        if($deleted) {
            ?>
    <div class="wrap">
        <div class="hold">
            <h3>DELETED SUCCESFULLY</h3>
            <div class='ok'>
                <button class="button okbtn">OK</button>
            </div>
        </div>
    </div>
    <?php
        } else {
            echo "Not deleted";
        }
    } else {
        ?>
    <div class="wrap">
        <div class="hold">
            <h3>You can't delete this because it was not created by you!</h3>
            <div class='ok'>
                <button class="button okbtn">OK</button>
            </div>
        </div>
    </div>

    <?php
    }
}

?>

    <script src="buttons.js"></script>

    <script>
    const okbtn = document.querySelector('.okbtn');
    okbtn.addEventListener('click', () => {
        location.href = 'memories.php?page=<?php echo $page ?>';
    })
    </script>
</body>

</html>