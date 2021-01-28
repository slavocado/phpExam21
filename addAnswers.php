<?php
require 'db.php';

if($_POST != []) {

    $session_id = $_POST['session_id'];
    unset($_POST['session_id']);

    // INSERT NEW ANSWERS INTO THE DATABASE
    $date = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];

    foreach ($_POST as $id => $answer){

        $query_question = mysqli_real_escape_string($conn, htmlspecialchars($answer));
        $insert_query = mysqli_query($conn, "INSERT INTO `answers` (`session_id`, `question_id`, `answer`, `date`, `user_ip`) VALUES ( '$session_id', '$id', '$answer', '$date', '$ip')");

    }

}

header ('Location: sessions.php');