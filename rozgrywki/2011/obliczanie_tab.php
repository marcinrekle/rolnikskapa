<?php
include '../../funkcje.php';
include '../../polacz.php';
update("mecze11_12"," wynik='$_GET[wynik]'"," id=".$_GET['id']);
echo'<FORM id="f'.$_GET['id'].'"><SELECT id="gosp" name="gosp">';
echo '<option> </option>';
	$w=explode(":",$_GET['wynik']);
	for ($i = 0; $i <=30; $i++) {
	if ($i==$w[0]) {
		echo '<option selected>'.$i.'</option>'."\n";
	}else
	echo '<option>'.$i.'</option>'."\n";
}
echo '</SELECT><SELECT id="gosc" name="gosc">';
echo '<option> </option>';
for ($i = 0; $i <= 30; $i++) {
	if ($i==$w[1]) {
		echo '<option selected>'.$i.'</option>'."\n";
	}
	echo '<option>'.$i.'</option>'."\n";
}
echo '</SELECT>';
echo'<a href="javascript:wyswietl_cos('.$_GET['id'].')">Zmień</a></form>';
?>
