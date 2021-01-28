<?php

require 'db.php';

if ($_COOKIE['isAdmin'] == false){
    header ('Location: index.php');
}

    if(isset($_GET['session_id'])){

    $session_id = $_GET['session_id'];
    $delete_session = mysqli_query($conn,"DELETE FROM `sessions` WHERE id='$session_id'");

    if($delete_session){
        echo "<script>
        alert('Data Deleted');
        window.location.href = 'sessions.php';
        </script>";
        exit;
    }else{
        echo "Oops something go wrong!";
    }
}else{
    // set header response code
    http_response_code(404);
    echo "<h1>404 Page Not Found!</h1>";
}