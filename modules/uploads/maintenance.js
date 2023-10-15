const createFolder = document.getElementById("popup_button");

const popupContainer = document.getElementById("popup_container");

// folder input and button
const folderInput = document.getElementById("folder_name");

const folderButton = document.getElementById("folder_button");

const close = document.getElementById("close");

const folder = document.querySelectorAll(".folder");

/* fermeture de la popup en appuyant sur la croix */
close.addEventListener("click", function() {
    popupContainer.style.display = 'none';
});

/* ouvrerture de la popup  popup_container pour créer un sous dossier*/
createFolder.addEventListener("click", function() {
    if (popupContainer.style.display === 'none') popupContainer.style.display = 'flex';
    else  popupContainer.style.display = 'none';
});


for(let i = 0; i < folder.length; i++){
    console.log("test folder.length :"+ folder.length);
    folder[i].addEventListener("click", function() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload_php.php');
        const formData = new FormData();
        formData.append('dossier_choisi', folder[i].dataset.folder);
        console.log( formData);
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
        xhr.open('POST', 'upload_php.php');
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