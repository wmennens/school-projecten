class AutomatischAanvuller {
  constructor() {
    this.minimAantalKar = 2;
    this.veld = 0;
    this.hulp = document.createElement('div');
    this.hulp.id = 'helper';
    this.bron = 0;
    document.body.appendChild(this.hulp);
  }
  volgInvoer(inv) {
    if (inv.length >= this.minimAantalKar) {
      console.log(inv);
      this.hulp.style.display = 'block';
      this.vergelijk(inv);
    } else {
      console.log('verbergen');
      this.verbergHelper();
    }
  }
  vergelijk(inv) {
    console.log(inv);
    let lijst = [];
    this.hulp.innerHTML = '';
    for (var i = 0; i < this.bron.length; i++) {
      if (inv.toLowerCase() == this.bron[i].substr(0, inv.length).toLowerCase()) {
        lijst.push(this.bron[i]);
      }
    }
    if (lijst.length >= 1) {
      this.toon(lijst);
    }
  }
  toon(arr) {
    console.log(arr);
    this.hulp.innerHTML = '';
    for (let i=0; i<arr.length; i++) {
      let linkje = document.createElement('span');
      linkje.innerHTML = arr[i];
      this.hulp.appendChild(linkje);
      linkje.addEventListener('click', () => {
        this.voerWaardeIn(arr[i]);
      });
    }
    this.positioneerHelper(this.hulp);
  }
  positioneerHelper(el) {
    let elem = this.veld;
    el.style.width = elem.offsetWidth - 42 + 'px';
    el.style.left = elem.offsetleft + 21 + 'px';
    el.style.top = elem.offsetTop + elem.offsetHeight + 'px';
  }
  voerWaardeIn(land) {
    this.veld.value = land;
    this.verbergHelper();
  }
  verbergHelper() {
    this.hulp.style.display = 'none';
  }
  init(idVanHetVeld, bron) {
    this.bron = bron;
    this.veld = document.getElementById(idVanHetVeld);
    this.veld.onkeyup = () => {
      this.volgInvoer(this.veld.value);
    };
    this.veld.addEventListener('blur', () => {
      setTimeout( () => this.verbergHelper(), 1000);
    })
  }
}
