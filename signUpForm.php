<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginForm.css?v=<?php echo time(); ?>">
    <title>SignUp</title>
</head>

<body>

    <?php
include "header.php";
?>

    <form class="wrapper" action="process.php" method="POST">
        <div class="login-container">
            <img src="signin.png" alt="" class="signinlogo">
            <h1>Sign Up</h1>

            <div class="form-contro">
                <div class="email">
                    <input type="text" name="username" required />
                    <label>Username *</label>
                </div>
            </div>

            <div class="form-contro">
                <div class="email">
                    <input type="email" name="email" required />
                    <label>Email Address *</label>
                </div>
            </div>

            <div class="form-contro">
                <div class="password">
                    <input type="text" name="password" required />
                    <label>Password *</label>
                </div>
            </div>

            <div class="form-contro">
                <div class="email">
                    <input type="text" name="cpassword" required />
                    <label>Confirm Password *</label>
                </div>
            </div>

            <button type="submit" name="signup" class="button">SIGN UP</button>
            <a href="loginForm.php" class="dont">ALREADY HAVE AN ACCOUNT? SIGN IN</a>
        </div>
    </form>

    <?php

    if(@$_GET['exit']) {
        ?>

    <h3 class='errormsg'><?php echo $_GET['exit']; ?></h3>;

    <?php
    }

?>

    <script src="buttons.js"></script>

</body>

</html>