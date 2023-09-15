/* 
création du fichier parisarebours.js le 20/08/2023
par l'association collectif 11880
version 1.0.0
pas de copyright
pour le projet paris à rebours


*/
/* déclaration des variables globales  */
var zoom_map = "plan1";
var minzoom = 600; // minimum de de la zone html en verticale 
var maxzoom = 1000;// maximun de l'image en verticale
var paszoom = 20;


/* 2 fonctions pour agrandir ou retrecir une image brut de copie */
function agrandir() {
    var myImg = document.getElementById(zoom_map);
    var width = myImg.clientWidth;
    var height = myImg.clientHeight;
        if (width == maxzoom) {
        alert("Vous avez atteint le niveau de zoom maximal.");// non pas une alerte
    } else {
        myImg.style.width = (width + paszoom) + "px";
        myImg.style.height = (height + paszoom) + "px"; 
       
    }
}
function diminuer() {
    var myImg = document.getElementById(zoom_map);
    var width = myImg.clientWidth;
    var height = myImg.clientHeight;
    if (width == minzoom) {
        alert("Vous avez atteint le niveau de zoom minimal.");// non pas une alerte
    } else {
        myImg.style.width = (width - paszoom) + "px";
        myImg.style.height = (height - paszoom) + "px"; 
        // console.log("position image mini wight :"+ (width - paszoom) + "et height : "+ (height - paszoom));
    }
}

/* test détection de la molette de la souris */
let scale = 1;
document.addEventListener("wheel", function() {
   

scale += event.deltaY * 0.01;

// scale = Math.min(Math.max(0.125, scale), 4);
  
   

    console.log("ici ca bouge ?"+ scale);

    // console.log("ici ca bouge ?"+ event.deltaY);
  })

/*   
  const el = document.querySelector("div");
  el.onwheel = zoom;

  function zoom(event) {
    event.preventDefault();
  
    scale += event.deltaY * -0.01;
  
    // Restrict scale
    scale = Math.min(Math.max(0.125, scale), 4);
  
    // Apply scale transform
    el.style.transform = `scale(${scale})`;
  }
   */

/* fin fonctions zoom image */