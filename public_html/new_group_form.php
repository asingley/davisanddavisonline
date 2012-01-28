<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:index.php");
}?>
<head>
<title>New Group Portal</title>
</head>

<H1>New Group Portal</H1>
<hr>

<form enctype="multipart/form-data" action="submit_new_item.php" method="post"></br>
Group Name: <input type="text" name="group_name"/></br>
Group Short Name: <input type="text" name="short_name"/></br>




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
<textarea name="group_desc" rows = "12" cols = "50"></textarea><br>
<input type="button" value="Bold" onclick="formatText (group_desc,'b');" />
<input type="button" value="Italic" onclick="formatText (group_desc,'i');" />
<input type="button" value="Underline" onclick="formatText (group_desc,'u');" />


<br>

Price Per Unit: <input type="text" name="prod_price"/><br>
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Submit"/><a href="../admin.php">Return to Admin Home</a>
</form>