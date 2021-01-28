<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Enter password</title>
</head>
<body class="min-vh-100 d-flex justify-content-center flex-column">

<div class="container d-flex justify-content-center">
    <form class="form-group col-6" action="" method="post">
        <label for="InputPassword">Введите пароль админа</label>
        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Пароль"  required>
        <button type="submit" class="btn btn-primary mt-3">Войти</button>
    </form>
</div>

<div class="container d-flex justify-content-center">
    <?php
    require 'db.php';

    // function for getting password from database
    function get_password($conn)
    {
        $get_data = mysqli_query($conn, "SELECT password FROM `password` WHERE id=1");
        if (mysqli_num_rows($get_data) > 0) {
            while ($row = mysqli_fetch_assoc($get_data)) {
                return $row['password'];
            }
        } else {
            echo "<h3>Error while getting password</h3>";
        }
        return '';
    }

    $password = get_password($conn);

    if (isset($_POST['password'])){

        if ($_POST['password'] == $password){
            echo '<a href="sessions.php" class="h3">Перейти на старницу сессий</a>';
        } else {
            echo '<h3>Пароль неверный</h3>';
        }
    } else{
        echo '<h3>Введите пароль</h3>';
    }
    ?>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>