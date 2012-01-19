<? include('includes/templates/header.php');?>
<h1>Search for an order</h1>
<form method="post" action="">
<input type="hidden" name="action" value="orderSearchResults">
<p>To locate an order, enter as many search fields as you like:</p>
<table border="0" cellpadding="2" cellspacing="0" class="fancyTable">
<tr class="fancyTableHeader"><td colspan="2"><b>Find orders by date range</b></td></tr>
<tr><td>Placed after date:</td><td><input type="text" name="fromDate"> (format YYYY-MM-DD)</td></tr>
<tr><td>Placed before date:</td><td><input type="text" name="toDate"> (format YYYY-MM-DD)</td></tr>
<tr><td>Status</td><td><?$this->selectMenu("status", '', $statusOptions, true)?></td></tr>
		
<tr><td>&nbsp;</td><td><input type="submit" value="Search"></td></tr>

<tr class="fancyTableHeader"><td colspan="2"><b>Find orders by customer details</b></td></tr>
<tr><td width="25%">Order Number:</td><td><input type="text" name="orderNumber"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email"></td></tr>
<tr><td>Billing Name:</td><td><input type="text" name="name"></td></tr>
<tr><td>Billing Company:</td><td><input type="text" name="company"></td></tr>
<tr><td>Billing Zip/Postal Code:</td><td><input type="text" name="zip"></td></tr>
<tr><td>Shipping Name:</td><td><input type="text" name="shipName"></td></tr>
<tr><td>Shipping Company:</td><td><input type="text" name="shipCompany"></td></tr>
<tr><td>Shipping Zip/Postal Code:</td><td><input type="text" name="shipZip"></td></tr>

<!--
<tr><td>Billing Address 1:</td><td><input type="text" name="address1"></td></tr>
<tr><td>Billing Address 2:</td><td><input type="text" name="address2"></td></tr>
<tr><td>Billing City:</td><td><input type="text" name="city"></td></tr>
<tr><td>Billing State:</td><td><input type="text" name="state"></td></tr>
<tr><td>Billing Country:</td><td><input type="text" name="country"></td></tr>

<tr><td>Shipping Address 1:</td><td><input type="text" name="shipAddress1"></td></tr>
<tr><td>Shipping Address 2:</td><td><input type="text" name="shipAddress2"></td></tr>
<tr><td>Shipping City:</td><td><input type="text" name="shipCity"></td></tr>
<tr><td>Shipping State:</td><td><input type="text" name="shipState"></td></tr>
<tr><td>Shipping Country:</td><td><input type="text" name="shipCountry"></td></tr>
-->

<tr><td>&nbsp;</td><td><input type="submit" value="Search"></td></tr>
</table>
</form>
<? include('includes/templates/footer.php');?>
