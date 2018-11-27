<?php
	
	session_start();
	include_once "include/class.owned.php";
	include_once "include/class.user.php";
	include_once "include/utils.php";
	include_once "include/class.books.php";

	$user = new User();
	$book = new Book();

	//get session info
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
  	$email = $_SESSION['email'];

	if(!$user->get_session()){
    	header("location:login.php");
  	}
	
	$isbn = $_GET['isbn'];

	//TODO: FIX API Usage when book is not found
	/*$url = 'https://api.isbndb.com/book/'.$isbn;  
 	$restKey = '7P8UAfqbCZ6siLJ8bUYet3pRMdiF6EJq5E5RBtyD';  
 
	$headers = array(  
	   "Content-Type: application/json",  
	   "X-API-Key: " . $restKey  
	);  
	 
	$rest = curl_init();  
	curl_setopt($rest,CURLOPT_URL,$url);  
	curl_setopt($rest,CURLOPT_HTTPHEADER,$headers);  
	curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
	 
	$response = curl_exec($rest);  

	echo $response;

	$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($response, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

	$arr = json_decode($response,true);

	
	curl_close($rest);  */


	$own = new OwnedBooks();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Details</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
	<?php getNavBar($fname,$lname);?>

	<?php 
		echo "<br><br>";
		$book->printBookDetails($isbn);
		echo "<br><br>";
	?>
	<!-- <div class="container">
		<div class="row">
			<div class="col-sm">
				<?php echo "<img class=\"img-fluid\" src=\"".$arr["book"]["image"]."\">" ?>
			</div>
			
		</div>	
	</div>
	<div class="conatiner-fluid">

				<?php echo "<h3 >".$arr["book"]["title"]."</h3>";

				foreach ($jsonIterator as $key => $val) {
				    if(is_array($val)) {
				        echo "<h6>$key:</h6>";
				    } else {
				        echo "<h6>$val</h6>";
				    }
				}

			 ?>
	</div> -->

	<?php $own->printBookOwners($isbn,$email);?>



	
</body>
</html>
