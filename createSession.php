<?php
require 'db.php';

if ($_COOKIE['isAdmin'] == false){
    header ('Location: index.php');
}
$types_arr = array();

if (isset($_GET['types_arr']) && $_GET['types_arr'] != null){
    $types_arr = explode('+' , $_GET['types_arr']);
}

if (isset($_GET['add_type'])){
    array_push($types_arr, $_GET['add_type']);
}

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Создание сессии</title>
</head>
<body class="min-vh-100 d-flex">
<div class="container">
    <h1>Создание сессии</h1>

    <form action="" method="get">
        <div class="form-group">
            <label >Добавить вопрос типа</label>
            <select class="form-select" aria-label="Default select" name="add_type">
                <option selected value="number">Число</option>
                <option value="positive-n">положительное число</option>
                <option value="string">строка</option>
                <option value="text">текст</option>
                <option value="radio">с единственным выбором </option>
                <option value="checkbox">с множественным выбором</option>
            </select>
            <?php
                $string_arr = implode("+", $types_arr);
                echo '<input type="hidden" name="types_arr" value=' . $string_arr . '>';
            ?>
            <div class=" mt-3 mb-4">
                <button type="submit" class="btn btn-primary">Добавить</button>
                <a href="createSession.php" class="btn btn-primary">Сбросить всё</a>
            </div>
        </div>
    </form>
    <form action="addSessionDb.php" method="post">
        <?php
            foreach ($types_arr as $key => $input_type){
                switch ($input_type){
                    case 'number':
                        echo '
                            <div class="form-group">
                                <label for="question' . $key . '">Вопрос ' . $key . ' типа число</label>
                                <input type="text" class="form-control" id="question' . $key . '" placeholder="Question" name="' . $key.$input_type . '">
                            </div>';
                        break;

                    case 'positive-n':
                        echo '
                            <div class="form-group">
                                <label for="question' . $key . '">Вопрос' . $key . ' типа положительное число</label>
                                <input type="text" class="form-control" id="question' . $key . '" placeholder="Question" name="' . $key.$input_type . '">
                            </div>';
                        break;

                    case 'string':
                        echo '
                            <div class="form-group">
                                <label for="question' . $key . '">Вопрос' . $key . ' типа строка</label>
                                <input type="text"  class="form-control" id="question' . $key . '" placeholder="Question" name="' . $key.$input_type . '">
                            </div>';
                        break;

                    case 'text':
                        echo '
                            <div class="form-group">
                                <label for="question' . $key . '">Вопрос' . $key . ' типа текст</label>
                                <input type="text" class="form-control" id="question' . $key . '" placeholder="Question" name="' . $key.$input_type . '">
                            </div>';
                        break;
                }
            }

            if ($types_arr){
                echo '<button type="submit" class="btn btn-primary mt-3">Добавить сессию</button>';
            }
        ?>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>