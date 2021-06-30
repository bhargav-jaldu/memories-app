<?php
include "memoriesHeader.php";
include "dbcon.php";
?>

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

if(isset($_GET['view'])) {
    $id=$_GET['view'];
    $query = "SELECT * from cards WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            ?>
<div class="containerr">
    <div>
        <h2 class="title"><?php echo $row['title'] ?></h2>
        <p class='tags-card'><?php $array = explode(",", $row['tags']); 
                               for($i = 0;$i<count($array);$i++) {
                                   echo "#" . $array[$i] . " ";
                               }
        ?></p>
        <p class="messa"><?php echo $row['messagee'] ?></p>
        <h3 class="created">CREATED BY: <?php echo $row['creator'] ?></h3>
        <p class="time"><?php echo time_elapsed_string($row['time']);?></p>
        <hr>
    </div>
    <div>
        <img src="uploads/<?php echo "$row[imageUrl]" ?>" alt="" class="view-img">
    </div>
    <div class="comments-container">
<div class="comments">
<button class="bottom"><i class="fas fa-chevron-down"></i></button>

<script>

const commentsContainer = document.querySelector('.comments')
const downBtn = document.querySelector('.bottom')

$(document).ready(function() {

    $(".comments-form").on('submit', function(e) {
        e.preventDefault();
    });

    <?php  include "fetchComments.php"; ?>

    $("#commentSubmit").on('click', function() {
        const comment = $("#comment").val();
        console.log(comment)
            $.ajax({
            type:"POST",
            url: 'comments.php',
            data: {
                postId: <?php echo $_GET['view']; ?>,
                uComment: comment
            },
            success: function(data) {
                // convert to js object
                const results = JSON.parse(data);
                var vs = commentsContainer.scrollHeight > commentsContainer.clientHeight;
                    if(vs) {
                        commentsContainer.scrollBy(0,1000);
                    }
                    commentsContainer.innerHTML += `
                        <h3>${results.sessionName}</h3>
                        <p>${results.comment}</p>
                    `;
            }
        })
    })
})

</script>

<?php
$idd = $_GET['view'];
$fetcing = "SELECT * FROM comments WHERE post_id='$idd'";
$fetchingResults = mysqli_query($conn, $fetcing);

    if(mysqli_num_rows($fetchingResults) > 0) {
        while($rows = mysqli_fetch_assoc($fetchingResults)) {
            ?>
                <h3><?php echo $rows['sessionName'] ?></h3>
                <p><?php echo nl2br($rows['comment']) ?></p>
            <?php
        }
    }

?>
</div>
        <form class="comments-form">
            <label for="comment">Write your comment: </label>
            <textarea name="text" id="comment" cols="40" rows="5" placeholder="Write Your comment...." required></textarea>
            <button type="submit" id="commentSubmit" name="commentSubmit">Comment</button>
        </form>
    </div>
</div>

<?php
        }
    }
}
?>

<script>
    downBtn.addEventListener('click', () => {
        commentsContainer.scrollBy(0, 1000);
    })
</script>

<div class="con">
    <h1 style="padding: 10px;">You might also like:</h1>
    <hr>
    <?php

            $condition = "";
            $q = "SELECT tags from cards WHERE id='$id'";
            $exe = mysqli_query($conn, $q);
            $title = mysqli_fetch_assoc($exe);

            $searchq = $title['tags'];
            $str_arr = preg_split ("/\,/", $searchq);
            for($i = 0;$i < count($str_arr);$i++) {
                $condition .= " '%$str_arr[$i]%' OR";
            }
            $cond =  substr($condition, 0, -3);

            $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

        
            $query = "SELECT * from cards WHERE tags LIKE $cond";
            $result = mysqli_query($conn, $query);
            // $resul = mysqli_fetch_all($result);
            // print_r($resul);
        ?>
    <div class="places">

        <?php
            
        
            if(mysqli_num_rows($result) == 0) {
                ?>
        <h2 class="found">Nothing Found</h2>
        <?php
            } else {
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
        <div class="place">
            <h2><?php echo $row['title']; ?></h2>
            <h5 class="created">CREATED BY: <?php echo $row['creator']; ?></h5>
            <p class="messag"><?php echo $row['messagee'] ?></p>
            <img src="uploads/<?php echo "$row[imageUrl]" ?>" alt="" class="like-img"><br>
            <a href="youMayLike.php?view=<?php echo $row['id'] ?>" class="youmay-view">VIEW</a>
        </div>

        <?php
                }
            }
        ?>
    </div>

</div>

