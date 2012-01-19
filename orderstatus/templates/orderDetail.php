<style>
.fancyTable td {
	background-color: #CCCCCC;
}


.fancyTable td.empty {
	background-color: #FFFFFF;
}
.orderComment {
	border: solid #CCCCCC 1px;
	width: 400px;
	background-color: #EEEEEE;
	padding: 5px;
}
</style>
<p><b>Order Details: Order <?=$order->getOrderNumber()?></b></p>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr><td valign="top">
		<p><b>Bill To:</b><br>
		<?=$order->getName()?><br>
		<? if ($company = $order->getCompany()) print "$company<br>" ?>
		<?=$order->getAddress1()?><br>
		<? if ($address2 = $order->getAddress2()) print "$address2<br>" ?>
		<?=$order->getCity()?>, <?=$order->getState()?> <?=$order->getZip()?><br>
		<?=$order->getCountry()?><br>
		<a href="mailto:<?=$order->getEmail()?>"><?=$order->getEmail()?></a><br>
		<?=$order->getPhone()?></p>
		</td>
		<td valign="top">
		<p><b>Ship To:</b><br>
		<? if (!$order->getShipAddress1()) { ?>
			(Same as "Bill To")</p>
		<? } else { ?>
			<?=$order->getShipName()?><br>
			<? if ($company = $order->getShipCompany()) print "$company<br>" ?>
			<?=$order->getShipAddress1()?><br>
			<? if ($address2 = $order->getShipAddress2()) print "$address2<br>" ?>
			<?=$order->getShipCity()?>, <?=$order->getShipState()?> <?=$order->getShipZip()?><br>
			<?=$order->getShipCountry()?><br>
			<?=$order->getShipPhone()?></p>
		<? } ?>
		<p>Ship Method: <?=$order->getShipMethod()?></p>
		
		</td>
		</tr>
	</table>
	<p><b>Current Status:</b> <?=$order->getStatus()?>
	<? if ($trackingNumber = $order->getTrackingNumber()) { ?>
		<br><b>Tracking Number:</b> <a target="_blank" href="<?=$order->getTrackingLink()?>"><?=$trackingNumber?></a>

		
	<? } ?>
	</p> 
	<h3>Purchases:</h3>
	
	<table border="0" class="fancyTable" cellpadding="3" cellspacing="3">
		<tr class="fancyTableHeader">
			<td>SKU</td>
			<td width="50%">Name</td>
			<td>Quantity</td>
			<td>Price</td>
			<td>Total</td>
		</tr>
		<? foreach ($order->getProducts() as $id=>$details) {?>
		<tr>
			<td valign="top"><?=$details['sku']?></td>
			<td valign="top"><?=$details['name']?><br>
			<? if (!empty($details['productOptions'])) { ?>
				<?=str_replace('|', '<br>', $details['productOptions'])?><br>
			<? } if (!empty($details['otherOptions'])) { ?>
				<?=$details['otherOptions']?></td>
			<? } ?>
			<td valign="top"><?=$details['quantity']?></td>
			<td valign="top"><?=sprintf("%01.2f", $details['price'])?></td>
			<td valign="top"><?=sprintf("%01.2f", $details['extendedPrice'])?></td>
		</tr>
		<? } ?>
	<tr><td colspan="3" class="empty">&nbsp;</td><td>Product Total</td><td><?=sprintf("%01.2f", $order->getSubtotal())?></td></tr>
	<? if ($order->getDetail('surchargeLabel')) { ?>
	<tr><td colspan="3" class="empty">&nbsp;</td><td>Surcharge: <?=$order->getDetail('surchargeLabel')?></td><td><?=sprintf("%01.2f", $order->getDetail('surchargeTotal'))?></td></td></tr>
	<? } ?>
	<tr><td colspan="3" class="empty">&nbsp;</td><td>Tax</td><td><?=sprintf("%01.2f", $order->getTax())?></td></tr>
	<tr><td colspan="3" class="empty">&nbsp;</td><td>Shipping</td><td><?=sprintf("%01.2f", $order->getShipping())?></td></tr>
	<? if ($order->getDetail('giftCertificate')) { ?>
	<tr><td colspan="3">&nbsp;</td><td>Gift Cert: <? list ($gnum, $gleft, $gamt) = split ("~", $order->getDetail('giftCertificate')); ?><?=$gnum?><br>Balance: <?=$gleft?></td><td>-<?=sprintf("%01.2f", $gamt)?></td></tr>
	<? } ?>
	<tr><td colspan="3" class="empty">&nbsp;</td><td>Grand Total</td><td><?=sprintf("%01.2f", $order->getGrandTotal())?></td></tr>
	</table>
	<p><b>History</b><br>
	<? foreach ($order->getStatusEvents() as $eventDate => $status) { ?>
		<?=$eventDate?>: <?=$status?><br>
	<? } ?>
	</p>
	
	<? if ($comments = $order->getComments('public')) { ?>
		<p><b>Comments</b></p>
		<? foreach ($comments as $commentID=>$details) { ?>
			<p class="orderComment">
			<em><?=$details[0]?></em><br />
			<?=nl2br($details[1])?><br /></p>
			
		<? } ?>
	<? } ?>
	<h3>Payment</h3>
	<p><?=$order->getDetail('paymentMethod')?></p>

	<? if ($order->getDetail('orderInstructions')) { ?>
		<h3>Order Instructions</h3>
		<p><?=$order->getDetail('orderInstructions')?>
	<? } ?>
	<? if ($order->getDetail('orderComments')) { ?>
		<h3>Customer Comments</h3>
		<p><?=$order->getDetail('orderComments')?>
	<? } ?>
