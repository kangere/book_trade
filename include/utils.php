<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	function printError($message){
		echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Error!</strong>". $message . "</div>";
	}


	function printSuccess($message){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Success!</strong>". $message . "</div>";
	}

	function printWarning($message){
		echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Warning!</strong>". $message . "</div>";
	}

	function getNavBar($fname,$lname,$email){
		echo "<nav class=\"navbar navbar-expand-lg navbar-light  justify-content-between\" style=\"background-color: #e3f2fd;\">
		  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
		    <span class=\"navbar-toggler-icon\"></span>
		  </button>
		  <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
		    <ul class=\"navbar-nav\">
		      <li class=\"nav-item\">
		        <a class=\"nav-link\" href=\"home.php\">My Library</a>
		      </li>
		      <li>
		        <a class=\"nav-link\" href=\"Store.php\">Book Store <span class=\"sr-only\">(current)</span></a>
		      </li>
		      <li class=\"nav-item\">
		        <a class=\"nav-link\" href=\"requests.php\">My Requests</a>
		      </li>
		      <li class=\"nav-item\">
		        <a class=\"nav-link\" href=\"trades.php\">My Transactions</a>
		      </li>
		    </ul>
		    <form action=\"search-form.php\" class=\"form-inline my-2 my-lg-0\">
      			<input class=\"form-control mr-sm-2\" type=\"text\" name=\"title\"placeholder=\"Search By Title\" aria-label=\"Search\">
      			<button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">Search</button>
    		</form>
		  </div>

		  <li class=\"nav-item dropdown\">
		        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		          ".$fname." ".$lname."
		        </a>
				<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
		          	<a class=\"dropdown-item\" href=\"editProfile.php?email=".$email."\">Edit Profile</a>
		          	<a class=\"dropdown-item\" href=\"changepassword.php?email=".$email."\">Change Password</a>
		          	<div class=\"dropdown-divider\"></div>
		          	<a class=\"dropdown-item\" href=\"home.php?q=logout\">Logout</a>
		        </div>
       	</li>
		  
		  </nav>";
	}


	//FIXME
	function build_table($array){
		if(count($array) < 1)
			return "<h1> No books added yet </h1>";


		$html = '<table class="table">';

		//header row
		$html .= '<thead>';
		$html .= '<tr>';
		foreach($array as $value){
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    	$html .= '</tr>';
    	$html .= '</thead>';

    	$html .= '<tbody>';

    	// data rows
	    foreach( $array as $key=>$value){
	        $html .= '<tr>';
	        foreach($value as $key2=>$value2){
	            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
	        }
	        $html .= '</tr>';
	    }

	    $html .= '</tbody>';
	    // finish table and return it

	    $html .= '</table>';
	    return $html;
	}