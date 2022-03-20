modal = document.getElementById("modal")
modalContent = document.getElementById("modalContent")

// открытие чатов
document.getElementById("chatsNav").onclick = () => {
    chats = document.getElementById("chats")
    messegeStory = document.getElementById('messegeStory')
    if(chats.style.display == 'none'){
        chats.style.display = 'block'
        messegeStory.style.display = 'none'
        modal.style.display = 'none'
        content = document.getElementById('content')
        content.style.backgroundImage = "none"
        document.getElementById('messegeInputDiv').style.display = "none"
        document.getElementById('chatsSearch').style.display = "block"
        document.getElementById('welcomeToTheChat').style.display = "none"
    }
}

// открытие поиска пользователей
document.getElementById("searchUsersNav").onclick = () => {
    if(modal.style.display == 'none'){
        modal.style.display = 'flex'
        modalContent.style.height = '650px'
        document.getElementById("searchUsers").style.display = "block"
        closeModal(modal.style.display)
    }
}

// открытие сообщений
chatsDiv = document.getElementById('chats')
chatsDiv.onclick = (event) => {
    if(chatsDiv.style.display != "none"){
        chatsDiv.style.display = "none"
        content.style.backgroundImage = "url('img/atlantic-1794462_1280.jpg')"
        document.getElementById('messegeInput').style.display = "flex"
        document.getElementById('chatsSearch').style.display = "none"
        document.getElementsByTagName('header')['0']['children']['1'].style.display = 'block'
        document.getElementById('welcomeToTheChat').style.display = "block"
        // document.getElementsByTagName('header').lastChild.style.display = 'block'
        messegeStory.style.display = 'block'

        input = document.getElementById('messegeInput')
        input.addEventListener('keypress', function(event) {
            val = input.value
            if(event.code == 'Enter' && val != '' || event['which'] == 13){
                input.value = ""
                createMessege(val, "User")
            }
        })
    }
}

// открытие модалки создания чата
document.getElementById("createChatNav").onclick = () => {
    if(modal.style.display == "none"){
        modal.style.display = "flex"
        modalContent.style.height = '200px'
        createChat = document.getElementById("createChat").style
        createChat.display = "flex"
        // кнопка назад
        document.getElementById('createChatResetButton').onclick = () => {
            createChat.display = "none"
            modal.style.display = "none"
        }
        // кнопка далее
        document.getElementById('createChatNextButton').onclick = () => {
            createChat.display = "none"
            addParticipants = document.getElementById('addParticipants')
            addParticipants.style.display = "block"
            modalContent.style.height = "650px"

            // выделение пользователей для добавления в чат
            document.getElementById('addParticipants').querySelector('.searchUserslist').onclick = (e) => {
                console.log(e.composedPath())
                for (i = 0; i < e.composedPath().length; i++){
                    if(e.composedPath()[i]['localName'] == 'li'){
                        if(e.composedPath()[i].classList != 'add'){
                            e.composedPath()[i].classList.add('add')
                        }
                        else{
                            e.composedPath()[i].classList.remove('add')
                        }
                        break
                    }
                }
            }

            // кнопка назад
            document.getElementById('createChatBackButton').onclick = () => {
                modalContent.style.height = '200px'
                createChat.display = "flex"
                addParticipants.style.display = "none"
            }
            // кнопка создать
            document.getElementById('createChatCreateButton').onclick = () => {
                modal.style.display = 'none'
                addParticipants.style.display = 'none'
                createChat.display = "none"
            }
        }
        closeModal(modal.style.display)    
    }
}

// открытие модалки о проекте
document.getElementById("aboutProjectNav").onclick = () => {
    if(modal.style.display == "none"){
        modal.style.display = "flex"
        modalContent.style.height = '500px'
        document.getElementById("aboutProject").style.display = "block"
        closeModal(modal.style.display)
    }
}

// ночной режим
nightMode = document.getElementById("nightModeNav")
rootStyle = document.documentElement.style
deleteIcons = document.getElementsByClassName('delete')
nightMode.onclick = () => {
    if(nightMode.classList.contains("light")){
        nightMode.classList.add("dark")
        nightMode.classList.remove("light")

        rootStyle.setProperty('--current-bg-color', 'var(--dark-theme-bg)');
        rootStyle.setProperty('--current-main-color', 'var(--dark-theme-main)');
        rootStyle.setProperty('--current-theme-hover', 'var(--dark-theme-hover)');
        rootStyle.setProperty('--current-main-text-color', 'var(--dark-main-text-color)');
        rootStyle.setProperty('--bg-image-opacity', '0.6');

        // замена икнок крестиков
        for (i = 0; i < deleteIcons.length; i++){
            deleteIcons[i].src = '../img/icons8-close-48 (1).png'
        }
    }
    else {
        nightMode.classList.add("light")
        nightMode.classList.remove("dark")

        rootStyle.setProperty('--current-bg-color', 'var(--light-theme-bg)');
        rootStyle.setProperty('--current-main-color', 'var(--light-theme-main)');
        rootStyle.setProperty('--current-theme-hover', 'var(--light-theme-hover)');
        rootStyle.setProperty('--current-main-text-color', 'var(--light-main-text-color)');
        rootStyle.setProperty('--bg-image-opacity', '1');

         // замена икнок крестиков
        for (i = 0; i < deleteIcons.length; i++){
            deleteIcons[i].src = '../img/icons8-close-48.png'
        }
    }
}