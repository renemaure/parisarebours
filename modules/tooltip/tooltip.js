/* 
  module tooltip version 1.0.5 crée le  01/10/2023 par Fateh kabbani
  pour l'association collectif 1180 
  affiche une bulle d'eplication sur un mot technique et renvoi sur une popup lexique
  pour plus d'information sur ce mot
  en phase alpha (le code suivant riste de me pas toujour fonctionner)
  ## Historique des modifications
   -Le 23/10/2023, Fateh Kabbani quelques modifications au module Tooltip. Ces modifications
   ont été mises en œuvre pour améliorer les fonctionnalités du module, 
   car celui-ci n'était pas entièrement optimisé.
*/
const elm = "tooltip";
const paragraphs = document.querySelectorAll("p");
const defaultElements = document.querySelectorAll(`.${elm}`);
let tooltipData;

// Fetch tooltip data from a JSON file.
function getData() {
  return $.get("../modules/tooltip/tooltip.json", (data) => data).fail(() =>
    console.error("Error loading tooltip data:", error)
  );
}

function applyTooltip(data, element) {
  element.addEventListener("mouseenter", () => {
    installContent(data, element);
    // console.log(data , element)
  });

  return element;
}

function manualTooltip(data, elements) {
  /*
   la boucle renvoie des éléments (tooltip dans ce cas)
  */
  elements.forEach((e) => {
    applyTooltip(data, e);
  });

  return elements;
}

function autoTooltip(data, elements) {
  elements.forEach((e) => {
    const words = e.innerText.split(" ");
    /*
      clear the element's content (tooltipText)
      Effacer le elements content (tooltipText)
     */
    e.innerHTML = "";
    words.forEach((word, index) => {
      if (data[word]) {
        const span = document.createElement("span");
        span.classList.add("tooltip");
        span.textContent = word;

        e.appendChild(applyTooltip(data, span));

        /* Ajoutez un espace après l'info-bulle si ce n'est pas le dernier mot */
        if (index < words.length - 1) {
          e.appendChild(document.createTextNode(" "));
        }
      } else {
        /* 
          If the word doesn't have a tooltip, just add it as plain text
          Si le mot n'a pas d'info-bulle, ajoutez-le simplement sous forme de texte brut
        */
        e.appendChild(document.createTextNode(word));

        /* 
         Add a space after the word if it's not the last word
         Ajoutez un espace après le mot si ce n'est pas le dernier mot
        */
        if (index < words.length - 1) {
          e.appendChild(document.createTextNode(" "));
        }
      }
    });
  });
}

/* 
call function to install tooltip content inside the element 
appeler la fonction pour installer le contenu de installTooltip à l'intérieur de l'élément
*/
function installContent(data, element) {
  const content = element.textContent;

  if (data[content]) {
    const icon = document.createElement("img");
    icon.src = "../modules/tooltip/icon/book.svg";
    icon.classList.add("learn_more");
    const p = document.createElement("p");
    p.classList.add("tooltiptext");
    p.textContent = data[content].short_explanation;
    p.append(icon);
    console.log(p , icon )
    element.append(p);
  }else{
    console.log('hello')
  }
}

async function initiate(mode) {
  const data = await getData();
  if (mode === "auto") {
    console.log("Initiating automatic tooltip");
    autoTooltip(data, paragraphs);
  } else if (mode == "manual") {
    console.log("Initiating manual tooltip");
    console.log(manualTooltip(data, defaultElements)); /* default element == tooltip */
  }
}


initiate("manual");
