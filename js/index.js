document.getElementById("chatsNav").onclick = () => {
    chats = document.getElementById("chats")
    if(chats.style.display == 'none'){
        chats.style.display = 'block'
        document.getElementById("modal").style.display = 'none'
    }
}

document.getElementById("searchUsersNav").onclick = () => {
    modal = document.getElementById("modal")
    if(modal.style.display == 'none'){
        modal.style.display = 'flex'
        
        if(modal.style.display == 'flex'){
            document.getElementById('modal').onclick = (event) => {
                const withinBoundaries = event.composedPath().includes(document.getElementById("modalContent")) //получаем путь до объекта включая модальное окно
                if (!withinBoundaries) {
                    if(document.getElementById("modal").style.display == 'flex'){
                        document.getElementById("modal").style.display = 'none'
                    }
                }
            }
        }
    }
}