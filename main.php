<?php
    require_once 'config.php';
    // var_dump($_SESSION);

    $db = new db('messenger', 'root', '', 'messenger');
    $link = $db->connect();

        // $id = uniqid();
        // $from_id = $_SESSION['user_data']['0'];
        // $content = 'ghbdtn';
        // $result = NULL;

        // $sql = "INSERT INTO `messege`(`id`, `from_id`, `to_id`, `chat_id`, `content`, `created_at`) VALUES ('$id', '$from_id', '6236ea66db8e5', '111111111', '$content', '2077-04-15 15:43:12')";
        // $result = mysqli_query($link, $sql);    
        // $arr = array(
        //     'message' => ' ', 
        //     'from_id' => ' ', 
        //     'id' => ' ',
        //     'response' => ' ',
        //     'sql' => ' '
        // );
        // $arr['message'] = $content;
        // $arr['from_id'] = $from_id;
        // $arr['id'] = $id;
        // $arr['response'] = $result;
        // $arr['sql'] = $sql;
        // print_r($arr);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main_styles.css">
    <title>Messenger</title>
</head>
<body>

<!-- ################################# M O D A L ###################################################################################### -->

    <div id="modal" style="display: none;">
        <div id="modalContent">

            <!-- Высота modalContent: 650px -->
            <div id="searchUsers" style="display: none;">
               <div class="stickyDivHeader">
                    <h3 style="margin-left: 10px;">Поиск пользователей</h3>
                    <input type="text" id="searchUsersinput" placeholder="Поиск" style="color: var(--current-main-text-color);">
               </div>
                <ul id="searchUserslist" class="searchUserslist" style="height: 540px;"></ul>
            </div>

            <!-- Высота modalContent: 200px -->
            <div id="createChat" class="modalDiv" style="display: none;">
                <h3 style="padding: 10px; margin: 0;">Название беседы</h3>
                <form action="#" method="POST">
                    <input type="text" id="nameChatInput" placeholder="название" required style="color: var(--current-main-text-color);">
                </form>
               <div style="margin: auto 0 0 auto;">
                    <button id="createChatResetButton">Отмена</button>
                    <button id="createChatNextButton" type="submit">Далее</button>
               </div>
            </div>

             <!-- Высота modalContent: 650px -->
            <div id="addParticipants" style="display: block; height: 100%; display: none;">
                <div class="stickyDivHeader">
                    <h3 style="margin-left: 10px;">Добавить участников</h3>
                    <input type="text" id="searchUsersinput" placeholder="Поиск" style="color: var(--current-main-text-color);">
                </div>
                <ul class="searchUserslist" id="addParticipantsSearchUserslist" style="height: 480px;"></ul>

                <div class="stickyDivFooter">
                    <button id="createChatBackButton">Назад</button>
                    <button id="createChatCreateButton">Создать</button>
               </div>
            </div>

            <!-- Высота modalContent: 500px -->
            <div id="aboutProject" class="modalDiv" style="box-sizing: border-box; display: none; flex-direction: column; padding: 10px; height: 100%;"> 
                <h3>О проекте «Messenger»</h3>
                <p><b>Messenger</b> – социальная сеть в России и странах СНГ. Наша миссия — соединять людей, сервисы и компании, создавая простые и удобные инструменты коммуникации.</p>

                <div style="margin-top: 20px;">
                    <p><b>Версия:</b> 1.0 (прототип)</p>
                    <p><b>Стэк технологий:</b> Visual Studio Code, HTML5, CSS3, JavaScript ES6, PHP 7.1, MySQL 8.0</p>
                    <p><b>Разработчики:</b> <a href="https://vk.com/dark_scarlet_doom">Владислав Кирилин</a>, <a href="https://vk.com/ilyaguar">Илья Кузьмин</a></p>
                </div>
            </div>


        </div>
    </div>

<!-- ################################# M A I N ###################################################################################### -->

    <main data-id='<?=$_SESSION['user_data']['0'];?>'>
        <div id="profile">
            <div id="profileHeader">
                <div class="avatar" id="userAvatar"></div>
                <div style="margin-top: 10px;">
                    <p id="nameOfUser">
                        <?php
                            if (isset($_SESSION['user_data'])){
                                echo $_SESSION['user_data']['1'] . ' ' . $_SESSION['user_data']['2'];
                            }
                            else{
                                echo 'ERROR';
                            }
                        ?>
                    </p>
                    <p id="login">
                        <?php
                            if (isset($_SESSION['user_data'])){
                                echo $_SESSION['user_data']['3'];
                            }
                            else{
                                echo 'ERROR';
                            }
                        ?>
                    </p>
                </div>
            </div>

            <ul id="navigation">
                <li id="chatsNav">Чаты</li>
                <li id="createChatNav">Создать беседу</li>
                <li id="searchUsersNav">Поиск пользователей</li>
                <li id="nightModeNav" class="light">Ночной режим</li>
                <li id="aboutProjectNav">О проекте</li>
                <li id="exit">Выход</li>
            </ul>

            <div class="footer">
                <p>@ 2022 «MESSENGER»</p>
                <p>version: 1.0 прототип</p>
            </div>
        </div>

        <div id="mainContent">
            <header>
                <input id="chatsSearch" type="text" placeholder="Поиск" style="color: var(--current-main-text-color);">
                <div style="display: none;">
                    <p id="nameOfChat"></p>
                    <p>Был(а) в сети в <span>12:00</span></p>
                </div>
            </header>
            
            <div id="content" style="height: 730px; background-size: cover; display: flex; flex-direction: column;">
                <h2 id="welcomeToTheChat" style="display: none; color: white; margin: 0; padding: 10px; opacity: 0.8;">Напишите что нибудь здесь. История сообщений пуста</h2>
                <ul id="messegeStory" style="overflow: auto; height: 100%; display: none;"></ul>
<!-- ################################# C H A T S ###################################################################################### -->

                <ul id="chats" style="display: block;"></ul>

                <input id="messegeInput" type="text" placeholder="Напишите свое сообщение...">
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/functions.js"></script>
    <script src="../js/switching_tabs.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>
