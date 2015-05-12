<?php
	
	include_once("dbConnection.class.php");
	
	$verb = $_SERVER['REQUEST_METHOD'];
	$uri = $_SERVER['REQUEST_URI'];
	
	if ($verb == "GET") {
      $function = $_GET['func'];
	  
	  $dbHandler = new BowlingConnection();
	  
		$dbHandler->connect();
	
	  switch($function)
	  {
			case '"getAllOrders"':
				$dbHandler->getAllOrders();
			break;
			
			case '"getCustomerView"':
				$id = $_GET['id'];
				$dbHandler->getCustomerView($id);
			break;
			
			case '"getOrder"':
				$id = $_GET['id'];
				$dbHandler->getOrder($id);
			break;
			
			case '"getAllBalls"':
				$dbHandler->getAllBalls();
			break;
			
			case '"getBall"':
				$id = $_GET['id'];
				$dbHandler->getBall($id);
			break;
			
			case '"searchOrder"':
				$text = $_GET['text'];
				$term = $_GET['searchBy'];
			
				$dbHandler->searchOrderBy($term, $text);
			break;
			
			default:
				echo "Not recognized function";
	  }
	  
	}
	
?>