<? include('includes/templates/header.php');?>
<h1><?=$title?></h1>
<?php if (count($orders)==0) { ?>
	<p class="error">No orders found.</p>
	<p><a href="?action=orderSearchForm">Refine Search</a></p>
<? 	} else { 
		include('includes/templates/orderList.php');
	} 
	include('includes/templates/footer.php');
	
	
?>
