<?php
include 'function.php';
$day="";
$query=mysql_query("SELECT * FROM history INNER JOIN EVENTS ON ( history.event_id = events.id ) ORDER BY TIME DESC");
//echo "<span id=\"infotxt\">Odswiezono</span>";
while ($row=mysql_fetch_array($query)){
	echo"";
	//echo " 0=".$row[0]." 1=".$row[1]." 2=".$row[2]." 3=".$row[3]." 4=".$row[4]." 5=".$row[5]."<br>";
	$nday=date("Y-m-d",strtotime($row[2]));
	//SELECT time FROM history WHERE time<'2013-01-18 09:17:41' and event_id=2 ORDER BY id DESC;
	echo $day==""||$day==$nday?"":"</div>";
	if($day!=$nday){
		echo "<div class=\"infoDay\"><div class=\"infoItem date\"><div class=\"itemDay black3d\">$nday</div></div>";
		$day=$nday;
	}	
		$class="event".$row[1];
		echo "<div class=\"infoItem red $class\"><div class=\"itemDate\">".date("H:i:s",strtotime($row[2]))."</div><div class=\"itemTitle\">".$row[4].
		"</div><div class=\"itemTime\">";
		$id=0;
		switch ($row[1]){
			case 3:$id=3;break;
			case 6:$id=10;break;
			case 7:$id=6;break;
			case 8:$id=11;break;
			case 9:$id=8;break;
			case 10:$id=1;break;
			case 11:$id=2;break;
		}
		$result=mysql_query("SELECT time FROM history WHERE id<'$row[0]' and event_id=$id ORDER BY id DESC LIMIT 1;");
		$time = mysql_fetch_array($result);
		$eventTime = strtotime($row[2])-strtotime($time[0]);
		$hour=floor($eventTime/3600);
		$eventTime-=$hour*3600;
		$min=floor($eventTime/60);
		$eventTime-=$min*60;
		$resultTime= $hour<200? $hour." h ".$min." m ".$eventTime." s":"bd";
		echo $resultTime;
		echo "</div></div>";
}
echo "</div>";

?>