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

<form enctype="multipart/form-data" action="submit_product_edit.php" method="post"></br>
Product Name: <input type="text" name="prod_name" value="<?php echo $row['product_name'];?>"/></br>
<?php 
echo '<input type="hidden" name="proid" value="'.$proid.'">';
if($row['prod_type'] == "alone")
	echo '<input type="radio" name="group1" value="alone" checked> Stand Alone Item<br>';
else 
	echo '<input type="radio" name="group1" value="alone" > Stand Alone Item<br>';
if($row['prod_type'] == "drink")
	echo '<input type="radio" name="group1" value="drink" checked> Drinks<br>';
else
	echo '<input type="radio" name="group1" value="drink"> Drinks<br>';
if($row['prod_type'] == "bowl")
	echo '<input type="radio" name="group1" value="bowl" checked> Bowls<br>';
else
	echo '<input type="radio" name="group1" value="bowl"> Bowls<br>';
if($row['prod_type'] == "cball")
	echo '<input type="radio" name="group1" value="cball" checked> Cheeseball Kits<br>';
else
	echo '<input type="radio" name="group1" value="cball" > Cheeseball Kits<br>';
if($row['prod_type'] == "oil")
	echo '<input type="radio" name="group1" value="oil" checked> Cooking and Dipping Oils<br>';
else
	echo '<input type="radio" name="group1" value="oil"> Cooking and Dipping Oils<br>';
if($row['prod_type'] == "dip")
	echo '<input type="radio" name="group1" value="dip" checked> Dipper Mixes<br>';
else
	echo '<input type="radio" name="group1" value="dip"> Dipper Mixes<br>';
if($row['prod_type'] == "fdrink")
	echo '<input type="radio" name="group1" value="fdrink" checked> Frozen Drinks and Mixes<br>';
else
	echo '<input type="radio" name="group1" value="fdrink"> Frozen Drinks and Mixes<br>';
if($row['prod_type'] == "kstuff")
	echo '<input type="radio" name="group1" value="kstuff" checked> Ken\'s Stuff<br>';
else
	echo '<input type="radio" name="group1" value="kstuff"> Ken\'s Stuff<br>';
if($row['prod_type'] == "must")
	echo '<input type="radio" name="group1" value="must" checked> Mustards and Relishes<br>';
else
	echo '<input type="radio" name="group1" value="must" > Mustards and Relishes<br>';
if($row['prod_type'] == "salsa")
	echo '<input type="radio" name="group1" value="salsa" checked> Salsa Magic<br>';
else
	echo '<input type="radio" name="group1" value="salsa"> Salsa Magic<br>';
$description = base64_decode($row['description']);
$description = str_replace("<br />", " ", $description );


?>


<script type="text/javascript">
function saveCurRng() {
curRng = document.selection.createRange().duplicate();
}
function surround(btag, etag){
if (curRng) {
document.editform.article.focus();
curRng.text= btag + curRng.text + etag;
return false;
}
}
</script>
</head>
<body>
Product Description: <br>
<textarea rows=5 cols=40 name="prod_desc" onKeyup="saveCurRng()" onMouseup="saveCurRng()"></textarea>

<a href="#" onclick="return surround('<b>', '</b>');">bold</a><br>
<a href="#" onclick="return surround('<i>', '</i>');">italic</a>




<!-- Product Description: <br><textarea cols="50" rows="4" name="prod_desc" ><?php //echo $description;?></textarea><br>-->
Product Recipe:<br><textarea cols="50" rows="4" name="prod_recip" ><?php echo $row['recipe'];?></textarea><br>
Price Per Unit: <input type="text" name="prod_price" value="<?php echo $row['cost'];?>"/><br>
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<br>
<h4>Active:</h4>
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
<input type="submit" value="Update"/><a href="../admin.php">Return to Admin Home</a>
</form>



<?php 
require_once("db_close.php");

?>