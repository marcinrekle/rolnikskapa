<!--HEADER-->
<?
include("head.php");
?>
<!--/HEADER-->

<DIV id="naglowek">
<?
include("naglowek.php");
?>
</DIV>

<div id="lewy_bok">
     <?
     include("lewy.php");
     ?>
</div>

<div id="tresc">
<div class="terminarz">
      <div class="tyt">Wyniki</div>
<?php
include("polacz.php");
function pobierz_m($id){
$wynik=mysql_fetch_array(mysql_query("SELECT * FROM mecze WHERE id='".$id."'"));
return $wynik;
}//pobierz
function pobierz_n($id){
$wynik=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id='".$id."'"));
return $wynik;
}
function wyswietl_mecze(){
      $mecz=pobierz_m($_POST['id_m']);
      $ile=mysql_num_rows(mysql_query("Select id from mecze "));
      if($_POST['walkower']==1) $w=1 ;
      elseif($_POST['o_walkower']==1) $w=2;else $w=0;

      if(isset($_POST['mecz']) AND $_POST['w1']!='' AND $_POST['w2']!=''){//dodac sprawdzenie czy zalogowany
      mysql_query("UPDATE `mecze` SET `wynik` = '".$_POST['w1'].":".$_POST['w2']."', `walk` ='".$w."' WHERE  id='".$_POST['id_m']."'");

      }

      echo'<table rules="rows" class="typer">
      <tr><th>Data</th><th>Godz</th><th>Mecz</th><th>Wynik</th><th>Edycja</th></tr>'."\n".'<tr><th colspan="6">1 Kolejka</th></tr>'."\n";

      for($a=1;$a<=$ile;$a++){
      if($a==7 OR $a==13 OR $a==19 OR $a==25 OR $a==31 OR $a==37 OR $a==43 OR $a==49 OR $a==55 OR $a==61){
      $z=(($a-1)/6)+1;
      echo  '<tr><th colspan="5">'.$z.' Kolejka</th></tr>'."\n";
      }
      $mecze=pobierz_m($a);
      $godz=explode(":",$mecze[3]);
      $godz1=$godz[0].":".$godz[1];


      $dru1=pobierz_n($mecze[4]);
      $dru2=pobierz_n($mecze[5]);
      $dru=$dru1[0]." - ".$dru2[0];
      if($mecze[7]!=0) $mecze[6].='(wo)';
      echo'<tr><td>'.$mecze[2].'</td><td>'.$godz1.'</td><td>'.$dru.'</td><td>'.$mecze[6].'</td><td><a href="wyniki.php?id_m='.$a.'">zmień</a></td></tr>'."\n";
      }
      echo'</table>';
      }//wyswietl_mecze
      $u=mysql_fetch_array(mysql_query("Select ranga from uzytkownik where login='".$_SESSION['nick']."'"));
      $u2=mysql_fetch_array(mysql_query("Select ranga from sesja where nazwa_uz='".$_SESSION['nick']."'"));
      if($_COOKIE['zalogowany']=="no" AND $u[0]==$u2[0] AND $u[0]='admin') wyswietl_mecze();

      include("dodatki/typer/tabela_typerow.php");
      include("dodatki/typer/obliczanie_tab.php");
?>
 </div>
</div>
</div>

<div id="prawy_bok">
     <?
     include("prawy.php");
     ?>
</div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
	