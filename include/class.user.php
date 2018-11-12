<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	include_once "db_config.php";

	class User{

		public $db;

		function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if($this->db->connect_errno){
				printf("Connect failed:%s\n",$this->db->connect_errno);
				exit;
			}
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

		public function get_session(){
			return $_SESSION['login'];
		}

		public function user_logout() {
			$_SESSION['login'] = false;
			session_destroy();
		}
	}
