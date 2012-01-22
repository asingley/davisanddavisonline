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

<?php 

$column_count = mysql_num_fields($result)
or die("display_db_query:" . mysql_error());
// Here the table attributes from the $table_params variable are added
print("<TABLE $table_params >\n");
// optionally print a bold header at top of table
if($header_bool) {
	print("<TR>");
	for($column_num = 0; $column_num < $column_count; $column_num++) {
		$field_name = mysql_field_name($result, $column_num);
		print("<TH>$field_name</TH>");
	}
	print("</TR>\n");
}
// print the body of the table
while($row = mysql_fetch_row($result)) {
	print("<TR ALIGN=LEFT VALIGN=TOP>");
	for($column_num = 0; $column_num < $column_count; $column_num++) {

		print("<TD>$row[$column_num]&nbsp;</TD>\n");
		
	}
	//echo "<TD></TD>\n";
	print("</TR>\n");

}
print("</TABLE>\n");

require_once("public_html/db_close.php");

?>