<?php
include "memoriesHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <!-- ajax cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="users.css?v=<?php echo time(); ?>">
    <title>USER</title>
</head>
<body>

<div class="chat-container">

<script>
    let searchParams = new URLSearchParams(window.location.search);
    searchParams.has('userId') // true
    let param = searchParams.get('userId')

    // console.log(param)

    $(document).ready(function(){
    fetchUserChat();
    function fetchUserChat() {
        $.ajax({
            type: 'POST',
            url: "fetchUserChat.php",
            data: {userId : param},
            success: 
            function(data){
            $('.details').html(data); 
            }
        });
    };

  setInterval(fetchUserChat, 5000);
});

</script>

    <div class="header">
        <a href="users.php"><i class="fas fa-arrow-left"></i></a>
        <div class="details">
            
        </div>
    </div>
    <div class="messages">
        
    
    </div>
    <form action="" class="message-form">
        <input type="text" name="input-msg" class="input-msg" placeholder="type...">
        <button type="submit" name="send" class="send">SEND</button>
    </form>
</div>

<!-- insert into chat table -->
<script>
    $(document).ready(function(){
    $(".message-form").on('submit', (e) => {
        e.preventDefault();
    });

    $('.send').on('click', () => {
        const message = $('.input-msg').val(); 

    insertMessage();
    function insertMessage() {
        $.ajax({
            type: 'POST',
            url: "insertMessage.php",
            data: {to_id : param,
                message: message
            },
            success: 
            function(data){
            const messageField = document.querySelector('.input-msg')
            messageField.value = "";
            console.log(data)
            }
        });
    };
    })
});
</script>

<!-- fetch messages from chat table -->
<script>
$(document).ready(function () {
    fetchMessages();
    function fetchMessages() {
        $.ajax({
            type: 'POST',
            url: 'fetchMessages.php',
            data: {
                to_id: param
            },
            success: function(data) {
                console.log(data)
                $(".messages").html(data);
            }
        })
    }

    setInterval(fetchMessages, 500);
})
</script>

</body>
</html>