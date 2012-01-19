<?php
require_once('includes/classes/OrderEmailer.php');	
	
class OrderEditor {
	
	function updateOrderStatus($orderNumber, $status, $trackingNumber, $sendNotification, $comment = null, $hiddenComment = null) {
		$order = new Order($orderNumber);
		$statusChanged = $order->setStatus($status);
		$trackingNumberAdded = $order->setTrackingNumber($trackingNumber);
		if (!empty($comment)) {
			$order->addComment($comment);
			$regularCommentAdded = true;
		}
		if (!empty($hiddenComment)) {
			$order->addComment($hiddenComment, true);
			$hiddenCommentAdded = true;
		}			
		if ($sendNotification) {
			$orderEmailer = new OrderEmailer();
			if ($regularCommentAdded == true) {
				$orderEmailer->sendComment($order, $comment);		
			} elseif ($statusChanged or $trackingNumberAdded) {
				$orderEmailer->sendStatusChange($order);		
			}
		}
		if ($statusChanged or $trackingNumberAdded or $regularCommentAdded or $hiddenCommentAdded) {
			return true;
		}		
	}

}

?>