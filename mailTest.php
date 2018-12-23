<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once 'include/PHPMailer/src/Exception.php';
	require_once 'include/PHPMailer/src/PHPMailer.php';
	require_once 'include/PHPMailer/src/SMTP.php';

	$mail = new PHPMailer(true);

	try{
		
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		// optional
		// used only when SMTP requires authentication  
		$mail->SMTPAuth = true;
		$mail->Username = 'booktrade.kenya@gmail.com';
		$mail->Password = 'bookTrade321*';
		
		/* Set the mail sender. */
	   $mail->setFrom('booktrade.kenya@gmail.com', 'Book Trade');

	   /* Add a recipient. */
	   $mail->addAddress('kangere721@gmail.com', 'Paul');

	   /* Set the subject. */
	   $mail->Subject = 'Test';

	   /* Set the mail message body. */
	   $mail->Body = 'This is a test email from the book trade email';

	   /* Finally send the mail. */
	   $mail->send();
	}catch(Exception $e){
		echo "Message could not be sent.Mailed Error:". $mail->ErrorInfo;
	}
?>