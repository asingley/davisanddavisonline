<?php
class SingleOrderImporter {

	function SingleOrderImporter($post) {
		$numberOfProducts = $post['O-NumItems'];
		$orderDate = strtotime($post['O-Date']);
		$orderDate = date("Y-m-d H:i:s", $orderDate);
		
		// Extract surcharge label and surcharge total
		
		$surchargeParts = explode(';',$post['O-Surcharge']);
		if (is_array($surchargeParts)) {
			$surchargeLabel = $surchargeParts[0];
			$pairs = explode('|',$post['O-AllTotals']);
			foreach ($pairs as $pair) {
				$split = explode(':', $pair);
				if ($split[0] == 'SurchargeTotal') {
					$surchargeTotal = $split[1];
				}
			}
			
		}
		
		$orderDetails = array (
			'orderDate' => $orderDate,
			'orderNumber' => $post['O-OrderNum'], 
			'name' => $post['O-Name'], 
			'company' => $post['O-Company'], 
			'address1' => $post['O-Address'], 
			'address2' => $post['O-Address2'], 
			'city' => $post['O-City'], 
			'state' => $post['O-State'], 
			'zip' => $post['O-Zip'], 
			'country' => $post['O-Country'], 
			'phone' => $post['O-Phone'], 
			'email' => $post['O-Email'], 
			'shipName' => $post['O-ShipName'], 
			'shipCompany' => $post['O-ShipCompany'], 
			'shipAddress1' => $post['O-ShipAddress'], 
			'shipAddress2' => $post['O-ShipAddress2'], 
			'shipCity' => $post['O-ShipCity'], 
			'shipState' => $post['O-ShipState'], 
			'shipZip' => $post['O-ShipZip'], 
			'shipCountry' => $post['O-ShipCountry'], 
			'shipPhone' => $post['O-ShipPhone'], 
			'paymentMethod' => $GLOBALS['payTypes'][$post['O-paytype']], 
			'paymentResults' => $post['F-OrderInfo'],
			'shipMethod' => $post['F-Shipping'], 
			'orderInstructions' => $post['F-OrderInst'], 
			'orderComments' => $post['F-Comments'], 
			'emailList' => $post['F-EmailList'], 
			'referredBy' => $post['O-RefName'], 
			'customerIP' => $post['F-IP_Addr'], 
			'productTotal' => $post['F-ProductTotal'], 
			'couponTotal' => $post['O-Coupons'], 
			'discount' => $post['O-Discount'], 
			'surchargeLabel' => $surchargeLabel, 
			'surchargeTotal' => $surchargeTotal,
			'taxTotal' => $post['F-TaxTotal'], 
			'shippingTotal' => $post['F-ShippingTotal'], 
			'orderTotal' => $post['F-GrandTotal'], 
			'orderWeight' => $post['F-Total_Weight'], 
			'customFields' => $post['F-Custom Fields'], 
			'itemCount' => $post['O-NumItems'], 
			'giftCertificate' => $post['O-GiftCertificate'],
		);
		$order = new Order();
		$order->setDetails($orderDetails);
				
		for ($i = 1; $i <= $numberOfProducts; $i++) { 
			$j = ($i<10) ? '0' . $i : $i; // Add a leading 0 so we get the form B01-whatever to meet the Shopsite Order API
			if ($post['B' . $j . '-Product Type'] == 'coupon') {
				$extendedPrice = $post['B' . $j . '-Price'];
			} else {
				$extendedPrice = $post['B' . $j . '-Sub-total'];
			}			
			
			$order->addProduct(array (
				'name' => $post['B' . $j . '-Name'],
				'sku' => $post['B' . $j . '-SKU'],
				'price' => $post['B' . $j . '-Price'],
				'quantity' => $post['B' . $j . '-Quantity'],
				'extendedPrice' => $extendedPrice,
				'taxable' => $post['B' . $j . '-Taxable'],
				'productType' =>  $post['B' . $j . '-Product Type'],
				'productOptions' => $post['B' . $j . '-Finite Options'],
				'otherOptions' => $post['B' . $j . '-Freeform Options'],
				'totalItemWeight' => $post['B' . $j . '-Weight'],
				'dimensions' => $post['B' . $j . '-Dimension'],
				'quickBooksInfo' => $post['B' . $j . '-QBImport']
			));
		}

		$order->saveNew();
		$order->setStatus($GLOBALS['defaultStatus']);

	}
}

?>
