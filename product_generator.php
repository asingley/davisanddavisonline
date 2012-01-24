<script type="text/javascript" src="scripter.js"></script>
<link rel="stylesheet" type="text/css" href="product.css" />
<?php 
require_once("public_html/db_connect.php");
$sql= "SELECT * FROM products where id=$proid";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);


echo $proid;
require_once("public_html/db_close.php");
?>