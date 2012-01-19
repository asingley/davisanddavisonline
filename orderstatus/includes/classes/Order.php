<?php
require_once('includes/dbopen.php');
class Order {

	var $orderNumber;
	var $details = array();
	var $products = array();
	var $statusEvents = array();
	var $comments = array();
	var $publicComments = array();
	
	//Getters
	
	function getProducts() {
		return $this->products;
	}
	
	function getStatusEvents() {
		return $this->statusEvents;
	}
	function getComments($restriction = null) {
		if ($restriction == 'public') {
			return $this->publicComments;
		} else {
			return $this->comments;
		}
	}
	function getDetail($detail) {
		return $this->details[$detail];
	}
	function getName() {
		return $this->details['name'];
	}
	function getOrderNumber() {
		return $this->details['orderNumber'];
	}
	function getOrderDate() {
		return $this->prettyDate($this->details['orderDate']);
	}
	function getCompany() {
		return $this->details['company'];
	}
	function getEmail() {
		return $this->details['email'];
	}
	function getAddress1() {
		return $this->details['address1'];
	}
	function getAddress2() {
		return $this->details['address2'];
	}
	function getCity() {
		return $this->details['city'];
	}
	function getState() {
		return $this->details['state'];
	}
	function getZip() {
		return $this->details['zip'];
	}
	function getPhone() {
		return $this->details['phone'];
	}
	function getCountry() {
		return $this->details['country'];
	}
	function getShipName() {
		return $this->details['shipName'];
	}
	function getShipCompany() {
		return $this->details['shipCompany'];
	}
	function getShipAddress1() {
		return $this->details['shipAddress1'];
	}
	function getShipAddress2() {
		return $this->details['shipAddress2'];
	}
	function getShipCity() {
		return $this->details['shipCity'];	
	}
	function getShipState() {
		return $this->details['shipState'];	
	}
	function getShipZip() {
		return $this->details['shipZip'];	
	}
	function getShipCountry() {
		return $this->details['shipCountry'];	
	}
	function getShipPhone() {
		return $this->details['shipPhone'];	
	}
	function getSubtotal() {
		return $this->details['productTotal'];
	}
	function getTax() {
		return $this->details['taxTotal'];
	}
	function getShipping() {
		return $this->details['shippingTotal'];
	}	
	function getGrandTotal() {
		return $this->details['orderTotal'];	
	}
	function getStatus() {
		return $this->details['status'];
	}
	function getTrackingNumber() {
		return $this->details['trackingNumber'];
	}
	function getShipMethod() {
		return $this->details['shipMethod'];
	}
	function getOrderInstructions() {
		return $this->details['orderInstructions'];
	}
	function getOrderComments() {
		return $this->details['orderComments'];
	}	
	function getTrackingLink() {
		$upsAccessKey = $GLOBALS['upsAccessKey'];
		$shipMethod = strtolower($this->details['status']);
		$trackingNumber = $this->details['trackingNumber'];
		$mappings = array(
			'ups' => "http://wwwapps.ups.com/WebTracking/OnlineTool?InquiryNumber1=$trackingNumber&UPS_HTML_License=$upsAccessKey&IATA=us&Lang=eng&UPS_HTML_Version=3.0&TypeOfInquiryNumber=T",
			'fedex' => "http://www.fedex.com/Tracking?tracknumbers=$trackingNumber&action=trackingNumber&language=english&cntry_code=us&mps=y&ascend_header=1&imageField=Track",
			'usps' => 'http://www.usps.com/',
			'dhl' => "http://track.dhl-usa.com/TrackByNbr.asp?ShipmentNumber=$trackingNumber",
			'airborne' => "http://track.dhl-usa.com/TrackByNbr.asp?ShipmentNumber=$trackingNumber");
		foreach ($mappings as $name => $url) {
			if (strpos($shipMethod, $name)) {
				$this->trackingLink = $url;
			}
		}
		return $this->trackingLink;
	}
	// Setters
	
