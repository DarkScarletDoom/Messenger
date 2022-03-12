function createMessege (text) {
    console.log('пошел нахуй')
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