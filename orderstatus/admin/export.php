<?php

  require_once('settings.php');

  $submit = $_POST["submit"];

  if ($submit == "") {
	output_page("");
  }



  elseif ($submit == 'Export Orders') {
	$ordernums = $_POST["ordernums"];
	$exportname = $_POST["exportname"];
	$exportset = $_POST["exportset"];
	$useheader = $_POST["useheader"];
	$fromdate = ""; $todate = "";
	$fromdate = $_POST["fromdate"];
	$todate = $_POST["todate"];
	$screen = "";
	$screen = $_POST["screen"];
	$choosestatus = $_POST["choosestatus"];

	$counter = 0;
	while ($counter <= 34) {
		$setcounter = $counter + 1;
		$a[$counter] = $_POST["a$setcounter"];
		if ($a[$counter] == 'first') {$a[$counter] = "name"; $flag[$counter] = "first";}
		elseif ($a[$counter] == 'last') {$a[$counter] = "name"; $flag[$counter] = "last";}
		elseif ($a[$counter] == 'shipfirst') {$a[$counter] = "shipName"; $flag[$counter] = "first";}
		elseif ($a[$counter] == 'shiplast') {$a[$counter] = "shipName"; $flag[$counter] = "last";}
		$counter++;
	}

	$counter = 0;
	while ($counter <= 5) {
		$setcounter = $counter + 1;
		$p[$counter] = $_POST["p$setcounter"];
		$counter++;
	}

	$count = 0;

	$counter = 0;
	while ($counter <= 34) {
		if ($a[$counter] != 'None') {
			if ($counter == 0) {
				$aa[$counter] = $a[$counter];
				if ($flag[$counter] == 'first' AND $a[$counter] == 'name') {$aa[$counter] = "first";}
				elseif ($flag[$counter] == 'first' AND $a[$counter] == 'shipName') {$aa[$counter] = "shipfirst";}
				elseif ($flag[$counter] == 'last' AND $a[$counter] == 'name') {$aa[$counter] = "last";}
				elseif ($flag[$counter] == 'last' AND $a[$counter] == 'shipName') {$aa[$counter] = "shiplast";}
				$fields .= "$aa[$counter]"; $count++;
			}
			else {
				$aa[$counter] = $a[$counter];
				if ($flag[$counter] == 'first' AND $a[$counter] == 'name') {$aa[$counter] = "first";}
				elseif ($flag[$counter] == 'first' AND $a[$counter] == 'shipName') {$aa[$counter] = "shipfirst";}
				elseif ($flag[$counter] == 'last' AND $a[$counter] == 'name') {$aa[$counter] = "last";}
				elseif ($flag[$counter] == 'last' AND $a[$counter] == 'shipName') {$aa[$counter] = "shiplast";}
				$fields .= ",$aa[$counter]"; $count++;
			}
		}
		$counter++;
	}

	$pcount = 0;
	$counter = 0;
	while ($counter <= 5) {
		if ($p[$counter] != 'None') {
			if ($counter == 0) {
				$pfields .= "$p[$counter]"; $pcount++;
			}
			else {
				$pfields .= ",$p[$counter]"; $pcount++;
			}
		}
		$counter++;
	}
	
	list ($min, $max) = split ("-", $ordernums);
	if ($max == '' AND $ordernums > 0) {$min = $ordernums; $max = $ordernums;}
	if ($min == '') {$min = 1;}
	if ($max == '') {$max = 1;}

	$link = mysql_connect("localhost",$dbuser,$dbpass);
	mysql_select_db("$dbname");


	if ($exportset != 'None' AND $exportset != '') {
		$query = "SELECT exportfields,productfields,numfields,numproductfields,useheader from exports WHERE exportname = '$exportset'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
			$fields = $row[0];
			$pfields = $row[1];
			$count = $row[2];
			$pcount = $row[3];
			$useheader = $row[4];
			list ($a[0],$a[1],$a[2],$a[3],$a[4],$a[5],$a[6],$a[7],$a[8],$a[9],$a[10],$a[11],$a[12],$a[13],$a[14],$a[15],$a[16],$a[17],$a[18],$a[19],$a[20],$a[21],$a[22],$a[23],$a[24],$a[25],$a[26],$a[27],$a[28],$a[29],$a[30],$a[31],$a[32],$a[33],$a[34]) = split(",",$fields);
			list ($p[0],$p[1],$p[2],$p[3],$p[4],$p[5]) = split(",",$pfields);

			$counter = 0;
			while ($counter <= 34) {
				if ($a[$counter] == 'first') {$a[$counter] = "name"; $flag[$counter] = "first";}
                                elseif ($a[$counter] == 'last') {$a[$counter] = "name"; $flag[$counter] = "last";}
                                elseif ($a[$counter] == 'shipfirst') {$a[$counter] = "shipName"; $flag[$counter] = "first";}
                                elseif ($a[$counter] == 'shiplast') {$a[$counter] = "shipName"; $flag[$counter] = "last";}
                                $counter++;
                        }

		}
	}

	if ($choosestatus != "All") {
		$limiter = "AND status = \"$choosestatus\"";
	}
	else {
		$limiter = "";
	}
	
	if ($fromdate == "" AND $min != 1 AND $max != 1) {
		$query = "SELECT * from orders WHERE orderNumber >= $min AND orderNumber <= $max $limiter";
	}
	elseif ($fromdate == "" AND $min == 1 AND $max == 1 AND $choosestatus != "All") {
		$query = "SELECT * from orders WHERE status = \"$choosestatus\"";
	}
	else {
		$fromdate = $fromdate . " 00:00:00";
		if ($todate == "") {$todate = "2037-12-31";}
		$todate = $todate . " 23:59:59";
		$query = "SELECT * from orders WHERE orderDate >= \"$fromdate\" AND orderDate <= \"$todate\" $limiter";
	}

	$result = mysql_query($query);

	$num_rows = mysql_num_rows($result);
	if ($num_rows == 0) {
		$text = "NO RESULTS WERE FOUND. PLEASE RE-ENTER A NEW EXPORT CRITERIA.";
		output_page($text);
		exit;
	}

	if ($screen == "") {
		header('Content-type: text/plain');
		header('Content-Disposition: attachment; filename="export.txt"');
	}
	else {
		header('Content-type: text/html');
		print "<HTML><BODY><PRE>";
	}

	$firstcount = 0;
	$text_header = "";
	$text_data = "";

	if ($useheader == "checked") {
		$firstcount = 1;
		$tfcount = 0;
		while ($tfcount <= 34) {
			if ($a[$tfcount] != "None" AND isset($a[$tfcount])) {
				if ($tfcount == 0) {
					$text_header .= "$a[$tfcount]";
					//print "$a[$tfcount]";
				}
				else {
					$text_header .= "\t$a[$tfcount]";
					//print "\t$a[$tfcount]";
				}
			}
			$tfcount++;
		}
	}	

	$number_product_fields = 0;
	$text_products = "";
		
	while ($row = mysql_fetch_assoc($result)) {
		$tempvar = $row["orderNumber"];
		$query2 = "SELECT * from productPurchases WHERE ordernumber = $tempvar";
		$result2 = mysql_query($query2);

		$num_prod_rows = mysql_num_rows($result2);
		if ($num_prod_rows > 0) {
			$text_products = "";
			$temp_prod = $num_prod_rows;
			if ($num_prod_rows > $number_product_fields) {$number_product_fields = $num_prod_rows;}
			while ($row2 = mysql_fetch_assoc($result2)) {
				$temp = 0;
				while ($temp < $pcount) {
					$ptext = $row2["$p[$temp]"];
					$text_products .= "\t" . $ptext;
					$temp++;
				}
				//$text_products .= "\t" . $row2["name"] . "\t" . $row2["sku"] . "\t" . $row2["quantity"] . "\t" . $row2["extendedPrice"];
			}
		}
			

		$temp = 0;
		if ($row["shipAddress1"] == "") {
			$row["shipName"] = $row["name"];
			$row["shipCompany"] = $row["company"];
			$row["shipAddress1"] = $row["address1"];
			$row["shipAddress2"] = $row["address2"];
			$row["shipCity"] = $row["city"];
			$row["shipState"] = $row["state"];
			$row["shipZip"] = $row["zip"];
			$row["shipPhone"] = $row["phone"];
			$row["shipCountry"] = $row["country"];
		}
		if ($firstcount > 0) {$text_data .= "\r\n";}
		while ($temp < $count) {
			$rowtemp = $row["$a[$temp]"];
			if ($flag[$temp] == 'first') {
				list ($first, $last) = split (" ", $row["$a[$temp]"]);
				$rowtemp = $first;
			}
			elseif ($flag[$temp] == 'last') {
				list ($first, $last) = split (" ", $row["$a[$temp]"]);
				$rowtemp = $last;
			}

			if ($temp == 0) {
				$ttext = $rowtemp;
				$text_data .= $ttext;
				//print "$ttext";
			}
			else {
				$ttext = $rowtemp;
				$text_data .= "\t" . $ttext;
				//print "\t$ttext";
			}
			$temp++;
		}
		$text_data .= $text_products . $text_footer;
		$firstcount++;
		$row["shipAddress1"] = "";
	}

	if ($number_product_fields > 0 AND $useheader == 'checked') {
		$tcount = 1;
		while ($tcount <= $number_product_fields) {
			$temp = 0;
			while ($temp < $pcount) {
				$ptext = $p[$temp];
				$text_header .= "\tProduct " . $ptext . $tcount;
				$temp++;
			}
			//$text_header .= "\tProduct Name $tcount\tProduct SKU $tcount\tProduct Quantity $tcount\tProduct Price $tcount";
			$tcount++;
		}
	}

	print "$text_header";
	print "$text_data";


	if ($exportname != "") {
		$query = "SELECT exportfields from exports WHERE exportname = '$exportname'";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);

		if ($num_rows == 0) {
			$query = "INSERT into exports (exportname, exportfields, productfields, numfields, numproductfields, useheader) values ('$exportname', '$fields', '$pfields', '$count', '$pcount', '$useheader')";
			$result = mysql_query($query);
		}
		else {
			$query = "UPDATE exports SET exportfields='$fields', productfields = '$pfields', numfields='$count', numproductfields='$pcount', useheader='$useheader' WHERE exportname='$exportname'";
			$result = mysql_query($query);
		}
	}
		
	if ($screen != "") {
		print "</PRE></BODY></HTML>";
	}
  }


