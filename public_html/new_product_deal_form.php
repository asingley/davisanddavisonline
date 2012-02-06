<head>
<title>New Product Deal Portal</title>
</head>

<H1>New Product Deal Portal</H1>
<hr>

<form enctype="multipart/form-data" action="submit_new_product_deal.php" method="post"></br>
Deal Name(i.e. 3 pack for $20.99): <input type="text" name="deal_name"/></br>
Product ID Number(From ShopSite): <input type="text" name="shop_id"/></br>

<?php 
require_once("db_connect.php");
$sql= "SELECT * FROM products WHERE active=1";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result))
{
	echo '<input type="radio" name="group1" value="'.$row[id].'" >'.base64_decode($row[product_name]).'<br>';
}
require_once("db_close.php");
?>


<br>

<input type="submit" value="Submit"/><a href="../admin.php">Return to Admin Home</a>
</form>