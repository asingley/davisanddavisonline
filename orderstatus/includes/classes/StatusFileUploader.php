<?php
require_once('includes/classes/OrderEditor.php');

class StatusFileUploader {
	var $message;

	function StatusFileUploader() {
		if (isset($_FILES['userfile']) && !$_FILES['userfile']['error']) {
			$orderEditor = new OrderEditor();
			$updateCount = 0;
			$lines = file($_FILES['userfile']['tmp_name']);
			foreach ($lines as $line) {
				$updated = false;
				$columns = explode("	", $line);
				$updated = $orderEditor->updateOrderStatus(trim($columns[0]), trim($columns[1]), trim($columns[2]), $_REQUEST['sendNotification']);	
				if ($updated) $updateCount++;
			}
			$ordersUpdated = ($updateCount == 1) ? '1 order was updated' : "$updateCount orders were updated";
			$this->message = "File upload succeeded. $ordersUpdated.";
		} else {
			$this->message = 'No file was uploaded.';
		}
	}

	function getMessage() {
		return $this->message;
	}

}

?>