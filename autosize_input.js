var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
function init () {
    var text = document.getElementsByTagName('textarea');
var arrLength = text.length - 1;
  for (let i=0; i<=arrLength; i++){
    function resize () {
        text[i].style.height = 'auto';
        text[i].style.height = text[i].scrollHeight+'px';
    }
    /* 0-timeout to get the already changed text */
    function delayedResize () {
        window.setTimeout(resize, 0);
    }
    observe(text[i], 'change',  resize);
    observe(text[i], 'cut',     delayedResize);
    observe(text[i], 'paste',   delayedResize);
    observe(text[i], 'drop',    delayedResize);
    observe(text[i], 'keydown', delayedResize);

    resize();
  }
}