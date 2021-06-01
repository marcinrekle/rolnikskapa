var Tw_left = 263;
var Tw_top  = 188;

var Tw_col = 'white';
var Col_br = 'brown';
var Col_red = 'red';
var Col_green = 'green';
var Col_blu = 'blue';
var Col_blc = 'black';

var Pls_left = 770;
var Pls_top = 44;
var Pls_tp2 = 350;
var Joz_left = -50;
var Joz_top = 40;
var Joz_tp2 = 360;
var Sob_top = 551;
var Sob_left = 240;

var TW_X = 360;
var TW_W = 240;
var TW_N = 120;

var Desc = [
["A kryta","<b>Trybuna A-Kryta</b><br/><br/>Najbardziej presti¿owa trybuna na stadionie, gdzie znajduj± siê miejsca sprzedawane w ramach pakietu hospitality, VIP oraz presti¿owe bilety i karnety. Miejsce biznesowych spotkañ i gwarancja ogl±dania meczu w komfortowych warunkach",Tw_left,Tw_top,Tw_col,TW_W],
["A 6-8","<b>Trybuna A</b><br/><br/>Miejsce, w którym zasiadaj± wierni, regularni bywalcy stadionu. Kibiców od murawy oddziela jedynie niewielkie ogrodzenie co znakomicie poprawia jako¶æ boiskowych wra¿eñ. Wysoki standard za nisk± cenê!",Tw_left,Tw_top,Tw_col,TW_W],
["A2Lux","<b>Trybuna A2-Lux</b><br/><br/>Miejsca o podwy¿szonym standardzie na trybunie krytej",Tw_left,Tw_top,Tw_col,TW_W],
["B - niciarka","<b>Trybuna B 'Niciarka</b>'<br/><br/>Bardzo dobre miejsce dla kibiców, którzy po raz pierwszy pojawiaj± siê na stadionie. Niska cena biletów i bardzo dobry widok na murawê sprzyjaj± m³odej widowni. To Ty decydujesz czy bêdziesz wspiera³ zespó³ dopingiem, czy skupisz siê na ogl±daniu zawodow. Potocznie nazywana 'Niciark±'",Tw_left,Tw_top,Tw_col,TW_W],
["C - prosta","<b>Trybuna C 'prosta</b>'<br/><br/>Najwiêksza trybuna, gdzie znajduje siê miejsce zarówno dla kibiców ceni±cych sobie spokój w pasjonowaniu siê wydarzeniami na boisku, jak i dla tych, którzy chc± ³±czyæ ogl±danie meczu z dopingowaniem Naszego zespo³u.",Tw_left,Tw_top,Tw_col,TW_W],
["D - zegar","<b>Trybuna D - 'Pod Zegarem'</b><br/><br/>Miejsce, w którym zasiadaj± najbardziej zagorzali kibice klubu. Sympatyków obowi±zuje niepisany Kodeks Kibica<br/>1. 'Pod Zegar' przychodzimy ubrani w klubowe, czerwone barwy oraz w szalik.<br/>2. Bez wzglêdu na wynik, ¿ywio³owo dopingujemy nasz zespo³<br/>3. Uczestniczymy w oprawie",Tw_left,Tw_top,Tw_col,TW_W],
["Wej¶cie 20-21","Wej¶cie na trybunê kibiców dru¿yny Go¶ci.",Joz_left,Joz_top,Col_br,TW_N],
["Wej¶cie 18","Wej¶cie 18",Tw_left,Tw_top,Tw_col,TW_W],
["Wej¶cie 16-19","Wej¶cie na trybunê 'B' dla posiadaczy biletów i karnetów",110,Sob_top,Col_blu,TW_W],
["Wej¶cie 16","Wej¶cie 16",Sob_left,Sob_top,Col_blu,TW_W],
["Wej¶cie 14-15","Wej¶cie na sektory B1-B3 dla posiadaczy biletów i karnetów",Sob_left,Sob_top,Col_green,TW_W],
["Wej¶cie 14","Wej¶cie 14",Sob_left,Sob_top,Col_green,TW_W],
["Wej¶cie 13","Wej¶cie sektory A6-A8 dla posiadaczy biletów i karnetów",Sob_left,Sob_top,Col_green,TW_W],
["Wej¶cie 12","Wej¶cie na trybunê A kryt±",Sob_left,Sob_top,Col_green,TW_W],
["Wej¶cie 11","G³owne wej¶cie na stadion i do budynku Klubu.",Sob_left,Sob_top,Col_blc,TW_X],
["Wej¶cie 10","Wej¶cie na trybunê D dla posiadaczy biletów i karnetów",Pls_left,Pls_tp2,Col_red,TW_N],
["Wej¶cie 9","Wej¶cie 9",Tw_left,Tw_top,Tw_col,TW_W],
["Wej¶cie 8","Wej¶cie 8",Tw_left,Tw_top,Tw_col,TW_W],
["Wej¶cie 7","Wej¶cie 7",Tw_left,Tw_top,Tw_col,TW_W],
["Wej¶cie 6","Wej¶cie 6",Tw_left,Tw_top,Tw_col,TW_W],
["Wej¶cie 5","Wej¶cie na trybunê C dla posiadaczy biletów i karnetów",Pls_left,Pls_top,Col_br,80],
["Wej¶cie 4","Wej¶cie 4",Pls_left,Pls_top,Col_br,TW_W],
["Wej¶cie 3","Wej¶cie 3",Pls_left,Pls_top,Col_br,TW_W],
["Wej¶cie 2","Wej¶cie 2",Pls_left,Pls_top,Col_br,TW_W],
["Wej¶cie 1","Wej¶cie 1",Pls_left,Pls_top,Col_br,TW_W],
["Kasa 8","<b>Kasa 8</b><br/>Czynna w dniu imprezy. ",Joz_left,Joz_tp2,Col_red,TW_N],
["Kasa 7","<b>Kasa 7</b><br/>Czynna w dniu imprezy od ok. 2 godz. przed rozpoczêciem meczu. Sprzeda¿ biletów oraz wydawanie biletów zakupionych przez internet",Joz_left,Joz_tp2,Col_red,TW_N],
["Kasa 6","<b>Kasa 6</b><br/>Czynna w dniu imprezy od godz. 10:00. Wydawanie biletów, karnetów oraz Kart Identyfikacji Kibica zakupionych przez internet",Joz_left,Joz_tp2,Col_red,TW_N],
["Kasa 5","<b>Kasa 5</b><br/>Kasa g³ówna, czynna pn-pt. w godz. 10-19, sob.10-14; w dniu imprezy od godz.10. Sprzeda¿ biletów i karnetów oraz wydawanie biletów zakupionych przez internet",Pls_left,Pls_tp2,Col_red,TW_N],
["Kasa 4","<b>Kasa 4</b><br/>Czynna w dniu imprezy od godz. 10:00. Sprzeda¿ Kart Identyfikacji Kibica",Pls_left,Pls_tp2, Col_red,TW_N],
["Kasa 3","<b>Kasa 3</b><br/>Czynna w dniu imprezy od godz. 12:30. Sprzeda¿ biletów i karnetów oraz wydawanie biletów zakupionych przez internet",Pls_left,Pls_tp2,Col_red,TW_N],
["Kasa 2","<b>Kasa 2</b><br/>Czynna w dniu imprezy od ok. 2 godz. przed rozpoczêciem meczu. Sprzeda¿ biletów oraz wydawanie biletów zakupionych przez internet",Pls_left,Pls_tp2,Col_red,TW_N],
["Kasa 1","<b>Kasa 1</b><br/>Czynna w dniu imprezy od ok. 2 godz. przed rozpoczêciem meczu. Sprzeda¿ biletów oraz wydawanie biletów zakupionych przez internet",Pls_left,Pls_tp2,Col_red,TW_N],
["Sektory Go¶ci","<b>Sektory dla kibicow dru¿yny Go¶ci</b>",Tw_left,Tw_top,Tw_col,TW_W],
["Wej¶cie 6","Wej¶cie na trybunê D TYLKO DLA POSIADACZY KARNETÓW",Pls_left,Pls_tp2,Col_red,TW_N],
["Wej¶cie 2","Wej¶cie na trybunê C TYLKO DLA POSIADACZY KARNETÓW",Pls_left,Pls_top,Col_br,80]
];


function hideSprite() {
//	var sprite = document.getElementById('trawnik');
//	document.getElementById('trawnik_0').style.display = "none";
	document.getElementById('TW').style.display = "none";
}

function showSprite(msg) {
	var sprite = document.getElementById('TW');
	var browser=navigator.appName;
	var oL = document.getElementById('std').offsetLeft;
	var oT = document.getElementById('std').offsetTop;
	if (browser=="Microsoft Internet Explorer") 
	 { 
        var oE = document.body.offsetWidth;
	if (oE>1000) { oL = oL + oE/2 - 500};
	sprite.style.left = oL  + msg[2] + "px";
	sprite.style.top = (oT + 180) + msg[3] + "px";
	 }
	else
	 {
	sprite.style.left = oL + msg[2] + "px";
	sprite.style.top = oT + msg[3] + "px";
	 };
	sprite.style.color = msg[4];
	sprite.style.width = msg[5] + "px";
	sprite.innerHTML = msg[1];
	sprite.style.display = "inline";
}