function errorpage ($error) {
print <<<END
<HTML><BODY>
<B>ERROR: </B> $error
<P>
Please go back and correct the error.
</BODY></HTML>
END;
}

function output_page ($texterror) {
  extract($GLOBALS);
  include('includes/templates/header.php');

	print <<<END
<h1>Export Orders - Tab delimited text file: export.txt</h1>
END;
if ($texterror != "") {
  print "<BR><FONT COLOR=\"red\"><B>$texterror</B></FONT>";
}
print <<<END
<FORM ACTION="export.php" METHOD="POST">
<B>Enter Range of Order Numbers to Export (i.e.  1275-1300):</B> <BR>
<INPUT TYPE="TEXT" NAME="ordernums">
<BR><BR>
-OR-<BR>
<BR><B>Enter range of dates to Export (YYYY-MM-DD format):</B><BR>
From: <INPUT TYPE="TEXT" NAME="fromdate" SIZE="10"> &nbsp; &nbsp; To: <INPUT TYPE="TEXT" NAME="todate" SIZE="10">
<BR><BR>
<BR><B>Choose an Order Status to Restrict Export</B><BR>
 (Leave order numbers and date range blank to export all orders limited by order status.)<BR>
<SELECT NAME="choosestatus">
<OPTION VALUE="All" SELECTED>All
END;

foreach ($statusOptions as $val) {
	print "<OPTION VALUE=\"$val\">$val\n";
}

print <<<END
</SELECT>
<P>
<table border=0 width="100%">
<tr><td valign="top">
<B>Choose the fields below in the order you want them exported:</B><BR>
<B>1</B> <SELECT NAME="a1">
<OPTION VALUE="orderNumber" SELECTED>Order Number
<OPTION VALUE="orderDate">Order Date/Time
<OPTION VALUE="email">Email Address
<OPTION VALUE="name">Billing Full Name
<OPTION VALUE="first">Billing First Name
<OPTION VALUE="last">Billing Last Name
<OPTION VALUE="company">Billing Company
<OPTION VALUE="address1">Billing Address 1
<OPTION VALUE="address2">Billing Address 2
<OPTION VALUE="city">Billing City
<OPTION VALUE="state">Billing State
<OPTION VALUE="zip">Billing Zip
<OPTION VALUE="phone">Billing Phone
<OPTION VALUE="country">Billing Country
<OPTION VALUE="shipName">Shipping Full Name
<OPTION VALUE="shipfirst">Shipping First Name
<OPTION VALUE="shiplast">Shipping Last Name
<OPTION VALUE="shipCompany">Shipping Company
<OPTION VALUE="shipAddress1">Shipping Address 1
<OPTION VALUE="shipAddress2">Shipping Address 2
<OPTION VALUE="shipCity">Shipping City
<OPTION VALUE="shipState">Shipping State
<OPTION VALUE="shipZip">Shipping Zip
<OPTION VALUE="shipPhone">Shipping Phone
<OPTION VALUE="shipCountry">Shipping Country
<OPTION VALUE="shipMethod">Shipping Method
<OPTION VALUE="itemCount">Number of Separate Items
<OPTION VALUE="productTotal">Product Total
<OPTION VALUE="taxTotal">Tax Total
<OPTION VALUE="shippingTotal">Shipping Total
<OPTION VALUE="orderTotal">Order Total
<OPTION VALUE="orderWeight">Total Weight of Products
</SELECT>
END;

	$tcount = 2;
	while ($tcount <= 35) {
		print <<<END
<BR>
<B>$tcount</B> <SELECT NAME="a$tcount">
<OPTION VALUE="None" SELECTED>None
<OPTION VALUE="orderNumber">Order Number
<OPTION VALUE="orderDate">Order Date/Time
<OPTION VALUE="email">Email Address
<OPTION VALUE="name">Billing Full Name
<OPTION VALUE="first">Billing First Name
<OPTION VALUE="last">Billing Last Name
<OPTION VALUE="company">Billing Company
<OPTION VALUE="address1">Billing Address 1
<OPTION VALUE="address2">Billing Address 2
<OPTION VALUE="city">Billing City
<OPTION VALUE="state">Billing State
<OPTION VALUE="zip">Billing Zip
<OPTION VALUE="phone">Billing Phone
<OPTION VALUE="country">Billing Country
<OPTION VALUE="shipName">Shipping Full Name
<OPTION VALUE="shipfirst">Shipping First Name
<OPTION VALUE="shiplast">Shipping Last Name
<OPTION VALUE="shipCompany">Shipping Company
<OPTION VALUE="shipAddress1">Shipping Address 1
<OPTION VALUE="shipAddress2">Shipping Address 2
<OPTION VALUE="shipCity">Shipping City
<OPTION VALUE="shipState">Shipping State
<OPTION VALUE="shipZip">Shipping Zip
<OPTION VALUE="shipPhone">Shipping Phone
<OPTION VALUE="shipCountry">Shipping Country
<OPTION VALUE="shipMethod">Shipping Method
<OPTION VALUE="itemCount">Number of Separate Items
<OPTION VALUE="productTotal">Product Total
<OPTION VALUE="taxTotal">Tax Total
<OPTION VALUE="shippingTotal">Shipping Total
<OPTION VALUE="orderTotal">Order Total
<OPTION VALUE="orderWeight">Total Weight of Products
</SELECT>
END;
		$tcount++;
	}

	print <<<END
</td>
<td valign="top"><B>choose product field order if you want all products on same line item for the order:</b><BR>
(Product fields will appear at the end of each row repeated for the number of distinct products for an order.)
END;
$tcount = 1;
while ($tcount <= 6) {
	print <<<END
<BR>
<SELECT NAME="p$tcount">
<OPTION VALUE="None" SELECTED>None
<OPTION VALUE="name">Product Name
<OPTION VALUE="sku">Product SKU
<OPTION VALUE="quantity">Product Quantity
<OPTION VALUE="price">Product Price
<OPTION VALUE="productOptions">Product Ordering Options
<OPTION VALUE="totalItemWeight">Total Weight of Items
</SELECT>
END;
	$tcount++;
	}

print <<<END
</td>
</tr>
</table>
<P>
<INPUT TYPE="checkbox" NAME="useheader" VALUE="checked"> Set first row as headers for columns
<BR><BR>
<B>Name for saving above Export order for future use:</B><BR>
(Leave blank if you do not want this export order saved.)<BR>
<INPUT TYPE="TEXT" NAME="exportname">
<P>&nbsp;<BR>
END;

        $link = mysql_connect("localhost",$dbuser,$dbpass);
        mysql_select_db("$dbname");

        $query = "SELECT * from exports";

        $result = mysql_query($query);
	$num_rows = mysql_num_rows($result);

	if ($num_rows > 0) {
		print <<<END
<B>-OR-</B><BR>
Choose from a saved export set below:<BR>
<SELECT NAME="exportset">
<OPTION NAME="None" SELECTED>None
END;
        	while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
			print "<OPTION VALUE=\"$row[0]\">$row[0] - $row[1] $row[2]";
		}
		print "</SELECT><P>";
	}


	print <<<END
<INPUT TYPE="checkbox" NAME="screen" VALUE="checked"> Output results to browser screen instead of text file
<P>
<INPUT TYPE="SUBMIT" NAME="submit" VALUE="Export Orders">
</FORM>
END;
	include('includes/templates/footer.php');
	print <<<END
</BODY>
</HTML>
END;
}

?>
