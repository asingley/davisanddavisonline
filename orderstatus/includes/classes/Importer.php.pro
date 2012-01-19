<?
require_once('includes/dbopen.php');
require_once('includes/classes/Order.php');

class OrderImporter {
	
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
				$itemCount = $details[44];
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
					'referredBy' => $details[32], 
					'customerIP' => $details[33], 
					'productTotal' => $details[34], 
					'couponTotal' => $details[35], 
					'discount' => $details[36], 
					'surchargeLabel' => $details[37], 
					'surchargeTotal' => $details[38], 
					'taxTotal' => $details[39], 
					'shippingTotal' => $details[40], 
					'orderTotal' => $details[41], 
					'orderWeight' => $details[42], 
					'customFields' => $details[43], 
					'itemCount' => $itemCount
				);
				$order = new Order();
				$order->setDetails($orderDetails);
				// add products
				for ($i=0; $i<$itemCount;$i++) {
					$offset = $i * 12;
					if ($details[51 + $offset] == 'coupon') {
						$extendedPrice = $details[47 + $offset];
					} else {
						$extendedPrice = $details[49 + $offset];
					}	
					
					$order->addProduct(array (
						'name' => $details[45 + $offset],
						'sku' => $details[46 + $offset],
						'price' => $details[47 + $offset],
						'quantity' => $details[48  + $offset],
						'extendedPrice' => $extendedPrice,
						'taxable' => $details[50 + $offset],
						'productType' =>  $details[51 + $offset],
						'productOptions' => $details[52 + $offset],
						'otherOptions' => $details[53  + $offset],
						'totalItemWeight' => $details[54 + $offset],
						'dimensions' => $details[55 + $offset],
						'quickBooksInfo' => $details[56 + $offset]
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
