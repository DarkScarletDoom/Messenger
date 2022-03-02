<?php
    require 'constants.php';
?>

<?php
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database);
    if (!$link){
        echo "<p>Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error() . "</p>";
    } 
    else {
        echo "<p>Соединение установлено успешно</p>";
    }

    $user = new User($_POST['login'], $_POST['password'], $link);
    $response = $user->authorization();
    if ($response == 2){
        echo "<p>Ошибка запроса</p>";
    } 
    elseif($response == 0) {
        echo "<p>Неправльный логин или пароль</p>";
    }
    else{
        echo "<p>Добро пожаловать!</p>";
    }

    mysqli_close($link);
?>