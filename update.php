<?php
 	include_once "include/class.books.php";

 	$books = new Book();

 	$isbn = $_GET['isbn'];

 	if(isset($_POST['update'])){
 		$title = $_POST['title'];
 		$author = $_POST['author'];
 		$year = $_POST['year'];

 		$books->updateBookInfo($title,$author,$year,$isbn);

 		header("location:home.php");
 	}


 	$books->displayBookUpdate($isbn);

 ?>