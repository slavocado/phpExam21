<?php
require 'db.php';

if ($_COOKIE['isAdmin'] == false){
    header ('Location: index.php');
}

// function for getting data from database
function get_answers($conn)
{
    $session_id = null;

    if(isset($_GET['session_id'])){
        $session_id = $_GET['session_id'];
    }

    $get_data = mysqli_query($conn, "SELECT * FROM `answers` WHERE session_id='$session_id'");
    if (mysqli_num_rows($get_data) > 0) {
        while ($row = mysqli_fetch_assoc($get_data)) {

            $question_id = $row['question_id'];
            $question_data = mysqli_query($conn, "SELECT * FROM `questions` WHERE id='$question_id'");
            $question = mysqli_fetch_assoc($question_data);

            echo '
               <tbody>
                <tr>
                    <th scope="row">' . $row['id'] . '</th>
                    <td>' . $question['data'] . '</td>
                    <td>' . $row['answer'] . '</td>
                    <td>' . $row['date'] . '</td>
                    <td>' . $row['user_ip'] . '</td>
                </tr>
                </tbody>
                ';
        }
    } else {
        echo "<h3>Не найдено ответов</h3>";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Ответы</title>
</head>
<body class="min-vh-100 d-flex mt-4 ml-4 mr-4 flex-column">

<a href="sessions.php" type="button" class="btn btn-primary mb-4">На страницу сессий</a>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id ответа</th>
        <th scope="col">Id вопроса</th>
        <th scope="col">Ответ</th>
        <th scope="col">Дата и веремя ответа</th>
        <th scope="col">IP</th>
    </tr>
    </thead>
    <?php
    get_answers($conn);
    ?>
</table>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
</body>