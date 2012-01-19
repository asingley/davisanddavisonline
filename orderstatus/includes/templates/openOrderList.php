<?php include('includes/templates/header.php');?>
<h1><?=$title?></h1>
<? if ($this->message) { ?>
	<p class="message"><?=$this->message?></p>
<? } if (count($orders)==0) { ?>
	<p>There are no open orders, but you may <a href="?action=orderSearchForm">search for past orders</a>.</p>
 <? } else { 
		include('includes/templates/orderList.php');
	} ?>
<? include('includes/templates/footer.php');?>
