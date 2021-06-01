<?php
include 'function.php';
$info=mysql_fetch_array(mysql_query("SELECT num_plcstate FROM info WHERE id=1"));
$file = 'C:\plc.txt';
$current = file_get_contents($file);
$current = $info[0];
file_put_contents($file, $current);
?>