let alleAfb = [
 'myImage1.jpg',
 'myImage2.jpg',
 'myImage3.jpg',
 'myImage4.jpg',
 'myImage5.jpg',
 'myImage6.jpg',
 'myImage7.jpg',
 'myImage8.jpg',
 'myImage9.jpg',
 'myImage10.jpg',
 'myImage11.jpg',
 'myImage12.jpg',
 'myImage13.jpg',
 'myImage14.jpg',
 'myImage15.jpg'
];

let uitvoer = document.getElementById('uitvoer');
const TotaleBreedte = uitvoer.clientWidth;
let teller = 0;
let tijdelijkeBreedte = 0;
const UitgangsHoogte = 180;
const MARGE = 2;

function wisselArray(arr) {
 let nieuweArray = [];
 while(arr.length > 0){
   let rndm = Math.floor(Math.random()*arr.length);
   let element = arr.splice(rndm, 1);
   nieuweArray.push(element);
 }
 return nieuweArray;
}

alleAfb = wisselArray(alleAfb);

function maakRij(){
 let element = document.createElement('div');
 element.className = 'rij';
 uitvoer.appendChild(element);
}

function zoekDeRij() {
 let element = document.getElementsByClassName('rij');
 return element[0];
}

function maakPlaatje(num) {
 let afbeelding = document.createElement('img');
 afbeelding.src = 'afb/' + alleAfb[num];
 afbeelding.alt = 'Mijn gebruikte achtergronden' + num;
 return afbeelding;
}

function nieuweHoogte(getal){
 let gewensteHoogte = UitgangsHoogte*TotaleBreedte/getal;
 return gewensteHoogte + 'px';
}

function voegPlaatjeToe(num) {
 afb = maakPlaatje(num);
 let rij = zoekDeRij();
 rij.appendChild(afb);
 afb.addEventListener('load', function(){
   tijdelijkeBreedte += afb.clientWidth + (2*MARGE);
   if (tijdelijkeBreedte >= TotaleBreedte) {
     rij.className = 'klaar';
     rij.style.height = nieuweHoogte(tijdelijkeBreedte);
     maakRij();
     tijdelijkeBreedte = 0;
     }
     teller ++;
     if (teller < alleAfb.length) {
       voegPlaatjeToe(teller);
   }
 });
}

maakRij();
voegPlaatjeToe(0);

document.getElementById('meer').addEventListener('click', function(){
 alleAfb = wisselArray(alleAfb);
 teller = 0;
 voegPlaatjeToe(0);
});
