<head>
<title>New Product Portal</title>
</head>

<H1>New Product Portal</H1>
<hr>

<form enctype="multipart/form-data" action="submit_new_item.php" method="post"></br>
Product Name: <input type="text" name="prod_name"/></br>
<?php 
require_once("db_connect.php");
$sql= "SELECT * FROM groups WHERE active=1";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result))
{
	echo '<input type="radio" name="group1" value="'.$row[short_name].'" >'.base64_decode($row[group_name]).'<br>';
}
require_once("db_close.php");
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
<textarea name="prod_desc" rows = "12" cols = "50"></textarea><br>
<input type="button" value="Bold" onclick="formatText (prod_desc,'b');" />
<input type="button" value="Italic" onclick="formatText (prod_desc,'i');" />
<input type="button" value="Underline" onclick="formatText (prod_desc,'u');" />


<br>
Product Recipe:<br><textarea cols="50" rows="4" name="prod_recip" ></textarea><br>

Price Per Unit: <input type="text" name="prod_price"/><br>
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Submit"/><a href="../admin.php">Return to Admin Home</a>
</form>
