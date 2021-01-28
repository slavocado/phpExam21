<?php
require 'db.php';

if ($_COOKIE['isAdmin'] == false){
    header ('Location: index.php');
}

if(isset($_GET['session_id'])){

    $session_id = $_GET['session_id'];
    // UPDATE USER DATA
    $update_query = mysqli_query($conn,"UPDATE `sessions` SET status='archive' WHERE id='$session_id'");

    //CHECK DATA UPDATED OR NOT
    if($update_query){
        echo "<script>
            alert('Session archived');
            window.location.href = 'sessions.php';
            </script>";
        exit;
    }else{
        echo "<h3>Oops something wrong!</h3>";
    }

}else{
    // set header response code
    http_response_code(404);
    echo "<h1>404 Page Not Found!</h1>";
}