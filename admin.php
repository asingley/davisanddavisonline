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

require_once("public_html/db_connect.php");

echo '<div class="tabber">';
echo '<div class="tabbertab">';
echo '<H2>Products</H2>';
echo '<a href="public_html/new_item_form.php">Add a new Item</a>'; 
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


echo '<div class="tabbertab">';
echo '<H2>Recipes</H2>';
echo '<a href="public_html/new_recipe_form.php">Add a new Recipe</a>';

$sql= "SELECT id, recipe_name, active FROM recipes";
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

	echo '<TD><a href="public_html/edit_recipe.php?proid='. $row[0] .'">edit</a></TD>';
	print("</TR>\n");

}
print("</TABLE>\n");



echo '</div>';


echo '<div class="tabbertab">';
echo '<H2>Group Deals</H2>';
echo '<a href="public_html/new_group_deal_form.php">Add a new Group Deal</a>';

$sql= "SELECT id, deal_name, prod_type, active FROM group_deals";
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

	echo '<TD><a href="public_html/edit_group_deal.php?proid='. $row[0] .'">edit</a></TD>';
	print("</TR>\n");

}
print("</TABLE>\n");



echo '</div>';

echo '<div class="tabbertab">';
echo '<H2>Product Deals</H2>';
echo '<a href="public_html/new_product_deal_form.php">Add a new Product Deal</a>';

$sql= "SELECT id, deal_name, prod_id, active FROM product_deal";
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
		elseif ($column_num ==2){
				
			$sqlProd= "SELECT product_name FROM products WHERE id=$row[$column_num]";
			$resultProd = mysql_query($sqlProd);
			$rowProd = mysql_fetch_array($resultProd);
			echo "<TD>" . base64_decode($rowProd['product_name']) . "&nbsp;</TD>\n";
		}
		else {
			echo "<TD>$row[$column_num]&nbsp;</TD>\n";
		}
		
	}

	echo '<TD><a href="public_html/edit_product_deal.php?proid='. $row[0] .'">edit</a></TD>';
	print("</TR>\n");

}
print("</TABLE>\n");



echo '</div>';


echo '</div>';
require_once("public_html/db_close.php");

?>