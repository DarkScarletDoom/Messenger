function closeModal(display) {
    modal = document.getElementById("modal")
    modalContent = document.getElementById("modalContent")
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
    if(chats.style.display == "none"){
        chats.style.display = "block"
        document.getElementById("modal").style.display = "none"
    }
}

modal = document.getElementById("modal")
modalContent = document.getElementById("modalContent")

document.getElementById("searchUsersNav").onclick = () => {
    if(modal.style.display == "none"){
        modal.style.display = "flex"
        document.getElementById("searchUsers").style.display = "block"
        closeModal(modal.style.display)
    }
}

document.getElementById("createChatNav").onclick = () => {
    if(modal.style.display == "none"){
        modal.style.display = "flex"
        document.getElementById("createChat").style.display = "block"
        closeModal(modal.style.display)
    }
}
document.getElementById("aboutProjectNav").onclick = () => {
    if(modal.style.display == "none"){
        modal.style.display = "flex"
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
        rootStyle.setProperty('--bg-image-opacity', '0.45');
        rootStyle.setProperty('--current-main-text-color', 'var(--dark-main-text-color)');
    }
    else {
        nightMode.classList.add("light")
        nightMode.classList.remove("dark")
        rootStyle.setProperty('--current-bg-color', 'var(--light-theme-bg)');
        rootStyle.setProperty('--current-main-color', 'var(--light-theme-main)');
        rootStyle.setProperty('--bg-image-opacity', '0.6');
        rootStyle.setProperty('--current-main-text-color', 'var(--light-main-text-color)');
    }
}