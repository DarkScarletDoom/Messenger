let xhr = new XMLHttpRequest()
    xhr.open('POST', '../php/ajax/data.php', false)
    xhr.onload = () => {
        response = JSON.parse(xhr.response)
        console.log(response)
        if (response['length'] == 0) {
            console.log('у вас нет чатов')
        }
        else{
            response.forEach(elem => {
                time = parseUnixTime(new Date(elem['datetime'] * 1000))
                // lastMessageTime = parseUnixTime(time)
               
                appendChatList(elem['name_of_chat'], elem['last_message'], time)
            })
        }
    }
xhr.send()