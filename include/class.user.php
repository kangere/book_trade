<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	include_once "conn.php";
	include_once "utils.php";

	class User extends Connection{

		function __construct(){
			parent::__construct();
		}

		//Registration
		public function reg_user($f_name,$l_name,$email,$password){

			$password = password_hash($password,PASSWORD_DEFAULT);
			
			$sql="SELECT * FROM users WHERE email='$email'";

			$check = $this->db->query($sql);
			
			$count_row = $check->num_rows;

			if($count_row == 0){
				$sql1="INSERT INTO users(f_name,l_name,email,password)
						VALUES ('$f_name','$l_name','$email','$password')";

                $result = $this->db->query($sql1);

                if(!$result)
                	echo $this->db->connect_errno;
                return $result;

			}else{
				return false;
			}
		}

		//login check
		public function check_login($email,$password){

			
			$login_query = "SELECT * from users WHERE email='$email'";

			$result = $this->db->query($login_query);
			
			if(!$result)
				return false;

            $user_data = $result->fetch_array();
            

            if(password_verify($password,$user_data['password'])	){
            	$_SESSION['login'] = true;
            	$_SESSION['email'] = $user_data['email'];
            	$_SESSION['fname'] = $user_data['f_name'];
            	$_SESSION['lname'] = $user_data['l_name'];

            	return true;	
            } else {
            	return false;
            }
		}
		public function changePassword($email,$password,$newpassword){

			
			$login_query = "SELECT * from users WHERE email='$email'";

			$result = $this->db->query($login_query);
			
			if(!$result)
				return false;

            $user_data = $result->fetch_array();
            
			$newpassword = password_hash($newpassword,PASSWORD_DEFAULT);
            if(password_verify($password,$user_data['password'])	){
            	$update = "UPDATE users SET password = '$newpassword' WHERE email = '$email'";

			$result = $this->db->query($update);

			if($result)
				return true;
			else
				return false;

            	return true;	
            } else {
            	return false;
            }
		}
		public function displayUserUpdate($email){

			$sql = "SELECT * FROM users WHERE email = '$email'";

			$result = $this->db->query($sql);

			$row = $result->fetch_array(MYSQLI_NUM);

			echo "<form method=\"post\" action=\"editProfile.php?email=".$row[2]."\">";
			echo "<table class=\"table\">";
			echo"<thead>";		
			echo "<tr>" ;    
			echo "<td>First Name</td>";         
			echo "<td>Last Name</td>";                 
			echo "</tr>";       
			echo "</thead>";     
			echo "<tbody>";

			echo "<td align=\"center\"><input name=\"f_name\" type =\"text\"
					class=\"form-control\" value=\"".$row[0]."\" size=\"25\"/></td>";

			echo "<td align=\"center\"><input name=\"l_name\" type =\"text\"
					class=\"form-control\" value=\"".$row[1]."\" size=\"25\"/></td>";
			

			echo "</tbody></table>";
			echo "<input type=\"submit\" class=\"btn btn-primary\" name=\"update\"/>";
			echo "</form>";      
		}

		public function updateuserInfo($f_name,$l_name,$email){

			$update = "UPDATE users SET f_name = '$f_name',
						l_name='$l_name' WHERE email = '$email'";

			$result = $this->db->query($update);

			if($result)
				return true;
			else
				return false;
		}

		public function get_session(){
			return $_SESSION['login'];
		}

		public function user_logout() {
			$_SESSION['login'] = false;
			session_destroy();
		}
	}
