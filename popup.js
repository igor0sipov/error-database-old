var deleteBtn = document.getElementsByClassName("delete-button");
var noteID = document.getElementsByClassName("id-cell-textarea");
var popupOverlay = document.querySelector('.popup-overlay');
var question = document.querySelector('.delete-q');
var qText = question.innerText;
var idText;
var idClass;


for (var i = 0; i < deleteBtn.length; i++){
    idText = noteID[i].innerHTML;
    deleteBtn[i].classList.add (idText);
    

    deleteBtn[i].addEventListener ('click', function showPopup(){
        popupOverlay.classList.remove ("hidden");
        idClass =  this.classList[2];
        question.textContent = qText + " №" + idClass + "?";
    });
    
}

popupOverlay.addEventListener('click', function(event) {
    e = event || window.event
    if (e.target == this) {
        popupOverlay.classList.add("hidden");
    }
});