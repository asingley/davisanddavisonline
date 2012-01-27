<link type="text/css" rel="Stylesheet" href="admin-css.css" />
<script type="text/javascript" src="tabber.js"></script>
<?php
 session_start();
 if(!session_is_registered(myusername)){
 header("location:index.php");
 }
 
echo '<H1>Admin Portal</H1>';
echo '<hr>';
echo '<a href="index.php">Back to Home</a>';
echo '<br>';
echo '<H2>Product List</H2>';
echo '<a href="public_html/new_item_form.php">Add a new Item</a>';
require_once("public_html/db_connect.php");

echo '<div class="tabber">';
echo '<div class="tabbertab">';
echo '<H2>Products</H2>';
$sql= "SELECT id, product_name, prod_type, cost, active FROM products";
$result = mysql_query($sql);



$column_count = mysql_num_fields($result)
or die("display_db_query:" . mysql_error());
// Here the table attributes from the $table_params variable are added
print("<TABLE  >");
// optionally print a bold header at top of table
if(!$header_bool) {
	print("<TR>");
	for($column_num = 0; $column_num < $column_count; $column_num++) {
		$field_name = mysql_field_name($result, $column_num);
		print("<TH>$field_name&nbsp;|</TH>");
	}
	print("</TR>\n");
}
// print the body of the table
while($row = mysql_fetch_row($result)) {
	print("<TR ALIGN=LEFT VALIGN=TOP>");
	for($column_num = 0; $column_num < $column_count; $column_num++) {

		if ($column_num ==1){
		echo "<TD>" . base64_decode($row[$column_num]) . "&nbsp;</TD>\n";}
		else {
			echo "<TD>$row[$column_num]&nbsp;</TD>\n";
		}
	}
	
	echo '<TD><a href="public_html/edit_product.php?proid='. $row[0] .'">edit</a></TD>';
	print("</TR>\n");

}
print("</TABLE>\n");
echo '</div>';

echo '<div class="tabbertab">';
echo '<H2>Product Groups</H2>';
echo '<a href="public_html/new_group_form.php">Add a new Group</a>';

$sql= "SELECT id, group_name, active FROM groups";
$result = mysql_query($sql);



$column_count = mysql_num_fields($result)
or die("display_db_query:" . mysql_error());
// Here the table attributes from the $table_params variable are added
print("<TABLE  >");
// optionally print a bold header at top of table
if(!$header_bool) {
	print("<TR>");
	for($column_num = 0; $column_num < $column_count; $column_num++) {
		$field_name = mysql_field_name($result, $column_num);
		print("<TH>$field_name&nbsp;|</TH>");
	}
	print("</TR>\n");
}
// print the body of the table
while($row = mysql_fetch_row($result)) {
	print("<TR ALIGN=LEFT VALIGN=TOP>");
	for($column_num = 0; $column_num < $column_count; $column_num++) {

		if ($column_num ==1){
			echo "<TD>" . base64_decode($row[$column_num]) . "&nbsp;</TD>\n";
		}
		else {
			echo "<TD>$row[$column_num]&nbsp;</TD>\n";
		}
	}

	echo '<TD><a href="public_html/edit_group.php?proid='. $row[0] .'">edit</a></TD>';
	print("</TR>\n");

}
print("</TABLE>\n");


echo '</div>';

echo '</div>';
require_once("public_html/db_close.php");

?>