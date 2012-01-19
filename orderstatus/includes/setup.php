<?php

 	include('includes/settings.php');
 	require_once('DB.php');
 	if ($_REQUEST['dbname'] && $_REQUEST['dbuser'] && $_REQUEST['dbpass']) {
		setup($_REQUEST['dbname'],$_REQUEST['dbuser'],$_REQUEST['dbpass']);
 	} elseif (empty($dbuser) || empty($dbpass) || empty($dbname)) {
 		include('includes/templates/setup.php');
 	} else {
 		print "Settings are configured.";
 	}
 	
 	function setup($dbname, $dbuser, $dbpass) {
 		if (testDatabase($dbname, $dbuser, $dbpass)) {
 			createSettingsFile('includes/settings.php', $content);
 		}
 	}
 	function testDatabase($dbname, $dbuser, $dbpass) {
 		$dbhost = 'localhost';
 		$dsn = "mysql://$dbuser:$dbpass@$dbhost/$dbname";
        $db = DB::connect($dsn);
        if (DB::isError($GLOBALS['db'])) {
           die ($GLOBALS['db']->getMessage());
        } 
        return true;
 	}
 	
 	function createSettingsFile($filename, $content) {
 		if (!is_writable($filename)) { 
 			throwException("File $filename is not writable");
 		}
 		/*
 		// (!is_writable ($filename)) {
 		 	//throwException("File $filename is not writable");
    	    //return false;
    	} elseif (!$handle = fopen($filename ,'a')) { 
    		throwException("Cannot open file $filename");
			return false;
    	} elseif (!fwrite ($handle , $content )) { 
			throwException("Cannot write to file $filename");
    	    return false;
    	} else {
	      	fclose ($handle ); 
            return true;       
		}*/	
 	}
 	function throwException($message) {
 		print "Fatal Exception:<br>$message<br>Exiting.";
 	}