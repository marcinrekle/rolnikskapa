<?php
/*
 MPShout 0.2
 By Morgan Andersson
 www.morgande.com
 */
require_once "mpcfg.php";

$db = mysql_connect($dbaddress,$username,$password); if (!$db) die("Could'nt connect to the database");
mysql_select_db($mysqldb,$db) or die ("Could'nt open $db: ".mysql_error() );
$shout=$_POST['shout'];
$message=$_POST['messageText'];
$name=$_POST['name'];
if(!isset($shout))
{
	shouttable($color1,$color2,$color3);
}
elseif(isset($shout))
{

	$name = trim($name);
	$message = trim($message);

	if(!$name || !$message)
	{
		shouttable($color1,$color2,$color3);
	}
	else
	{
		if(strstr($message,"<img"))
		{
			shouttable($color1,$color2,$color3);
		}
		else
		{
			generateshout($name,$message);
			shouttable($color1,$color2,$color3);
		}
	}
}

function shouttable($color1,$color2,$color3)
{
	?>


<table rules="none">
	<form method="post" name="shoutform" action="">
	<tr>
		<td colspan="2"><iframe NAME="MPShout"
			SRC="<?php echo $_SESSION['bez']?>mpshout/show.php" WIDTH=188
			HEIGHT=200 FRAMEBORDER="0"></iframe></td>
		<script language="Javascript" type="text/javascript">
function MPsmiley(smiley) {
document.shoutform.message.value += " "+smiley+" ";
document.shoutform.message.focus();
}</script>
	</tr>
	<tr>
		<td colspan="2"><br>
		</td>
	</tr>
	<tr>
	<?php
	if($_COOKIE['zalogowany']=="no"){
		ECHO'
      <td>Nick: </td><td><input name="name" type="text" id="name" size="20" maxlength="20" value="'.$_SESSION['nick'].'"></td></tr> 
        <tr><td>Text: </td>
        <td><input name="messageText" type="text" id="messageText" size="20" maxlength="250"> 
        </td></tr><tr><td></td><td> <input name="shout" type="submit" id="shout" value="Napisz" class="btn" > </td>
    </tr>
	 </form>
    <tr> 
      <td colspan="2" style="padding-left:5px;padding-top:3px;"><a href="javascript:MPsmiley(\':)\')" title=\':)\' class="sb"><img src="'.$_SESSION[bez].'mpshout/shoutimages/smile.gif" border="0" class="sb"></a> 
        <a href="javascript:MPsmiley(\':D\')" title=\':D\' class="sb"><img src="'.$_SESSION[bez].'mpshout/shoutimages/bigsmile.gif" border="0" class="sb"></a> 
        <a href="javascript:MPsmiley(\'8D\')" title=\'8D\' class="sb"><img src="'.$_SESSION[bez].'mpshout/shoutimages/cool.gif" border="0" class="sb"></a> 
        <a href="javascript:MPsmiley(\':(!\')" title=\':(!\' class="sb"><img src="'.$_SESSION[bez].'mpshout/shoutimages/angry.gif" border="0" class="sb"></a> 
        <a href="javascript:MPsmiley(\':(\')" title=\':(\' class="sb"><img src="'.$_SESSION[bez].'mpshout/shoutimages/frown.gif" border="0" class="sb"></a> 
        <a href="javascript:MPsmiley(\':P\')" title=\':P\' class="sb"><img src="'.$_SESSION[bez].'mpshout/shoutimages/tongue.gif" border="0" class="sb"></a> 
        <a href="javascript:MPsmiley(\';)\')" title=\';)\' class="sb"><img src="'.$_SESSION[bez].'mpshout/shoutimages/wink.gif" border="0" class="sb"></a> 
      </td>';
	}else
	echo '<tr><td colspan="2" style="padding-left:5px">Pisać mogą tylko osoby zalogowane</td></tr>';
	?>
	</tr>
	<tr>
		<td colspan="2">
		<div align="center"><a href="http://www.morgande.com">www.morgande.com</a></div>
		</td>
	</tr>

</table>

	<?php
} // end shouttable()
function generateshout($name,$message)
{
	$shoutdate = date("d-m-Y");
	$shouttime = date("G:i");

	$name = addslashes($name);
	$message = addslashes($message);
	$insertquery = mysql_query("INSERT INTO `mpshout` (shoutName,shoutMessage,shoutDate,shoutTime)
											VALUES ('$name','$message','$shoutdate','$shouttime')");

} // end generateshout()
mysql_close($db);
?>