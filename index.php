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
		if (is_numeric($proid)){
		require_once("product_generator.php");
		}
		else{
			require_once("group_generator.php");
		}



}
require("public_html/footer.php");
}
echo '</div>';
?>
