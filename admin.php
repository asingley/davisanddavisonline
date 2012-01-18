<?php
 session_start();
 if(!session_is_registered(myusername)){
 header("location:index.php");
 }
 
echo '<a href="public_html/new_item_form.php">Add a new Item</a>';

$con = mysql_connect("localhost","davis","davis");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("davisanddavis", $con);


$sql= "SELECT * FROM products";
$result = mysql_query($sql);


echo '<u><pre>id	Product Name		Price	Available</pre></u>';

while ($row = mysql_fetch_array($result))
{
	echo $row['id']. '<dd>'. $row['product_name'];
	echo "<br />";
}

mysql_close($con);

?>