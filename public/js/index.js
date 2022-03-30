var btn = document.getElementById("inscription");
var nbPlaces = document.getElementById("nbPlaces").dataset.nbplaces;
var dateLimiteHackathon = document.getElementById("dateLimite").dataset.datelimite;


var dateNow = new Date();
dateLimiteHackathon = new Date(dateLimiteHackathon);

console.log("Now : ", dateNow)
console.log("Limite : ", dateLimiteHackathon)


if (dateNow > dateLimiteHackathon || nbPlaces == 0) {
    btn.setAttribute('href', '#');
}