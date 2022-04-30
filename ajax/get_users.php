<?php
    require_once '../config.php';

    $db = new db('messenger', 'root', '', 'messenger');
    $link = $db->connect();

    $users = array();
    $response = $db->query("SELECT * FROM `users`");
    for($i = 0; $i < $response['rows']; $i++){
        array_push($users, $response[$i]);
    }
    // $users['user_id'] = $_SESSION['user_data']['0'];
    $json = json_encode($users);
    echo $json;
?>