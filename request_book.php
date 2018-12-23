<?php
	session_start();
	include_once 'include/class.user.php';
	include_once 'include/class.request.php';
	include_once 'include/class.notify.php';
	include_once 'include/class.books.php';

	$user = new User();
	if(!$user->get_session()){
   		 header("location:login.php");
  	}

  	$req = new Requests();
  	$book = new Book();

  	$req_email = $_SESSION['email'];
	$owner_email = $_GET['email'];
	$book_requested = $_GET['isbn'];


	if(isset($_GET['ex_book'])){

		$ex_book = $_GET['ex_book'];

		$req->addRequest($owner_email,$book_requested,$req_email,$ex_book);

		$notify = new Notify();
		
		$owned_book = $book->getBookTitle($book_requested);
		$exchange_book = $book->getBookTitle($ex_book);

		$receiver_message = "User with email: ".$req_email." Has requested to trade your book: ".$owned_book." with the book: ".$exchange_book.", Log in to Book-Trade to Accept or Decline Trade Request.";

		$requester_message = "Your request for book: ".$owned_book." In exchange for book: ".$exchange_book." has been sent.";

		$notify->notifyUser($owner_email,"Request",$receiver_message);

		$notify->notifyUser($req_email,"Request Sent",$requester_message);

		header("location:Store.php");
	}


	$req->printBookRequests($req_email,$owner_email,$book_requested);
?>

