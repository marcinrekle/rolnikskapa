<?php
include '../polacz.php';
include '../funkcje.php';

zeruj_tabele();
oblicz_typy();
function oblicz_typy(){
	$a=0;
$dana=mysql_query("SELECT * FROM typer1314");
while ($r=mysql_fetch_array($dana)){
	$a+=1;
	$wynik=pobierz("wynik", "mecze1314", "id", $r[1]);
	if ($wynik==NULL) {
		continue;
	}
	$typer=pobierz("*", "tab_typerow1314", "id_uz", $r[2]);
	if ($typer[0]==''){ mysql_query("INSERT INTO `tab_typerow1314` 
	( `id` , `id_uz` , `pkt` , `tr_w` , `tr_r` , `typ_m` , `miejsce` )
	VALUES ('', '".$r[2]."', '0', '0', '0', '0', '0')");}
	$t=explode(":",$r[3]);
	$w=explode(":",$wynik);
	if ($r[3]==$wynik){
	$typer[2]=$typer[2]+11;
	$typer[3]=$typer[3]+1;
	$typer[5]=$typer[5]+1;
	}
	elseif((($t[0]>$t[1] AND $w[0]>$w[1])OR($t[0]==$t[1] AND $w[0]==$w[1])OR($t[0]<$t[1] AND $w[0]<$w[1]))) {
	$typer[2]=$typer[2]+1;
	$typer[4]=$typer[4]+1;
	$typer[5]=$typer[5]+1;
	}else $typer[5]=$typer[5]+1;
	update("tab_typerow1314", "`pkt` = $typer[2], `tr_w` = $typer[3],
	 `tr_r` = $typer[4], `typ_m` = $typer[5]", "`id`=".$typer[0]);
	
}//while
}//oblicz typy

function zeruj_tabele(){
	$dana=mysql_query("SELECT * FROM tab_typerow1314");
	while ($r=mysql_fetch_row($dana)){
		update("tab_typerow1314", "`pkt` = 0, `tr_w` = 0, `tr_r` = 0, `typ_m` = 0", "`id`=".$r[0]);
	}//while
}//zeruj_tabele()
$arr=array("Status"=>"Tabela została obliczona");
echo json_encode($arr);

?>
