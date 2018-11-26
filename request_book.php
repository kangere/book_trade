<?php
	session_start();
	include_once 'include/class.user.php';
	include_once 'include/class.request.php';

	$user = new User();
	if(!$user->get_session()){
   		 header("location:login.php");
  	}

  	$req = new Requests();

  	$req_email = $_SESSION['email'];
	$owner_email = $_GET['email'];
	$book_requested = $_GET['isbn'];


	if(isset($_GET['ex_book'])){

		$ex_book = $_GET['ex_book'];

		$req->addRequest($owner_email,$book_requested,$req_email,$ex_book);
		header("location:Store.php");
	}


	$req->printBookRequests($req_email,$owner_email,$book_requested);
?>

