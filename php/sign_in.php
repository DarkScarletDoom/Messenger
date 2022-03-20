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
        echo "<script>
                alert('Ошибка запроса. Попробуйте еще раз')
             </script>";
    } 
    elseif($response == 0) {
        echo "<script>
                alert('Неправльный логин или пароль')
                window.location.href = '../index.html'
             </script>";
    }
    else{   
        $user->save_session_data();
        echo "<script>
                alert('Добро пожаловать!')
                window.location.href = 'main.php'
             </script>"; 
    }

    mysqli_close($link);
?>