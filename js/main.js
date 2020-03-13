window.addEventListener("load", function () {
    let collectionBtnNouvelle = document.querySelectorAll(".btnNouvelle");
    if (collectionBtnNouvelle) {
        for (let btn of collectionBtnNouvelle) {
            btn.addEventListener('click', Ajax)
        }
    }
});




function Ajax(evt) {
    
    //  instructions ici

    let id = evt.target.id;
    let maRequete = new XMLHttpRequest();
    maRequete.open('GET', 'http://localhost/wordpress/wp-json/wp/v2/posts/' + id); 
    maRequete.onload = function () {
        if (maRequete.status >= 200 && maRequete.status < 400) {
            let data = JSON.parse(maRequete.responseText);
            // instructions ici
            creationHTML(data , evt);  // paramètres à ajouter
        } else {
            console.log('La connexion est faite mais il y a une erreur')
        }
    }
    maRequete.onerror = function () {
        console.log("erreur de connexion");
    }
    maRequete.send()
    {
    }

    // instructions à ajouter

}

function creationHTML(oDataJSON, evt) {


    let oAffiche = document.querySelector("div[visible='true']");
    let id = oDataJSON.id;
    //Click
    let oDiv = document.querySelector("div[data-id='" + id + "']");

    let monHtmlString = '<div>';
        monHtmlString += '<h2>' + oDataJSON.title.rendered + '</h2>';
        monHtmlString += oDataJSON.content.rendered;
        monHtmlString += '</div>';

        oDiv.innerHTML += monHtmlString;

    if (evt.value == "Voir moins") {

        oDiv.setAttribute("visible", "false");
        oDiv.style.display = "none";
        oDiv.innerHTML = "";
        console.log(oDiv.innerHTML);

        evt.value = "Lire la suite...";
    } else {
        evt.value = "Voir moins";
        oDiv.style.display = "block";
        oDiv.setAttribute("visible", "true");
    }

    if (oAffiche != null) {
        oAffiche.setAttribute("visible", "false");
        oAffiche.style.display = "none";
        oDiv.innerHTML = "";
        console.log(oDiv.innerHTML);

        let Button = document.querySelector("input[id='" +id + "']");
        Button.value = "Lire la suite...";
    }



    console.log(oDiv.innerHTML);

    
}