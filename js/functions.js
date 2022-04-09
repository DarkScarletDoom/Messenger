parseUnixTime = (date) => {
    if(date.getHours() < 10){
        hours = '0' + date.getHours()
    }
    else{
        hours = date.getHours()
    }

    if(date.getMinutes() < 10){
        minutes = '0' + date.getMinutes()
    }
    else{
        minutes = date.getMinutes()
    }
    time = hours + ":" + minutes
    return time
}

// добавление чатов
appendChatList = (chat, message, time) => {
    chatList = document.querySelector('#chats')
    newLi = document.createElement('li')
    deleteIcon = document.createElement('div')
    InfoAbout = document.createElement('div')
    avatar = document.createElement('div')
    div = document.createElement('div')
    nameOfChat = document.createElement('p')
    nameOfChat.textContent = chat
    lastMessege = document.createElement('p')
    lastMessege.textContent = message + ' · ' + time

    chatList.appendChild(newLi)
    newLi.appendChild(InfoAbout).classList.add('infoAboutChat')
    InfoAbout.appendChild(avatar).classList.add('avatar')
    InfoAbout.appendChild(div)
    div.appendChild(nameOfChat).classList.add('nameOfChat')
    div.appendChild(lastMessege).classList.add('lastMessege')
    newLi.appendChild(deleteIcon).classList.add('delete')
}

// добавление пользователей
appendUsersList = (fullname) => {
    userList = document.getElementsByClassName('searchUserslist')['0']
    newLi = document.createElement('li')
    newDiv1 = document.createElement('div')
    newDiv2 = document.createElement('div')
    avatar = document.createElement('div')

    nameOfUser = document.createElement('p')
    nameOfUser.textContent = fullname
    
    userList.appendChild(newLi)
    newLi.appendChild(newDiv1).style.display = 'flex'
    newDiv1.appendChild(avatar).classList.add('avatar')
    newDiv1.appendChild(newDiv2)
    newDiv2.appendChild(nameOfUser).classList.add('nameOfChat')
}

createMessege = (text, from) => {
    document.getElementById('welcomeToTheChat').style.display = "none"
    newLi = document.createElement("li")
    document.querySelector('#messegeStory').appendChild(newLi).classList.add('messege')

    newDiv = document.createElement("div")

    newPFrom = document.createElement("p")
    newPFrom.textContent = from + ': ';   
    newDiv.appendChild(newPFrom)

    newPText = document.createElement("p")
    newPText.textContent = text;   
    newDiv.appendChild(newPText)

    newLi.appendChild(newDiv).style.display = 'flex'

    // работа со временем
    now = new Date()
    time = parseUnixTime(now)

    newPTime = document.createElement("p")
    newPTime.textContent = time;   
    newLi.appendChild(newPTime)
}

closeModal = (display) => {
    if(modal.style.display == "flex" || modal.style.display == "block"){
        modal.onclick = (event) => {
            const withinBoundaries = event.composedPath().includes(modalContent) //получаем путь до объекта включая модальное окно
            if (!withinBoundaries) {
                if(modal.style.display == "flex"){
                    for (var i = 0; i < modalContent.children.length; i++) {
                        modalContent.children[i].style.display = "none"
                        modal.style.display = "none"
                        list = document.getElementsByClassName('searchUserslist')['0']
                        while (list.firstChild) {
                            list.removeChild(list.firstChild);
                        }
                    }
                }
            }
        }
    }
}