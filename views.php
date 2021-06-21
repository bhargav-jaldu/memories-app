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
</div>
<?php
        }
    }
}

?>

<div class="con">
    <h1 style="padding: 10px;">You might also like:</h1>
    <hr>
    <?php

            $q = "SELECT tags from cards WHERE id='$id'";
            $exe = mysqli_query($conn, $q);
            $title = mysqli_fetch_assoc($exe);

            $searchq = $title['tags'];
            // $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

        
            $query = "SELECT * from cards WHERE tags LIKE '%$searchq%'";
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