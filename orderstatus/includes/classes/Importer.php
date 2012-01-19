<?
require_once('includes/dbopen.php');
require_once('includes/classes/Order.php');

class OrderImporter {
	/*
		Used only with ShopSite Manager.  Pro produces a 
		different format with more fields and different
		offsets.
	*/	
	
	function OrderImporter($fileName_) {
		print "Importing orders...<br>";
		$lines = file($fileName_);		
		array_shift($lines); // Strip column names
		$existingOrders = $GLOBALS['db']->getCol("SELECT orderNumber from orders", 0);		
		foreach ($lines as $line) {
			$details = explode('	', $line);
			$orderNumber = $details[1];
			if (!in_array($orderNumber, $existingOrders)) {
				$orderDate = strtotime($details[0]);
				$orderDate = date("Y-m-d H:i:s", $orderDate);
				$itemCount = $details[39];
				$orderDetails = array (
					'orderDate' => $orderDate,
					'orderNumber' => $details[1], 
					'name' => $details[2], 
					'company' => $details[3], 
					'address1' => $details[4], 
					'address2' => $details[5], 
					'city' => $details[6], 
					'state' => $details[7], 
					'zip' => $details[8], 
					'country' => $details[9], 
					'phone' => $details[10], 
					'email' => $details[11], 
					'shipName' => $details[12], 
					'shipCompany' => $details[13], 
					'shipAddress1' => $details[14], 
					'shipAddress2' => $details[15], 
					'shipCity' => $details[16], 
					'shipState' => $details[17], 
					'shipZip' => $details[18], 
					'shipCountry' => $details[19], 
					'shipPhone' => $details[20], 
					'paymentMethod' => $details[21], 
					//'paymentInfo1' => $details[22], 
					//'paymentInfo2' => $details[23], 
					//'paymentInfo3' => $details[24], 
					//'paymentInfo4' => $details[25], 
					//'CVV2' => $details[26], 
					'paymentResults' => $details[27], 
					'shipMethod' => $details[28], 
					'orderInstructions' => $details[29], 
					'orderComments' => $details[30], 
					'emailList' => $details[31], 
					'customerIP' => $details[32], 
					'productTotal' => $details[33], 
					'taxTotal' => $details[34], 
					'shippingTotal' => $details[35], 
					'orderTotal' => $details[36], 
					'orderWeight' => $details[37], 
					'customFields' => $details[38], 
					'itemCount' => $itemCount
				);
				$order = new Order();
				$order->setDetails($orderDetails);
				// add products
				for ($i=0; $i<$itemCount;$i++) {
					$offset = $i * 11;
					$order->addProduct(array (
						'name' => $details[40 + $offset],
						'sku' => $details[41 + $offset],
						'price' => $details[42 + $offset],
						'quantity' => $details[43  + $offset],
						'extendedPrice' => $details[44  + $offset],
						'taxable' => $details[45 + $offset],
						'productOptions' => $details[46 + $offset],
						'otherOptions' => $details[47  + $offset],
						'totalItemWeight' => $details[48 + $offset],
						'dimensions' => $details[49 + $offset],
						'quickBooksInfo' => $details[50 + $offset]
					));					
				}
				$order->saveNew();
				$order->setStatus($GLOBALS['defaultStatus']);
			}	
		}
		print "Import complete.";
	}
	
	
}
?> 
