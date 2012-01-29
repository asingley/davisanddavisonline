<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:index.php");
}
?>
<head>
<title>New Recipe Portal</title>
</head>

<H1>New Recipe Portal</H1>
<hr>

<form enctype="multipart/form-data" action="submit_new_recipe.php" method="post"></br>
Recipe Name: <input type="text" name="recipe_name"/></br>



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
<textarea name="recipe_desc" rows = "20" cols = "80"></textarea><br>
<input type="button" value="Bold" onclick="formatText (recipe_desc,'b');" />
<input type="button" value="Italic" onclick="formatText (recipe_desc,'i');" />
<input type="button" value="Underline" onclick="formatText (recipe_desc,'u');" />
<input type="button" value="Bullet" onclick="formatText (recipe_desc,'li');" />


<br>

<input type="submit" value="Submit"/><a href="../admin.php">Return to Admin Home</a>
</form>
