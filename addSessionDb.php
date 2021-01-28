<?php
require 'db.php';

if($_POST != []) {

    // INSERT NEW SESSION INTO THE DATABASE
    $query = mysqli_query($conn, "SELECT id FROM `sessions` ORDER BY id DESC LIMIT 1;");
    while ($row = mysqli_fetch_assoc($query)) {
        $session_id = $row['id'] + 1;
        $link = 'user.php?session_id=' . $session_id;
        $insert_query = mysqli_query($conn, "INSERT INTO `sessions` (link, status) VALUES ('$link','Working')");
    }

    foreach ($_POST as $type => $question){
        $str = substr($type, 1);

        $query_question = mysqli_real_escape_string($conn, htmlspecialchars($question));
        $insert_query = mysqli_query($conn, "INSERT INTO `questions` (session_id, type, data) VALUES ( '$session_id', '$str', '$query_question')");

    }

    header ('Location: sessions.php');

}