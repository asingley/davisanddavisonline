<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:index.php");
}
$proid = $_GET["proid"];

require_once("db_connect.php");

$sql= "SELECT * FROM recipes where id=$proid";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$description = base64_decode($row['description']);
$description = str_replace("<br />", " ", $description );

?>
<head>
<title>New Recipe Portal</title>
</head>

<H1>New Recipe Portal</H1>
<hr>

<form enctype="multipart/form-data" action="submit_edit_recipe.php" method="post"></br>
Recipe Name: <input type="text" name="recipe_name" value="<?php echo base64_decode($row['recipe_name']);?>"/></br>



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
<textarea name="recipe_desc" rows = "20" cols = "80"><?php echo $description;?></textarea><br>
<input type="button" value="Bold" onclick="formatText (recipe_desc,'b');" />
<input type="button" value="Italic" onclick="formatText (recipe_desc,'i');" />
<input type="button" value="Underline" onclick="formatText (recipe_desc,'u');" />
<input type="button" value="Bullet" onclick="formatText (recipe_desc,'li');" />

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


<input type="submit" value="Submit"/><a href="../admin.php">Return to Admin Home</a>
</form>
