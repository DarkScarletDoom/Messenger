function print(text){
    console.log(text)
}

function createMessege (text, from) {
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
    let now = new Date();
    if(now.getHours() < 10){
        hours = '0' + now.getHours()
    }
    else{
        hours = now.getHours()
    }

    if(now.getMinutes() < 10){
        minutes = '0' + now.getMinutes()
    }
    else{
        minutes = now.getMinutes()
    }
    time = hours + ":" + minutes

    newPTime = document.createElement("p")
    newPTime.textContent = time;   
    newLi.appendChild(newPTime)
}

function closeModal(display) {
    if(modal.style.display == "flex" || modal.style.display == "block"){
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