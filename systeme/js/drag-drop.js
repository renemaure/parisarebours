const dropContainer = document.getElementById("drop-container");
const fileInput = document.getElementById("file");

// preventer le comportement par defaut des evenements de drag
dropContainer.addEventListener("dragover", (e) => {
  e.preventDefault();
}, false);

// ajouter la classe drag-active au container
dropContainer.addEventListener("dragenter", () => {
  dropContainer.classList.add("drag-active");
});

// suppression de la classe drag-active du container
dropContainer.addEventListener("dragleave", () => {
  dropContainer.classList.remove("drag-active");
});

// recuperer les fichiers droppés
dropContainer.addEventListener("drop", (e) => {
  e.preventDefault();
  dropContainer.classList.remove("drag-active");
  const files = e.dataTransfer.files;
  fileInput.files = files;
});

