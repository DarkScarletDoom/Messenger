modal = document.getElementById("modal")
modalContent = document.getElementById("modalContent")

function closeModal(display) {
    if(modal.style.display == "flex"){
        modal.onclick = (event) => {
            const withinBoundaries = event.composedPath().includes(modalContent) //получаем путь до объекта включая модальное окно
            if (!withinBoundaries) {
                if(modal.style.display == "flex"){
                    for (var i = 0; i < modalContent.children.length; i++) {
                        modalContent.children[i].style.display = "none"
                        modal.style.display = "none"
                    }
                }
            }
        }
    }
}

document.getElementById("chatsNav").onclick = () => {
    chats = document.getElementById("chats")
    if(chats.style.display == 'none'){
        chats.style.display = 'block'
        document.getElementById("modal").style.display = 'none'
        document.getElementById('content').style.backgroundImage = "none"
        document.getElementById('messegeInputDiv').style.display = "none"
    }
}

document.getElementById("searchUsersNav").onclick = () => {
    if(modal.style.display == 'none'){
        modal.style.display = 'flex'
        modalContent.style.height = '650px'
        document.getElementById("searchUsers").style.display = "block"
        closeModal(modal.style.display)
    }
}

chatsDiv = document.getElementById('chats')
chatsDiv.onclick = (event) => {
    if(chatsDiv.style.display != "none"){
        chatsDiv.style.display = "none"
        document.getElementById('content').style.backgroundImage = "url('img/atlantic-1794462_1280.jpg')"
        document.getElementById('messegeInputDiv').style.display = "flex"

        input = document.getElementById('messegeInput')
        input.addEventListener('keypress', function(event) {
            val = input.value.trim().toLowerCase()
            if(event.code == 'Enter' && val != '' || event['which'] == 13){
                input.value = ""
                createMessege(val)
            }
        })
    }
}

document.getElementById("createChatNav").onclick = () => {
    if(modal.style.display == "none"){
        modal.style.display = "flex"
        modalContent.style.height = '200px'
        document.getElementById("createChat").style.display = "block"

        closeModal(modal.style.display)    
    }
}

document.getElementById("aboutProjectNav").onclick = () => {
    if(modal.style.display == "none"){
        modal.style.display = "flex"
        modalContent.style.height = '500px'
        document.getElementById("aboutProject").style.display = "block"
        closeModal(modal.style.display)
    }
}

nightMode = document.getElementById("nightModeNav")
rootStyle = document.documentElement.style
nightMode.onclick = () => {
    if(nightMode.classList.contains("light")){
        nightMode.classList.add("dark")
        nightMode.classList.remove("light")
        rootStyle.setProperty('--current-bg-color', 'var(--dark-theme-bg)');
        rootStyle.setProperty('--current-main-color', 'var(--dark-theme-main)');
        rootStyle.setProperty('--bg-image-opacity', '0.6');
        rootStyle.setProperty('--current-main-text-color', 'var(--dark-main-text-color)');
        rootStyle.setProperty('--current-theme-hover', 'var(--dark-theme-hover)');
    }
    else {
        nightMode.classList.add("light")
        nightMode.classList.remove("dark")
        rootStyle.setProperty('--current-bg-color', 'var(--light-theme-bg)');
        rootStyle.setProperty('--current-main-color', 'var(--light-theme-main)');
        rootStyle.setProperty('--bg-image-opacity', '1');
        rootStyle.setProperty('--current-main-text-color', 'var(--light-main-text-color)');
        rootStyle.setProperty('--current-theme-hover', 'var(--light-theme-hover)');
    }
}