	function setStatus($status) {
		if ($status != $this->details['status']) {
			$this->setDetail('status', $status);
			$query = "INSERT INTO statusEvents (orderNumber, eventDate, status) VALUES ('" . $this->orderNumber . "', NOW(), '$status')";
			$result = $GLOBALS['db']->query($query);
			$this->_loadStatusEvents();
			return true;
		} else {
			// Status sent was the same as the one we already had.
			return false;
		}
	}
	function setTrackingNumber($trackingNumber) {
		if ($trackingNumber != ($this->details['trackingNumber'])) {
			$this->setDetail('trackingNumber', $trackingNumber);	
			if (empty($trackingNumber)) {
				//print "Tracking number was removed";
				return false;
			} else {		
				//print "New tracking number ('$trackingNumber') was added";
				return true;
			}
		} else {
			//print "Tracking number was the same";
			return false;
		}
	}
	
	function setDetail($detailName, $value) {
		$this->details[$detailName] = $value;
		$GLOBALS['db']->query("UPDATE orders SET $detailName = '$value' WHERE orderNumber = $this->orderNumber");
	
	}
	
	function setDetails($details) {
		$this->details = $details;
		$this->orderNumber = $details['orderNumber'];
	}
	function exists() {
		if (!empty($this->details['orderNumber'])) {
			return true;
		}
	}
	function Order($orderNumber = null) {
		if (isset($orderNumber)) {
			$this->orderNumber = $orderNumber;
			$this->_load($orderNumber);
		}
	}
	function addProduct($productDetails) {
		$this->products[] = $productDetails;
	}
	function addComment($comment, $hidden = false) {
		$query = "INSERT INTO orderComments 
					(orderNumber, commentDate, comment, commentHidden) 
				  VALUES ('$this->orderNumber', NOW(), '$comment', ";
		$query .= $hidden ? 1 : 0;
		$query .= ")";
		$result = $GLOBALS['db']->query($query);	
		$this->_loadComments();
	}

	function saveNew() {
		$result = $GLOBALS['db']->autoExecute('orders', $this->details);
		if (DB::isError($result)) {
			die($result->getMessage());
		}
		
		foreach ($this->products as $id=>$productDetails) {
			$productDetails['orderNumber'] = $this->details['orderNumber'];
			$result = $GLOBALS['db']->autoExecute('productPurchases', $productDetails);
			if (DB::isError($result)) {
				print "<pre>";
				print_r($result);
				die($result->getMessage());
			}	
		}
	}
	function delete() {
		if ($orderNumber = $this->details['orderNumber']) {
			$GLOBALS['db']->query("DELETE FROM orders WHERE orderNumber = '$orderNumber'");
			$GLOBALS['db']->query("DELETE FROM productPurchases WHERE orderNumber = '$orderNumber'");
		}
	}
	function prettyDate($date) {
		return date('M j, Y g:iA', strtotime($date));
	}
	function _load($orderNumber) {
		$query = "SELECT * FROM orders WHERE orderNumber = '$orderNumber'";
		$this->details = $GLOBALS['db']->getRow($query, DB_FETCHMODE_ASSOC);
			
		$result	= $GLOBALS['db']->getAll("
			SELECT *
			FROM productPurchases pp 
			WHERE orderNumber = '$orderNumber'", DB_FETCHMODE_ASSOC);
		if (DB::isError($result)) {
			die($result->getMessage());
		}
		foreach ($result as $row) {
			$this->products[] = $row;
		}
		$this->_loadComments();
		$this->_loadStatusEvents();
	}

	function _loadComments() {
		$this->comments = $GLOBALS['db']->getAssoc("SELECT commentID, commentDate, comment, commentHidden 
			FROM orderComments 
			WHERE orderNumber = '$this->orderNumber' 
			ORDER BY commentDate");
		foreach ($this->comments as $commentID=>$details) {
			$details[0] = $this->prettyDate($details[0]);
			$this->comments[$commentID] = $details;
		}
		$this->publicComments = $GLOBALS['db']->getAssoc(
			"SELECT commentID, commentDate, comment, commentHidden 
			FROM orderComments 
			WHERE orderNumber = '$this->orderNumber' 
			AND commentHidden = 0 
			ORDER BY commentDate");
		foreach ($this->publicComments as $commentID=>$details) {
			$details[0] = $this->prettyDate($details[0]);
			$this->publicComments[$commentID] = $details;
		}
	}
	function _loadStatusEvents() {
		$statusEvents = $GLOBALS['db']->getAssoc(
			"SELECT eventDate, status 
			FROM statusEvents 
			WHERE orderNumber = '$this->orderNumber' 
			ORDER BY eventDate");
		foreach ($statusEvents as $eventDate => $status) {
			$this->statusEvents[$this->prettyDate($eventDate)] = $status;
		}
	}
	
}
?>
