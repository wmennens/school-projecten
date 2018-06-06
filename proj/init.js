var inhoud1 = document.getElementById('inhoud1');
var knop1 = document.getElementById('k1');

inhoud1.parentNode.removeChild(inhoud1);

knop1.addEventListener('click', function() {
   modaal.open(inhoud1);
});

var inhoud2 = document.getElementById('inhoud2');
var knop2 = document.getElementById('k2');

inhoud2.parentNode.removeChild(inhoud2);

knop2.addEventListener('click', function() {
    modaal.open(inhoud2);
});

var inhoud3 = document.getElementById('inhoud3');
var knop3 = document.getElementById('k3');

inhoud3.parentNode.removeChild(inhoud3);

knop3.addEventListener('click', function() {
    modaal.open(inhoud3);
});

var inhoud4 = document.getElementById('inhoud4');
var knop4 = document.getElementById('k4');

inhoud4.parentNode.removeChild(inhoud4);

knop4.addEventListener('click', function() {
    modaal.open(inhoud4);
});