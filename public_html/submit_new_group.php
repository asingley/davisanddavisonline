<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:index.php");
}
$target_path = "../img/";

/* Add the original filename to our target path.
 Result is "uploads/filename.extension" */
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	echo "success";
} else{
	error_reporting(E_ALL);
	echo "There was an error uploading the file, please try again!";
	echo $_FILES['uploadedfile']['tmp_name'] . "target:" . $target_path;
}


$target_path = basename( $_FILES['uploadedfile']['name']); //get filename without directory

$description = base64_encode(nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($_POST[group_desc]))));
$name = base64_encode($_POST[group_name]);
$con = mysql_connect("localhost","davis","davis");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("davisanddavis", $con);

$sql="INSERT INTO groups (group_name, short_name, description, img_filename, active)
VALUES
('$name', '$_POST[short_name]' ,'$description','$target_path', 0)";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con);
header('Location: ../admin.php');
?>