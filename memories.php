<?php

// session_start();
include "dbcon.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginForm.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="memories.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <title>Memories.php</title>
</head>

<body>

    <?php

    $liked = false;

include('memoriesHeader.php');

if(isset($_SESSION['email'])) {
    echo "Welcome " . $_SESSION['email'];
} else {
    header('location: index.php');
}

include "update.php";


// include "search.php";    

?>

    <div class="memories-c">
        <?php include "cards.php"; ?>
        <div>
            <!-- Search container -->
            <form class="search-c" action="search.php" method="POST">
                <div class="search">
                    <h3>Seach for a post</h3>
                    <div class="form-contro">
                        <div class="email">
                            <input type="text" name="search-title" required />
                            <label>Title</label>
                        </div>
                    </div>

                    <!-- <div class="form-contro">
                        <div class="password">
                            <input type="text" />
                            <label>Tags</label>
                        </div>
                    </div> -->

                    <button class="button" name="search">Search</button>
                </div>
            </form>
            <!-- Search container -->
            <!-- Form -->
            <form method='POST' class="form-c" enctype="multipart/form-data">
                <h2>Create a memory</h2>
                <div class="form-contro">
                    <div class="creator">
                        <input type="text" name="creator" value="<?php echo $editCreator ?>" required />
                        <label>Creator *</label>
                    </div>
                </div>
                <div class="form-contro">
                    <div class="title">
                        <input type="text" name="title" value="<?php echo $editTitle ?>" required />
                        <label>Title *</label>
                    </div>
                </div>
                <div class="form-contro">
                    <div class="message">
                        <input type="text" name="message" value="<?php echo $editMessage ?>" required />
                        <label>Message *</label>
                    </div>
                </div>
                <div class="form-contro">
                    <div class="tags">
                        <input type="text" name="tags" value="<?php echo $editTags ?>" required />
                        <label>Tags(comma separted) *</label>
                    </div>
                </div>
                <?php
if($updateBtn) {
    ?>
                <div>
                    <input type="file" name="image" class="image hidden">
                </div>
                <?php
} else {
    ?>
                <div>
                    <input type="file" name="image" class="image">
                </div>
                <?php
}
                ?>

                <?php 
if($updateBtn) {
    ?>
                <!-- Updata btn -->
                <div>
                    <button type="submit" name="updateCard" class="button update">UPDATE</button>
                </div>
                <?php
} else {
    ?>
                <div>
                    <button type="submit" name="createCard" class="button">SUBMIT</button>
                </div>
                <?php
}
                ?>



                <div>
                    <button class="button clear" name="clear">CLEAR</button>
                </div>
            </form>
            <!-- Pagination -->
            <div class="pages-c">
                <?php // Display links on the page
for($page = 1;$page <= $number_of_pages;$page++) {
    ?>

                <div class="pages">
                    <a href="memories.php?page=<?php echo $page ?>"><?php echo $page ?></a>
                </div>

                <?php
} ?>
            </div>
        </div>
    </div>


    <script src="buttons.js"></script>
</body>

</html>