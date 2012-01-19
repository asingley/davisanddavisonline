<? include('includes/templates/header.php');?>
<h1>Order Details: Order <?=$order->getOrderNumber()?></h1>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="60%" valign="top">
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
			(Same as "Bill To")<br />
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
	<p><b>Status:</b> <?=$order->getStatus()?> (<a href="?action=emailStatus&orderNumber=<?=$order->getOrderNumber()?>">Email status to customer</a>)

	<? if ($trackingNumber = $order->getTrackingNumber()) { ?>
		<br><b>Tracking Number:</b> <a target="_blank" href="<?=$order->getTrackingLink()?>"><?=$trackingNumber?></a>
		
	<? } ?>
	</p> 
	<p><b>History</b><br>
	<? foreach ($order->getStatusEvents() as $eventDate => $status) { ?>
		<?=$eventDate?>: <?=$status?><br>
	<? } ?>
	</p>
	
	<? if ($comments = $order->getComments()) { ?>
		<p><b>Comments</b></p>
		<? foreach ($comments as $commentID=>$details) { ?>
			<p class="orderComment<?= $details[2] ? 'Hidden' : null; ?>">
			<?= $details[2] ? '<b>Internal Comment</b><br />' : null; ?>
			<em><?=$details[0]?></em><br />
			<?=nl2br($details[1])?><br /></p>
			
		<? } ?>
	<? } ?>
	</td>
	<td width="40%" valign="top">
	<p><a href="?action=nextOrder&afterOrderNumber=<?=$order->getOrderNumber()?>">Skip To Next Order</a></p>
	<form action="" method="post" class="orderStatusControlBox">
		<input type="hidden" name="action" value="updateOrderStatus">
		<input type="hidden" name="orderNumber" value="<?=$order->getOrderNumber()?>">
		<p><b>Update Order Status</b><br />
		<?=$this->selectMenu("status", $order->getStatus(), $GLOBALS['statusOptions'], true)?><br /> 
		Tracking Number:<br />
		<input type="text" name="trackingNumber" value="<?=$order->getTrackingNumber()?>" size="40">
		<br />Add comment for customer:<br>
		<textarea name="comment" cols="40" rows="6"></textarea>
		<br />Add internal comment (hidden from customer):<br>
		<textarea name="hiddenComment" cols="40" rows="6"></textarea>
		<br />
		<input type="checkbox" name="sendNotification" value="1"<?=$this->checkSelected($GLOBALS['customerNotificationDefault'], true, 'checked')?>>Send notification to customer<br>
		<input type="submit" value="Save changes"></p>
		</form>
	</td></tr></table>
	<h3>Purchases:</h3>
	
	<table border="0" cellpadding="5" cellspacing="0" class="fancyTable">
		<tr class="fancyTableHeader">
			<td>SKU</td>
			<td width="50%">Name</td>
			<td>Quantity</td>
			<td>Price</td>
			<td>Total</td>
		</tr>
		<? foreach ($order->getProducts() as $id=>$details) {?>
		<?$this->trToggle('fancyTableRow2')?>
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
	<tr><td colspan="3">&nbsp;</td><td>Product Total</td><td><?=sprintf("%01.2f", $order->getSubtotal())?></td></tr>
	<? if ($order->getDetail('surchargeLabel')) { ?>
	<tr><td colspan="3">&nbsp;</td><td>Surcharge: <?=$order->getDetail('surchargeLabel')?></td><td><?=sprintf("%01.2f", $order->getDetail('surchargeTotal'))?></td></td></tr>
	<? } ?>
	<tr><td colspan="3">&nbsp;</td><td>Tax</td><td><?=sprintf("%01.2f", $order->getTax())?></td></tr>
	<tr><td colspan="3">&nbsp;</td><td>Shipping<br>(<?=$order->getShipMethod()?>)</td><td><?=sprintf("%01.2f", $order->getShipping())?></td></tr>
	<? if ($order->getDetail('giftCertificate')) { ?>
	<tr><td colspan="3">&nbsp;</td><td>Gift Cert: <? list ($gnum, $gleft, $gamt) = split ("~", $order->getDetail('giftCertificate')); ?><?=$gnum?><br>Balance: <?=$gleft?></td><td>-<?=sprintf("%01.2f", $gamt)?></td></tr>
	<? } ?>
	<tr><td colspan="3">&nbsp;</td><td>Grand Total</td><td><?=sprintf("%01.2f", $order->getGrandTotal())?></td></tr>
	</table>
	<h3>Payment</h3>
	<p><?=$order->getDetail('paymentMethod')?><br>
	<?=$order->getDetail('paymentResults')?></p>

	<? if ($order->getDetail('orderInstructions')) { ?>
		<h3>Order Instructions</h3>
		<p><?=$order->getDetail('orderInstructions')?>
	<? } ?>
	<? if ($order->getDetail('orderComments')) { ?>
		<h3>Customer Comments</h3>
		<p><?=$order->getDetail('orderComments')?>
	<? } ?>
	<? if ($order->getDetail('customFields')) { ?>
		<h3>Custom Fields</h3>
		<p><?=str_replace('|', '<br>', $order->getDetail('customFields'))?>
	<? } ?>
		
 <? include('includes/templates/footer.php');?>
