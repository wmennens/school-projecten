var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

class Bit {
     constructor(x,y) {
       this.state = true;
       this.y = y;
       this.x = x;
       addEventListener('mousedown',(evt)=> {
         var rect = canvas.getBoundingClientRect();
         var mouseX = evt.clientX - rect.left;
         var mouseY = evt.clientY - rect.top;
         console.log('je klikt',mouseY,mouseX);
         if (mouseX > this.x && mouseX < this.x +100 && mouseY > this.y && mouseY < this.y +100) {
           this.state = !this.state;
           this.draw();
         }
       });
    }
    draw() {
      ctx.beginPath();
      if (this.state) {
        ctx.fillStyle = 'yellow';
      }
      else {
        ctx.fillStyle = 'blue';
      }
      ctx.rect(this.x,this.y,100,100);
      ctx.stroke();
      ctx.fill();
      ctx.closePath();
    }
}



for (var i = 0; i < 10; i++) {
  var h = new Bit(0,100*i);
  h.draw();
}

for (var i = 0; i < 10; i++) {
  var h = new Bit(100,100*i);
  h.draw();
}
for (var i = 0; i < 10; i++) {
  var h = new Bit(200,100*i);
  h.draw();
}
for (var i = 0; i < 10; i++) {
  var h = new Bit(300,100*i);
  h.draw();
}
for (var i = 0; i < 10; i++) {
  var h = new Bit(400,100*i);
  h.draw();
}
for (var i = 0; i < 10; i++) {
  var h = new Bit(500,100*i);
  h.draw();
}
for (var i = 0; i < 10; i++) {
  var h = new Bit(600,100*i);
  h.draw();
}
for (var i = 0; i < 10; i++) {
  var h = new Bit(700,100*i);
  h.draw();
}
for (var i = 0; i < 10; i++) {
  var h = new Bit(800,100*i);
  h.draw();
}
for (var i = 0; i < 10; i++) {
  var h = new Bit(900,100*i);
  h.draw();
}
