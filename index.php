<?php
$_SESSION['email'] = 'hello';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="loginForm.css?v=<?php echo time();?>">
    <title>Index Page</title>
</head>

<style>
.sentence {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 7px 30px -10px rgba(86, 110, 122, 0.5);
}



.flex {
    display: flex;
    justify-content: space-around;
    align-items: center;
}

/* Check this furthur */
.right-side {
    max-width: 400px;
    min-height: 700px;
}

.button.delete {
    pointer-events: none;
    opacity: 0.5;
}

.edit {
    pointer-events: none;
    opacity: 0.5;
}

.button.search {
    pointer-events: none;
    opacity: 0.6;
}

.flex {
    max-width: 1350px;
    margin: auto;
    display: flex;
    flex-wrap: wrap;
}

.view {
    pointer-events: none;
    opacity: 0.6;
}

.likeBtn {
    pointer-events: none;
    opacity: 0.6;
}

.delete {
    pointer-events: none;
    opacity: 0.6;
}
</style>

<body>

    <?php
include "header.php";

?>


    <div class="flex">
        <?php include 'cards.php' ?>
        <div class="right-side">
            <form class="search-c">
                <div class="search">
                    <h3>Seach for a post</h3>
                    <div class="form-contro">
                        <div class="email">
                            <input type="text" required />
                            <label>Title</label>
                        </div>
                    </div>

                    <!-- <div class="form-contro">
                        <div class="password">
                            <input type="text" required />
                            <label>Tags</label>
                        </div>
                    </div> -->

                    <button class="button search">Search</button>
                </div>
            </form>

            <div class="sentence">
                <p>Please signin to view all the memories -- create your own memory and like other memories</p>
            </div>

            <!-- PAGINATION -->
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