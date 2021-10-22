const form =  document.querySelector(".login form"), 
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    // AJAX script
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST", "php/signin.php", true)
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let response = xhr.response;
                if(response === "success") {
                    location.href = "./users.php";
                } else {
                    console.log(response);
                    errorText.textContent = response;
                    errorText.style.display = "block";
                }
            }
        }
    } 
    let formData = new FormData(form)
    xhr.send(formData)
}