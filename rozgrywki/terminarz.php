<?php
include("../head.php");
?>
<!--/HEADER-->

<DIV id="naglowek">
<?php
include($_SESSION['adres']."naglowek.php");
?>
</DIV>

<div id="lewy_bok">
     <?php
     include($_SESSION['adres']."lewy.php");
     ?>
</div>

<div id="tresc">

<?php
include("term3.php");
?>

</div>

<div id="prawy_bok">
     <?php
     include($_SESSION['adres']."prawy.php");
     ?>
</div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
