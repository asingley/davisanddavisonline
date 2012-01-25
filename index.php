<?php
echo '<link type="text/css" rel="Stylesheet" href="../styler.css" />';
echo '<div id="centerBlock">';
if(!isset($_COOKIE['no_splash'])) {
	// Start of the IF statement - if the user does not have a cookie that says whether he/she has visited the splash page, take them to the splash page
	header('Location: intro.php'); // Redirect code
} else { 
require("public_html/header.php");
if (!isset($_GET["proid"])){
	
?>

<div id="panel">
<div>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="760" height="500" id="panel" align="middle">
<param name="movie" value="panel.swf" />
<param name="quality" value="high" />
<param name="bgcolor" value="#ffffff" />
<param name="play" value="true" />
<param name="loop" value="false" />
<param name="wmode" value="transparent" />
<param name="scale" value="showall" />
<param name="menu" value="false" />
<param name="devicefont" value="false" />
<param name="salign" value="" />
<param name="allowScriptAccess" value="sameDomain" />
<!--[if !IE]>-->
<object type="application/x-shockwave-flash" data="panel.swf" width="760" height="500">
<param name="movie" value="panel.swf" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#ffffff" />
					<param name="play" value="true" />
					<param name="loop" value="false" />
					<param name="wmode" value="transparent" />
					<param name="scale" value="showall" />
					<param name="menu" value="false" />
					<param name="devicefont" value="false" />
					<param name="salign" value="" />
					<param name="allowScriptAccess" value="sameDomain" />
				<!--<![endif]-->
<a href="http://www.adobe.com/go/getflash">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
					</a>
<!--[if !IE]>-->
</object>
<!--<![endif]-->
</object>
</div>
</div>

<?php 
}
else {
	$proid = $_GET["proid"];
//	require_once("public_html/");
	//require_once("product_generator.php");

require_once("public_html/db_connect.php");

$sql= "SELECT * FROM products";
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

		print("<TD>$row[$column_num]&nbsp;</TD>\n");
		
	}
	echo '<TD><a href="public_html/edit_product.php?proid='. $row[0] .'">edit</a></TD>';
	print("</TR>\n");

}
print("</TABLE>\n");

require_once("public_html/db_close.php");


}
require("public_html/footer.php");
}
echo '</div>';
?>
