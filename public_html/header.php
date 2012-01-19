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
	
</head>
<body>




<noscript>You must enable scripting in your browser settings to navigate and order on this site. 
</noscript>
<div name="top" id="top"></div>
<div id="centerBlock">



<div style="text-align:right;font-weight:bold;">
<div id="container">
  <div id="topnav" class="topnav"><a href="login" class="signin"><span>Admin</span></a>   <a href="dd_catalog.pdf" target="newWin">View the 2010 Catalog</a></div>
  <fieldset id="signin_menu">
    <form method="post" id="signin" action="http://slomaro34.servebeer.com/public_html/check_login.php">
      <label for="username">Username</label>
      <input id="username" name="myusername" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" name="mypassword" value="" title="password" tabindex="5" type="password">
      </p>
      <p class="remember">
        <input id="submit" value="Login" name="Submit" tabindex="6" type="submit">
      </p>
    </form>
  </fieldset>

</div>


<script src="../javascripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {
                e.preventDefault();
                $("fieldset#signin_menu").toggle();
                $(".signin").toggleClass("menu-open");
            });

            $("fieldset#signin_menu").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.signin").length==0) {
                    $(".signin").removeClass("menu-open");
                    $("fieldset#signin_menu").hide();
                }
            });            

        });
</script>

</div>
    
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
            <?php 
            require_once("public_html/db_connect.php");
            $sql= "SELECT * FROM products";
            $result = mysql_query($sql);
            
            while ($row = mysql_fetch_array($result))
            {
            echo '<div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(11);" href="../index.php?proid="'. $row['id'] .'>' . $row['product_name'] . '</a></div>';
            }
            require_once("public_html/db_close.php");
            ?>
           
            <div id="moneyShot">
                <img id="imgShot" src="images/blankshot.gif" alt="Davis and Davis Product Highlight" />
            </div>
        </div>
    </div>
