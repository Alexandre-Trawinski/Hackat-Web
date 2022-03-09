var nbPlace = document.getElementById("inscription")
var dateHackathon = document.getElementById("");
var btn = document.getElementById("inscription");

function date(event)
{
    var dateNow = Date.now();
    if(dateNow>dateHackathon)
    {
        btn.disabled=true;
    }
    else
    {
        btn.disabled=false;
    }

}

function nbPlaces(event)
{
    if(nbPlace=0)
    {
        btn.disabled=true;
    }
    else
    {
        btn.disabled=false;
    }

}

btn.addEventListener("DOMContentLoaded", date());
btn.addEventListener("DOMContentLoaded",nbPlaces());