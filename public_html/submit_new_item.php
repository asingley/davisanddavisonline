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

error_reporting(E_ALL && ~E_NOTICE);

$target_path = basename( $_FILES['uploadedfile']['name']); //get filename without directory

$description = base64_encode($_POST[prod_desc]);

$con = mysql_connect("localhost","davis","davis");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("davisanddavis", $con);

$sql="INSERT INTO products (product_name, description, recipe, prod_type, img_filename, cost, active)
VALUES
('$_POST[prod_name]','$description','$_POST[prod_recip]','$_POST[group1]','$target_path','$_POST[prod_price]', 1)";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con);
header('Location: new_item_form.php');
?>
