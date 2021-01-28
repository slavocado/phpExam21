<?php
require 'db.php';

if($_POST != []) {

    // INSERT NEW SESSION INTO THE DATABASE
    $insert_query = mysqli_query($conn, "INSERT INTO `sessions` (`id`, `link`, `status`) VALUES (NULL, '', 'working');");
    $query = mysqli_query($conn, "SELECT id FROM `sessions` ORDER BY id DESC LIMIT 1;");
    while ($row = mysqli_fetch_assoc($query)) {
        $session_id = $row['id'];
        $link = 'user.php?session_id=' . $session_id;
        echo $link;
        $update_query = mysqli_query($conn,"UPDATE `sessions` SET link='$link' WHERE id='$session_id'");
    }

    foreach ($_POST as $type => $question){
        $str = substr($type, 1);

        $query_question = mysqli_real_escape_string($conn, htmlspecialchars($question));
        $insert_query = mysqli_query($conn, "INSERT INTO `questions` (session_id, type, data) VALUES ( '$session_id', '$str', '$query_question')");

    }

}

header ('Location: sessions.php');