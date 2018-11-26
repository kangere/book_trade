<?php
	
	include_once "utils.php";

	class Requests extends Connection{

		function __construct(){
			parent::__construct();
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
				echo "<td>".$row[1]."</td>";
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

		//prints requests that user with email parameter has requested
		public function printMyRequests($email){

			$query = "SELECT * FROM requests WHERE req_email = '$email'";

			$request = $this->db->query($query);

			echo "<h4>My Requests</h4>";
			echo "<table class=\"class\"><thead>";
			echo "<tr>";
			echo "<th>Owner<th>";
			echo "<th>Book<th>";
			echo "<th>Exchange Book<th>";
			echo "</tr></thead><tbody>";

			while ($row = $result->fetch_array(MYSQLI_NUM)){
				
				echo "<tr>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[4]."</td>";
				echo "</tr>";
			}
			echo "</tbody></table>";

		}

		//prints requests made for users books
		public function printUserRequests($email){

			$query = "SELECT * FROM requests WHERE owner_email = '$email'";

			$request = $this->db->query($query);

			echo "<h4>Users Requests</h4>";
			echo "<table class=\"class\"><thead>";
			echo "<tr>";
			echo "<th>Requester<th>";
			echo "<th>My Book<th>";
			echo "<th>Book Offered<th>";
			echo "</tr></thead><tbody>";

			while ($row = $result->fetch_array(MYSQLI_NUM)){
				
				echo "<tr>";
				echo "<td>".$row[3]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[4]."</td>";
				echo "<td><a href=\"request_book.php?status=accept\">Accept</a></td>";
				echo "<td><a href=\"request_book.php?status=reject\">Decline</a></td>";
				echo "</tr>";
			}
			echo "</tbody></table>";

		}

	}