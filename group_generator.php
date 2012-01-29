<script type="text/javascript" src="scripter.js"></script>
<link rel="stylesheet" type="text/css" href="styler.css" />
<?php 
$con = mysql_connect("localhost","davis","davis");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("davisanddavis", $con);
$sql= "SELECT * FROM groups where short_name='$proid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

echo '<center><H2>' . base64_decode($row['group_name']) . '</H2></center>';
?>
		<div class="purpBar">
			<img src="images/purplefadebar.jpg" alt="" />
		</div>
		
<?php 
$sqlOne = "SELECT * FROM products WHERE prod_type='$proid'";
$resultOne = mysql_query($sqlOne);


echo '<div id="prodDisp">';
while ($rowOne = mysql_fetch_array($resultOne))
{
echo '<div class="imgContainer">';
	echo '<div class="conTitle">'.base64_decode($rowOne['product_name']).'</div>';
echo '<a href="index.php?gitemid='.$rowOne['id'].'"><img src="img/'.$rowOne['img_filename'].'"WIDTH="150" /></a>';
echo '<div class="conOrder"><a href="cheeseballBanana.htm">Ordering Info</a></div>';
echo '</div>';
}
echo '</div>';



mysql_close($con);
?>