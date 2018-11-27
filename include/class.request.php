<?php
	
	include_once "utils.php";
	include_once "class.books.php";


	class Requests extends Connection{

		protected $book;

		function __construct(){
			parent::__construct();
			$this->book = new Book();
		}


		public function deleteRequest($email,$isbn){
			$query = "DELETE FROM requests 	WHERE owner_email = '$email' AND owned_book = '$isbn'";

			$result = $this->db->query($query);

			if($result)
				printSuccess("Request Deleted");
			else
				printError("Unable to delete request");

		}


		public function printBookRequests($email,$owner_email,$book_req){
			

			$library_query = "SELECT title, b.isbn FROM books b JOIN ownedBooks ob on b.isbn = ob.isbn where ob.email = '$email' AND ('$email',ob.isbn) NOT IN(SELECT req_email,req_book FROM requests)";

			$result = $this->db->query($library_query);

			if(!$result)
				printError($this->db->error);

			echo "<h4>Choose book to exchange</h4>";
			echo "<table class=\"class\"><thead>";
			echo "<tr>";
			echo "<th>Title<th>";
			echo "<th >ISBN<th>";
			echo "</tr></thead><tbody>";
			while ($row = $result->fetch_array(MYSQLI_NUM)){
				
				echo "<tr>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$this->book->getBookTitle($row[1])."</td>";
				echo "<td align=\"center\"><a href=\"request_book.php?isbn=".$book_req."&email=".$owner_email."&ex_book=".
					$row[1]."\">Trade</a></td>";
				echo "</tr>";
			}
			echo "</tbody></table>";
		}

		public function addRequest($owner,$owned_book,$requester,$ex_book){
			$req_query = "INSERT INTO requests(owner_email,owned_book,req_email,req_book) VALUES ('$owner','$owned_book','$requester','$ex_book')";

			$result = $this->db->query($req_query);

			if($result)
				printSuccess("Request Sent");
			else
				printError("Unable to send request");
		}

		//prints books that user  has requested
		public function printMyRequests($email){

			$query = "SELECT * FROM requests WHERE req_email = '$email'";

			$result = $this->db->query($query);

			if(!$result)
				printError($this->db->error);

			echo "<h4>My Requests</h4>";
			echo "<table class=\"table\"><thead class=\"thead-dark\">";
			echo "<tr>";
			echo "<th>Owner</th>";
			echo "<th>Book</th>";
			echo "<th>Exchange Book</th>";
			echo "</tr></thead><tbody>";

			while ($row = $result->fetch_array(MYSQLI_NUM)){
				
				echo "<tr>";
				echo "<td >".$row[1]."</td>";
				echo "<td >".$this->book->getBookTitle($row[2])."</td>";
				echo "<td >".$this->book->getBookTitle($row[4])."</td>";
				echo "</tr>";
			}
			echo "</tbody></table>";

		}

		//prints requests that have been made to a particular user
		public function printUserRequests($email){

			$query = "SELECT * FROM requests WHERE owner_email = '$email'";

			$result = $this->db->query($query);

			if(!$result)
				printError($this->db->error);

			echo "<h4>Users Requests</h4>";
			echo "<table class=\"table\"><thead class=\"thead-dark\">";
			echo "<tr>";
			echo "<th>Requester</th>";
			echo "<th>My Book</th>";
			echo "<th>Book Offered</th>";
			echo "</tr></thead><tbody>";

			while ($row = $result->fetch_array(MYSQLI_NUM)){
				
				echo "<tr>";
				echo "<td>".$row[3]."</td>";
				echo "<td>".$this->book->getBookTitle($row[2])."</td>";
				echo "<td>".$this->book->getBookTitle($row[4])."</td>";
				echo "<td><a href=\"requests.php?status=accept&b_isbn=".$row[2]."&t_isbn=".$row[4]."&r_email=".$row[3]."\">Accept</a></td>";
				echo "<td><a href=\"requests.php?status=reject&b_isbn=".$row[2]."\">Decline</a></td>";
				echo "</tr>";
			}
			echo "</tbody></table>";

		}

	}