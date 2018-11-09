<?php
	include_once "db_config.php";

	class User{

		public $db;

		public function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if(mysqli_connect_errno()){
				echo "Error: could not connect to database";
				exit;
			}
		}

		//Registration
		public function reg_user($f_name,$l_name,$password,$email){

			$password = md5($password);
			$sql="SELECT * FROM users WHERE email='$email'";

			$check = this->db->query($sql);
			$count_row = $check->num_rows;

			if($count_row == 0){
				$sql1="INSERT INTO users SET f_name='$f_name', l_name='$l_name', email='$email', password='$password'";
29
                $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
30
                return $result;

			}else{
				return false;
			}
		}

		public function check_login($email,$password){

			$password = md5($password);
			$login_query = "SELECT email from users WHERE email='$email'  and password='$password'";

			 $result = mysqli_query($this->db,$login_query);
            $user_data = mysqli_fetch_array($result);
            $count_row = $result->num_rows;

            if($count_row == 1){
            	$_SESSION['login'] = true;
            	$_SESSION['email'] = $user_data['email'];
            	$_SESSION['fname'] = $user_data['f_name'];
            	$_SESSION['lname'] = $user_data['l_name'];

            	return true;	
            } else {
            	return false;
            }
		}

		public function get_session(){
			return $_SESSION['login'];
		}

		publi function user_logout() {
			$_SESSION['login'] = false;
			session_destroy();
		}
	}
?>