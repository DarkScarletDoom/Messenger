let xhr = new XMLHttpRequest()
    xhr.open('POST', '../php/ajax/get_chats.php', false)
    xhr.onload = () => {
        response = JSON.parse(xhr.response)
        all_chats_of_user = response['all_chats_of_user']
        // console.log(response);
        if (response['length'] == 0) {
            console.log('у вас нет чатов')
        }
        else{
            for (i = 0; i < response['all_chats_of_user'].length; i++){
                name_of_chat = response['all_chats_of_user'][i]['name_of_chat']
                chat_id = response['all_chats_of_user'][i]['chat_id']
                last_message = response['all_chats_of_user'][i]['last_message']
                time = response['all_chats_of_user'][i]['datetime']
                datetime = parseUnixTime(new Date(time * 1000))
                opponent = response['all_participants'][i]['opponent']
                appendChatList(name_of_chat, last_message, datetime, opponent, chat_id)
            }

            // all_chats_of_user.forEach(elem => {
            //     time = parseUnixTime(new Date(elem['datetime'] * 1000))
            //     // lastMessageTime = parseUnixTime(time)
               
            //     appendChatList(elem['name_of_chat'], elem['last_message'], time)
            // })
        }
    }
xhr.send()