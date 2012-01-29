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
<H1>Editing: <?php echo base64_decode($row['product_name']);?></H1>
<hr>

<form enctype="multipart/form-data" action="submit_product_edit.php" method="post"></br>
Product Name: <input type="text" name="prod_name" value="<?php echo base64_decode($row['product_name']);?>"/></br>
<?php 
echo '<input type="hidden" name="proid" value="'.$proid.'">';
if($row['prod_type'] == "alone")
	echo '<input type="radio" name="group1" value="alone" checked> Stand Alone Item<br>';
else 
	echo '<input type="radio" name="group1" value="alone" > Stand Alone Item<br>';
$sqlOne= "SELECT * FROM groups WHERE active=1";
$resultOne = mysql_query($sqlOne);

while ($rowOne = mysql_fetch_array($resultOne))
{
	if ($rowOne[short_name] == $row[prod_type]){
		echo '<input type="radio" name="group1" value="'.$rowOne[short_name].'" checked>'.base64_decode($rowOne[group_name]).'<br>';
	}
	else {
		echo '<input type="radio" name="group1" value="'.$rowOne[short_name].'" checked>'.base64_decode($rowOne[group_name]).'<br>';
	}
	}
$description = base64_decode($row['description']);
$description = str_replace("<br />", " ", $description );


?>


<script type="text/javascript">
function formatText (el,tag) {
var selectedText=document.selection?document.selection.createRange().text:el.value.substring(el.selectionStart,el.selectionEnd);
if (selectedText!='') {
var newText='<'+tag+'>'+selectedText+'</'+tag+'>';
el.value=el.value.replace(selectedText,newText)
}
} 
</script>

Product Description:<br>
<textarea name="prod_desc" rows = "12" cols = "50"><?php echo $description;?></textarea><br>
<input type="button" value="Bold" onclick="formatText (prod_desc,'b');" />
<input type="button" value="Italic" onclick="formatText (prod_desc,'i');" />
<input type="button" value="Underline" onclick="formatText (prod_desc,'u');" />


<br>


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