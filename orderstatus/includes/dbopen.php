<?php
        /*
                Copyright (c)2003 Satori Design and Alex Pukinskis
                info@satoridesign.com
                This code may be modified, but not resold.
                Modifications may void the warranty.
        */

        require_once 'DB.php';
		
	
        $dsn = "mysql://$dbuser:$dbpass@$dbhost/$dbname";
        $db = DB::connect($dsn);
        if (DB::isError($GLOBALS['db'])) {
           die ($GLOBALS['db']->getMessage());
        } 

?>
