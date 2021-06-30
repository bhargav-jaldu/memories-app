<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="memories.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

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


    <div class="cards-c">
        <?php
include "dbcon.php";


// PAGENATION

include "pagenation.php";

if(isset($_POST['createCard'])) {
    ?>
        <script>
        location.href = 'memories.php?page=<?php echo $_SESSION['num_of_pages'] ?>';
        </script>
        <?php
    $creator = mysqli_real_escape_string($conn, $_POST['creator']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    $file = $_FILES['image'];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode(".", $fileName);

    $fileNewExt = strtolower(end($fileExt));
    

    $allowed = array('jpg', 'jpeg', 'png', 'PNG');

    if(in_array($fileNewExt, $allowed)) {
        if($fileError == 0) {
            if($fileSize < 1000000) {
                $fileNewName = uniqid('', true). '.'. $fileNewExt;
                 $fileDestination = 'uploads/'.$fileNewName;
                 move_uploaded_file($fileTmpName, $fileDestination);
                 $email = $_SESSION['email'];
                // Insert into db
              $sql = "INSERT INTO cards (sessionName, creator, title, messagee, tags, imageUrl) VALUES ('$email', '$creator','$title', '$message', '$tags', '$fileNewName')";
              $result = mysqli_query($conn, $sql);

            //   Fetch results;
            $query = "SELECT * FROM cards ORDER by id DESC limit 1";
            $results = mysqli_query($conn, $query);

            if(mysqli_num_rows($results) > 0) {
                while($row = mysqli_fetch_assoc($results)) {
                    ?>
        <?php include "card.php"; ?>
        <?php
                }
            }
            } else {
                echo "<script>alert('The image is too large')</script>";
            }
        } else {
            echo "<script>alert('something went wrong')</script>";
        }
    } else {
        echo "<script>alert('This image format is not allowed')</script>";
    }
} 

?>
    </div>



</body>

</html>


<!-- CREATE TABLE `memoriesapp`.`cards` ( `id` INT NOT NULL AUTO_INCREMENT , `sessionName` VARCHAR(255) NOT NULL , `creator` VARCHAR(255) NOT NULL , `title` VARCHAR(255) NOT NULL , `messagee` VARCHAR(255) NOT NULL , `tags` VARCHAR(255) NOT NULL , `imageUrl` VARCHAR(255) NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->