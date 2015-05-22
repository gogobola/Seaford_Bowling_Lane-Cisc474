<?php
	
	include_once("dbConnection.class.php");
	
	$verb = $_SERVER['REQUEST_METHOD'];
	$uri = $_SERVER['REQUEST_URI'];
	//$url_parts = parse_url($uri);
	//$path = $url_parts["path"];
	//$parameters = $url_parts["query"];
	//$prefix = "api";
	//$ind = strpos($path, $prefix);
	//$request = substr($path, $ind + strlen($prefix));
	
	if ($verb == "GET") {
      $function = $_GET['func'];
	  
	  $dbHandler = new BowlingConnection();
	  
		$dbHandler->connect();
	//echo $function;
	  switch($function)
	  {
			case '"getAllCustomers"':
				$dbHandler->getAllCustomers();
			break;
			
			case '"getCustomerView"':
				$id = $_GET['id'];
				$dbHandler->getCustomerView($id);
			break;
			
			case '"getCustomer"':
				$id = $_GET['id'];
				$dbHandler->getCustomer($id);
			break;
			
			case '"getAllStates"':
				$dbHandler->getAllStates();
			break;
			
			case '"searchCustomer"':
				$text = $_GET['text'];
				$term = $_GET['searchBy'];
			
				$dbHandler->searchCustomerBy($term, $text);
			break;
			
			default:
				echo "Not recognized function";
	  }
	  
	}
	
?>