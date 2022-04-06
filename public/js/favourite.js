var fav = document.getElementsByClassName("js-a-favourite")

fav[0].addEventListener('click', function(event) {
    event.preventDefault()
    console.log(fav[0].firstElementChild)
    if(fav[0].firstElementChild.className ="fa-regular fa-star") {
        fav[0].firstElementChild.className = "fa-solid fa-star";
    }
})