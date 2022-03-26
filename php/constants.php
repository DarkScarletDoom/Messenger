<?php
    session_start();
    $_SESSION['session_id'] = session_id();

    $host = 'messenger'; // адрес сервера 
    $database = 'messenger'; // имя базы данных
    $user = 'root'; // имя пользователя
    $password = ''; // пароль

    class User {
        // 3 – ошибка
        // 1 – успешно
        // 2 – ошибка при выполнении SQL запроса
        private $firstname, $lastname, $password, $repassword, $link, $login, $id;

        public function __construct($login, $password, $link, $firstname = '', $lastname = '', $repassword = '') {
            // нициализация
            $this->login = $login;
            $this->password = strip_tags($password);
            $this->link = $link;
            $this->firstname = strip_tags($firstname);
            $this->lastname = strip_tags($lastname);
            $this->repassword = strip_tags($repassword);
            $this->id = uniqid();
        }
        
        public function authorization() {
            // sql запрос
            $sql = "SELECT * FROM `users` WHERE `login` = \"$this->login\"";
            $result = mysqli_query($this->link, $sql);
    
            if (!$result) {
                return 2;
            }
            else {
                $data = mysqli_fetch_row($result);  // получаем результат в массив
                $this->password = hash('sha256', (strip_tags($this->password)) . $data['1']);
                if($this->password == $data['4']) {  // если пароли совпадают, то мы вошли
                    $_SESSION['user_login'] = $this->login;
                    return 1;
                }
                else {
                    return 0;
                }
            }
        }

        public function registration() {
            if(isset($this->password) && isset($this->login) && isset($this->repassword) && isset($this->firstname) && isset($this->lastname)){
                while(TRUE) { // цикл создания идентификатора
                    $sql = "SELECT * FROM `users` WHERE `id` = \"$this->id\""; // проверка – существует ли уже такой идентификатор
                    $result = mysqli_query($this->link, $sql);
                    if(!$result) {
                        return 2;
                    }
                    else {
                        $rows = mysqli_num_rows($result);
                        if($rows != 0) { // если такой идентификатор уже существует, то создать новый
                            $this->id = uniqid();
                        }
                        else {
                            break;
                        }
                    }
                }    
    
                $sql = "SELECT * FROM `users` WHERE `login` = \"$this->login\""; // проверка – существует ли уже такой логин
                $result = mysqli_query($this->link, $sql);
                if(!$result) {
                    return 2;
                }
                else {
                    $rows = mysqli_num_rows($result);
                }
    
                if($rows == 0) { // если такого же логина не существует
                    if($this->password == $this->repassword) { // отправка данных в таблицу 
                        $this->password = hash('sha256', (strip_tags($this->password)) . $this->firstname);
                        $sql = "INSERT INTO `users`(`id`, `firstname`, `lastname`, `password`, `login`) VALUES ('$this->id','$this->firstname','$this->lastname', '$this->password', '$this->login')";
                        $result = mysqli_query($this->link, $sql);
                        if (!$result) {
                            return 2;
                        }
                        else {
                            $_SESSION['user_login'] = $this->login;
                            return 1;
                        }
                    }
                } 
    
                else if($rows != 0) { // если такой же логин существует
                    return 0;
                }   
            }
        }

        public function save_session_data() {
            $sql = "SELECT * FROM `users` WHERE `login` = \"$this->login\""; // проверка – существует ли уже такой идентификатор
            $result = mysqli_query($this->link, $sql);
            $data = mysqli_fetch_row($result);
            $_SESSION['user_data'] = $data;
            return 1;
        }
    }
?>