// class TooltipManager {
//   constructor() {
//     tooltipData = null;
//     tooltips = document.querySelectorAll(".tooltip");
//     paragraphs = document.querySelectorAll("p");
//   }

//  async loadData() {
//     try {
//       const response = await fetch('../systeme/donnees/tooltip.json');
//       tooltipData = await response.json();
//       setupTooltipEvents();
//     } catch (error) {
//       console.error("Error loading tooltip data:", error);
//     }
//   }

//   initializeTooltipsAutomatically() {
//     if (tooltipData) {
//       const wordsSet = new Set(Object.keys(tooltipData));

//       const tooltipsMap = new Map();
//       for (const word of Object.keys(tooltipData)) {
//         tooltipsMap.set(
//           word,
//           `<span class="tooltip">${word}
//           <span class="tooltiptext">${tooltipData[word][1]} <img class="exit_tooltip" src="../systeme/img/icon/x.svg">
//           <img class="learn_more" src="../systeme/img/icon/book.svg"></span></span>`
//         );
//       }

//       for (const paragraph of paragraphs) {
//         const words = paragraph.textContent.split(" ");
//         const newContent = [];

//         for (const word of words) {
//           if (wordsSet.has(word)) {
//             newContent.push(tooltipsMap.get(word));
//           } else {
//             newContent.push(word);
//           }
//         }

//         paragraph.innerHTML = newContent.join(" ");
//       }

//       setupTooltipEvents();
//     }
//   }

//   initializeTooltipsManually() {
//     // Add manual initialization logic here, similar to the `showTooltip` function
//     if (tooltipData) {
//       const AutoParagrahs = document.querySelectorAll('.tooltip');
//       const wordsSet = new Set(Object.keys(tooltipData));
//       const tooltipsMap = new Map();
//       for (const word of Object.keys(tooltipData)) {
//         tooltipsMap.set(
//           word,
//           `${word}
//           <span class="tooltiptext">${tooltipData[word][1]}<img class="exit_tooltip" src="../systeme/img/icon/x.svg"></img>
//           <img class="learn_more" src="../systeme/img/icon/book.svg"></img></span>`
//         );
//       }
//       for (const paragraph of AutoParagrahs) {
//         const words = paragraph.textContent.split(" ");
//         const newContent = [];
//         for (const word of words) {
//           if (wordsSet.has(word)) {
//             newContent.push(tooltipsMap.get(word));
//           } else {
//             newContent.push(word);
//           }
//         }
//         paragraph.innerHTML = newContent.join(" ");
//       }
//       setupTooltipEvents();
//     }
//   }

//   showTooltip(tooltip) {
//     const tooltipText = tooltip.getElementsByClassName("tooltiptext")[0];
//     tooltipText.style.visibility = "visible";
//     tooltipText.style.opacity = "1";
//   }

//   hideTooltip(tooltip) {
//     const tooltipText = tooltip.getElementsByClassName("tooltiptext")[0];
//     tooltipText.style.visibility = "hidden";
//     tooltipText.style.opacity = "0";
//   }

//   setupTooltipEvents() {
//     tooltips.forEach((tooltip) => {
//       tooltip.addEventListener("mouseenter", () => {
//         console.log("Mouse entered tooltip");
//         showTooltip(tooltip);
//       });

//       tooltip.addEventListener("mouseleave", () => {
//         console.log("Mouse left tooltip");
//         hideTooltip(tooltip);
//       });

//       tooltip.addEventListener("mouseover", (event) => {
//         console.log("Mouse over tooltip");
//       });
//       // Add a click event listener to the image elements
//       const exitButton = tooltip.querySelector(".exit_tooltip");
//       const learnMoreButton = tooltip.querySelector(".learn_more");

//       if (exitButton) {
//         exitButton.addEventListener("click", (event) => {
//           event.stopPropagation(); // Stop event propagation
//           hideTooltip(tooltip);
//         });
//       }
//       console.log(tooltip.addEventListener)
//       console.log(tooltip);
//     });
//   }
// }

// const tooltipManager = new TooltipManager();

