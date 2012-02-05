<?php

	$ref=$_SERVER['HTTP_REFERER'];
	if(strpos($ref,'partyRequest.htm')){
		$strMail=$_GET['chk0'].'<br>'.$_GET['chk1'].'<br>'.$_GET['chk2'].'<br><br>'.$_GET['txt0'].'<br>'.$_GET['txt1'].'<br>'.$_GET['txt2'].'<br>'.$_GET['txt3'].'<br>'.$_GET['txt4'];

		require("class.phpmailer.php");

		$mail = new PHPMailer();
		
		$mail->isHTML(true);
		
		//$mail->IsSMTP();  // telling the class to use SMTP   
		//$mail->Host     = "smtpout.secureserver.net"; // SMTP server   
		
		$mail->From = "sandy@davisanddavisonline.com";
		$mail->FromName = "Form Submit";
		$mail->AddAddress("sandy@davisanddavisonline.com");
		$mail->AddCC("ken@davisanddavisonline.com");
		
		$mail->Subject  = "D&D Party Info Request - Form Submit";
		
		$body=$strMail;
		
		$mail->Body = $body;
		
		if(!$mail->Send()) {   
		  echo 'Problem Sending Data at this time.  Please email sandy@davisanddavisonline.com for assistance.';   
		  echo 'Mailer error: ' . $mail->ErrorInfo;   
		} else {
		  echo 'Message has been sent. Thank you!';
		  echo '<p>Click <a href="start.htm">HERE</a> to continue.</p>';
		}
	}else{
		echo('Sorry. Nothing here.');
	}


?>