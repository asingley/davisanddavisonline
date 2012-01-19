<?php
require_once('includes/classes/Emailer.php');

class OrderEmailer {
	
	function sendStatusChange($order) {
		$orderNumber = $order->getOrderNumber();
		$fields = array (
			'name' => $order->getName(),
			'storeName' => $GLOBALS['storeName'],
			'status'=> $order->getStatus(), 
			'trackingNumber'=> $order->getTrackingNumber(), 
			'orderNumber'=> $orderNumber,
			'statusURL' => $GLOBALS['orderStatusURL'] . "/?action=findOrder&orderNumber=$orderNumber&zipCode=" . $order->getZip());	
		$emailer = new Emailer;
		$template = $GLOBALS['emailTemplatePath'] . 'statusChangeEmail.txt';
		return $emailer->send($order->getEmail(), $GLOBALS['emailSubject'], $GLOBALS['merchantEmail'], $template, $fields);
	
	}
	function sendComment($order, $comment) {
		$orderNumber = $order->getOrderNumber();
		$fields = array (
			'name' => $order->getName(),
			'storeName' => $GLOBALS['storeName'],
			'status'=> $order->getStatus(), 
			'trackingNumber'=> $order->getTrackingNumber(), 
			'comment'=> $comment, 
			'orderNumber'=> $orderNumber,
			'statusURL' => $GLOBALS['orderStatusURL'] . "/?action=findOrder&orderNumber=$orderNumber&zipCode=" . $order->getZip());	
		$emailer = new Emailer;
		$template = $GLOBALS['emailTemplatePath'] . 'newCommentEmail.txt';
		return $emailer->send($order->getEmail(), $GLOBALS['emailSubject'], $GLOBALS['merchantEmail'], $template, $fields);
	}
	function sendFullHistory($order) {
	
		$orderNumber = $order->getOrderNumber();
		foreach ($order->getStatusEvents() as $eventDate => $status) { 
			$statusHistory .= "$eventDate: $status\n";
		}
		foreach ($order->getComments('public') as $commentID=>$details) {
			$comments .= "$details[0]\n$details[1]\n";
		}
		$fields = array (
			'name' => $order->getName(),
			'storeName' => $GLOBALS['storeName'],
			'status'=> $order->getStatus(), 
			'trackingNumber'=> $order->getTrackingNumber(), 
			'statusHistory'=> $statusHistory,
			'comments'=> $comments, 
			'orderNumber'=> $orderNumber,
			'statusURL' => $GLOBALS['orderStatusURL'] . "/?action=findOrder&orderNumber=$orderNumber&zipCode=" . $order->getZip());	
		$emailer = new Emailer;
		$template = $GLOBALS['emailTemplatePath'] . 'orderHistoryEmail.txt';
		return $emailer->send($order->getEmail(), $GLOBALS['emailSubject'], $GLOBALS['merchantEmail'], $template, $fields);
	}
}
?>