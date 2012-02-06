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

$sql="UPDATE product_deal SET shop_id='$POST[shop_id]', deal_name='$name', prod_id='$POST[group1]', active='$_POST[group2]' WHERE id='$_POST[proid]'";




if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con);
header('Location: ../admin.php');
?>
