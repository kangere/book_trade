<?php


	
	include_once "utils.php";
	include_once "conn.php";
	include_once "class.authors.php";

	class OwnedBooks extends Connection{

		function __construct(){
			parent::__construct();
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
			
			$library_query = "SELECT title,year, b.isbn FROM books b JOIN ownedBooks ob on b.isbn = ob.isbn ";

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
				echo "<h5 class=\"card-title\">".$row[0]."</h1>";

				$auth = new Authors();
				$authors = $auth->getAuthors($row[2]);

				foreach($authors as $value){
					echo "<br><p class=\"card-text\"> Author: ".$value[0].
					"</p><br>";	
				}
				
				
				echo "<p class=\"card-text\">Year Published: ".$row[1]."</p><br><p class=\"card-text\"> ISBN: ".$row[2]."</p><br><input type=\"submit\" class=\"btn btn-primary\" value=\"Detail\">";
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

