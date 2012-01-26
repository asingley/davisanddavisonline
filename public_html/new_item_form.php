<head>
<title>New Product Portal</title>
</head>

<H1>New Product Portal</H1>
<hr>

<form enctype="multipart/form-data" action="submit_new_item.php" method="post"></br>
Product Name: <input type="text" name="prod_name"/></br>

<input type="radio" name="group1" value="alone" checked> Stand Alone Item<br>
<input type="radio" name="group1" value="drink"> Drinks<br>
<input type="radio" name="group1" value="bowl"> Bowls<br>
<input type="radio" name="group1" value="cball"> Cheeseball Kits<br>
<input type="radio" name="group1" value="oil"> Cooking and Dipping Oils<br>
<input type="radio" name="group1" value="dip"> Dipper Mixes<br>
<input type="radio" name="group1" value="fdrink"> Frozen Drinks and Mixes<br>
<input type="radio" name="group1" value="kstuff"> Ken's Stuff<br>
<input type="radio" name="group1" value="must" > Mustards and Relishes<br>
<input type="radio" name="group1" value="salsa"> Salsa Magic<br>

Product Description: <br><textarea cols="50" rows="4" name="prod_desc" ></textarea><br>
Product Recipe:<br><textarea cols="50" rows="4" name="prod_recip" ></textarea><br>

Price Per Unit: <input type="text" name="prod_price"/><br>
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Submit"/><a href="../admin.php">Return to Admin Home</a>
</form>
