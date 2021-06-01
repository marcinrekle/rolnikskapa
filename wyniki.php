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
      function pobierz_id($nazwa){
$wynik=mysql_fetch_array(mysql_query("SELECT id FROM uzytkownik WHERE login='".$nazwa."'"));
return $wynik;
}//pobierz
function pobierz_n($id){
$wynik=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id='".$id."'"));
return $wynik;
}//pobierz

      $mecz=pobierz_m($_GET['id_m']);
      $t1=pobierz_n($mecz[4]);
      $t2=pobierz_n($mecz[5]);
      echo '<br><form action="zarzadzanie.php" method="POST">'."\n".
      $t1[0].' - '.$t2[0]."\n".

      '<SELECT name="w1" >'."\n".'<option></option>'."\n";
      for($i=0;$i<=20;$i++) echo '<option>'.$i.'</option>'."\n" ;
      echo'</SELECT>'."\n".'
      <SELECT name="w2"><option></option>'."\n";
      for($i=0;$i<=20;$i++) echo '<option>'.$i.'</option>'."\n" ;
      echo'</SELECT><br>walkower
      <input type="checkbox" name="walkower" value="1">'."\n".'obustronny walkower
      <input type="checkbox" name="o_walkower" value="1">'."\n".'
      <br><br>
      <input type="hidden" name="id_m" value="'.$_GET['id_m'].'">'."\n".'
      <input type="submit" value="Zapisz" class="przycisk_r" name="mecz">';

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
