<?php 
    require_once '../config.php';

    if(isset($_GET)){
        $db = new db('messenger', 'root', '', 'messenger');
        $link = $db->connect();

        $id = uniqid();
        $from_id = $_SESSION['user_data']['0'];
        $content = $_GET['value'];
        $opponent = $_GET['opponent_id'];
        $chat_id = $_GET['chat_id'];
        $time = date('Y-m-d H:i:s', $_GET['time']);

        $sql = "INSERT INTO `messege`(`id`, `from_id`, `to_id`, `chat_id`, `content`, `created_at`) VALUES ('$id', '$from_id', '$opponent', '$chat_id', '$content', '$time')";
        $result = mysqli_query($link, $sql);  

        $arr = array(
            'id' => ' ',
            'from_id' => ' ',
            'opponent_id' => ' ',
            'chat_id' => ' ',
            'message' => ' ',
            'time' => ' ',
            'query_status' => ' '
        );

        $arr['id'] = $id;
        $arr['from_id'] = $from_id;
        $arr['opponent_id'] = $opponent;
        $arr['chat_id'] = $chat_id;
        $arr['message'] = $content;
        $arr['time'] = $time;
        $arr['query_status'] = $result;        

        echo json_encode($arr);
    }
?>