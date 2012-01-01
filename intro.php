<!doctype html>
<?php

$expire = time() + 60*60*24; // This means, expire in 1 day - 60 seconds * 60 minutes * 24 hours
setcookie("no_splash", "1", $expire); // This makes the cookie. It goes in this order: setcookie(cookie_name, cookie_value, expiry_time)

// Do splash page from here down....
?>
<html>
<link rel="stylesheet" href="intro-css.css" type="text/css">

<div id="intro-anim">
<iframe src="intro-animation.php" width="1000" height="240"
             scrolling="no" frameborder="0">
TEXT FOR NON-COMPATIBLE BROWSERS HERE</iframe>

<div id="enter">
<a href="index.php" >Enter Site</a> 
</div>
</div>
</html>