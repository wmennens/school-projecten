var xPos = 101;
var speed = 1;

window.addEventListener("load", init);

  function init() {
    setInterval(float, 10);
  }

  function float () {
    var bootje = document.getElementById("bootje");
    if(900 == xPos || 100 == xPos) {
      speed = -speed;
    }
    xPos += speed;
    bootje.style.marginLeft = xPos + 'px';
  }
