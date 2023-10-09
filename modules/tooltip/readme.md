
# Module Tooltip - Texte dans un d'info-bulle

Module crée et conçu par Fateh [manque nom], [manque mail], pour l’association Collectif 11880, Club CMIT.

Ce module vous permet de donner une brève définition de mots spécifiques dans des paragraphes grâce à une info-bulle basée au survole du mot. De plus, un clic dans l’info-bulle, ouvre une fenêtre pardessus le texte, pour donner la définition précise du mot
Ce module permet d’améliorer l'expérience utilisateur avec des info-bulles pour les termes ou mots-clés importants de votre contenu.

## Comment utiliser ce module

a ecrire 


# Tooltip module - Text in a tooltip

Module created and designed by Fateh [missing name], [missing email], for the association Collectif 11880, Club CMIT.

This module allows you to give a brief definition of specific words in paragraphs using a tooltip based on hovering over the word. In addition, a click in the tooltip opens a window over the text, to give the precise definition of the word
This module helps improve the user experience with tooltips for important terms or keywords in your content.

## How to use this module

1. Include the `tooltipTextReplacement` function in your JavaScript code.

2. Define an object (`obj`) where keys are words to be replaced, and values are arrays with the replacement text and tooltip content.

```javascript
const obj = {
  "word1": ["word1", "Tooltip for word1", "https://example.com/word1"],
  "word2": ["word2", "Tooltip for word2", "https://example.com/word2"],
  //   more words...
// word [word, tooltip, link]
};
// add paragrah (or any other element)
const paragrah = document.querySelectorAll("p");
```

Call the tooltipTextReplacement function, passing the object and selecting the target paragraphs
```javascript
tooltipTextReplacement(obj, paragrah);
```
# example 
```html
<p>This is an example sentence with word1 and word2.</p>
```
After running the code, the paragraph will be modified to:
```html
<p>This is an example sentence with <span class="tooltip">word1 <span class="tooltiptext">Tooltip for word1</span></span> and <span class="tooltip">word2 <span class="tooltiptext">Tooltip for word2</span></span>.</p>
```
# parametere
- obj: object with the word as key and value as array of 0 word, 1 tooltip, 2 link
- paragrah: target element to replace the word with tooltip
# Performance Considerations
This function is optimized for performance and can handle a large number of paragraphs and words.


### JavaScript Function

```javascript
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
```