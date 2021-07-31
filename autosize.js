var ta = document.querySelector('textarea');

ta.addEventListener('input', autosize);
var arrLenght = ta.length;
for (let i=0; i<arrLenght; i++){
    function autosize(){
        setTimeout(function(){
          ta[i].style.cssText = 'height:auto;';
          ta[i].style.cssText = 'height:' + ta.scrollHeight + 'px';
        },0);
      }
}
