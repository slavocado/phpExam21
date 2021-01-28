<?php
require 'db.php';

if(isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];
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

    <title>Сессия</title>
</head>
<body class="min-vh-100 d-flex">

<div class="container">
    <form action="addAnswers.php" method="post">
        <?php
            $get_data = mysqli_query($conn, "SELECT * FROM `sessions` WHERE id = '$session_id'");
            if (mysqli_num_rows($get_data) > 0) {
                $session  = mysqli_fetch_assoc($get_data);
                if ($session['status'] == 'archive'){
                    header ('Location: sessions.php');
                }
            }

            $get_data = mysqli_query($conn, "SELECT * FROM `questions` WHERE session_id = '$session_id'");
            if (mysqli_num_rows($get_data) > 0) {
                while ($question = mysqli_fetch_assoc($get_data)) {
                    switch ($question['type']){
                        case 'number':
                            echo '
                                <div class="form-group">
                                    <label for="question' . $question['id'] . '"> ' . $question['data'] . ' </label>
                                    <input required type="number" class="form-control" id="question' . $question['id'] . '" placeholder="Ответ" name="' . $question['id'] . '">
                                </div>';
                            break;

                        case 'positive-n':
                            echo '
                                <div class="form-group">
                                    <label for="question' . $question['id'] . '"> ' . $question['data'] . ' </label>
                                    <input required type="number" min="0" class="form-control" id="question' . $question['id'] . '" placeholder="Ответ" name="' . $question['id'] . '">
                                </div>';
                            break;

                        case 'string':
                            echo '
                                <div class="form-group">
                                    <label for="question' . $question['id'] . '"> ' . $question['data'] . ' </label>
                                    <input required type="text" maxlength="30" class="form-control" id="question' . $question['id'] . '" placeholder="Ответ" name="' . $question['id'] . '">
                                </div>';
                            break;

                        case 'text':
                            echo '
                                <div class="form-group">
                                    <label for="question' . $question['id'] . '"> ' . $question['data'] . ' </label>
                                    <input required type="text" maxlength="255" class="form-control" id="question' . $question['id'] . '" placeholder="Ответ" name="' . $question['id'] . '">
                                </div>';
                            break;
                    }
                }
                echo '<input type="hidden" name="session_id" value="'. $session_id .'">';
            } else {
                echo "<h3>No records found. Please insert some records</h3>";
            }
        ?>

        <button type="submit" class="btn btn-primary mt-3">Отправить</button>
    </form>
</div>