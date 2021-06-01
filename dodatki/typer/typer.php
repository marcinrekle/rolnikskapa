<!--HEADER-->
<?
include("../../head.php");
?>
<!--/HEADER-->

<DIV id="naglowek"><?
include("../../naglowek.php");
?></DIV>

<div id="lewy_bok"><?
include("../../lewy.php");
?></div>

<div id="tresc">
<div class="typer">
<div class="tyt">Typer</div>
<?php

mysql_connect("mysql.cba.pl","admin_marcin","haslorolnik") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
mysql_select_db("rolnikskapa_cba_pl") or die(mysql_error()."Nie mozna wybrac bazy danych.");


function pobierz_m($id){
	$wynik=mysql_fetch_array(mysql_query("SELECT * FROM mecze WHERE id='".$id."'"));
	return $wynik;
}//pobierz
function pobierz_t($id,$nazwa){
	$wynik=mysql_fetch_array(mysql_query("SELECT * FROM typer WHERE id_m='".$id."' AND id_uz='".$nazwa."'"));
	return $wynik;
}//pobierz
function pobierz_nu($nazwa){
	$wynik=mysql_fetch_array(mysql_query("SELECT login FROM uzytkownik WHERE id='".$nazwa."'"));
	return $wynik[0];
}//pobierz
function pobierz_id($nazwa){
	$wynik=mysql_fetch_array(mysql_query("SELECT id FROM uzytkownik WHERE login='".$nazwa."'"));
	return $wynik;
}//pobierz
function pobierz_n($id){
	$wynik=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id='".$id."'"));
	return $wynik;
}//pobierz
function sprawdz_czas($mecze){
	$d=explode("-",$mecze[2]);//data
	$g=explode(":",$mecze[3]);//godzina
	$c_m=mktime($g[0],$g[1],$g[2],$d[1],$d[2],$d[0]);//czas meczu
	$now=time(); //czas teraz
	if($c_m>$now) return 1; else return 0;
}//sprawdz_czas
function typ($id,$uz,$mecze){

	$typ=pobierz_t($id,$uz);
	$t=explode(":",$typ[3]);//typ
	if(($typ[3]!=null)AND(sprawdz_czas($mecze)==1)) return '<a href="typuj.php?id_m='.$id.'&w1='.$t[0].'&w2='.$t[1].'">'.$typ[3].'</a>';
	elseif($typ[3]!=null) return $typ[3];
	elseif(sprawdz_czas($mecze)==1) return '<a href="typuj.php?id_m='.$id.'">typuj</a>'; else return 'NT';


}
function pkt($typ,$wynik){
	$t=explode(":",$typ);
	$w=explode(":",$wynik);
	$r=0;
	if($typ==$wynik) $r=10;
	if((($t[0]>$t[1] AND $w[0]>$w[1])OR($t[0]==$t[1] AND $w[0]==$w[1])OR($t[0]<$t[1] AND $w[0]<$w[1]))) $r=$r+1;
	if($typ==null) $r="-";
	if(($typ==null AND $wynik==null)OR($wynik==null)) $r=" ";
	return $r;
}     function tab_typerow(){
	echo '<br>Tabela typerów<br><br><table rules="rows" >
      <tr><th>Lp</th><th>Nazwa typera</th><th>Pkt</th><th>Traf. wyniki</th><th>Traf. rezultaty</th><th>Typ. mecze</th></tr>';
	$ile=mysql_num_rows(mysql_query("Select id from tab_typerow"));
	for($i=1;$i<=$ile;$i++){
		for($j=1;$j<=$ile;$j++){
			$miejsce=mysql_fetch_array(mysql_query("Select * from tab_typerow where id='".$j."'"));
			if($miejsce[6]==$i){
				echo'<tr><td>'.$i.'</td><td style="text-align:left">'.pobierz_nu($miejsce[1]).'</td><td>'.$miejsce[2].'</td><td>'.$miejsce[3].'</td><td>'.$miejsce[4].'</td><td>'.$miejsce[5].'</td><tr>'."\n";
			}
		}//for<for
	}//for
	echo'</table><br><br>';
}//tab_typerow
function wyswietl_typy(){
	$id=$_POST['id_m'];
	$mecz=pobierz_m($id);
	$uz=pobierz_id($_SESSION['nick']);
	$typ_spr=pobierz_t($id,$uz[0]);
	if(isset($_POST['typek']) AND $_POST['w1']!='' AND $_POST['w2']!='' AND sprawdz_czas($mecz)==1 ){//dodac sprawdzenie czy zalogowany
		if($typ_spr[0]!='')  mysql_query("UPDATE `typer` SET `wynik` = '".$_POST['w1'].":".$_POST['w2']."' WHERE `id_uz` = '".$uz[0]."' AND id_m='".$id."' LIMIT 1");else
		mysql_query("INSERT INTO `typer` ( `id` , `id_m` , `id_uz` , `wynik` )VALUES ('', '".$id."', '".$uz[0]."', '".$_POST['w1'].":".$_POST['w2']."') ");
	}
	echo'<table rules="rows" class="typer">
      <tr><th>Data</th><th>Godz</th><th>Mecz</th><th>Typ</th><th>Wynik</th><th>Pkt</th></tr>'."\n".'<tr><th colspan="6">1 Kolejka</th></tr>'."\n";
	for($a=1;$a<=132;$a++){
		if($a==7 OR $a==13 OR $a==19 OR $a==25 OR $a==31 OR $a==37 OR $a==43 OR $a==49 OR $a==55 OR $a==61 OR $a==67 OR $a==73 OR $a==79 OR $a==85 OR $a==91 OR $a==97 OR $a==103 OR $a==109 OR $a==115 OR $a==121 OR $a==127){
			$z=(($a-1)/6)+1;
			echo  '<tr><th colspan="6">'.$z.' Kolejka</th></tr>'."\n";
		}
		$mecze=pobierz_m($a);
		$godz=explode(":",$mecze[3]);
		$godz1=$godz[0].":".$godz[1];
		$uz=pobierz_id($_SESSION['nick']);
		$typ=pobierz_t($a,$uz[0]);
		$dru1=pobierz_n($mecze[4]);
		$dru2=pobierz_n($mecze[5]);
		$dru=$dru1[0]." - ".$dru2[0];
		echo'<tr><td>'.$mecze[2].'</td><td>'.$godz1.'</td><td>'.$dru.'</td><td>'.typ($a,$uz[0],$mecze).'</td><td>'.$mecze[6].'</td><td>'.pkt($typ[3],$mecze[6]).'</td></tr>'."\n";
	}
	echo'</table>';
}//wyswietl_typy
tab_typerow();
if($_COOKIE['zalogowany']=="no") wyswietl_typy(); else
echo 'Typer jest dostępny tylko dla zalogowanych użytkowników. Jeżeli nie posiadasz jeszcze konta w serwisie to <a href="'.$_SESSION['adres'].'rejestracja.php">zarejestruj się</a>.<br><br>';
?></div>
</div>
</div>

<div id="prawy_bok"><?
include("../../prawy.php");
?></div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
