<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:index.php");
}

$proid = $_GET["proid"];

require_once("db_connect.php");

$sql= "SELECT * FROM groups where id=$proid";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$description = base64_decode($row['description']);
$description = str_replace("<br />", " ", $description );
?>
<head>
<title>New Group Portal</title>
</head>

<H1>New Group Portal</H1>
<hr>

<form enctype="multipart/form-data" action="submit_edit_group.php" method="post"></br>
Group Name: <input type="text" name="group_name" value="<?php echo base64_decode($row['group_name']);?>"/></br>
Group Short Name: <input type="text" name="short_name"value="<?php echo $row['short_name'];?>"/></br>




<script type="text/javascript">
function formatText (el,tag) {
var selectedText=document.selection?document.selection.createRange().text:el.value.substring(el.selectionStart,el.selectionEnd);
if (selectedText!='') {
var newText='<'+tag+'>'+selectedText+'</'+tag+'>';
el.value=el.value.replace(selectedText,newText)
}
} 
</script>

Group Description:<br>
<textarea name="group_desc" rows = "12" cols = "50"><?php echo $description;?></textarea><br>
<input type="button" value="Bold" onclick="formatText (group_desc,'b');" />
<input type="button" value="Italic" onclick="formatText (group_desc,'i');" />
<input type="button" value="Underline" onclick="formatText (group_desc,'u');" />


<br>

<br>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />

<br>
<h4>Active:</h4>
<?php 
if ($row['active'] == 1){
	echo '<input type="radio" name="group2" value="1" checked> Active<br>';
	echo '<input type="radio" name="group2" value="0"> Not Active(No Longer a Valid Group)<br>';}
else{
	echo '<input type="radio" name="group2" value="1" > Active<br>';
	echo '<input type="radio" name="group2" value="0" checked> Not Active(No Longer a Valid Group)<br>';
}
?>

<input type="submit" value="Submit"/><a href="../admin.php">Return to Admin Home</a>
</form>