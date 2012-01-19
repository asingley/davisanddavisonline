<?php
	/*
	
		This script receives a Shopsite order from the perl wrapper script 
		miraizon.pl.  It builds a proper post array because for some reason
		php doesn't recognize the post array from ShopSite as a vaild post array.
	
	*/
	if (!empty($argv[1])) {
		$pairs = split ("&", $argv[1]);
		foreach ($pairs as $pair) {
				list($name,$value) = split ("=", $pair);
				$post[urldecode($name)] = urldecode($value);
		}
		$ospath = $post['orderapi1'];
		set_include_path(get_include_path() . ":$ospath");
		require_once('settings.php');
		require_once('includes/classes/Order.php');
		require_once('includes/classes/SingleOrderImporter.php');
		
		$op = new SingleOrderImporter($post);
	} else {
		print "No arguments provided.\n";	
	}
?>
