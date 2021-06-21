<div class='card'>
    <img src="uploads/<?php echo "$row[imageUrl]" ?>" alt="">
    <div class="overlay"></div>
    <div class='title-flex'>
        <div>
            <h3><?php echo $row['creator'] ?></h3>
            <p class="time"><?php echo time_elapsed_string($row['time']);?></p>
        </div>
        <div>
            <a href="memories.php?page=<?php echo $page ?>&edit=<?php echo $row['id']; ?>" name="editBtn"
                class="edit">EDIT</a>
        </div>
    </div>

    <p class='tags-card'><?php $array = explode(",", $row['tags']); 
                               for($i = 0;$i<count($array);$i++) {
                                   echo "#" . $array[$i] . " ";
                               }
        ?></p>
    <h3 class='title-card'><?php echo $row['title'] ?></h3>
    <p class='message-card'><?php echo $row['messagee'] ?></p>
    <div class='button-flex'>
        <a href="like.php?likeId=<?php echo $row['id']; ?>" class="likeBtn"><?php 
        $sqll = "SELECT COUNT(*) as total FROM `likes` WHERE session_name='{$_SESSION['email']}' AND post_id='{$row['id']}' AND likes = '1'";
        $resulttt=mysqli_query($conn,$sqll);
        $data=mysqli_fetch_assoc($resulttt);
        if($data['total'] > 0) {
            echo "<i class='fas fa-thumbs-up like'></i> You and";
        } else {
            echo "<i class='far fa-thumbs-up like'></i>";
        }
        $sql = "SELECT COUNT(*) as totalLikes FROM likes WHERE post_id='{$row['id']}' AND likes = '1'";
        $results = mysqli_query($conn, $sql);
        $dataa = mysqli_fetch_assoc($results);
        $likes = $dataa['totalLikes'] - 1;
        if($likes == -1) {
            echo "";
        } else {
            echo " $likes Other";
        }
        ?></a>
        <a href="delete.php?id=<?php echo $row['id']; ?>&page=<?php echo $page ?>" class="delete"><i
                class="fas fa-trash"></i></a>
        <a href="view.php?view=<?php echo $row['id']; ?>" class="view">VIEW</a>
    </div>
</div>