<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:index.php");
}
$target_path = "../img/";

/* Add the original filename to our target path.
 Result is "uploads/filename.extension" */
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
$description = base64_encode(nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($_POST[group_desc]))));
$name = base64_encode($_POST[group_name]);
if (basename( $_FILES['uploadedfile']['name']) == ""){
	
	
	$con = mysql_connect("localhost","davis","davis");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("davisanddavis", $con);
	
	$sql="UPDATE groups SET group_name='$name', short_name='$_POST[short_name]' , description='$description' , active='$_POST[group2]' WHERE id='$_POST[proid]'";
	
	
	if (!mysql_query($sql,$con))
	{
		die('Error: ' . mysql_error());
	}
	echo "1 record added";
	
	mysql_close($con);
	//header('Location: ../admin.php');
	
}
else{
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	echo "success";
} else{
	error_reporting(E_ALL);
	echo "There was an error uploading the file, please try again!";
	echo $_FILES['uploadedfile']['tmp_name'] . "target:" . $target_path;
}

error_reporting(E_ALL && ~E_NOTICE);

$target_path = basename( $_FILES['uploadedfile']['name']); //get filename without directory

$con = mysql_connect("localhost","davis","davis");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("davisanddavis", $con);

$sql="UPDATE groups SET product_name='$name', description='$description' , recipe='$_POST[prod_recip]' , prod_type='$_POST[group1]' , img_filename='$target_path' , cost='$_POST[prod_price]', active='$_POST[group2]' WHERE id='$_POST[proid]'";


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con);
header('Location: ../admin.php');
}
?>
