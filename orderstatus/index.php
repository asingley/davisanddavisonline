<?php
require_once('settings.php');     
require_once('includes/classes/Order.php');


if ($_REQUEST['action']=='findOrder') {
	findOrder($_REQUEST['orderNumber'], $_REQUEST['zipCode']);
} elseif ((!empty($_REQUEST['orderNumber']))
&& (!empty($_REQUEST['orderDate']))) {
	findOrderByNumberAndDate($_REQUEST['orderNumber'], $_REQUEST['orderDate']);
} else {
	displayOrderSearchForm();
}

///////////////////////////////////////////////////////
function findOrder($orderNumber, $zipCode) {
	if (!empty($orderNumber) && !empty($zipCode)) {
		$order = new Order($orderNumber);
		//print "<pre>"; print_r($order);
		if ($zipCode == $order->getZip()) {
			displayOrder($order);
		} else {
			displayOrderSearchForm("Order not found in our system.");
		}
	} else {
		displayOrderSearchForm("You must provide both an order number and the billing zip code.");
	}
	
}

function findOrderByNumberAndDate($orderNumber, $orderDate) {
	$order = new Order($orderNumber);
	$realOrderDate = $order->getOrderDate();
	$convertedOrderDate = date("D M d, Y", strtotime($realOrderDate));
	//print "$orderDate | $convertedOrderDate | $realOrderDate";
	if ($orderDate == $convertedOrderDate) {
		if ($_REQUEST['noHeaderOrFooter']=='true') {
			include('templates/orderDetail.php');
		} else {
			displayOrder($order);
		}
	} else {
		displayOrderSearchForm("Order not found in our system.");
	}

}
function displayOrder(&$order) {
	wrap ('templates/orderDetail.php', $order, false);
}
function displayOrderSearchForm($error = false) {
	wrap ('templates/searchForm.php', $order, $error);
}

function wrap($file, &$order, $error) {
	$wrapper = file_get_contents($GLOBALS['shopsiteTemplateFile'], 1);
	ob_start();
	include($file);
	$output = ob_get_contents();
	ob_end_clean();
	print str_replace('[orderstatus]', $output, $wrapper);
}
?>
