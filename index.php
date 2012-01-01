<?php
if(!isset($_COOKIE['no_splash'])) {
	// Start of the IF statement - if the user does not have a cookie that says whether he/she has visited the splash page, take them to the splash page
	header('Location: intro.php'); // Redirect code
} else { 
require("public_html/header.php");
require("public_html/footer.php");
}
?>