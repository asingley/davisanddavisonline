<script type="text/javascript" src="scripter.js"></script>
<link rel="stylesheet" type="text/css" href="styler.css" />
<?php 
$con = mysql_connect("localhost","davis","davis");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("davisanddavis", $con);
$sql= "SELECT * FROM groups where short_name=$proid";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

echo base64_decode($row['group_name']);
?>
		<div class="purpBar">
			<img src="images/purplefadebar.jpg" alt="" />
		</div>
		
<?php mysql_close($con);?>