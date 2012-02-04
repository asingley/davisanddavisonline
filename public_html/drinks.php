
<div id="panel">
<div id="prodTitle">
<div>Frozen Drink Mixes</div>
</div>

<!--BAR-->
<div class="purpBar">
<img src="images/purplefadebar.jpg" alt="" />
</div>
<div id="prodDisp">
<div><img src="images/frozenGroup.jpg" alt="Frozen Drink Mix Group Shot" /></div>
</div>
<div id="prodInfoText">
			<div>
WOW! ...over 1/2 gallon of perfectly blended cocktails each and every time you make a Davis &amp; Davis Gourmet Foods Frozen Drink Mix. Pick your favorite. There’s a flavor for just about everyone’s taste buds.  Cosmopolitan, Lemon Drop, Margarita, Strawberry Margarita, Tango Tini, Chocolate Tini, Peach Bellini, Mimosa, Sangria or Wine Magic.
</div>
<div>
<div style="font-weight:bold;text-decoration:underline;margin-top:12px;"><br />Frozen Drink Mix Directions</div>
<div><br />
Combine contents of Magic Drink Mix bag with 6 cups of water and 2 cups of your favorite white wine, vodka, rum or tequila in a one gallon freezer safe zip bag. Blend well and place in the freezer. Freeze for 3-4 hours, remove from freezer and squeeze the bag, enjoy!
</div>
</div>
</div>
<p style="text-align:left;margin-left:20px;"><b>SAVE!!!</b> Buy a Multi-Pack and choose any 2 or 6 flavor combinations of Frozen Drink Mixes!
Just choose the 2 or 6 Pack option in the drop-down, click the cart, and then select your drink mixes in the shopping cart...</p>
<p>
<div style="text-align:center;font-weight:bold;text-decoration:underline;">ORDERING OPTIONS</div>
			<div style="text-align:center;margin-top:14px;">
				<table style="margin:auto;width:200px;">
<tr>
						<td>
							<select id="selOpt">
<?php 

require_once("public_html/db_connect.php");
$sqlOne= "SELECT * FROM products WHERE active=1 AND prod_type='drink'";
$resultOne = mysql_query($sqlOne);

while ($rowOne = mysql_fetch_array($resultOne))
{
	echo '<option value="'.$rowOne['shop_id'].'">'.base64_decode($rowOne['product_name']).': $'.$rowOne['cost'].'</option>';
}

/*<optgroup label="Create a Multi-Pack">
<option value="118">2 Pack: $20.00</option>
<option value="27">6 Pack: $50.00</option>*/
require_once("public_html/db_close.php");
?>
								</optgroup>
</select>
</td>
<td>
							<!-- <img onclick="fAddItem('drink')" class="cart" src="images/cart.gif" alt="Add this selection to your basket." />
--></td>
</tr>
</table>
</div>
</p>
	</div>
