<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title>Davis &amp; Davis Gourmet Foods</title>
	<meta name="Author" content="Greg Goodhile Made the graphics for the header and footer, everything else by Andy Singley" />
	<meta name="Description" content="" />
	<meta name="Keywords" content="" />
  <link type="text/css" rel="Stylesheet" href="styler.css" />
	<script type="text/javascript" language="javascript">AC_FL_RunContent = 0;</script>
	<script type="text/javascript" src="flash/AC_RunActiveContent.js" language="javascript"></script>
	<script type="text/javascript" language="javascript" src="scripter.js"></script>
	
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="../css/slide.css" type="text/css" media="screen" />
	
  	<!-- PNG FIX for IE6 -->
  	<!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
	<!--[if lte IE 6]>
		<script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>
	<![endif]-->
	 
    <!-- jQuery - the core -->
	<script src="../js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="../js/slide.js" type="text/javascript"></script>
</head>
<body>

<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>Welcome to Web-Kreation</h1>
				<h2>Sliding login panel Demo with jQuery</h2>		
				<p class="grey">You can put anything you want in this sliding panel: videos, audio, images, forms... The only limit is your imagination!</p>
				<h2>Download</h2>
				<p class="grey">To download this script go back to <a href="http://web-kreation.com/index.php/tutorials/nice-clean-sliding-login-panel-built-with-jquery" title="Download">article &raquo;</a></p>
			</div>
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="#" method="post">
					<h1>Member Login</h1>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="log" id="log" value="" size="23" />
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="pwd" id="pwd" size="23" />
	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
					<a class="lost-pwd" href="#">Lost your password?</a>
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form action="#" method="post">
					<h1>Not a member yet? Sign Up!</h1>				
					<label class="grey" for="signup">Username:</label>
					<input class="field" type="text" name="signup" id="signup" value="" size="23" />
					<label class="grey" for="email">Email:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					<label>A password will be e-mailed to you.</label>
					<input type="submit" name="submit" value="Register" class="bt_register" />
				</form>
			</div>
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li>Hello Guest!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Log In | Register</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

<noscript>You must enable scripting in your browser settings to navigate and order on this site. 
</noscript>
<div name="top" id="top"></div>
<div id="centerBlock">



<div style="position:relative;text-align:right;font-weight:bold;padding-top:3px;">

<button type="button" onclick="location.href='../admin.php'">Admin</button>
<a href="dd_catalog.pdf" target="newWin">View the 2010 Catalog</a></div>
    
	<!--MAST-->	<div id="mast">
    	<img id="butCatalog" src="images/butCatalog.png" alt="Davis and Davis 2010 Print Catalog Button" onclick="javascript:window.open('dd_catalog.pdf','Davis and Davis 2010 Print Catalog');" />
		<div title="Go back to the Davis and Davis Homepage"></div>
	</div>
	
	<!--MENU-->
	<div id="menu">
        <div id="firstItem" onmouseout="fMenuOut();" onmouseover="fShowSub('menuSub1');fMenuOver();">PRODUCTS</div>
        <div class="menuItem"><a href="recipes.htm">RECIPES</a></div>
        <div class="menuItem"><a href="homeparty.htm">HOME PARTY</a></div>
        <div class="menuItem"><a href="http://www.davisanddavisonline.com/cgi-davisanddavisonline/sb/order.cgi?storeid=*30b3740e4644d5af8f32bfa5e10499e5a67c8e4df6afa904c38b&function=show">SHOPPING&nbsp;BASKET</a></div>
        <div id="menuSub1" class="menuItemSub" onmouseout="fMenuOut();" onmouseover="fMenuOver();">
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(14);" href="BBB.htm">Beer&nbsp;Bread</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(11);" href="bloodymary2.htm">Bloody&nbsp;Mary&nbsp;Magic</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(16);" href="soups.htm">Bountiful&nbsp;Bowls</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(10);" href="cheeseball.htm">Cheeseball&nbsp;Kits</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(1);" href="oils.htm">Cooking&nbsp;&amp;&nbsp;Dipping&nbsp;Oils</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(2);" href="dipperMixes.htm">Dipper&nbsp;Mixes</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(3);" href="drinks.htm">Frozen&nbsp;Drink&nbsp;Mixes</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(12);" href="kstuff.htm">Ken's&nbsp;Stuff</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(13);" href="lulu2.htm">LuLu's&nbsp;Ultimate</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(5);" href="mustard.htm">Mustards&nbsp;&amp;&nbsp;Relishes</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(15);" href="razzle.htm">Razzle&nbsp;Dazzle</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(7);" href="salsa.htm">Salsa&nbsp;Magic</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(8);" href="sampler.htm">Gourmet&nbsp;Sampler</a></div>
            <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(17);" href="vanilla.htm">Forever&nbsp;Vanilla</a></div>
            <div id="moneyShot">
                <img id="imgShot" src="images/blankshot.gif" alt="Davis and Davis Product Highlight" />
            </div>
        </div>
    </div>