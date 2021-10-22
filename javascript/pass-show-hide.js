const passField = document.querySelector("#password"), 
toggleBtn = document.querySelector(".field span");

toggleBtn.onclick = () => {
    if (passField.type == "password") {
        passField.type = "text";
        toggleBtn.classList.add('active');
    } else {
        passField.type = "password";
        toggleBtn.classList.remove('active');
    }
}