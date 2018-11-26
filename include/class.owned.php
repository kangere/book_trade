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
			
			$library_query = "SELECT title,year, b.isbn FROM books b JOIN ownedBooks ob on b.isbn = ob.isbn WHERE ob.isbn NOT IN (SELECT owned_book FROM requests UNION SELECT req_book FROM requests)";

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
				
				
				echo "<p class=\"card-text\">Year Published: ".$row[1]."</p><br><p class=\"card-text\"> ISBN: ".$row[2]."</p><br><a href=\"details.php?isbn=".$row[2]."\" class=\"btn btn-primary\">Details</a>";
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

		public function printBookOwners($isbn,$email){
			//Do not show books that have been requested
			//treat them as unavailable
			$query = "SELECT email,book_cond FROM ownedBooks WHERE
						isbn='$isbn' AND isbn NOT IN(SELECT owned_book FROM requests) AND email <> '$email' ";

			$result = $this->db->query($query);

			echo "<table class=\"table\"><thead>";
			echo "<tr>";
			echo "<th scope=\"col\">Owner</th>";
			echo "<th scope=\"col\">Condition</th>";
			echo "</tr></thead>";
			echo "<tbody>";

			while($row = $result->fetch_array(MYSQLI_NUM)){
				echo "<tr>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td align=\"center\"><a href=\"request_book.php?isbn=".
					$isbn."&email=".$row[0]."\">Request</a></td>";
				echo "</tr>";

			}

			echo "</tbody></table>";

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

