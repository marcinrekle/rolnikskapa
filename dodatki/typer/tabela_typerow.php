<?php
mysql_connect("mysql.cba.pl","admin_marcin","haslorolnik") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
mysql_select_db("rolnikskapa_cba_pl") or die(mysql_error()."Nie mozna wybrac bazy danych.");

zerowanie_tabeli();
$ile=mysql_num_rows(mysql_query("Select id from typer"));
for($i=1;$i<=$ile;$i++){
$typ=mysql_fetch_array(mysql_query("Select * from typer where id='".$i."'"));
$wynik=mysql_fetch_array(mysql_query("Select wynik from mecze where id='".$typ[1]."'"));
$typer=mysql_fetch_array(mysql_query("Select * from tab_typerow where id_uz='".$typ[2]."'"));
if($wynik[0]=='')continue;
if($typer[0]=='') mysql_query("INSERT INTO `tab_typerow` ( `id` , `id_uz` , `pkt` , `tr_w` , `tr_r` , `typ_m` , `miejsce` )VALUES ('', '".$typ[2]."', '0', '0', '0', '0', '0')");
$t=explode(":",$typ[3]);
$w=explode(":",$wynik[0]);
if($typ[3]==$wynik[0]){
$typer[2]=$typer[2]+11;
$typer[3]=$typer[3]+1;
$typer[5]=$typer[5]+1;
}
elseif((($t[0]>$t[1] AND $w[0]>$w[1])OR($t[0]==$t[1] AND $w[0]==$w[1])OR($t[0]<$t[1] AND $w[0]<$w[1]))) {
$typer[2]=$typer[2]+1;
$typer[4]=$typer[4]+1;
$typer[5]=$typer[5]+1;

}else $typer[5]=$typer[5]+1;
mysql_query("UPDATE `tab_typerow` SET  `pkt` = '".$typer[2]."', `tr_w` = '".$typer[3]."', `tr_r` = '".$typer[4]."', `typ_m` = '".$typer[5]."' WHERE `id_uz` = '$typ[2]' LIMIT 1");
}//for
function zerowanie_tabeli(){
$ile=mysql_num_rows(mysql_query("SELECT id from tab_typerow"));
for ($a=1;$a<=$ile;$a++){
mysql_query("UPDATE `tab_typerow` SET  `pkt` = '0', `tr_w` = '0', `tr_r` = '0', `typ_m` = '0', `miejsce` = '1' WHERE `id` = '".$a."'");

}//for
}//zerowanie_tabeli
miejsce();
function miejsce(){
$ile=mysql_num_rows(mysql_query("Select id from tab_typerow"));
for($i=1;$i<=$ile;$i++){


for($j=1;$j<=$ile;$j++){
                        $pkt1=mysql_fetch_array(mysql_query("Select * from tab_typerow where id='".$i."'"));
                        $pkt2=mysql_fetch_array(mysql_query("Select * from tab_typerow where id='".$j."'"));


                        if($pkt1[2]<$pkt2[2]) { $pkt1[6]=$pkt1[6]+1;mysql_query("UPDATE `tab_typerow` SET `miejsce`= '".$pkt1[6]."' WHERE id='".$i."'LIMIT 1");}
}//for<for
}//for
}//miejsce
$adresikg= explode("?",$_SERVER['HTTP_REFERER']);
$adresik=explode("&",$adresikg[1]) ;
$adres='';
$adres.=$adresikg[0];
header("Location:".$adres);
?>
