<?php

include "pages.php";

include "pageNo.php";

$this_page_first_result = ($page - 1) * $results_per_page;

$sql = "SELECT * FROM cards LIMIT $this_page_first_result, $results_per_page";
$fetch = mysqli_query($conn, $sql);

if(mysqli_num_rows($fetch) > 0) {
    while($row = mysqli_fetch_assoc($fetch)) {
        ?>
<?php include "card.php" ?>
<?php
    }
}

?>