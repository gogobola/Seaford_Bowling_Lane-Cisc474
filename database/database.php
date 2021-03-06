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
			case '"search"':
				$text = $_GET['text'];
				$term = $_GET['searchBy'];
				$table = $_GET['table'];
			
				$dbHandler->searchBy($table, $term, $text);
			break;
			
			default:
				echo "Not recognized function";
	  }
	  
	}
	else if ($verb == "POST") {
      $function = $_GET['func'];
	  
	  $dbHandler = new BowlingConnection();
	  
		$dbHandler->connect();
	//echo $function;
	  switch($function)
	  {
			case '"insert"':
				$table = $_GET['table'];
				
				$columns = $dbHandler->getColumns($table);
				array_splice($columns, 0, 1);
				
				$values = array();
				$values[] = $_POST['name'];
				$values[] = $_POST['address'];
				$values[] = $_POST['city'];
				$values[] = $_POST['id_state'];
				$values[] = $_POST['zip'];
				$values[] = $_POST['phone'];
				$values[] = $_POST['cell'];
				$values[] = $_POST['email'];
				
				$dbHandler->insert($table, $columns, $values);
			break;
			
			case '"edit"':
				$id = $_POST['idCustomer'];
				
				$table = $_GET['table'];
				
				$columns = $dbHandler->getColumns($table);
				array_splice($columns, 0, 1);
				
				$values = array();
				$values[] = $_POST['name'];
				$values[] = $_POST['address'];
				$values[] = $_POST['city'];
				$values[] = $_POST['id_state'];
				$values[] = $_POST['zip'];
				$values[] = $_POST['phone'];
				$values[] = $_POST['cell'];
				$values[] = $_POST['email'];
				
				$columnsCond = array();
				$columnsCond[] = $dbHandler->getIdColumn($table);
	
				$valuesCond = array();
				$valuesCond[] = $id;
				
				session_start();
				
				$_SESSION['status'] = $dbHandler->edit($table, $columns, $values, $columnsCond, $valuesCond);
			break;
			
			case '"del"':
				$id = $_POST['idCustomer'];
				$table = $_GET['table'];
				
				$columns = array();
				$columns[] = $dbHandler->getIdColumn($table);
				
				$values = array();
				$values[] = $id;
				
				session_start();
				
				$_SESSION['status'] = $dbHandler->delete($table, $columns, $values);
			break;
			
			
			default:
				echo "Not recognized function";
	  }

	}
?>