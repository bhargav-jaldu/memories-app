<?php
include "memoriesHeader.php";

include "dbcon.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="users.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ajax cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Users</title>
</head>
<style>
.conversationBtn {
    display: none;
}
</style>
<body>
<a href="memories.php" class="btn btn-primary mx-5">BACK</a>

<?php
 $email = $_SESSION['email'];
 $query = "SELECT username, `status` from memoriesapp WHERE email='$email'";
 $fetchUnameAndStatus = mysqli_query($conn, $query);

 $result = mysqli_fetch_assoc($fetchUnameAndStatus);

?>

<div class="container w-50 d-flex shadow-lg mt-3 flex-column rounded border">
    <div>
        <h3><?php echo $result['username']; ?></h3>
        <small><?php echo $result['status']; ?></small>
    </div>
    <hr>
    <p>Select an user to chat</p>
    <div>
    <!-- users container -->
        <div class="users-container"></div>
    </div>
</div>

<script>
$(document).ready(function(){
  sendRequest();
  function sendRequest(){
      $.ajax({
        url: "fetchUserAjax.php",
        success: 
          function(data){
            // console.log(data)
           $('.users-container').html(data); 
        }
    });
  };

  setInterval(sendRequest, 5000);
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

<!-- https://www.codespeedy.com/call-jquery-ajax-in-every-n-seconds/ -->