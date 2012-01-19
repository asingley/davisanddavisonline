<?php
require_once('settings.php');
require_once('includes/classes/Importer.php');

	$url = "https://$shopsiteUser:$shopsitePass@$shopsiteHost/";
	$url .= "$shopsitePathToOrderHandler?format=simple&tab_version=6.3&orders_version=6.3&filename=orders&filetype=txt&dbname=orders&datatype=3&pid=5334&extract_orders=1";	
	$oi = new OrderImporter($url);

?>