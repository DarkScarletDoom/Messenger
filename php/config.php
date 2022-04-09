<?php
    session_start();
    $_SESSION['session_id'] = session_id();

    class db {
        private $host, $user, $password, $database, $link;

        public function __construct($host = 'messenger', $user = 'root', $password = '', $database = 'messenger') {
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->database = $database;
        }

        public function connect(){
            $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            if (!$this->link) {
                exit(mysqli_connect_error());
            }
            else {
                return $this->link;
            }
        }

        public function close_connect(){
            if ($this->link != NULL){
                mysqli_close($this->link);
            }
        }

        public function query($sql){
            $result = mysqli_query($this->link, $sql);
            if (!$result){
                return false;
            }
            else{
                $rows = mysqli_num_rows($result);
                if($rows > 0){
                    $data = array();
                    for($i = 0; $i < $rows; $i++){
                        array_push($data, mysqli_fetch_row($result));
                    }
                    $data['rows'] = $rows;
                    return $data;
                }
                else{
                    $data['rows'] = $rows;
                    return $data;
                }
            }
           
        }
    }

    class User {
        // 3 – ошибка
        // 1 – успешно
        // 2 – ошибка при выполнении SQL запроса
        private $firstname, $lastname, $password, $repassword, $db, $login, $id, $context;

        public function __construct($login, $password, $db, $context, $firstname = '', $lastname = '', $repassword = '') {
            // нициализация
            $this->login = $login;
            $this->password = strip_tags($password);
            $this->db = $db;
            $this->firstname = strip_tags($firstname);
            $this->lastname = strip_tags($lastname);
            $this->repassword = strip_tags($repassword);
            $this->context = $context;
            $this->id = uniqid();
        }
        
        public function authorization_or_registrtion() {
            if($this->context == 'ent'){
                $sql = "SELECT * FROM `users` WHERE `login` = \"$this->login\"";
                $data = $this->db->query($sql)['0'];
                $this->password = hash('sha256', (strip_tags($this->password)) . $data['1']);
                if($this->password == $data['4']) {  // если пароли совпадают, то мы вошли
                    $_SESSION['user_login'] = $this->login;
                    $sql = "SELECT * FROM `users` WHERE `login` = \"$this->login\"";
                    $data = $this->db->query($sql)['0'];
                    $_SESSION['user_data'] = $data;
                    return 1;
                }
                else {
                    return 0;
                }
            }
            elseif($this->context == 'reg'){
                if(isset($this->password) && isset($this->login) && isset($this->repassword) && isset($this->firstname) && isset($this->lastname)){
                    while(TRUE) { // цикл создания идентификатора
                        $sql = "SELECT * FROM `users` WHERE `id` = \"$this->id\""; // проверка – существует ли уже такой идентификатор
                            $result = $this->db->query($sql)['0'];
                            $rows = $result['rows'];
                            if($rows != 0) { // если такой идентификатор уже существует, то создать новый
                                $this->id = uniqid();
                            }
                            else {
                                break;
                            }
                    }    
        
                    $sql = "SELECT * FROM `users` WHERE `login` = \"$this->login\""; // проверка – существует ли уже такой логин
                    $result = $this->db->query($sql);
                    $rows = $result['rows'];
        
                    if($rows == 0) { // если такого же логина не существует
                        if($this->password == $this->repassword) { // отправка данных в таблицу 
                            $this->password = hash('sha256', (strip_tags($this->password)) . $this->firstname);
                            $sql = "INSERT INTO `users`(`id`, `firstname`, `lastname`, `password`, `login`) VALUES ('$this->id','$this->firstname','$this->lastname', '$this->password', '$this->login')";
                                $this->db->query($sql);
                                $_SESSION['user_login'] = $this->login;
                                $sql = "SELECT * FROM `users` WHERE `login` = \"$this->login\"";
                                $data = $this->db->query($sql)['0'];
                                $_SESSION['user_data'] = $data;
                                return 1;
                        }
                    } 
                    else if($rows != 0) { // если такой же логин существует
                        return 0;
                    }   
                }
            }
            else{
                return NULL;
            }
        }
    }
?>