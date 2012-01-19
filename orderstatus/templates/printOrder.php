<style>
	div,td, body {
		font-family: Arial;
	}
	h1 {
		font-size: 18px;
	}
	h2 {
		font-size: 16px;
	}
	h3 {
		font-size: 14px;
	}
	.productTable {
		border: solid black 1px;
	}
	.ptHeader {
		background-color: #EEEEEE;
		border-bottom: 1px solid black;
	}
	.ptSubtotal {
		border-top: 1px solid black;
	}
	.productTable td {
		
	}
</style>
<h1><?=$GLOBALS['storeName']?></h1>
<div class="orderBox">
<p>Order Number: <?=$order->getOrderNumber()?><br>
Order Date: <?=$order->getOrderDate()?></p>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td valign="top" width="50%">
		<h2>Bill To:</h2>
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
		<h2>Ship To:</h2>
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
	<h2>Purchases</h2>
	
	<table border="0" cellpadding="5" cellspacing="0" width="100%" class="productTable">
		<tr>
			<td class="ptHeader">SKU</td>
			<td class="ptHeader" width="50%">Name</td>
			<td class="ptHeader">Quantity</td>
			<td class="ptHeader">Price</td>
			<td class="ptHeader">Total</td>
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
	<tr><td colspan="3" class="ptSubtotal">&nbsp;</td><td class="ptSubtotal">Product Total</td><td class="ptSubtotal"><?=sprintf("%01.2f", $order->getSubtotal())?></td></tr>
	<? if ($order->getDetail('surchargeLabel')) { ?>
	<tr><td colspan="3">&nbsp;</td><td>Surcharge: <?=$order->getDetail('surchargeLabel')?></td><td><?=sprintf("%01.2f", $order->getDetail('surchargeTotal'))?></td></td></tr>
	<? } ?>
	<tr><td colspan="3">&nbsp;</td><td>Tax</td><td><?=sprintf("%01.2f", $order->getTax())?></td></tr>
	<tr><td colspan="3">&nbsp;</td><td>Shipping<br>(<?=$order->getShipMethod()?>)</td><td><?=sprintf("%01.2f", $order->getShipping())?></td></tr>
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
</div>
<p style="page-break-after: always"></p>