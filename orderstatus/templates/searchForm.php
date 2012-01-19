<h1>Check Order Status</h1>
<? if ($error) { ?>
	<p class="message"><?=$error?></p>
<? } ?>
<P>To check the status of your order, enter your billing zip code and the order number:</p>
<form method="post">
<input type="hidden" name="action" value="findOrder">
<table border="0" cellpadding="2" cellspacing="0" class="fancyTable">
<tr><td>Order Number:</td><td><input type="text" name="orderNumber"value="<?=$orderNumber?>"></td></tr>
<tr><td>Billing Zip Code:</td><td><input type="text" name="zipCode" value="<?=$zipCode?>"></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Search"></td></tr>
</table>
</form>