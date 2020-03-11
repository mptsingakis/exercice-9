
window.addEventListener("load",function(){
    let collectionBtnNouvelle = document.querySelectorAll(".btnNouvelle");
    console.log(collectionBtnNouvelle.length)
    if (collectionBtnNouvelle)
    {
         for (let btn of collectionBtnNouvelle){
            console.log(btn.id)
            btn.addEventListener('click',Ajax)
        }
    }
});    



function Ajax(evt) {
    
    //console.log(evt.target.getAttribute("id"));
    //  instructions ici
    let oDiv = this.parentElement;
      
      let maRequete = new XMLHttpRequest();
        
      maRequete.onload = function(){
        
        if (maRequete.status >= 200 && maRequete.status < 400) {
            let oDataJSON = JSON.parse(maRequete.responseText);
//            console.log(evt.target.dataset.checked);
            // instructions ici
            console.log(oDataJSON);
            creationHTML(oDataJSON, oDiv);  // paramètres à ajouter
        } else {
            console.log('La connexion est faite mais il y a une erreur');
        }
      };
      
      maRequete.open('GET', 'http://localhost/wordpress/wp-json/wp/v2/posts/'+ evt.target.getAttribute("id"));  
      maRequete.send();

/*
    console.log(maRequete);
    maRequete.onload = function () {
        console.log(maRequete);
        if (maRequete.status >= 200 && maRequete.status < 400) {
            let data = JSON.parse(maRequete.responseText);
//            console.log(evt.target.dataset.checked);
            // instructions ici
            creationHTML(data);  // paramètres à ajouter
        } else {
            console.log('La connexion est faite mais il y a une erreur');
        }
    };
    console.log("allo");
    maRequete.onerror = function () {
        console.log("erreur de connexion");
        maRequete.send() 
    }
    // instructions à ajouter
*/
}



///////////////////////////////////////////////////////

function creationHTML(oDataJSON, oDiv){

//console.log(oDiv);

    let monHtmlString = '';
    
        monHtmlString += '<h2>' + oDataJSON.title.rendered + '</h2>';
        monHtmlString += oDataJSON.content.rendered;
        
        oDiv.innerHTML += monHtmlString;
        //console.log(oDataJSON); 
}




