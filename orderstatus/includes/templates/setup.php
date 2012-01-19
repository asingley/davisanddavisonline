<? include('includes/templates/header.php');?>
<h1>Activate Order Status</h1>

<P>To activate the Order Status system, enter your database information. We'll set up the tables for you.</p>
<form method="post">
<table border="0" cellpadding="2" cellspacing="0" class="fancyTable">
<tr class="fancyTableHeader"><td colspan="2"><b>MySQL Database Information</b></td></tr>
<tr><td>Database Name:</td><td><input type="text" name="dbname"></td></tr>
<tr><td>Database User:</td><td><input type="text" name="dbuser"></td></tr>
<tr><td>Database Password:</td><td><input type="text" name="dbpass"></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Set"></td></tr>
</table>
</form>
<? include('includes/templates/footer.php');?>