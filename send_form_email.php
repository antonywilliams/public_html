<?php
if(isset($_POST['email'])) {
	
	// EDIT THE 2 LINES BELOW AS REQUIRED
	$email_to = "antony@antonywilliams.com";
	$email_subject = "AW.com Contact Form";
	
	
	function died($error) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form you submitted. ";
		echo "These errors appear below:<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['first_name']) ||
		!isset($_POST['last_name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');		
	}
	
	$first_name = $_POST['first_name']; // required
	$last_name = $_POST['last_name']; // required
	$email_from = $_POST['email']; // required
	$comments = $_POST['comments']; // required
	
	$error_comments = "";
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
  if(!eregi($email_exp,$email_from)) {
  	$error_comments .= 'The email address you entered does not appear to be valid.<br />';
  }
	$string_exp = "^[a-z .'-]+$";
  if(!eregi($string_exp,$first_name)) {
  	$error_comments .= 'The first name you entered does not appear to be valid.<br />';
  }
  if(!eregi($string_exp,$last_name)) {
  	$error_comments .= 'The last name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
  	$error_comments .= 'You did not include a message.<br />';
  }
  if(strlen($error_comments) > 0) {
  	died($error_comments);
  }
	$email_comments = "Form details below.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_comments .= "First Name: ".clean_string($first_name)."\n";
	$email_comments .= "Last Name: ".clean_string($last_name)."\n";
	$email_comments .= "Email: ".clean_string($email_from)."\n";
	$email_comments .= "Comments: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_comments, $headers);  
?>

<!-- include your own success html here -->

Thanks, I'll try to reply within 24 hours.

<?
}
?>

