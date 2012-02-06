<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:index.php");
}

$name = base64_encode($_POST[deal_name]);
$con = mysql_connect("localhost","davis","davis");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("davisanddavis", $con);

$sql="INSERT INTO group_deals (shop_id, deal_name, prod_type, active)
VALUES
('$_POST[shop_id]','$name','$_POST[group1]', 0)";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con);
header('Location: ../admin.php');
?>
