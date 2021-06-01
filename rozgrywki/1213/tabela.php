<!--HEADER-->
<?php
include("../../head.php");
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
     include $_SESSION['adres'].'polacz.php';
     include $_SESSION['adres'].'funkcje.php';
     echo ' <div class="rozgrywki"><div class="tyt">Tabela  1 gr 
     sieradzkiej B Klasy sezon 2012/13</div><div class="content">'."<table>";
     echo '<tr><th width=5%></th><th style="width:30%;text-align:left">
     Nazwa</th><th width=8%>M </th><th width=8%>Pkt </th>
     <th width=8%>Z </th><th width=8%>R </th><th width=8%>P </th>
     <th width=15%>Bramki</th><th width=8%>RB</th><th width=2%></th></tr>';
     $i=0;
     $s_pkt=0;
     $s_rb=0;
     $s_b=0;
     $dana=mysql_query("SELECT * FROM tabela1213 ORDER by (z*3)+r DESC, bz-bs DESC,bz DESC");
     while ($r=mysql_fetch_row($dana)){
     	$i+=1;
     	$mecze=$r[1]+$r[2]+$r[3];
     	$pkt=$r[1]*3+$r[2];
     	$rb=$r[4]-$r[5];
     	if (($pkt==$s_pkt)&&($rb==$s_rb)&&($r[4]==$s_b)) {
     		$m=' ';
     	}else $m=$i;
     	$s_pkt=$pkt;
     	$s_rb=$rb;
     	$s_b=$r[4];
     	$dru=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id=$r[0]"));
     	echo "<tr><td>$m</td><td>$dru[0]</td><td>$mecze</td><td>$pkt</td><td>$r[1]</td><td>$r[2]</td>
     	<td>$r[3]</td><td>$r[4]-$r[5]</td><td>$rb</td><td></td></tr>";
     }//while
     echo "</table><h4>Tabela spotkań u siebie</h4><table>";
     echo '<tr><th width=5%></th><th style="width:30%;text-align:left">
     Nazwa</th><th width=8%>M </th><th width=8%>Pkt </th>
     <th width=8%>Z </th><th width=8%>R </th><th width=8%>P </th>
     <th width=15%>Bramki</th><th width=8%>RB</th><th width=2%></th></tr>';
     $i=0;
     $s_pkt=0;
     $s_rb=0;
     $s_b=0;
     $dana=mysql_query("SELECT * FROM tabela1213 ORDER by (z_h*3)+r_h DESC, bz_h-bs_h DESC,bz_h DESC");
     while ($r=mysql_fetch_row($dana)){
     	$i+=1;
     	$mecze=$r[6]+$r[7]+$r[8];
     	$pkt=$r[6]*3+$r[7];
     	$rb=$r[9]-$r[10];
     	if (($pkt==$s_pkt)&&($rb==$s_rb)&&($r[9]==$s_b)) {
     		$m=' ';
     	}else $m=$i;
     	$s_pkt=$pkt;
     	$s_rb=$rb;
     	$s_b=$r[9];
     	$dru=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id=$r[0]"));
     	echo "<tr><td>$m</td><td>$dru[0]</td><td>$mecze</td><td>$pkt</td><td>$r[6]</td><td>$r[7]</td>
     	<td>$r[8]</td><td>$r[9]-$r[10]</td><td>$rb</td><td></td></tr>";
     }//while
     echo "</table><h4>Tabela spotkań na wyjeździe</h4><table>";
     echo '<tr><th width=5%></th><th style="width:30%;text-align:left">
     Nazwa</th><th width=8%>M </th><th width=8%>Pkt </th>
     <th width=8%>Z </th><th width=8%>R </th><th width=8%>P </th>
     <th width=15%>Bramki</th><th width=8%>RB</th><th width=2%></th></tr>';
     $i=0;
     $s_pkt=0;
     $s_rb=0;
     $s_b=0;
     $dana=mysql_query("SELECT * FROM tabela1213 ORDER by (z_a*3)+r_a DESC, bz_a-bs_a DESC,bz_a DESC");
     while ($r=mysql_fetch_row($dana)){
     	$i+=1;
     	$mecze=$r[11]+$r[12]+$r[13];
     	$pkt=$r[11]*3+$r[12];
     	$rb=$r[14]-$r[15];
     	if (($pkt==$s_pkt)&&($rb==$s_rb)&&($r[14]==$s_b)) {
     		$m=' ';
     	}else $m=$i;
     	$s_pkt=$pkt;
     	$s_rb=$rb;
     	$s_b=$r[14];
     	$dru=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id=$r[0]"));
     	echo "<tr><td>$m</td><td>$dru[0]</td><td>$mecze</td><td>$pkt</td><td>$r[11]</td><td>$r[12]</td>
     	<td>$r[13]</td><td>$r[14]-$r[15]</td><td>$rb</td><td></td></tr>";
     }//while
     echo "</table></div></div>";
     mysql_close();
     ?>

</div> 
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
