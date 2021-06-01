<!--HEADER-->
<?php
include("head.php");
?>
<!--/HEADER-->

<DIV id="naglowek">
<?php
include("naglowek.php");
?>
</DIV>

<div id="lewy_bok">
     <?php
     include("lewy.php");
     ?>
</div>

<div id="tresc">
     <?php
     include("tresc.php");
     mysql_query("INSERT INTO przeg values('','$_SERVER[HTTP_USER_AGENT]')");
     
     ?>
</div>

<div id="prawy_bok">
     <?php
     include("prawy.php");
     ?>
</div>
<div id="stopka">
&copy; Copyright Marcin Kazuba
</div>
</BODY>
</HTML>
<!--/FOOTER-->
