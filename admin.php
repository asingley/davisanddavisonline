<?php
 session_start();
 if(!session_is_registered(myusername)){
 header("location:index.php");
 }
 
echo '';
echo '<a href="public_html/new_item_form.php">Add a new Item</a>';


require_once("public_html/db_connect.php");

$sql= "SELECT * FROM products";
$result = mysql_query($sql);

?>
<link type="text/css" rel="Stylesheet" href="admin-css.css" />
<u><pre>Product Name	Available</pre></u>
<ul class=\"header\">
<?php 
while ($row = mysql_fetch_array($result))
{
	echo '<ul class=\"col\">';
	echo '<li>'.$row['product_name'] . '&nbsp;';
	if ($row['active']==1){
		echo 'yes'.'</li>';
	}
	else
		echo 'no'.'</li>';
	echo '</ul>';
	echo "<br />";
}
echo '</li>';
echo '</ul>';
require_once("public_html/db_close.php");

?>