<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<style>
.session-logo {
    background-color: rebeccapurple;
    color: #eee;
    padding: 5px;
    height: 40px;
    width: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 19px;
}
</style>

<body>
    <header>
        <form class="container" method="POST">
            <div class="title-c">
                <h1>Memories</h1>
                <img src="logo.png" alt="">
            </div>
            <?php
            $sessionName = $_SESSION['email'];
            ?>
            <h4 class="session-logo"><?php echo strtoupper(substr($sessionName, 0, 1)); ?></h4>
            <button type="submit" name="logout" class="button header-btn">LOGOUT</button>
        </form>
    </header>

    <?php


if(isset($_POST['logout'])) {
session_destroy();

header('location: index.php');
}
    ?>

</body>

</html>