<?php

	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	include_once "db_config.php";
	include_once "class.owned.php";
	include_once "utils.php";

	class Book{

		public $db;

		function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if($this->db->connect_errno){
				printf("Connect failed:%s\n",$this->db->connect_errno);
				exit;
			}

		}

		public function displayBookUpdate($isbn){

			$sql = "SELECT * FROM books WHERE ISBN = '$isbn'";

			$result = $this->db->query($sql);

			$row = $result->fetch_array(MYSQLI_NUM);

			echo "<form method=\"post\" action=\"update.php?isbn=".$row[3]."\">";
			echo "<table class=\"table\">";
			echo"<thead>";		
			echo "<tr>" ;    
			echo "<td>Title</td>";         
			echo "<td>Author</td>";         
			echo "<td>Year</td>" ;        
			echo "<td>ISBN</td>";         
			echo "</tr>";       
			echo "</thead>";     
			echo "<tbody>";

			echo "<td align=\"center\"><input name=\"title\" type =\"text\"
					class=\"form-control\" value=\"".$row[0]."\" size=\"25\"/></td>";
			echo "<td align=\"center\"><input name=\"author\" type =\"text\"
					class=\"form-control\" value=\"".$row[1]."\" size=\"25\"/></td>";
			echo "<td align=\"center\"><input name=\"year\" type =\"text\"
					class=\"form-control\" value=".$row[2]." size=\"25\"/></td>";
			echo "<td align=\"center\">".$row[3]."</td>";

			echo "</tbody></table>";
			echo "<input type=\"submit\" class=\"btn btn-primary\" name=\"update\"/>";
			echo "</form>";      
		}
		//checks if book already exists
		public function exists($isbn){
			$sql = "SELECT * FROM books WHERE ISBN = '$isbn'";

			$check = $this->db->query($sql);

			if($check->num_rows > 0){
				return true;
			}else{
				return false;
			}
		}

		//Insert new book
		public function insert_book($email,$title,$author,$year,$isbn){

			if(!$this->exists($isbn)){
				$insert_sql = "INSERT INTO books(title,author,year,isbn)
						VALUES ('$title','$author','$year','$isbn')";

				$result = $this->db->query($insert_sql);

				if(!$result)
					printError($this->db->error);

			}

			$ownedTable = new OwnedBooks();

			$o_inserted = $ownedTable->insertBook($email,$isbn);


			if($o_inserted){
				return true;
			} else {
				return false;
			}

	
		}

		public function get_user_library($email){
			
			$library_query = "SELECT title,author,year, b.isbn FROM books b JOIN ownedBooks ob on b.isbn = ob.isbn where ob.email = '$email'";

			$result = $this->db->query($library_query);

			if(!$result)
				printError($this->db->error);

			while ($row = $result->fetch_array(MYSQLI_NUM)){
				echo "<tr>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				echo "<td align=\"center\"><a href=\"update.php?isbn=".
					$row[3]."\">Update</a></td>";	
				echo "</tr>";
			}
		}

		public function updateBookInfo($title,$author,$year,$isbn){

			$update = "UPDATE books SET title ='$title', author = '$author',
						year='$year' WHERE ISBN = '$isbn'";

			$result = $this->db->query($update);

			if($result)
				printSuccess("Book ".$isbn." updated");
			else
				printError("Unable to update book: ".$isbn);
		}

		
	}