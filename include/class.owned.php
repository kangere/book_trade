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
			while ($row = $result->fetch_array(MYSQLI_NUM)){
				if($col == 0){
					echo "<tr>";
				}

				echo "<td>","<h1>".$row[0]."</h1>","<br>","by ".$row[1]."<br>".$row[2]."<br>".$row[3]."<br>",'<input type="submit" class="btn btn-primary" value="Detail">'." "."</td>";
				$col++;
			if($col == 3) {
				  echo "</tr>";
				  $col = 0;
				} 
				
			}
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

