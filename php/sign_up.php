<?php
    require 'constants.php';
?> 
 
<?php
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database);
    if (!$link){
        echo "<p>Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error() . "</p>";
        exit();
    }
    
    $user = new User($_POST['login'], $_POST['password'], $link, $_POST['firstname'], $_POST['lastname'], $_POST['repassword']);
    $result = $user->registration();
    if($result == 2){
        echo "<script>
                alert('Ошибка запроса. Попробуйте еще раз')
             </script>";
        
    }
    elseif($result == 0){
        echo "<script>
                alert('Пользователь с таким логином уже существует');
                window.location.href = '../Registration.html'
             </script>";
    }
    else{
        $user->save_session_data();
        echo "<script>
                window.location.href = 'main.php'
             </script>"; 
    }            
    mysqli_close($link);
?>