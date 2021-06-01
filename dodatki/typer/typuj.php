<!--HEADER-->
<?
include("../../head.php");
?>
<!--/HEADER-->

<DIV id="naglowek">
<?
include("../../naglowek.php");
?>
</DIV>

<div id="lewy_bok">
     <?
     include("../../lewy.php");
     ?>
</div>

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
      function pobierz_id($nazwa){
$wynik=mysql_fetch_array(mysql_query("SELECT id FROM uzytkownik WHERE login='".$nazwa."'"));
return $wynik;
}//pobierz
      function pobierz_n($id){
$wynik=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id='".$id."'"));
return $wynik;
}//pobierz
function typ($id,$uz,$mecze){
         $d=explode("-",$mecze[2]);//data
         $g=explode(":",$mecze[3]);//godzina
         $c_m=mktime($g[0],$g[1],$g[2],$d[1],$d[2],$d[0]);//czas meczu
         $now=time(); //czas teraz
         $typ=pobierz_t($id,$uz);
         $t=explode(":",$typ[3]);//typ
         if(($typ[3]!=null)AND($c_m>$now)) return '<a href="typuj?id_m='.$id.'&w1='.$t[0].'&w2='.$t[1].'">'.$typ[3].'</a>';
         elseif($typ[3]!=null) return $typ[3];
         elseif($c_m>$now) return '<a href="typuj?id_m='.$id.'">typuj</a>'; else return 'NT';


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
}
      $mecz=pobierz_m($_GET['id_m']);
      $t1=pobierz_n($mecz[4]);
      $t2=pobierz_n($mecz[5]);
      echo '<br><form action="typer.php" method="POST">'."\n<p>".
      $t1[0].' - '.$t2[0]."\n".

      '<SELECT name="w1" >'."\n".'<option></option>'."\n";
      for($i=0;$i<=30;$i++) echo '<option>'.$i.'</option>'."\n" ;
      echo'</SELECT>'."\n".'
      <SELECT name="w2"><option></option>'."\n";
      for($i=0;$i<=30;$i++) echo '<option>'.$i.'</option>'."\n" ;
      echo'</SELECT>
      <input type="hidden" name="id_m" value="'.$_GET['id_m'].'">'."\n".'
      <input type="submit" value="Typuj" class="przycisk" name="typek">';

      ?>
      </div>
</div>
</div>

<div id="prawy_bok">
     <?
     include("../../prawy.php");
     ?>
</div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
