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

function get_list(){
$sql= mysql_query("SELECT * FROM products where active=1");
$get_list = array();
while($kpl = mysql_fetch_assoc($bar)){
	$get_list[] = $kpl;
}
	return $get_list;
}

echo '<u><pre>id	Product Name		Price	Available</pre></u>';
$result = get_list();


foreach($result as $row){
	echo $row['id'] . "    " . $row['product_name'];
}


?>