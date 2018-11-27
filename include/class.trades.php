<?php 
	
	include_once "utils.php";
	include_once "class.books.php";

	class Trades extends Connection{

		protected $book;

		function __construct(){
			parent::__construct();

			$this->book = new Book();
		}


		public function insertTrade($o_email,$o_isbn,$r_email, $r_isbn){

			$query = "INSERT INTO trades(owner_email,owned_book,requester_email,requester_book)
						VALUES ('$o_email','$o_isbn','$r_email','$r_isbn')";

			$result = $this->db->query($query);

			if($result)
				printSuccess("Trade Recorded");
			else
				printError("Unable to record trade");

		}

		public function printUserTrades($email){

			$query = "SELECT * FROM trades WHERE owner_email='$email' OR requester_email='$email'";

			$result = $this->db->query($query);

			if(!$result)
				printError("Unable to load trades");

			echo "<table class=\"table\"><thead>";
			echo "<tr>";
			echo "<th> Owner email</th>";
			echo "<th> Book</th>";
			echo "<th> Requester email</th>";
			echo "<th> Requester book</th>";
			echo "</tr></thead><tbody>";

			while ($row = $result->fetch_array(MYSQLI_NUM)){
				
				echo "<tr>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$this->book->getBookTitle($row[2])."</td>";
				echo "<td>".$row[3]."</td>";
				echo "<td>".$this->book->getBookTitle($row[4])."</td>";
				echo "</tr>";
			}
			echo "</tbody></table>";

		}

	}

?>