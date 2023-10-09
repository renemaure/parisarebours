const obj = {
  test: ["test", "this is a test hope it works", "https://www.google.com"],
  another: [
    "another test",
    "this is another test hope it works",
    "https://www.google.com",
  ],
  apple: ["apple", "A delicious fruit", "https://www.example.com/apple"],
  banana: ["banana", "A yellow fruit", "https://www.example.com/banana"],
  car: ["car", "A mode of transportation", "https://www.example.com/car"],
  dog: ["dog", "A loyal companion", "https://www.example.com/dog"],
  cat: ["cat", "A furry friend", "https://www.example.com/cat"],
  book: ["book", "A source of knowledge", "https://www.example.com/book"],
  computer: [
    "computer",
    "A technological marvel",
    "https://www.example.com/computer",
  ],
  code: [
    "code",
    "A set of instructions for computers",
    "https://www.example.com/code",
  ],
  music: ["music", "An auditory delight", "https://www.example.com/music"],
  coffee: [
    "coffee",
    "A caffeinated beverage",
    "https://www.example.com/coffee",
  ],
  keyboard: [
    "keyboard",
    "An input device for computers",
    "https://www.example.com/keyboard",
  ],
  guitar: ["guitar", "A musical instrument", "https://www.example.com/guitar"],
  beach: ["beach", "A sandy shoreline", "https://www.example.com/beach"],
  mountain: [
    "mountain",
    "A towering landform",
    "https://www.example.com/mountain",
  ],
  ocean: ["ocean", "A vast body of water", "https://www.example.com/ocean"],
  sun: ["sun", "A bright celestial object", "https://www.example.com/sun"],
  moon: ["moon", "Earth's natural satellite", "https://www.example.com/moon"],
  planet: [
    "planet",
    "Celestial bodies in space",
    "https://www.example.com/planet",
  ],
  star: ["star", "Distant luminous objects", "https://www.example.com/star"],
};
const tooltip = document.querySelectorAll(".tooltip");
const paragraphs = document.querySelectorAll("p");
function tooltipTextReplacement(obj, paragraphs) {
  const wordsSet = new Set(Object.keys(obj));

  const tooltipsMap = new Map();
  for (const word of Object.keys(obj)) {
    tooltipsMap.set(
      word,
      `<span class="tooltip">${word} <span class="tooltiptext">${obj[word][1]}</span></span>`
    );
  }

  for (const paragraph of paragraphs) {
    const words = paragraph.textContent.split(" ");
    const newContent = [];

    for (const word of words) {
      if (wordsSet.has(word)) {
        newContent.push(tooltipsMap.get(word));
      } else {
        newContent.push(word);
      }
    }

    paragraph.innerHTML = newContent.join(" ");
  }
}
// tooltipTextReplacement(obj, paragraphs);

function anotherWayToDoTheToolTip(obj) {
  const wordsSet = new Set(Object.keys(obj));
  const tooltipsMap = new Map();
  for (const word of Object.keys(obj)) {
    tooltipsMap.set(
      word,
      `<span class="tooltip">${word} <span class="tooltiptext">${obj[word][1]} <img class="exit_tooltip" src="../systeme/img/icon/x.svg"></img></span></span>`
    );
  }
  const paragraphs = document.querySelectorAll(`.tooltip`);
  for (const paragraph of paragraphs) {
    const words = paragraph.textContent.split(" ");
    const newContent = [];
    for (const word of words) {
      if (wordsSet.has(word)) {
        newContent.push(tooltipsMap.get(word));
      } else {
        newContent.push(word);
      }
    }
    paragraph.innerHTML = newContent.join(" ");
  }
}
anotherWayToDoTheToolTip(obj);

for (let i = 0; i < tooltip.length; i++) {
  const tooltiptext = tooltip[i].getElementsByClassName("tooltiptext");
  const tooltipimg = tooltip[i].getElementsByClassName("exit_tooltip");
  tooltip[i].addEventListener("mouseover", () => {
    tooltiptext[0].style.visibility = "visible";
    tooltiptext[0].style.opacity = "1";
  });
  tooltipimg[0].addEventListener("click", () => {
    tooltiptext[0].style.visibility = "hidden";
    tooltiptext[0].style.opacity = "0";
  });
}