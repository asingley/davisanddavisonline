<?php
	// Customize these settings for your store
	
	$dbuser = 'davis';  
	$dbpass = 'davis34p'; 
	$dbhost = 'localhost';
	$dbname = 'davis_order';
	$storeName = 'davisanddavisonline.com';
	$orderStatusURL = 'http://www.davisanddavisonline.com/orderstatus/';
	$storeEmail = 'guestrelations@davisanddavisonline.com';
	
	// The following settings are required if you're using
	// ShopSite Manager
	
	$shopsiteUser = 'davisanddavisonline';
	$shopsitePass = 'ss3738';
	$shopsiteHost = 'jade.secure-host.com';
	$shopsitePathToOrderHandler = 'cgi-davisanddavisonline/bo/orderhandler.cgi';
	
	
	/*
		Use ShopSite to generate a page with your template or
		header and footer, and put the text
		
			[orderstatus]
			
		where you want the Order status information to appear.
		Then provide the path to that file.
	
	*/
	$shopsiteTemplateFile = '../store/orderstatus.html';
	
	// The rest of the settings do not need to be changed
	
	$emailSubject = 'Your Order Status';
	$emailTemplatePath = '../templates/';
	$merchantEmail = "$storeName <$storeEmail>";
	
	/*
		Setting customerNotificationDefault to true means that
		the "send notification to customer" box will be checked
		by default.  Set it to false if you'd prefer this box
		to be unchecked most of the time.
	
	*/
	$customerNotificationDefault = true;

	/*
		If you want the "hide comment from customer" checkbox 
		checked by default, set hideCommentDefault to true.
	*/
	
	$hideCommentDefault = false;

	/*
		List all of the status options, in the order that you
		want them to appear
	*/
	
	$statusOptions = array(
		'Order Received',
		'Shipped via UPS',
		'Shipped via FedEx',
		'Shipped via USPS',
		'Backordered',
		'Cancelled');
	/*
		Which of the above status options should be considered
		"Open" orders?
	*/
	
	$openStatusOptions = array (
		'Order Received',
		'Backordered'
	);
	/*
		Which of the above status options is the default
		that gets assigned to orders when they first 
		arrive?
	*/
	$defaultStatus = 'Order Received';
	
	/*
		These mappings match the payment type codes coming from the 
		ShopSite Order API.  If you are using ShopSite Pro and have
		changed the names of any payment types, you'll want to edit 
		this list.
		
		This list is only used when new orders are placed via
		the Order API, so existing orders won't be changed.
	*/
	
	$payTypes = array (
		0 => 'Visa', 
		1 => 'MasterCard',
		2 => 'Discover', 
		3 => 'American Express', 
		4 => 'Purchase Order', 
		5 => 'C.O.D.', 
		6 => 'Check', 
		7 => 'PayPal', 
		8 => 'Generic Payment Option 1',
		9 => 'Generic Payment Option 2', 
		10 => 'DinerÕs Club/Carte Blanche'); 

	$upsAccessKey = '6BBA1649FF53668C';
?>
