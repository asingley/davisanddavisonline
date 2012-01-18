<?php
$con = mysql_connect("localhost","davis","davis");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("davisanddavis", $con);

$sql="INSERT INTO products (product_name, description, recipe, cost, active)
VALUES
('$_POST[prod_name]','$_POST[prod_desc]','$_POST[prod_recip]','$_POST[prod_price]', 1)";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con);
header('Location: new_item_form.php');
?>