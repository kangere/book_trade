<?php

	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	
	include_once "class.owned.php";
	include_once "utils.php";
	include_once "class.authors.php";
	include_once "conn.php";

	class Book extends Connection{

		function __construct(){
			parent::__construct();
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
				$insert_sql = "INSERT INTO books(title,year,isbn)
						VALUES ('$title','$year','$isbn')";

				$result = $this->db->query($insert_sql);

				if(!$result)
					printError($this->db->error);

				$auth = new Authors();

				foreach($author as $key=>$value){
					$auth->insert($value,$isbn);
				}
			}

			$ownedTable = new OwnedBooks();

			$o_inserted = $ownedTable->insertBook($email,$isbn);


			if($o_inserted){
				return true;
			} else {
				return false;
			}

	
		}

		public function displayBookUpdate($isbn){

			$auth = new Authors();

			$authors = $auth->getAuthors($isbn);

			$sql = "SELECT * FROM books WHERE ISBN = '$isbn'";

			$result = $this->db->query($sql);

			$row = $result->fetch_array(MYSQLI_NUM);

			echo "<form method=\"post\" action=\"update.php?isbn=".$row[2]."\">";
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

			echo "<td align=\"center\">";
			echo "<div class =\"form-group\" id=\"author\">";
			foreach($authors as $value){
				echo "<div class=\"entry input-group col-xs-3\"><input name=\"author[0]\" type =\"text\"
					class=\"form-control\" value=\"".$value[0]."\" size=\"25\"/><span class=\"input-group-btn\">
                            <button class=\"btn btn-success btn-add\" type=\"button\" onclick=\"addAuthor()\">
                                +
                            </button>
                        </span></div>";	
			}

			echo "</div></td>";
			


			echo "<td align=\"center\"><input name=\"year\" type =\"text\"
					class=\"form-control\" value=".$row[1]." size=\"25\"/></td>";
			echo "<td align=\"center\">".$row[2]."</td>";

			echo "</tbody></table>";
			echo "<input type=\"submit\" class=\"btn btn-primary\" name=\"update\"/>";
			echo "</form>";      
		}

		

		public function get_user_library($email){
		
			$library_query = "SELECT title,year, b.isbn FROM books b JOIN ownedBooks ob on b.isbn = ob.isbn where ob.email = '$email'";

			$result = $this->db->query($library_query);

			if(!$result)
				printError($this->db->error);

			$auth = new Authors();

			while ($row = $result->fetch_array(MYSQLI_NUM)){
				$authors = $auth->getAuthors($row[2]);

				echo "<tr>";
				echo "<td>".$row[0]."</td>";
				
				//TODO: print all authors
				echo "<td>";
				foreach($authors as $value){
					echo $value[0]."<br>";
				}
				echo "</td>";


				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td align=\"center\"><a href=\"update.php?isbn=".
					$row[2]."\">Update</a></td>";
				echo "</tr>";
			}
		}
		public function search($finder){

		$library_query = "SELECT * FROM books WHERE title LIKE '%".$finder."%'";

			$result = $this->db->query($library_query);

			if(!$result)
				printError($this->db->error);

			$auth = new Authors();

			while ($row = $result->fetch_array(MYSQLI_NUM)){
				$authors = $auth->getAuthors($row[2]);

				echo "<tr>";
				echo "<td>".$row[0]."</td>";
				
				//TODO: print all authors
				echo "<td>";
				foreach($authors as $value){
					echo $value[0]."<br>";
				}
				echo "</td>";


				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
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