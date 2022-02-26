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
    
    $user = new User($_POST['login'], $_POST['password'], $link, $_POST['firstname'], $_POST['lastname'], $_POST['repassword']);
    $result = $user->registration();
    if($result == 2){
        echo "<p>Ошибка запроса</p>";
    }
    elseif($result == 0){
        echo "<p>Пользователь с таким логином уже существует</p>";
    }
    else{
        echo "<p>Данные успешно отправлены на сервер</p>";
    }
    var_dump($result);

    mysqli_close($link);
?>