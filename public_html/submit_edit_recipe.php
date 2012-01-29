<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:index.php");
}

$description = base64_encode(nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($_POST[recipe_desc]))));
$name = base64_encode($_POST[recipe_name]);



$con = mysql_connect("localhost","davis","davis");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("davisanddavis", $con);

$sql="UPDATE recipes SET recipe_name='$name', description='$description' , active='$_POST[group2]' WHERE id='$_POST[proid]'";


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con);
//header('Location: ../admin.php');

?>