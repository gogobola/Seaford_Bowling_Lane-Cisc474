<?php
	
	include_once("dbConnection.class.php");
	
	$verb = $_SERVER['REQUEST_METHOD'];
	$uri = $_SERVER['REQUEST_URI'];

    //echo '<br>' . $verb;
    //echo '<br>' . $uri;
    
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
				$id2 = $_GET['id2'];
				$dbHandler->getOrder($id,$id2);
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
              /*
              case '"insert"':
                  $table = $_GET['table'];
                  $columns = $dbHandler->getColumns($table);
                    echo "<br> BEFORE <br><br>";
                    var_dump($columns);
                    echo "<br> AFTER <br><br>";
                  array_splice($columns, 0, 1);
                    var_dump($columns);
              break;
			*/
			default:
				echo "Not recognized function";
	  }
	  
	}
	else if ($verb == "POST") {
        $function = $_GET['func'];

        $dbHandler = new BowlingConnection();
	  
		$dbHandler->connect();
		switch ($function) {
			case '"insert"':
				$table = $_GET['table'];
				$columns = $dbHandler->getColumns($table);
				array_splice($columns, 0, 1);
				
                
				$values = array();
				$values[] = $_POST['hand'];
				$values[] = $_POST['conv'];
				$values[] = $_POST['ft'];
				$values[] = $_POST['pin'];
				$values[] = $_POST['weight'];
				$values[] = $_POST['layout'];
				$values[] = $_POST['surface'];
				$values[] = $_POST['bh_position'];
				$values[] = $_POST['size'];
                $values[] = $_POST['depth'];
				$values[] = $_POST['pap_horizontal'];
				$values[] = $_POST['pap_updown'];
				$values[] = $_POST['offset_thumb'];
				$values[] = $_POST['thumb_style'];
				$values[] = $_POST['fingers_style'];
				$values[] = $_POST['lf_measure'];
				$values[] = $_POST['la_style'];
				$values[] = $_POST['la_arrow'];
				$values[] = $_POST['lf_oval'];
				$values[] = $_POST['rf_measure'];
				$values[] = $_POST['ra_style'];
				$values[] = $_POST['ra_arrow'];
				$values[] = $_POST['rf_oval'];
				$values[] = $_POST['th_measure'];
				$values[] = $_POST['th_style'];
				$values[] = $_POST['th_arrow'];
				$values[] = $_POST['th_oval'];
				$values[] = $_POST['ff_sep'];
				$values[] = $_POST['lt_sep'];
				$values[] = $_POST['rt_sep'];

                 
               


				$dbHandler->insert($table, $columns, $values);
				break;
			case '"insertOrder"':
				$table = $_GET['table'];
				$columns = $dbHandler->getColumns($table);
				//array_splice($columns, 0, 1);
				
				//print_r($columns);
                
				$values = array();
				$values[] = $_POST['id_customer'];
				$values[] = $_POST['id_ball'];
				$values[] = $_POST['date'];
				$values[] = $_POST['price'];
				$values[] = $_POST['completed_by'];
				//echo '<br><br> VALUES <br><br>';
				//print_r($values);
				$dbHandler->insert($table, $columns, $values);
				
				break;

			case '"edit"':
				$id = $_POST['idBall'];
				
				$table = $_GET['table'];
				
				$columns = $dbHandler->getColumns($table);
				array_splice($columns, 0, 1);
				
				$values = array();
				$values[] = $_POST['hand'];
				$values[] = $_POST['conv'];
				$values[] = $_POST['ft'];
				$values[] = $_POST['pin'];
				$values[] = $_POST['weight'];
				$values[] = $_POST['layout'];
				$values[] = $_POST['surface'];
				$values[] = $_POST['bh_position'];
				$values[] = $_POST['size'];
                $values[] = $_POST['depth'];
				$values[] = $_POST['pap_horizontal'];
				$values[] = $_POST['pap_updown'];
				$values[] = $_POST['offset_thumb'];
				$values[] = $_POST['thumb_style'];
				$values[] = $_POST['fingers_style'];
				$values[] = $_POST['lf_measure'];
				$values[] = $_POST['la_style'];
				$values[] = $_POST['la_arrow'];
				$values[] = $_POST['lf_oval'];
				$values[] = $_POST['rf_measure'];
				$values[] = $_POST['ra_style'];
				$values[] = $_POST['ra_arrow'];
				$values[] = $_POST['rf_oval'];
				$values[] = $_POST['th_measure'];
				$values[] = $_POST['th_style'];
				$values[] = $_POST['th_arrow'];
				$values[] = $_POST['th_oval'];
				$values[] = $_POST['ff_sep'];
				$values[] = $_POST['lt_sep'];
				$values[] = $_POST['rt_sep'];

				
				$columnsCond = array();
				$columnsCond[] = $dbHandler->getIdColumn($table);
	
				$valuesCond = array();
				$valuesCond[] = $id;
				
				session_start();
				
				$_SESSION['status'] = $dbHandler->edit($table, $columns, $values, $columnsCond, $valuesCond);
				break;

				case '"editOrder"':
					$table = $_GET['table'];
					// $columns = $dbHandler->getColumns($table);
					//array_splice($columns, 0, 1);
					$columns = array();
					$columns[] = "date";
					$columns[] = "price";
					$columns[] = "completed_by";
					//print_r($columns);
					$id = $_POST['id_customer'];
					$id2 = $_POST['id_ball'];


	                
					$values = array();
					// $values[] = $_POST['id_customer'];
					// $values[] = $_POST['id_ball'];
					$values[] = $_POST['date'];
					$values[] = $_POST['price'];
					$values[] = $_POST['completed_by'];


					$columnsCond = array();
					$columnsCond[] = $dbHandler->getIdColumn($table);
		
					$valuesCond = array();
					$valuesCond[] = $id;
					$valuesCond[] = $id2;
					
					session_start();
					print_r($columns);
					print_r($values);

					echo $_SESSION['status'] = $dbHandler->edit($table, $columns, $values, $columnsCond, $valuesCond);

					break;
			
			default:
				# code...
				break;
		}
	}
	
?>
