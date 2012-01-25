<script type="text/javascript" src="scripter.js"></script>
<link rel="stylesheet" type="text/css" href="product.css" />
<?php 
require_once("public_html/db_connect.php");
$sql= "SELECT * FROM products where id=1";
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
require_once("public_html/db_close.php");
?>
