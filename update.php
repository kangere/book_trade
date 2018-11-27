<?php
	session_start();
	include_once 'include/class.user.php';
 	include_once "include/class.books.php";

 	$books = new Book();
 	$user = new User();
 	
 	if(!$user->get_session()){
    	header("location:login.php");
  	}

 	$isbn = $_GET['isbn'];

 	if(isset($_POST['update'])){
 		$title = $_POST['title'];
 		$author = $_POST['author'];
 		$year = $_POST['year'];

 		
 		$books->updateBookInfo($title,$author,$year,$isbn);

 		header("location:home.php");
 	}


 	

 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="	sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

<script src="main.js">
</script>

<?php $books->displayBookUpdate($isbn);?>

</body>
</html>
