<?PHP
include("polacz.php");
	@$content = 'Najlepsze �yczenia zdrowia szcz�cia spe�nienia marze�, tak�e tych sportowych, w nadchodz�cym roku �ycz� admin, zarz�d oraz pi�karze Rolnika Sk�pa';
	$header = 	"From: admin@rolnikskapa.cba.pl \nContent-Type:".
			' text/plain;charset="iso-8859-2"'.
			"\nContent-Transfer-Encoding: 8bit";
		
		for($i=1;$i<=3;$i++){
		$emaile=mysql_fetch_array(mysql_query("SELECT * from `uzytkownik` where id='".$i."'"));
		
		if (mail($emaile[7], 'Zyczenia', $content, $header))
		echo "<p>".$emaile[7]."</p>";
			else 
		echo '<p><b>NIE</b> wys�ano maila!</p>';
		} 
		
		
		?>