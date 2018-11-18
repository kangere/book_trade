<?php
	
	include_once 'conn.php';
	include_once 'utils.php';


	class Authors extends Connection 
	{

		function __construct(){
			parent::__construct();
		}


		public function insert($name,$isbn){

			$query = "INSERT INTO authors(name,isbn) VALUES('$name','$isbn')";

			$check = $this->db->query($query);

			if($check)
				printError("unable to insert author".$name);
			else
				printSuccess("Inserted author: ".$name);
		}


		public function getAuthors($isbn){
			$query = "SELECT name FROM authors WHERE isbn = '$isbn'";

			$result = $this->db->query($query);

			if(!$result)
				printError($this->db->error);

			return $result->fetch_all();
		}


	}