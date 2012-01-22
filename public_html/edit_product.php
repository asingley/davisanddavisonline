<?php 
session_start();
if(!session_is_registered(myusername)){
	header("location:../index.php");
}

$proid = $_GET["proid"]; 

require_once("db_connect.php");

$sql= "SELECT * FROM products where id=$proid";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);


?>
<H1>Editing: <?php echo $row['product_name'];?></H1>
<hr>

<form enctype="multipart/form-data" action="submit_new_item.php" method="post"></br>
Product Name: <input type="text" name="prod_name" value="<?php echo $row['product_name'];?>"/></br>
<?php 
if($row['prod_type'] == "alone")
	echo '<input type="radio" name="group1" value="alone" checked> Stand Alone Item<br>';
else 
	echo '<input type="radio" name="group1" value="alone" checked> Stand Alone Item<br>';

echo '<input type="radio" name="group1" value="drink"> Drinks<br>';
echo '<input type="radio" name="group1" value="bowl"> Bowls<br>';
echo '<input type="radio" name="group1" value="cball"> Cheeseball Kits<br>';
echo '<input type="radio" name="group1" value="oil"> Cooking and Dipping Oils<br>';
echo '<input type="radio" name="group1" value="dip"> Dipper Mixes<br>';
echo '<input type="radio" name="group1" value="fdrink"> Frozen Drinks and Mixes<br>';
echo '<input type="radio" name="group1" value="kstuff"> Ken\'s Stuff<br>';
echo '<input type="radio" name="group1" value="must" > Mustards and Relishes<br>';
echo '<input type="radio" name="group1" value="salsa"> Salsa Magic<br>';
?>
Product Description: <textarea cols="50" rows="4" name="prod_desc" value="<?php echo $row['description'];?>"></textarea><br>
Product Recipe: <input type="text" name="prod_recip" value="<?php echo $row['recipe'];?>"/><br>
Price Per Unit: <input type="text" name="prod_price" value="<?php echo $row['cost'];?>"/><br>
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
Choose a file to upload: <input name="uploadedfile" type="file" value="<?php echo $row['img_filename'];?>" /><br />
<input type="submit" value="Update"/><a href="../admin.php">Return to Admin Home</a>
</form>



<?php 
require_once("db_close.php");

?>