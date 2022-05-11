var monURL = document.getElementById("compte_portfolio")

monURL.addEventListener("input", function(event) {
    formatURL = event.target.value;
    var regex = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/
    var monErreur = document.getElementById("erreur");
    var button = document.getElementById("ajouter");

    if (regex.test(formatURL)) {
        monErreur.textContent = "";
        button.disabled = false;
    }
    else {
        monErreur.textContent = "Format non accepté";
        button.disabled = true;
    }
})