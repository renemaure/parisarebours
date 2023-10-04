const allFolders = document.querySelectorAll(".folder-list .folder-title");
const parentFolder = document.querySelectorAll(".parent-of-kids");

for (let i = 0; i < allFolders.length; i++) {
  allFolders[i].addEventListener("click", (e) => {
    e.preventDefault();
    parentFolder[i].classList.toggle("active-parent");
  });
}
