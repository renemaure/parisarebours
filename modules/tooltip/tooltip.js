/* 
  module tooltip  crée le  01/10/2023 par Fateh kabbani pour l'association collectif 1180 
  actuellement à la version 1.1.1 alpha au 31/10/2023

 
  Ce module affiche une bulle d'explication sur un mot technique en ouvrant une popup lexique pour affichée plus d'information sur ce mot.
  ** !! en phase alpha le code suivant risque de me pas toujour fonctionner !! **
  ## Historique des modifications:
   -Le 23/10/2023, Fateh Kabbani:
          quelques modifications au module Tooltip. Ces modifications ont été mises en œuvre pour améliorer les fonctionnalités du module, car celui-ci n'était pas entièrement optimisé.
   - le 30/10/2023 par pascal:
          rajout de constentes pour extraire les données.
          ajout extention 'tooltip' au variable données
    -le 31/10/2023 pascal:
          rangée les fonctions et contracté le code pour plus de visibilité
          première version test en condition réel commenté l'image, le reste n'est pas écrit
   
*/
/* constantes à extraire et a rangée da,s un fichier json utilisateur */
const elm_tooltip = "tooltip"; 
const chm_json_tooltip = "../modules/tooltip/lexique_test.json";
const iconcroix_tooltip = "../modules/tooltip/icon/book.svg";
const class_tooltip = "tooltip";

/* let tooltipData; */ /* pas utilisé?? */

initiate("manual"); // en version texte a extraire en production

async function initiate(mode) {
  const data = await getData(); // recupere le json
  if (mode === "auto"){
    const pargraph_tooltip = document.querySelectorAll("p");
    autoTooltip(data, pargraph_tooltip);
  }
  else {
    const defaultElements = document.querySelectorAll(`.${elm_tooltip}`);
    defaultElements.forEach((e) => {
      e.addEventListener("mouseenter", () => {
        installContent(data, e);
      });
    });
  }
}
function autoTooltip(data, elements) {
  elements.forEach((e) => {
    const words = e.innerText.split(" ");
    /* Effacer le elements content (tooltipText)  */
    e.innerHTML = "";
    words.forEach((word, index) => {
      if (data[word]) {
        const span_tooltip = document.createElement("span");
        span_tooltip.classList.add(class_tooltip);
        span_tooltip.textContent = word;
        e.appendChild(
          span_tooltip.addEventListener("mouseenter", () => {
            installContent(data, span_tooltip);
          })
        );
        /* Ajoutez un espace après l'info-bulle si ce n'est pas le dernier mot */
        if (index < words.length - 1)  e.appendChild(document.createTextNode(" "));
      } else {
        /*  Si le mot n'a pas d'info-bulle, ajoutez-le simplement sous forme de texte brut */
        e.appendChild(document.createTextNode(dwor));
        /* Ajoutez un espace après le mot si ce n'est pas le dernier mot */
        if (index < words.length - 1) e.appendChild(document.createTextNode(" "));
      }
    });
  });
}

/* installe le contenu du moy à l'intérieur de l'info bulle*/
function installContent(data, element) {
  const content = element.textContent;
  const icon = document.createElement("img");
  icon.src = iconcroix_tooltip;
  icon.classList.add("learn_more");
  p = document.createElement("p");
  p.classList.add("tooltiptext");
  if (data[content]) {
    p.textContent = data[content].short_explanation;
    element.append(p);
    // p.append(icon); /* déactivé en phase essai le reste n'est pas écrit */
  }
}

/* Récupérer les données du lexique à partir d'un fichier lexique.JSON.*/
function getData() {
  return $.get(chm_json_tooltip,(data) => data).fail(() =>
    console.error("Error loading tooltip data:", error)
  );
}


