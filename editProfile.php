<?php
	session_start();
 	include_once "include/class.user.php";
 	include_once "include/utils.php";

 	$users = new User();
 	if(!$users->get_session()){
    	header("location:login.php");
  	}

 	$email = $_GET['email'];

 	if(isset($_POST['update'])){
 		$f_name = $_POST['f_name'];
 		$l_name = $_POST['l_name'];
 	
 		$result = $users->updateuserInfo($f_name,$l_name,$email);
 		
 		if($result){
 			$_SESSION['fname'] = $f_name;
 			$_SESSION['lname'] = $l_name;
 			header("location:home.php");
 		}
 		else
 			printError("unable to update profile");
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

<?php $users->displayUserUpdate($email);?>

</body>
</html>
