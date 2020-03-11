window.addEventListener("load", function () {
    let collectionBtnNouvelle = document.querySelectorAll(".btnNouvelle");
    console.log(collectionBtnNouvelle.length)
    if (collectionBtnNouvelle) {
        for (let btn of collectionBtnNouvelle) {
            console.log(btn.id)
            btn.addEventListener('click', Ajax)
        }
    }
});


function Ajax(evt) {
    //attibut visible
    let oAffiche = document.querySelector("div[visible='true']");

    //Click
    let oDiv = document.querySelector("div[data-id='" + evt.srcElement.id + "']");

    if (this.value == "Voir moins") {

        oDiv.setAttribute("visible", "false");
        oDiv.style.display = "none";

        this.value = "Lire la suite...";
    } else {
        this.value = "Voir moins";
        oDiv.style.display = "block";
        oDiv.setAttribute("visible", "true");
    }

    if (oAffiche != null) {
        oAffiche.setAttribute("visible", "false");
        oAffiche.style.display = "none";

        let Button = document.querySelector("input[id='" + oAffiche.getAttribute("data-id") + "']");
        console.log(Button);
        Button.value = "Lire la suite...";
    }
    let maRequete = new XMLHttpRequest();

    maRequete.onload = function () {

        if (maRequete.status >= 200 && maRequete.status < 400) {
            let oDataJSON = JSON.parse(maRequete.responseText);
            creationHTML(oDataJSON, oDiv); // paramètres à ajouter
        } else {
            console.log('La connexion est faite mais il y a une erreur');
        }
    };

    maRequete.open('GET', 'http://localhost/wordpress/wp-json/wp/v2/posts/' + evt.target.getAttribute("id"));
    maRequete.send();



    maRequete.onerror = function () {
        console.log("erreur de connexion");
        maRequete.send()
    }

}


//}

function creationHTML(oDataJSON, oDiv) {

    console.log(oDataJSON);

    let monHtmlString = '<div class="postComplet">';

    monHtmlString += '<h2>' + oDataJSON.title.rendered + '</h2>';
    monHtmlString += oDataJSON.content.rendered;
    monHtmlString += '</div>';

    oDiv.innerHTML += monHtmlString;
}