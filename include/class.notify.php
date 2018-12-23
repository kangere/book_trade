<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once 'PHPMailer/src/Exception.php';
	require_once 'PHPMailer/src/PHPMailer.php';
	require_once 'PHPMailer/src/SMTP.php';
	require_once 'utils.php';

	class Notify {

		private static $instance = null;

		private $mail;

		function __construct(){
			
			$this->mail  = new PHPMailer(true);

			$this->mail->IsSMTP();
			$this->mail->Host = "smtp.gmail.com";

			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$this->mail->SMTPDebug = 2;
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$this->mail->Port = 587;
			//Set the encryption system to use - ssl (deprecated) or tls
			$this->mail->SMTPSecure = 'tls';
			// optional
			// used only when SMTP requires authentication  
			$this->mail->SMTPAuth = true;
			$this->mail->Username = 'booktrade.kenya@gmail.com';
			$this->mail->Password = 'bookTrade321*';
		}


		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new Notify();
			}

			return self::$instance;
		}


		public function notifyUser($email,$subject,$body){
			
			try{
				/* Set the mail sender. */
			   $this->mail->setFrom('booktrade.kenya@gmail.com', 'Book Trade');

			   /* Add a recipient. */
			   $this->mail->addAddress($email);

			   /* Set the subject. */
			   $this->mail->Subject = $subject;

			   /* Set the mail message body. */
			   $this->mail->Body = $body;

			   /* Finally send the mail. */
			   $this->mail->send();

			} catch(Exception $e){
				printWarning("Message could not be sent.Mailed Error:". $this->mail->ErrorInfo);
			}
		}


	}
?>