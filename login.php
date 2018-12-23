<?php
	session_start();
	include_once 'include/class.user.php';
    include_once 'include/utils.php';

	$user = new User();

	if(isset($_REQUEST['submit'])){
		extract($_REQUEST);

		$login = $user->check_login($email,$password);

		if($login){
			//Registration Success
			header("location:home.php");
		}else {
			printError('Wrong username or password');
		}
	}
?>

<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}




/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;

}

button:hover {
    opacity:1;
}

h1,h2{
    text-align: center;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .loginbtn, .signupbtn {
       text-align:center;
       margin: 0 auto; 
       width: 180px;
      margin-left: auto;
      margin-right: auto;
    }
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<body>

<script >


    function submitlogin() {
        var form = document.login;
        if(form.email.value == ""){
            alert( "Enter email or username." );
            return false;
        }
        else if(form.password.value == ""){
            alert( "Enter password." );
            return false;
        }

    }


</script>


<form action = ""
          method = "post" name="login">
  <div class="container">
    <h1> Bookstore </h1>
    
    <h1>Log In</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
  
    
    <input class ="btn btn-primary" onclick="return(submitlogin());" type="submit" name="submit" value="Login"/>
   
    
    <a href="registration.php" class ="btn btn-primary">Register new user</a>
  </div>
</form>

<br><br>
<!-- <a href="help_doc.html" class="btn btn-link" >Help </a>
<a href="https://docs.google.com/document/d/1Sc8L4olsGSvTdXg5Ou3U9wEW8ZRyUn0QAzxxkBSFjDU/edit?usp=sharing" class="btn btn-link" >Technical Documentation </a>
<a href="https://docs.google.com/document/d/1ccySpZeybLTTJ5EoUl1fEDnuZdLZR0iyueQir1K5C0w/edit?usp=sharing" class="btn btn-link" >Report</a> -->
</body>
</html>