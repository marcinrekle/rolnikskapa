<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>mkRSS</title>
<link rel="stylesheet" type="text/css" href="styl.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<script type="text/javascript">

</script>


</head>
<body>
<div id="kontener">
<?php 
echo "<div id=\"lewa\">";
include 'lewa.php';
echo "</div>";
?>
<div id="tresc">
<div id="contentRss">
<?php 
include "../../../polacz.php";
$query=mysql_query("Select * from channel");
while ($row = mysql_fetch_row($query)) {
	$nw=mysql_num_rows(mysql_query("Select * from item where channel='$row[0]' and `read`='0'"));
	echo "<div class=\"channel\" style=\"background:$row[7]\">
	<div class=\"title\">$row[3]</div>
	<div class=\"desc\">$row[5]</div>
	<div class=\"info\">$nw</div>
	</div>";
}
?>
</div>
</div>
</div>
</body>
</html>