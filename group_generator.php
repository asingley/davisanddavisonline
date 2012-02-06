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

echo '<center><H2>' . base64_decode($row['group_name']) . '</H2>';

echo '<select id="selOpt">';

$sqlGroup= "SELECT * FROM group_deals WHERE active=1 AND prod_type='$proid'";
$resultGroup = mysql_query($sqlGroup);

while ($rowGroup = mysql_fetch_array($resultGroup))
{
	echo '<option value="'.$rowGroup['shop_id'].'">'.base64_decode($rowGroup['deal_name']).'</option>';
}



echo '</optgroup>';
echo '</select><br>';
echo '<img onclick="fAddItem(\''.$proid.'\');" class="cart" src="images/cart.gif" alt="Add this selection to your basket." />';

echo '</center>';
?>
		<div class="purpBar">
			<img src="images/purplefadebar.jpg" alt="" />
		</div>
		
<?php 
$sqlOne = "SELECT * FROM products WHERE prod_type='$proid' AND active=1";
$resultOne = mysql_query($sqlOne);


echo htmlspecialchars_decode(base64_decode($row['description']));
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