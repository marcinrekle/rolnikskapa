<?php
include '../../polacz.php';
include '../../funkcje.php';
zeruj_tabele();
oblicz();
zeruj_tabele();
oblicz();
zeruj_tabele();
oblicz();
function oblicz(){
	
	$dana=mysql_query("SELECT * FROM mecze11_12 WHERE wynik<>''");
	while ($r=mysql_fetch_row($dana)) {
		if ($r[4]==17||$r[5]==17) continue;
		$gosp=pobierz("*", "tabela1112", "id", $r[4]);
		$gosc=pobierz("*", "tabela1112", "id", $r[5]);
		$wynik=explode(":", $r[6]);
		if ($wynik[0]>$wynik[1]) {
			$gosp[1]+=1;
			$gosp[4]+=$wynik[0];
			$gosp[5]+=$wynik[1];
			$gosp[6]+=1;
			$gosp[9]+=$wynik[0];
			$gosp[10]+=$wynik[1];
			$gosc[3]+=1;
			$gosc[4]+=$wynik[1];
			$gosc[5]+=$wynik[0];
			$gosc[13]+=1;
			$gosc[14]+=$wynik[1];
			$gosc[15]+=$wynik[0];
		}
		elseif ($wynik[0]==$wynik[1]){
			$gosp[2]+=1;
			$gosp[4]+=$wynik[0];
			$gosp[5]+=$wynik[1];
			$gosp[7]+=1;
			$gosp[9]+=$wynik[0];
			$gosp[10]+=$wynik[1];
			$gosc[2]+=1;
			$gosc[4]+=$wynik[1];
			$gosc[5]+=$wynik[0];
			$gosc[12]+=1;
			$gosc[14]+=$wynik[1];
			$gosc[15]+=$wynik[0];
		}
		elseif ($wynik[0]<$wynik[1]){
			$gosp[3]+=1;
			$gosp[4]+=$wynik[0];
			$gosp[5]+=$wynik[1];
			$gosp[8]+=1;
			$gosp[9]+=$wynik[0];
			$gosp[10]+=$wynik[1];
			$gosc[1]+=1;
			$gosc[4]+=$wynik[1];
			$gosc[5]+=$wynik[0];
			$gosc[11]+=1;
			$gosc[14]+=$wynik[1];
			$gosc[15]+=$wynik[0];
		}
		update("tabela1112",
		 "z=$gosp[1],r=$gosp[2],p=$gosp[3],bz=$gosp[4],bs=$gosp[5],
		 z_h=$gosp[6],r_h=$gosp[7],p_h=$gosp[8],bz_h=$gosp[9],bs_h=$gosp[10],
		 z_a=$gosp[11],r_a=$gosp[12],p_a=$gosp[13],bz_a=$gosp[14],bs_a=$gosp[15]", "id=$gosp[0]");
		update("tabela1112",
		 "z=$gosc[1],r=$gosc[2],p=$gosc[3],bz=$gosc[4],bs=$gosc[5],
		 z_h=$gosc[6],r_h=$gosc[7],p_h=$gosc[8],bz_h=$gosc[9],bs_h=$gosc[10],
		 z_a=$gosc[11],r_a=$gosc[12],p_a=$gosc[13],bz_a=$gosc[14],bs_a=$gosc[15]", "id=$gosc[0]");
	}//while
}
//mecze - id kolejka data godz gosp gosc wynik walk
//tabela 1z 2r 3p 4bz 5bs 6zh 7rh 8ph 9bzh 10bsh 11za 12ra 13pa 14bza 15bsa   


function zeruj_tabele(){
	mysql_query("UPDATE tabela1112 SET z=0,r=0,p=0,bz=0,bs=0,z_h=0,r_h=0,
	p_h=0,bz_h=0,bs_h=0,z_a=0,r_a=0,p_a=0,bz_a=0,bs_a=0");
	//while
}//zeruj_tabele()

echo "Tabela została obliczona";
?>
