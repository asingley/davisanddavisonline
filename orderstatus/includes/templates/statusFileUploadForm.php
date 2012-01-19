<?php include ('includes/templates/header.php');?>
<h1>Bulk Upload Status/Tracking Information</h1>
<? if ($errors = $this->getErrors()) { ?>
	<p class="error">
	<? foreach ($errors as $error) { ?>
		<?=$error?><br />
	<? } ?>
<? } ?>
<p>Use this form to bulk upload status and tracking information for many orders.  
The file should be tab-separated and contain three columns: Order number (required), status (required), and a tracking number (optional).</p>

<p><b>Select the file on your computer that contains order status and tracking information:</b></p>
<form enctype="multipart/form-data" method="POST" action="?">
<input type="hidden" name="action" value="statusFileUpload">
<input type="hidden" name="MAX_FILE_SIZE" value="40000000">
<p><input name="userfile" type="file"><br>
<input type="checkbox" name="sendNotification" value="true"<?=$this->checkSelected($GLOBALS['customerNotificationDefault'], true, 'checked')?>>Send notification to customers if their status changed or a tracking number was added<br>
<input type="submit" value="Upload File"></p>
</form>
<?php include('includes/templates/footer.php');