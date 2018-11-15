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