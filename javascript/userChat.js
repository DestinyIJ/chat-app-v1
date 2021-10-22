const form = document.querySelector(".typing-area"),
sendBtn = form.querySelector("button"),
inputField = form.querySelector(".input-field"), 
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
}

chatBox.onmouseenter = () => {
    chatBox.classList.remove("scrollToBottom")
}
chatBox.onmouseleave = () => {
    chatBox.classList.add("scrollToBottom")
}

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST", "php/insertChat.php", true)
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                inputField.value = "";
                if(chatBox.classList.contains("scrollToBottom")){
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form)
    xhr.send(formData)
}

setInterval(()=>{
    // AJAX script
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST", "php/getChat.php", true)
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let response = xhr.response;
                chatBox.innerHTML = response;
                if(chatBox.classList.contains("scrollToBottom")){
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form)
    xhr.send(formData)
}, 500);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}