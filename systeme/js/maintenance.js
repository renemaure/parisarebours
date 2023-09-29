const createFolder = document.getElementById("popup_button");
const popupContainer = document.getElementById("popup_container");
// folder input and button
const folderInput = document.getElementById("folder_name");
const folderButton = document.getElementById("folder_button");
const close = document.getElementById("close");
const folder = document.querySelectorAll(".folder");
close.addEventListener("click", function() {
    popupContainer.style.display = 'none';
});
createFolder.addEventListener("click", function() {
    if (popupContainer.style.display === 'none' || popupContainer.style.display === '') {
        popupContainer.style.display = 'flex';
    } else {
        popupContainer.style.display = 'none';
    }
});
for(let i = 0; i < folder.length; i++){
    folder[i].addEventListener("click", function() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../maintenance/test_serveur.php');
        const formData = new FormData();
        formData.append('dossier_choisi', folder[i].dataset.folder);
        xhr.send(formData);
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                console.log(xhr.responseText);
            }   
        }
    });
}
// create folder button
folderButton.addEventListener("click", function() {
    if (folderInput.value !== '') {
        popupContainer.style.display = 'none';
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../maintenance/test_serveur.php');
        const formData = new FormData();
        formData.append('folder_name', folderInput.value);
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        }
    }
});