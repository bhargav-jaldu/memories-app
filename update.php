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

$updateId = 0;
$updateBtn = false;

$editCreator = '';
$editTitle = '';
$editMessage = '';
$editTags = '';
$editImageUrl = '';

if(isset($_GET['edit'])) {
    $updateBtn = true;

    $id = $_GET['edit'];
    $sessionName = $_SESSION['email'];

    $sql = "SELECT * FROM `cards` WHERE id='$id' AND sessionName='$sessionName'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $select = "SELECT * from cards where id = $id";
        $result =  mysqli_query($conn, $select);
        $results = mysqli_fetch_assoc($result);
        
        $editCreator = $results['creator'];
        $_SESSION['creator'] = $editCreator;
        $editTitle = $results['title'];
        $editMessage = $results['messagee'];
        $editTags = $results['tags'];
        $editImageUrl = $results['imageUrl'];
    } else {
        ?>
    <div class="wrap">
        <div class="hold">
            <h3>You can't EDIT this because it was not created by you!</h3>
            <div class='ok'>
                <button class="button okbtn">OK</button>
            </div>
        </div>
    </div>

    <?php
    }
}

if(isset($_POST['updateCard'])) {
    $updateId = $_GET['edit'];

    $updateCreator = mysqli_real_escape_string($conn,$_POST['creator']);
    $updateTitle = mysqli_real_escape_string($conn,$_POST['title']);
    $updateMessage = mysqli_real_escape_string($conn, $_POST['message']);
    $updateTags = mysqli_real_escape_string($conn,$_POST['tags']);
    // $updateImageUrl = $_POST['image'];
    // echo $updateImageUrl;

    $update = "UPDATE cards SET creator='$updateCreator', title='$updateTitle', messagee='$updateMessage', tags='$updateTags' WHERE id=$updateId ";
    mysqli_query($conn, $update);

    header("location: memories.php");
}


if(isset($_POST['clear'])) {
    $editCreator = '';
    $editTitle = '';
    $editMessage = '';
    $editTags = '';
    $editImageUrl = '';
}

?>

    <script>
    const okbtn = document.querySelector('.okbtn');
    okbtn.addEventListener('click', () => {
        location.href = 'memories.php?page=<?php echo $page ?>';
    })
    </script>
</body>

</html>