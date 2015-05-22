<?php
	
	include_once("dbConnection.class.php");
	
	$verb = $_SERVER['REQUEST_METHOD'];
	$uri = $_SERVER['REQUEST_URI'];
	
	if ($verb == "GET") {
      $function = $_GET['func'];
	  
	  $dbHandler = new BowlingConnection();
	  
		$dbHandler->connect();
	//echo $function;
	  switch($function)
	  {
			case '"login"':
				$user = $_GET['user'];
				$pass = $_GET['pass'];
				echo $dbHandler->verifyLogin($user, $pass);
			break;
			
			case '"getUser"':
				$id = $_GET['id'];
				$dbHandler->getUser($id);
			break;
			
			case '"getUserId"':
				$user = $_GET['user'];
				$pass = $_GET['pass'];
				$dbHandler->getUserId($user, $pass);
			break;
			
			
			default:
				echo "Not recognized function";
	  }
	  
	}
	
?>