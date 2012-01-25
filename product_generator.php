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

echo $row[product_name];

echo '<div id="sales-container">';
echo $row['cost'];
echo '</div>';

echo '<div id="product-description">';
echo $row['description'];
echo '</div>';

echo $proid;
mysql_close($con);

?>