// // Load tooltip data
// tooltipManager.loadData().then(() => {
//   // Initialize tooltips automatically
//   tooltipManager.initializeTooltipsAutomatically();

//   // OR

//   // tooltipManager.initializeTooltipsManually();
// });
const paragraphs = document.querySelectorAll("p");

async function loadData() {
  try {
    const response = await fetch("../systeme/donnees/tooltip.json");
    tooltipData = await response.json();
    return tooltipData;
  } catch (error) {
    console.error("Error loading tooltip data:", error);
  }
}
function tooltipManager() {
  // handle click event on tooltip
  function setupTooltipEvents() {
    const tooltips = document.querySelectorAll(".tooltip");
    tooltips.forEach((tooltip) => {
      const tooltipText = tooltip.getElementsByClassName("tooltiptext")[0];
      const tooltipImg = tooltip.getElementsByClassName("exit_tooltip")[0];
      // Afficher le tooltip lorsque l'utilisateur la survole
      tooltip.addEventListener("mouseenter", () => {
        tooltipText.style.visibility = "visible";
        tooltipText.style.opacity = "1";
      });

      // Masquer le tooltip lorsque l'utilisateur éloigne sa souris
      tooltip.addEventListener("mouseleave", () => {
        tooltipText.style.visibility = "hidden";
        tooltipText.style.opacity = "0";
      });

      // Empêche le tooltip de se masquer lorsque l'utilisateur survole le tooltip elle-même
      tooltip.addEventListener("mouseover", (event) => {
        event.stopPropagation();
      });
      tooltipImg.addEventListener("click", () => {
        tooltipText.style.visibility = "hidden";
        tooltipText.style.opacity = "0";
      });
    });
  }

  // display tooltip auto when element have a word that in side tooltipData aka tooltip.json
  function autoTooltip(data, elements) {
    const wordSet = new Set(Object.keys(data));
    const tooltipMap = new Map();
    for (const word of Object.keys(data)) {
      tooltipMap.set(
        word,
        `<span class="tooltip">${word}
        <span class="tooltiptext">${data[word][1]}<img class="exit_tooltip" src="../systeme/img/icon/x.svg"></img>
        <img class="learn_more" src="../systeme/img/icon/book.svg"></img></span></span>`
      );
    }
    for (const element of elements) {
      const words = element.textContent.split(" ");
      const newContent = [];
      for (const word of words) {
        if (wordSet.has(word)) {
          newContent.push(tooltipMap.get(word));
        } else {
          newContent.push(word);
        }
      }
      element.innerHTML = newContent.join(" ");
    }
    setupTooltipEvents();
  }
  // display tooltip manual when element have a word that in side tooltipData aka tooltip.json
  function manualTooltip(data) {
   const wordSet = new Set(Object.keys(data));
    const tooltipMap = new Map();
    for (const word of Object.keys(data)) {
      tooltipMap.set(
        word,
        `<span class="tooltip">${word}
        <span class="tooltiptext">${data[word][1]}<img class="exit_tooltip" src="../systeme/img/icon/x.svg"></img>
        <img class="learn_more" src="../systeme/img/icon/book.svg"></img></span></span>`
      );
    }
    const elements = document.querySelectorAll(".tooltip");
    for(const element of elements){
      const words = element.textContent.split(" ");
      const newContent = [];
      for(const word of words){
        if(wordSet.has(word)){
          newContent.push(tooltipMap.get(word));
        }else{
          newContent.push(word);
        }
      }
      element.innerHTML = newContent.join(" ");
      
    }
    setupTooltipEvents();

  }
  
  return {
    autoTooltip: autoTooltip,
    manualTooltip: manualTooltip,
  };
}
async function initialize(mode) {
  const tooltipData = await loadData();
  const manualTooltipManager = tooltipManager();
  if (mode === "auto") {
    manualTooltipManager.autoTooltip(tooltipData, paragraphs);
  }else if(mode === "manual"){
    manualTooltipManager.manualTooltip(tooltipData);
  }
}
initialize("manual");
