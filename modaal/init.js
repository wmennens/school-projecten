var inhoud1 = document.getElementById('inhoud1');
var inhoud2 = document.getElementById('inhoud2');
var knop1 = document.getElementById('k1');
var knop2 = document.getElementById('k2');

inhoud1.parentNode.removeChild(inhoud1);
inhoud2.parentNode.removeChild(inhoud2);

knop1.addEventListener('click', function() {
   modaal.open(inhoud1);
});
knop2.addEventListener('click', function() {
   modaal.open(inhoud2);
});
