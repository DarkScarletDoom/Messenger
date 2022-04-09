<?php
    require_once '../config.php';

    $db = new db('messenger', 'root', '', 'messenger');
    $link = $db->connect();

    // // получения всех чатов пользователя вместе с их названиями
    $all_chats_of_user = array();
    $id = $_SESSION['user_data']['0'];
    $result = $db->query("SELECT * FROM `chat_partisipants` WHERE `user_id` = \"$id\"");
    $rows = $result['rows'];
    for($i = 0; $i < $rows; $i++){
        $array = array(
            'chat_id' => '',
            'name_of_chat' => '',
            'last_message' => '',
            'datetime' => ''
        );
        $chat_id = $result[$i]['0'];
        $array['chat_id'] = $chat_id;
        $array['name_of_chat'] = $db->query("SELECT * FROM `chats` WHERE `id` = \"$chat_id\"")['0']['2'];
        $responce = $db->query("SELECT * FROM `messege` WHERE `chat_id` = \"$chat_id\"");
        $rows = $result['rows'];
        $max = 0;   
        for($j = 0; $j < $rows; $j++){
            if($responce[$j]['5'] > $max){
                $max = $responce[$j]['5'];
            }
        }
       
        $last_message = $db->query("SELECT * FROM `messege` WHERE `created_at` = \"$max\"");
        $array['last_message'] = $last_message['0']['4'];
        $array['datetime'] = strtotime($max);
        array_push($all_chats_of_user, $array);
    }

    // получение всех участников беседы в массив
    // $all_partisipants = array();
    // for($i = 0; $i < $rows; $i++){
    //     $data = array(
    //         'id' => '',
    //         'participants' => ''
    //     );
    //     $chat_id = $all_chats_of_user[$i]['0'];
    //     // print_r($i . '   ');
    //     $result = mysqli_query($link, "SELECT * FROM `chat_partisipants` WHERE `chat_id` = \"$chat_id\"");
    //     $rowsIn = mysqli_num_rows($result);
    //     $all_partisipants_of_chat = array();
    //     for($j = 0; $j < $rowsIn; $j++){
    //         array_push($all_partisipants_of_chat, mysqli_fetch_row($result)['1']);
    //     }
    //     $data['id'] = $chat_id;
    //     $data['participants'] = $all_partisipants_of_chat;
    //     array_push($all_partisipants, $data);
    // }

    // отправка ajax
    $json = json_encode($all_chats_of_user);
    echo $json;
?>