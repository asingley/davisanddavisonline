<script type="text/javascript" src="scripter.js"></script>
<link rel="stylesheet" type="text/css" href="product.css" />
<?php 
$con = mysql_connect("localhost","davis","davis");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("davisanddavis", $con);
$sql= "SELECT * FROM products where id=$proid";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);



echo '<div id="sales-container">';
echo '<H3>' . $row['product_name'] . '</H3>';
echo '$' . $row['cost'];
echo '</div>';
echo '<div class="purpBar">';
echo '<img src="images/purplefadebar.jpg" alt="Davis And Davis" />';
echo '</div>';
echo '<div id="product-image" style="float: left;">';
echo '<img src="img/'. $row['img_filename'] . '"/>';
echo '</div>';
echo '<div id="product-description" style="float: right;">';
echo htmlspecialchars(base64_decode($row['description']));
echo '</div>';

mysql_close($con);

?>
