const searchBar = document.querySelector(".users .search input"), 
searchBtn  = document.querySelector(".users .search button"),
usersList  = document.querySelector(".users .users-list");


searchBtn.onclick = () => {
    searchBar.classList.toggle("active"); 
    searchBar.focus();
    searchBtn.classList.toggle("active");
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST", "./php/searchUser.php", true)
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let response = xhr.response;
                usersList.innerHTML = response;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm); 
}

setInterval(()=>{
    if(!searchBar.value) {
        // AJAX script
        let xhr = new XMLHttpRequest(); // creating XML object
        xhr.open("GET", "./php/user.php", true)
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    let response = xhr.responseText;
                    usersList.innerHTML = response;
                }
            }
        }
        xhr.send();
    }
}, 500);

// setInterval(()=>{
//     // AJAX script
//     let xhr = new XMLHttpRequest(); // creating XML object
//     xhr.open("GET", "./php/status.php", true)
//     xhr.onload = () => {
//         if(xhr.readyState === XMLHttpRequest.DONE) {
//             if(xhr.status === 200) {
//                 let response = xhr.responseText;
//             }
//         }
//     }
//     xhr.send();
// }, 500);

