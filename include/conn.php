<?php
	
	include_once "db_config.php";

	
	class Connection
	{
		protected $db;
		
		function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if($this->db->connect_errno){
				printError($this->db->connect_errno);
				exit;
			}
		}
	}

?>