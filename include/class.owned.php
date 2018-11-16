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
		public function get_ownedbooks(){
			//TODO Implement
			$library_query = "SELECT title,author,year, b.isbn FROM books b JOIN ownedBooks ob on b.isbn = ob.isbn ";

			$result = $this->db->query($library_query);
			
			if(!$result)
				printError($this->db->error);

			$col = 0;
			echo "<div class=\"container mt-2 mb-2\">";
			while ($row = $result->fetch_array(MYSQLI_NUM)){
				
				if($col === 0){
					echo "<div class=\"row\">";
				}
				echo "<div class=\"col-sm\">";
				echo "<div class=\"card\" style=\"width: 18rem;\">";
				echo "<div class=\"card-body\">";
				echo "<h5 class=\"card-title\">".$row[0]."</h1><br><p class=\"card-text\"> Author: by ".$row[1].
					"</p><br><p class=\"card-text\">Year Published: ".$row[2]."</p><br><p class=\"card-text\"> ISBN: ".$row[3]."</p><br><input type=\"submit\" class=\"btn btn-primary\" value=\"Detail\">";
				echo "</div></div>";
				echo "</div>";
		
				$col += 1;
				if($col === 3){
					$col = 0;
					echo "</div>";
				}
			}
			echo "</div>";
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

