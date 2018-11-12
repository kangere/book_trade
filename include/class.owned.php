<?php
	
	include_once "db_config.php";
	include_once "utils.php";

	class OwnedBooks{

		public $db;

		function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if($this->db->connect_errno){
				printError($this->db->connect_errno);
				exit;
			}
		}


		public function insertBook($email,$isbn){

			$insert_sql = "INSERT INTO ownedBooks(email,isbn)
							VALUES ('$email','$isbn')";

			$check = $this->db->query($insert_sql);

			if($check)
				return true;
			else
				return false;
		}

		public function deleteBookOwned($email,$isbn){
			$delete_sql = "DELETE FROM ownedBooks WHERE
							email = '$email' AND isbn = '$isbn'";

			$check = $this->db->query($delete_sql);

			if($check)
				return true;
			else {
				printError($this->db->error);
				return false;
			}
		}

	}

