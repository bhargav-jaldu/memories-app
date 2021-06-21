<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginForm.css?v=<?php echo time(); ?>">
    <title>Login Form</title>
</head>

<body>

    <?php
include('header.php');
include('dbcon.php');
?>

    <form class="wrapper" action="process.php" method="POST">
        <div class="login-container">
            <img src="signin.png" alt="" class="signinlogo">
            <h1>Sign in</h1>

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

            <button type="submit" class="button" name="signin">SIGN IN</button>
            <a href="signUpForm.php" class="dont">DON'T HAVE AN ACCOUNT? SIGN UP</a>
        </div>
    </form>

    <script src="buttons.js"></script>

    <?php
if(@$_GET['Invalid']) {
    echo "<h3 class='errormsg'>Invalid credentails</h3>";
}
?>

</body>

</html>