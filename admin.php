<?php
 session_start();
 if(!session_is_registered(myusername)){
 header("location:index.php");
 }
 
echo '';
echo '<a href="public_html/new_item_form.php">Add a new Item</a>';

$con = mysql_connect("localhost","davis","davis");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("davisanddavis", $con);


$sql= "SELECT * FROM products";
$result = mysql_query($sql);

?>
<link type="text/css" rel="Stylesheet" href="admin-css.css" />
<u><pre>id	Product Name		Price	Available</pre></u>
<ul class=\"header\">
<?php 
while ($row = mysql_fetch_array($result))
{
	echo '<ul class=\"col\">';
	echo '<li>'.$row['id'].'</li>';
	echo '<li>'.$row['product_name'].'</li>';
	echo '<li>'.$row['cost'].'</li>';
	if ($row['active']==1){
		echo '<li>'.'yes'.'</li>';
	}
	else
		echo '<li>'.'no'.'</li>';
	echo '</ul>';
	echo "<br />";
}
echo '</li>';
echo '</ul>';
mysql_close($con);

?>