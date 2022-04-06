// document
//     .getElementsByClassName("fa-solid fa-star")
//     .addEventListener("click", function(event) {
//     event.target.preventDefault()
//     .setAttribute("class", "fa-solid fa-star");
// });

// console.log(document.getElementsByClassName("fa-solid fa-star"))

var fav = document.getElementsByClassName("js-a-favourite")

fav[0].addEventListener('click', function(event) {
    event.preventDefault()
    console.log(fav[0].firstElementChild)
    if(fav[0].firstElementChild.className ="fa-regular fa-star") {
        fav[0].firstElementChild.className = "fa-solid fa-star";
    }
})