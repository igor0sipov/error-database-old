var inputButton = document.getElementById("input-button");
var hiddenInput = document.getElementById ("hidden-input");

function hiddenClick(){
  hiddenInput.click();
}

function changeText(){
    inputButton.innerHTML = hiddenInput.files[0].name;
}

inputButton.addEventListener("click", hiddenClick);
hiddenInput.addEventListener ("change", changeText);