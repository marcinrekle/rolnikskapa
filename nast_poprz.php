<?php
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_bin'");
function pobierz_n2($id){
$wynik=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id='".$id."'"));
return $wynik[0];
}//pobierz
function pobierz_n1($id){
$wynik=mysql_fetch_array(mysql_query("SELECT herb FROM druzyny WHERE id='".$id."'"));
return $wynik[0];
}//pobierz
function pobierz_m2($id){
$wynik=mysql_fetch_array(mysql_query("SELECT * FROM mecze WHERE id='".$id."'"));
return $wynik;
}//pobierz
echo'<div class="panel_n_p">';


$id=0;

for($i=1;$i<=22;$i++){
$cos=mysql_fetch_array(mysql_query("Select * from mecze where (id_h='1' OR id_a='1') AND id >'".$id."'"));
$d=explode("-",$cos[2]);//data
$g=explode(":",$cos[3]);//godzina
$c_m1=mktime($g[0],$g[1],$g[2],$d[1],$d[2],$d[0]);//czas meczu

$id=$cos[0];
$cos2=mysql_fetch_array(mysql_query("Select * from mecze where (id_h='1' OR id_a='1') AND id >'".$id."'"));
$d2=explode("-",$cos2[2]);//data
$g2=explode(":",$cos2[3]);//godzina
$c_m2=mktime($g2[0],$g2[1],$g2[2],$d2[1],$d2[2],$d2[0]);//czas meczu
$t1=explode(" ",pobierz_n2($cos[4]));
$t2=explode(" ",pobierz_n2($cos[5]));
$t3=explode(" ",pobierz_n2($cos2[4]));
$t4=explode(" ",pobierz_n2($cos2[5]));
if($c_m1<time()AND time()<$c_m2){
echo'<table><tr><th colspan="3">Poprzedni mecz</th></tr><tr><td  width=45%><img src="'.$_SESSION['adres'].'PLIKI/herb/'.pobierz_n1($cos[4]).'"></td><td width:10%>'.$cos[6].'</td><td width=45%><img src="'.$_SESSION['adres'].'PLIKI/herb/'.pobierz_n1($cos[5]).'"></td></tr><tr><td>'.$t1[0].'<br>'.$t1[1].'</td><td>-</td><td>'.$t2[0].'<br>'.$t2[1].'</td></tr><tr>
<tr><td colspan="3"></td></tr></table></div><div class="panel_n_p"><table><tr><th colspan="3">Następny mecz</th><tr><td  width=45%><img src="'.$_SESSION['adres'].'PLIKI/herb/'.pobierz_n1($cos2[4]).'"></td><td></td><td width=45%><img src="'.$_SESSION['adres'].'PLIKI/herb/'.pobierz_n1($cos2[5]).'"></td></tr><tr><td>'.$t3[0].'<br>'.$t3[1].'</td><td>-</td><td>'.$t4[0].'<br>'.$t4[1].'</td></tr><tr>
<tr><td colspan="3">'.$cos2[2].' '.$g2[0].':'.$g2[1].'</td></tr></table>';
break;
}
}
echo'</div>';
?>
