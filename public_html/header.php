<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title>Davis &amp; Davis Gourmet Foods</title>
	<meta name="Author" content="Greg Goodhile Made the graphics for the header and footer, everything else by Andy Singley" />
	<meta name="Description" content="" />
	<meta name="Keywords" content="" />
  <link type="text/css" rel="Stylesheet" href="../styler.css" />
	<script type="text/javascript" language="javascript">AC_FL_RunContent = 0;</script>
	<script type="text/javascript" src="flash/AC_RunActiveContent.js" language="javascript"></script>
	<script type="text/javascript" language="javascript" src="scripter.js"></script>
	
</head>
<body>




<noscript>You must enable scripting in your browser settings to navigate and order on this site. 
</noscript>
<div name="top" id="top"></div>
<div id="centerBlock">



<div id="container"><div style="position:relative;text-align:right;font-weight:bold;padding-top:3px;"><a href="dd_catalog.pdf" target="newWin">View the 2010 Catalog</a></div></div>


    
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
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(3);" href="drinks.htm">Frozen&nbsp;Drink&nbsp;Mixes</a></div>
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(12);" href="kstuff.htm">Ken's&nbsp;Stuff</a></div>
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(7);" href="salsa.htm">Salsa&nbsp;Magic</a></div>
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(5);" href="mustard.htm">Mustards&nbsp;&amp;&nbsp;Relishes</a></div>
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(2);" href="dipperMixes.htm">Dipper&nbsp;Mixes</a></div>
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(1);" href="oils.htm">Cooking&nbsp;&amp;&nbsp;Dipping&nbsp;Oils</a></div>
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(16);" href="soups.htm">Bountiful&nbsp;Bowls</a></div>
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(10);" href="cheeseball.htm">Cheeseball&nbsp;Kits</a></div>
        <div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(11);" href="bloodymary2.htm">Bloody&nbsp;Mary&nbsp;Magic</a></div>
        
            <?php 
            require_once("public_html/db_connect.php");
            $sql= "SELECT * FROM products WHERE active=1";
            $result = mysql_query($sql);
            
            while ($row = mysql_fetch_array($result))
            {
            echo '<div class="menuItem"><a onmouseout="fMoneyOut();" onmouseover="fMoneyShot(11);" href="../index.php?proid='. $row['id'] .'">' . $row['product_name'] . '</a></div>';
            }
            require_once("public_html/db_close.php");
            ?>
           
            <div id="moneyShot">
                <img id="imgShot" src="images/blankshot.gif" alt="Davis and Davis Product Highlight" />
            </div>
        </div>
    </div>
