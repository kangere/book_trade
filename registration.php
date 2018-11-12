<?php
	include_once 'include/class.user.php';
    include_once 'include/utils.php';

	$user = new User();

	if(isset($_REQUEST['submit'])){
		extract($_REQUEST);

		$register = $user->reg_user($fname,$lname,$email,$password);
		

		if($register){
			printSuccess("Regstration successful");
            header("location:login.php");
		} else {
			echo 'Registration failed. Email or Username already exists please try again';
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
	 function submitreg() {
		 var form = document.reg;
		 if(form.email.value == ""){
		 alert( "Enter email" );
		 return false;

	 	} else if(form.fname.value == ""){
		 alert( "Enter first name" );
		 return false;

	 	} else if(form.lname.value == ""){
			 alert( "Enter last name" );
			 return false;

		 } else if(form.password.value == ""){

		 alert( "Enter password" );
		 return false;

 		}

 	}

</script>

<form action = ""
          method = "POST" name="reg">
  <div class="container">
    <h1> Ethio-Kenya Bookstore </h1>
    <h2>Sign Up</h2>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label for="loginEmail"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="firstName"><b>First Name</b></label>
    <input type="text" placeholder="Enter first Name" name="fname" required>

    <label for="lastName"><b>Last Name</b></label>
    <input type="text" placeholder="Enter flast Name" name="lname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    
    <div class="clearfix">
      <input onclick="return(submitreg());" type="submit" name="submit" value ="Register" class="signupbtn"/>
    </div>  

    
  </div>
</form>



</body>
</html>
