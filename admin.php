<?php
 session_start();
 if(!session_is_registered(myusername)){
 header("location:index.php");
 }
 ?>
<a href="public_html/new_item_form.php">Add a new Item</a>
