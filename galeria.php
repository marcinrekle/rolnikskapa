<?
session_start();
?>

<!--HEADER-->
<?
include("head.php");
?>
<!--/HEADER-->

<DIV id="naglowek"><?
include("naglowek.php");
?></DIV>

<div id="lewy_bok"><?
include("lewy.php");
?></div>

<div id="tresc"><?php
echo' <script type="text/javascript"
	src="slide.js"></script>
        <script type="text/javascript">
        <!-- '."\n"  ;
dodaj_galerie('retro',5,'2010/retro/');
dodaj_galerie('turnieje',40,'2010/turnieje/');
dodaj_galerie('fotki',56,'2010/fotki/');
dodaj_galerie('rolnik_chociw10',19,'2010/rolnik-chociw/');
dodaj_galerie('rolnik_kielczyglow10',25,'2010/rolnik-kielczyglow/');
dodaj_galerie('w_chabielice_rolnik',9,'2011/w-chabielice-rolnik/');
dodaj_galerie('w_buczek_rolnik',16,'2011/w-buczek-rolnik/');
dodaj_galerie('pp_rolnik_strzelce',73,'2011/pp-rolnik-strzelce/');
function dodaj_galerie($n_gal,$il_zdj,$src_gal){
	$a="\n" ;
	echo $n_gal.' = new PhotoViewer();'.$a;
	for($i=1;$i<$il_zdj+1;$i++){
		echo $n_gal.'.add("galeria/'.$src_gal.$i.'.jpg");'.$a;
	}
}
echo'
  -->
  </script>';
?>
<div class="kadra">
<div class="tyt">Galeria</div>

<div class="panel">
<div class="panel_text">
<div class="text">Rolnik Retro</div>
<div class="text">5 zdjęć</div>
</div>
<div class="panel_foto"><a href="javascript:void(retro.show(0))"><img
	src="galeria/2010/retro/mini.jpg" /></a></div>
</div>

<div class="panel2">
<div class="panel_text">
<div class="text">Turnieje</div>
<div class="text">40 zdjęć</div>
</div>
<div class="panel_foto"><a href="javascript:void(turnieje.show(0))"><img
	src="galeria/2010/turnieje/mini.jpg" /></a></div>
</div>

<div class="panel">
<div class="panel_text">
<div class="text">Różne</div>
<div class="text">56 zdjęć</div>
</div>
<div class="panel_foto"><a href="javascript:void(fotki.show(0))"><img
	src="galeria/2010/fotki/mini.jpg" /></a></div>
</div>

<div class="panel2">
<div class="panel_text">
<div class="text">Rolnik - Chociw</div>
<div class="text">19 zdjęć</div>
</div>
<div class="panel_foto"><a
	href="javascript:void(rolnik_chociw10.show(0))"><img
	src="galeria/2010/rolnik-chociw/mini.jpg" /></a></div>
</div>

<div class="panel">
<div class="panel_text">
<div class="text">Rolnik-Kiełczygłów</div>
<div class="text">25 zdjęć</div>
</div>
<div class="panel_foto"><a
	href="javascript:void(rolnik_kielczyglow10.show(0))"><img
	src="galeria/2010/rolnik-kielczyglow/mini.jpg" /></a></div>
</div>
<div class="panel">
<div class="panel_text">
<div class="text">Chabielice-Rolnik</div>
<div class="text">9 zdjęć</div>
<div class="text">27.02.2011</div>
<div class="text">2:3</div>
</div>
<div class="panel_foto"><a
	href="javascript:void(w_chabielice_rolnik.show(0))"><img
	src="galeria/2011/w-chabielice-rolnik/mini.jpg" /></a></div>
</div>

<div class="panel">
<div class="panel_text">
<div class="text">Orkan II -Rolnik</div>
<div class="text">16 zdjęć</div>
<div class="text">03.04.2011</div>
<div class="text">0:1</div>
</div>
<div class="panel_foto"><a
	href="javascript:void(w_buczek_rolnik.show(0))"><img
	src="galeria/2011/w-buczek-rolnik/mini.jpg" /></a></div>
</div>

<div class="panel">
<div class="panel_text">
<div class="text">Rolnik - Strzelce</div>
<div class="text">73 zdjęcia</div>
<div class="text">24.07.2011</div>
<div class="text">2:0</div>
</div>
<div class="panel_foto"><a
	href="javascript:void(pp_rolnik_strzelce.show(0))"><img
	src="galeria/2011/pp-rolnik-strzelce/mini.jpg" /></a></div>
</div>

</div>
</div>

<div id="prawy_bok"><?
include("prawy.php");
?></div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
