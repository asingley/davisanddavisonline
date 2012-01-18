<?php
 session_start();
 if(!session_is_registered(myusername)){
 header("location:index.php");
 }
 
echo '<link type="text/css" rel="Stylesheet" href="styler.css" />';
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
echo '<div id="prod-id">ID';
while ($row = mysql_fetch_array($result))
{
	echo $row['id']. '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $row['product_name'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['cost'];
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	if ($row['active']==1){
		echo 'yes';
	}
	else
		echo 'no';
	echo "<br />";
}
echo '</div>';
mysql_close($con);

?>