<!--HEADER-->
<?php
include("../head.php");
include '../funkcje.php';

?>
<!--/HEADER-->
<DIV id="naglowek"><?php
include("../naglowek.php");
?></DIV>

<div id="lewy_bok"><?php
include("../lewy.php");
?></div>

<div id="tresc">
<div class="panel en">
<div class="tyt">Edycja i tworzenie newsów</div>
<div id="news_edit">
<form action="dodaj_news.php" method="post" id="newsForm">
<label for="tytNg">Tytuł na główną</label><input type="text" name="tytNg" maxlength="60"><br>
<label for="tyt">Tytuł</label><input type="text" name="tyt" maxlength="255"><br>
<label for="url">Url</label><input type="text" name="url" maxlength="60"><br>
<label for="link">Tytuł linka</label><input type="text" name="link" maxlength="60"><br>
<label for="rozgrywki">Rozgrywki</label><input type="text" name="rozgrywki" maxlength="12"><br>
<label for="rok">Rok</label><input type="text" name="rok" maxlength="4"><br>
<label for="foto">Zdjęcie</label><input type="text" name="foto" maxlength="64"><br>
<label for="data">Data</label><input type="text" name="data" maxlength="64" value="rrrr-mm-dd gg:mm"><br>
<?php 
include '../PLIKI/filelist.php';
?>

<label for="wpr">Wprowadzenie</label><textarea name="wpr" id="wpr"></textarea>
<label ></label>
<a href="javascript:zmienNews('wpr','<b></b>')" title="Pogrubienie"><b>b</b></a>
<a href="javascript:zmienNews('wpr','<i></i>')" title="Pochylenie"><i>i</i></a>
<a href="javascript:zmienNews('wpr','<u></u>')" title="Podkreślenie"><u>u</u></a>
<a href="javascript:zmienNews('wpr','<p>')" title="Nowy akapit">p</a>
<br>
<label for="opis">Opis</label><textarea name="opis" id="opis"></textarea>
<label ></label>
<a href="javascript:zmienNews('opis','<b></b>')" title="Pogrubienie"><b>b</b></a>
<a href="javascript:zmienNews('opis','<i></i>')" title="Pochylenie"><i>i</i></a>
<a href="javascript:zmienNews('opis','<u></u>')" title="Podkreślenie"><u>u</u></a>
<a href="javascript:zmienNews('opis','<p>')" title="Nowy akapit">p</a>
<br>
<label for="pods">Podsumowanie</label><textarea name="pods" id="pods"></textarea>
<label ></label>
<a href="javascript:zmienNews('pods','<b></b>')" title="Pogrubienie"><b>b</b></a>
<a href="javascript:zmienNews('pods','<i></i>')" title="Pochylenie"><i>i</i></a>
<a href="javascript:zmienNews('pods','<u></u>')" title="Podkreślenie"><u>u</u></a>
<a href="javascript:zmienNews('pods','<p>')" title="Nowy akapit">p</a>
<br>
<textarea name="news_sklad" id="news_sklad" ></textarea>
<textarea name="news_omeczu" id="news_omeczu" ></textarea><br>
<input type="submit" value="OK">
</form>

<form action="" id="wyn_br">
<label for="gospodarz">Gospodarz</label>
<select id="gospodarz">
<?php 
include'../polacz.php';
$pyt=mysql_query("SELECT * FROM druzyny");
while ($zaw=mysql_fetch_row($pyt)) {
	echo "<option>$zaw[1]</option>";
}
?>
</select><br>
<label for="gosc">Gość</label>
<select id="gosc">
<?php 
$pyt=mysql_query("SELECT * FROM druzyny");
while ($zaw=mysql_fetch_row($pyt)) {
	echo "<option>$zaw[1]</option>";
}
?>
</select><br>
<label>Wynik</label>
<select id="ggosp">
<?php 
for ($i = 0; $i < 23; $i++) {
	echo "<option>$i</option>";	
}
?>
</select> : 
<select id="ggosc">
<?php 
for ($i = 0; $i < 23; $i++) {
	echo "<option>$i</option>";	
}
?>
</select><br>
<label></label><a href="javascript:ENdodajWynik()">Dodaj wynik</a><br>
<label for="strz_rol">Strzelcy Rolnik</label>
<select id="strz_rol">
<?php 
$pyt=mysql_query("SELECT * FROM kadra WHERE kol_wys>0 ORDER by nazwisko");
while ($zaw=mysql_fetch_row($pyt)) {
	echo "<option>$zaw[2] $zaw[1]</option>";
}
?>
</select>
<a href="javascript:ENdodajStrzelca('rol')">Dodaj</a><a href="javascript:ENusunStrzelca('rol')">Wyczyść</a><br>
<label for="strz_rywal">Strzelcy rywal</label>
<input type="text" id="strz_rywal">
<a href="javascript:ENdodajStrzelca('ryw')">Dodaj</a><a href="javascript:ENusunStrzelca('ryw')">Wyczyść</a><br>
<br>
<a href="javascript:ENwynikGotowe()">Gotowe</a>
</form>
<br>
<div id="news_omeczu_kontener">
<div class="news_omeczu">
<div class="news_wynik">
<div class="news_wynik_gosp">Gospodarz</div>
<div class="news_wynik_wynik">?:?</div>
<div class="news_wynik_gosc">Gość</div>
</div>
<div class="news_bramki">
<div class="news_bramki_gosp">

