<?php 
    require_once '../config.php';

    if(isset($_GET)){
        $db = new db('messenger', 'root', '', 'messenger');
        $link = $db->connect();

        $chat_id = $_GET['chat_id'];

        $sql = "SELECT `id`, `from_id`, `to_id`, `chat_id`, `content`, `created_at` FROM `messege` WHERE `chat_id` = '$chat_id'";
        $result = mysqli_query($link, $sql);

        $rows = mysqli_num_rows($result);
        $response = array();
        for($j = 0; $j < $rows; $j++){
            $data = mysqli_fetch_row($result);
            $user_id = $data['1'];

            $array = array(
                'username' => '',
                'content' => '',
                'time' => ''
            );

            $res = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$user_id'"));
           
            $array['username'] = $res['1'];
            $array['content'] = $data['4'];
            $array['time'] = $data['5'];


            array_push($response, $array);
        }
       
        echo json_encode($response);
    }
?>