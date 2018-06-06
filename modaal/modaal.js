var grijzeAchtergrond = document.createElement('div');
document.body.appendChild(grijzeAchtergrond);
var sluitknop = document.createElement('span');
sluitknop.innerHTML = '&Cross;';
sluitknop.slassName = 'sluitknop';

var modaal = (function() {
  var modaalVenster = document.createElement('div');
  modaalVenster.className = 'modaal-venster';
  modaalVenster.addEventListener('click', function(e) {
    e.stopPropagation();
  });
  var modaalInhoud = document.createElement('div');
  modaalInhoud.className = 'modaal-inhoud';

  return {
    centreren: function() {
      var boven = Math.max((grijzeAchtergrond.offsetHeight - modaalVenster.offsetHeight)/2, 0);
      var links = Math.max((grijzeAchtergrond.offsetwidth - modaalVenster.offsetWidth)/2, 0);
      modaalVenster.style.top = boven + 'px';
      modaalVenster.style.left = links + 'px';
    },
    open: function(parameter) {
      modaalInhoud.appendChild(parameter);
      modaalVenster.appendChild(modaalInhoud);
      modaalVenster.appendChild(sluitknop);
      grijzeAchtergrond.className = 'grijze-achtergrond';
      grijzeAchtergrond.appendChild(modaalVenster);
      modaal.centreren();
    },
    sluiten: function() {
      modaalInhoud.innerHTML = '';
      modaalVenster.innerHTML = '';
      grijzeAchtergrond.removeChild(modaalVenster);
      grijzeAchtergrond.className = '';
    }
  }
}());

grijzeAchtergrond.addEventListener('click', modaal.sluiten);
sluitknop.addEventListener('click', modaal.sluiten);
