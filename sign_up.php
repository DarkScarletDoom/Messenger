<?php
    require 'config.php';
?> 
 
<?php
    $db = new db('messenger', 'root', '', 'messenger');
    $link = $db->connect();
    
    $user = new User($_POST['login'], $_POST['password'], $db, 'reg', $_POST['firstname'], $_POST['lastname'], $_POST['repassword']);
    $result = $user->authorization_or_registrtion();
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