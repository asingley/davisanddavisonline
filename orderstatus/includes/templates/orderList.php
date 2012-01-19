<script language="JavaScript"><!--
function checkAll(myval) {
	for (i=0;i<document.orderListForm.elements.length;i++) {
            if (document.orderListForm.elements[i].name.indexOf('checkedOrders[]') !=-1)
            document.orderListForm.elements[i].checked = myval;
	}
}
function changeCheckedStatus(newval) {
	for (i=0;i<document.orderListForm.elements.length;i++) {
        if (document.orderListForm.elements[i].name.indexOf('checkedOrders[]') !=-1) {
            if (document.orderListForm.elements[i].checked) {
            	statusMenu = document.orderListForm.elements[i].value + 'status';
            	document.orderListForm.elements[statusMenu].selectedIndex = newval;
			}
		}
	}
}
//--></script> 
<form action="" name="orderListForm" method="post" target="_top">
	<input type="hidden" name="action" value="editMultiple">
	<table border="0" cellpadding="5" cellspacing="0" class="fancyTable">
	<tr class="fancyTableHeader">
		<td>&nbsp;</td>
		<td>Order Number</td>
		<td>Name</td>
		<td>Company</td>
		<td>Order Date</td>
		<td>Status</td>
		<td>Tracking number</td>
		
	</tr>
	<? foreach ($orders as $order) { ?>
		<?$this->trToggle('fancyTableRow2')?>
		<input type="hidden" name="orderNumbers[]" value="<?=$order[0]?>">
		<td><input type="checkbox" name="checkedOrders[]" value="<?=$order[0]?>" id="<?=$order[0]?>"  /></td>
		<td><a href="?action=orderDetail&orderNumber=<?=$order[0]?>"><?=$order[0]?></a></td>
		<td><a href="?action=orderDetail&orderNumber=<?=$order[0]?>"><?=$order[1]?></a></td>
		<td><a href="?action=orderDetail&orderNumber=<?=$order[0]?>"><?=$order[2]?></a></td>
		<td><?=Order::prettyDate($order[3])?></td>
		<td>
		<?$this->selectMenu("$order[0]status", $order[4], $GLOBALS['statusOptions'], true)?>
		<td><input type="text" name="<?=$order[0]?>trackingNumber" value="<?=$order[5]?>" size="20"></td>
		</tr>
	<? } ?>
	<tr class="fancyTableFooter">
		<td colspan="5" valign="top">
		<a href="" onclick="checkAll(true); return false;">
            Check All</a>
        &nbsp;|&nbsp;
        <a href="" onclick="checkAll(false); return false;">
            Uncheck All</a>
        </td>
        <td colspan="2">
		<input type="checkbox" name="sendNotification" value="true"<?=$this->checkSelected($GLOBALS['customerNotificationDefault'], true, 'checked')?>>Send notification to customer<br>
        <input type="submit" value="Save all tracking info">
        <input type="reset" value="Reset">
        </td>
        </tr>
	</table>
	<p>Change status for checked orders to
	
		<?$this->selectMenu('checkedOrdersStatus', null, $GLOBALS['statusOptions'], true)?>
	<input type="button" onClick="changeCheckedStatus(document.orderListForm.checkedOrdersStatus.selectedIndex); return false;" value="go"></p>
	<p><input type="submit" name="printOrders" value="Print checked orders" onClick="this.form.target = 'printable'"></p>
	</form>