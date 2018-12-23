<?php
	session_start();
	include_once 'include/class.user.php';
	include_once 'include/class.request.php';
	include_once 'include/class.owned.php';
	include_once 'include/class.trades.php';
	include_once 'include/class.books.php';
	include_once 'include/class.notify.php';
	include_once 'include/utils.php';


	 $user = new User();
	 if(!$user->get_session()){
	    header("location:login.php");
	 }

	 $req = new Requests();
	 $own = new OwnedBooks();
	 $book = new Book();
	 $notify = new Notify();


	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
  	$email = $_SESSION['email'];

  

  	if(isset($_GET['status'])){


  		$status = $_GET['status'];
  		$b_isbn = $_GET['b_isbn'];
  		$book_to_trade = $_GET['t_isbn'];
  		$requester_email = $_GET['r_email'];

  		

  		$owned_book = $book->getBookTitle($b_isbn);
		$exchange_book = $book->getBookTitle($book_to_trade);


  		$req->deleteRequest($email,$b_isbn);

  		if($status === "accept"){
  			$trade = new Trades();
  			
  			$owned_message = "You just accepted to trade your book ".$owned_book." In exchange for the book ".$exchange_book;

  			$req_message = "Your request to trade book ".$exchange_book." In exchange for the book ".$owned_book." was accepted by the owner";

  			$notify->notifyUser($email,"Trade Accepted",$owned_message);
  			$notify->notifyUser($requester_email,"Trade Accepted",$req_message); 

  			$own->deleteBookOwned($email,$b_isbn);
  			$own->deleteBookOwned($requester_email,$book_to_trade);

  			$trade->insertTrade($email,$b_isbn,$requester_email,$book_to_trade);


  		} else if($status === "reject"){

  			$owned_message = "You just rejected to trade your book ".$owned_book." In exchange for the book ".$exchange_book;

  			$req_message = "Your request to trade book ".$exchange_book." In exchange for the book ".$owned_book." was rejected by the owner";

  			$notify->notifyUser($email,"Trade Rejected",$owned_message);
  			$notify->notifyUser($requester_email,"Trade Rejected",$req_message);

  		}	
  	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Requests</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<?php getNavBar($fname,$lname,$email) ?>
</head>
<body>
	<?php 

		$req->printUserRequests($email);
		
		echo "<br><br>";	
		$req->printMyRequests($email);

	?>
</body>
</html>