<?php
class Emailer {
	function send($recipient, $subject, $sender, $template, $fields) {
		if ($message = file_get_contents($template, 1)) {
			$message = $this->personalizeMessage($message, $fields);
			return $this->sendMail($recipient, $subject, $sender, $message);
		} else {
			print "<p class=\"error\">Couldn't open email template '$template'</p>";
			return false;
		}
	}
	function personalizeMessage($message,$fields) {
		foreach ($fields as $key=>$value) {
			// Allow $ in comments.
			$value = preg_replace("!" . '\x24' . "!" , '\\\$' , $value); 
			$message = preg_replace("/\[$key\]/",$value,$message);
		}
		if (get_magic_quotes_gpc()==1) {
			$message = stripslashes($message);
		}
		return $message;
	}
	function sendMail($recipient, $subject, $sender, $message) {
		if (mail($recipient, $subject, $message, $this->makeFromHeader($sender))) {
			return true;
		} else { 
			return false;
		}
	}
	function makeFromHeader($sender) {
		return "From: " . $sender . "\r\n";
	}
}

