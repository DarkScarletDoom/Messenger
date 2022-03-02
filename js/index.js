function createMessege (text) {
    newDiv = document.createElement("div")
    document.querySelector('#content').insertBefore(newDiv, document.querySelector("#messegeInputDiv")).style.color = "rgb(233, 233, 233)"
    newP = document.createElement("p")
    newP.textContent = text;   
    newDiv.appendChild(newP)

    let now = new Date();
    hours = now.getHours()
    minutes = now.getMinutes()
    time = hours + ":" + minutes
    console.log(time) 

    newP = document.createElement("p")
    newP.textContent = time;   
    newDiv.appendChild(newP)
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