</div>
<div class="news_bramki_gosc">

</div>
</div>
</div>
</div>


<form action="" id="sklad" >
<select id="zaw_id" style="display:none">
<?php 
for ($i = 1; $i < 23; $i++) {
	echo "<option>$i</option>";	
}
?>
</select><br>
<label for="stan">Status</label><input type="radio" name="stan" value="Podstawowy" checked="checked">Podstawowy
<input type="radio" name="stan" value="Zmiennik">Zmiennik
<input type="radio" name="stan" value="NieGral">Nie grał
<br>
<label for="poz">Pozycja</label>
<select id="poz">
<option>BR</option>
<option>PO</option>
<option>SOP</option>
<option>SOL</option>
<option>LO</option>
<option>PP</option>
<option>SPP</option>
<option>SPL</option>
<option>LP</option>
<option>PN</option>
<option>LN</option>
</select><br>
<label for="zaw">Imię i Nazwisko</label>
<select id="zaw">
<?php 
$pyt=mysql_query("SELECT * FROM kadra WHERE kol_wys>0 ORDER by nazwisko");
while ($zaw=mysql_fetch_row($pyt)) {
	echo "<option>$zaw[2] $zaw[1]</option>";
}
?>
</select><br>
<label for="nr">Numer</label>
<select id="nr">
<?php 
for ($i = 1; $i < 100; $i++) {
	echo "<option>$i</option>";	
}
?>
</select><br>
<label for="bramki">Bramki</label>
<select id="bramki">
<?php 
for ($i = 0; $i < 11; $i++) {
	echo "<option>$i</option>";	
}
?>
</select><br>
<label for="zk">Żółte kartki</label>
<select id="zk">
<?php 
for ($i = 0; $i < 3; $i++) {
	echo "<option>$i</option>";	
}
?>
</select><br>
<label for="czk">Czerwona kartka</label>
<select id="czk">
<?php 
for ($i = 0; $i < 2; $i++) {
	echo "<option>$i</option>";	
}
?>
</select><br>
<label for="sbramki">Bramki samobójcze</label>
<select id="sbramki">
<?php 
for ($i = 0; $i < 11; $i++) {
	echo "<option>$i</option>";	
}
?>
</select><br>
<label for="kontuzja">Kontuzja</label>
<input id="kontuzja" type="checkbox">
<br>
<a href="javascript:dodajZawodnika()">Dodaj</a>
<a href="javascript:dodajSklad()">Gotowe</a>
</form>
<div id="sklad_kontener">
<div class="news_sklad">
<div class="belka">Skład</div>
<div class="news_sklad_p">

</div>

<div class="news_sklad_r">
<div class="zawodnik rezerwa" id="lawka"><span>Rezerwowi:</span>


</div>

<div class="zawodnik trener">Trener:<br>
Jacek Wesołowski</div>

</div>

<div class="news_sklad_boisko">
<div class="gracz ln" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz pn" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz pp" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz spp" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz spl" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz lp" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz lo" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz sol" style=opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz sop" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz po" style="opacity:0">
<div class="nazwisko"></div>
</div>
<div class="gracz br" style="opacity:0">
<div class="nazwisko"></div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
<div id="opcje">

</div>
<div id="prawy_bok"><?php
include("../prawy.php");
?></div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
