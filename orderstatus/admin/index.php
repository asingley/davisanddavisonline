<?php
	require_once('settings.php');
	require_once('includes/classes/OrderFinder.php');
	require_once('includes/classes/Order.php');
	require_once('includes/classes/Form.php');
	require_once('includes/classes/OrderEditor.php');
	require_once('includes/classes/StatusFileUploader.php');
	class OrderStatusAdminForm extends Form {
	
		function defaultBehavior() {
			$this->openOrderList();
		}
	
		function orderDetail() {
			$order = new Order($_REQUEST['orderNumber']);
			include ('includes/templates/adminOrderDetail.php');	
		}
		function openOrderList() {
			$this->of = new OrderFinder();
			$orders = $this->of->getOpenOrders();
			$title = "Open Orders";
			include('includes/templates/openOrderList.php');
		}
		function updateOrderStatus() {
			$orderEditor = new OrderEditor();
			$orderEditor->updateOrderStatus(
				$_REQUEST['orderNumber'], 
				$_REQUEST['status'],
				$_REQUEST['trackingNumber'], 
				$_REQUEST['sendNotification'], 
				$_REQUEST['comment'], 
				$_REQUEST['hiddenComment']);
			$order = new Order($_REQUEST['orderNumber']);
			include ('includes/templates/adminOrderDetail.php');	
		}
		function nextOrder() {
			$this->showNextOrder($_REQUEST['afterOrderNumber']);
		}
		function showNextOrder($currentOrderNumber) {
			$this->of = new OrderFinder();
			if ($nextOrderNumber = $this->of->getNextOpenOrderNumber($currentOrderNumber)) {
				$order = new Order($nextOrderNumber);
				include ('includes/templates/adminOrderDetail.php');
			} else {
				$this->defaultBehavior();
			}
		}
		function editMultiple() {
			if ($_REQUEST['printOrders']=='Print checked orders') {
				$this->printMultiple();
			} else {
				$orderEditor = new OrderEditor();
				foreach($_REQUEST['orderNumbers'] as $orderNumber) {
					$orderEditor->updateOrderStatus($orderNumber, $_REQUEST[$orderNumber . 'status'], $_REQUEST[$orderNumber . 'trackingNumber'], $_REQUEST['sendNotification']);
				}
				$this->openOrderList();
			}
		}
		function orderSearchForm() {
			$statusOptions = $GLOBALS['statusOptions'];
			array_unshift($statusOptions, '');
			include('includes/templates/orderSearchForm.php');
		}
		function orderSearchResults() {
			$of = new OrderFinder();
			$orders = $of->search($_REQUEST['fromDate'], $_REQUEST['toDate'], $_REQUEST['status'], $_REQUEST['orderNumber'], $_REQUEST['email'], $_REQUEST['name'], $_REQUEST['company'], $_REQUEST['zip'], $_REQUEST['shipName'], $_REQUEST['shipCompany'], $_REQUEST['shipZip']);
			$title = "Order Search Results";
			include ('includes/templates/orderSearchResults.php');
		}
		function statusFileUploadForm() {
			include('includes/templates/statusFileUploadForm.php');
		}
		function statusFileUpload() {
			$sfu = new StatusFileUploader();
			$this->message = $sfu->getMessage();
			$this->openOrderList();
		}
		function printMultiple() {
			include('includes/templates/printHeader.php');
			if (count($_REQUEST['checkedOrders']) > 0) {
				foreach($_REQUEST['checkedOrders'] as $orderNumber) {
					$order = new Order($orderNumber);
					include('templates/printOrder.php');
					}
			} else {
				print "No orders were selected. Please close this window and then check off the orders
				you'd like to print, and click the \"Print checked orders\" button again." ;
			}
			include('includes/templates/printFooter.php');
		
		}
		function emailStatus() {
			$orderNumber = $_REQUEST['orderNumber'];
			$order = new Order($orderNumber);
			$orderEmailer = new OrderEmailer();		
			if ($orderEmailer->sendFullHistory($order)) {
				$this->message = "Status for order $orderNumber was emailed to the customer.";
			} else {
				$this->message = "Couldn't email status for order $orderNumber.";
			}
			$this->openOrderList();
		}
		
	}
	$osf = new OrderStatusAdminForm();
?>
