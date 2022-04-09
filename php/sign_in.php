<?php
    require_once 'config.php';
?>

<?php
    $db = new db('messenger', 'root', '', 'messenger');
    $link = $db->connect();

    $user = new User($_POST['login'], $_POST['password'], $db, 'ent');
    $response = $user->authorization_or_registrtion();
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
        if($_SESSION == NULL){
            echo "<script>
                    alert('Ошибка доступа / access_error')
                    window.location.href = '../index.html'
                 </script>"; 
        }
        else{
            echo "<script>
                    alert('Добро пожаловать!')
                    window.location.href = 'main.php'
                 </script>"; 
        }
    }
?>