<?php 
session_start();
if(!session_is_registered(myusername)){
	header("location:../index.php");
}

$proid = $_GET["proid"]; 

require_once("db_connect.php");

$sql= "SELECT * FROM product_deal where id=$proid";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$name = base64_decode($row['deal_name']);
?>
<head>
<title>Edit Product Deal Portal</title>
</head>

<H1>Edit Product Deal Portal</H1>
<hr>

<form enctype="multipart/form-data" action="submit_edit_product_deal.php" method="post"></br>
Deal Name(i.e. 3 pack for $20.99): <input type="text" name="deal_name" value="<?php echo $name;?>"/></br>
Product ID Number(From ShopSite): <input type="text" name="shop_id" value="<?php echo $row['shop_id'];?>"/></br>

<?php 
echo '<input type="hidden" name="proid" value="'.$proid.'">';

$sqlOne= "SELECT * FROM products WHERE active=1";
$resultOne = mysql_query($sqlOne);

while ($rowOne = mysql_fetch_array($resultOne))
{
if ($rowOne[id] == $row[prod_type]){
		echo '<input type="radio" name="group1" value="'.$rowOne[id].'" checked>'.base64_decode($rowOne[product_name]).'<br>';
	}
	else {
		echo '<input type="radio" name="group1" value="'.$rowOne[id].'" >'.base64_decode($rowOne[product_name]).'<br>';
	}
}

?>
<hr>

<?php 
if ($row['active'] == 1){
	echo '<input type="radio" name="group2" value="1" checked> Active(available for sale)<br>';
	echo '<input type="radio" name="group2" value="0"> Not Active(out of stock, not for sale, etc...)<br>';}
else{
	echo '<input type="radio" name="group2" value="1" > Active(available for sale)<br>';
	echo '<input type="radio" name="group2" value="0" checked> Not Active(out of stock, not for sale, etc...)<br>';
}
?>

<br>

<input type="submit" value="Submit"/><a href="../admin.php">Return to Admin Home</a>
</form>
<?php 
require_once("db_close.php");

?>