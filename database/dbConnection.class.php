<?php

    class BowlingConnection {
        
        private $host;
        private $user;
        private $pass;
        private $database;
        private $conn;
        
        public function BowlingConnection(){
            $this->host = "localhost";
            //$this->user = "engineerdb_ball";
            //$this->pass = "Advancedweb2015";
			
			$this->user = "diogo";
			$this->pass = "Cefet2015";
			
            $this->database = "bowling_ball";
            
        }
        
        // ***** GETS *************
        
        public function getHost()
        {
            return $this->host;
        }
        
        public function getDbUser()
        {
            return $this->user;
        }
        
        public function getPass()
        {
            return $this->pass;
        }
        
        public function getDb()
        {
            return $this->database;
        }
        
        public function getConn()
        {
            return $this->conn;
        }
        
        
        //********** SETS *************************
        
        public function setHost($hostdb)
        {
            $this->host = $hostdb;
        }
        
        public function setDbUser($userdb)
        {
            $this->user = $userdb;
        }
        
        public function setPass($passdb)
        {
            $this->pass = $passdb;
        }
        
        public function setDatabase($dbname)
        {
            $this->database = $dbname;
        }
        
        
        public function setConn($dbConn)
        {
            $this->conn = $dbConn;
        }


        //*********************** Handle Connection ************************************
        
        public function connect(){
            /*$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database);
            if($this->conn->connect_errno > 0)
                die ("Failed database connection: " . $this->conn->connect_error );
            */
			
			try {
				$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->pass);
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
        }
		
        /*
        public function close(){
            $this->conn->close();
        }
        */
        
        
        //************************* INSERT, EDIT, DELETE ************************************
        
        public function insert($table,$columns, $values)
        {
            $query = "INSERT INTO `$table` ( ";
            
            $cont = 0;
            foreach($columns as $c)
            {
                if($cont == 0)
                    $query = $query . "`$c`";
                else
                    $query = $query . ", `$c`";
                
                $cont++;
            }
            
            $query = $query . ') VALUES (' ;
            
            $cont = 0;
            foreach($values as $v)
            {
                if($cont == 0)
                    $query = $query .'"'. "$v" . '"';
                else
                    $query = $query .', "'. "$v" . '"';
                
                $cont++;
            }
            
            $query = $query . ')';
            
            //echo '<br>' . "$query" .'<Br>';
            $statement = $this->conn->prepare($query);
             if( $statement->execute() )
                    return  $this->conn->lastInsertId();
                else
                    return 0;
			
        }
        
        
        
        public function edit($table, $columns, $values, $columnsCond, $valuesCond)
        {
            $query = "UPDATE `$table` SET ";
            
            
            for($i = 0; $i < count($columns); $i++)
            {
                if($i == 0)
                    $query = $query . ' `'. $columns[$i] . '` = "' . $values[$i] . '"';
                else
                    $query = $query . ', `' . $columns[$i] . '` = "' . $values[$i] . '"';
                
            }
            
            for($i = 0; $i < count($columnsCond); $i++)
            {
                if($i == 0)
                    $query = $query . ' WHERE ( `' . $columnsCond[$i] . '` = "' . $valuesCond[$i] . '")';
                else
                    $query = $query . ' AND (`' . $columnsCond[$i] . '` = "' . $valuesCond[$i] . '")';
                
            }
            
            echo '<br> '. $query;
            $statement = $this->conn->prepare($query);
             if( $statement->execute() )
                    return  true;
                else
                    return false;

        }
        
        
        
        
        public function delete($table, $columns, $values)
        {
            $remove = "DELETE FROM `$table` ";
            
            for($i = 0; $i < count($columns); $i++)
            {
                if($i == 0)
                    $remove = $remove . ' WHERE ( `' . $columns[$i] . '` = "' . $values[$i] . '")';
                else
                    $remove = $remove . ' AND (`' . $columns[$i] . '` = "' . $values[$i] . '")';
                
            }
            
            $statement = $this->conn->prepare($remove);
             if( $statement->execute() )
                    return  true;
                else
                    return false;

        }
        
        
        //************************* USER LOGIN ****************************************
        
        
        public function verifyLogin($user, $pass)
        {
            $querySQL = "SELECT * FROM user WHERE ((user = " . '"' . $user . '"' . ") AND (pass = " . '"' . $pass . '"' . "))";
            //echo $querySQL;
            
            $statement = $this->conn->prepare($querySQL);
            $statement->execute();
            
            if($statement->rowCount() > 0)
                return true;
            else
                return false;
        }
        
        
        
        public function getUserId($user, $pass)
        {
            $querySQL = "SELECT idUser FROM user WHERE ((user = " . '"' . $user . '"' . ") AND (pass = " . '"' . $pass . '"' . "))";
            
            $statement = $this->conn->prepare($querySQL);
            $statement->execute();
            while($result = $statement->fetch(PDO::FETCH_ASSOC) )
            {
                $id = $result["idUser"];
            }
            
            if($statement->rowCount() > 0)
                return $id;
            else
                return null;
        }
        
        public function getUser($user_id){
            
            $query = "SELECT * FROM user WHERE (idUser = $user_id)";
            
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo json_encode($results);
        }

        
        
        //************************* Queries ********************************************
        
        public function arrayQuery($querySQL){
            $statement = $this->conn->prepare($querySQL);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }
        
		public function query($querySQL){
			$statement = $this->conn->prepare($querySQL);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
		}
        
        public function getAllBalls(){
            
			$query = "SELECT * FROM ball";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		public function getAllBallsArray(){
            
			$query = "SELECT * FROM ball";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
        }
        
        
        public function getBall($ball_id){
            
			$query = "SELECT * FROM ball WHERE (idBall = $ball_id)";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		public function getBallArray($ball_id){
            
			$query = "SELECT * FROM ball WHERE (idBall = $ball_id)";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
        }
        
        
        public function getAllCustomers(){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE (C.id_state = S.idState)";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		public function getAllCustomersArray(){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE (C.id_state = S.idState)";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
        }
        
        public function getCustomer($customer_id){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE ( (C.idCustomer = $customer_id) AND (C.id_state = S.idState) )";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
            
        }
		
		public function getCustomerView($customer_id){
            $query = "SELECT C.idCustomer as ID, C.name as Name, C.address as Address, C.city as City, S.Name as State, S.abbr as StateAbbr, C.phone as Phone, C.cell as Cellular, C.email as Email FROM customer C, state S 
						WHERE ( (C.idCustomer = $customer_id) AND (C.id_state = S.idState) )";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
            
        }
		
		public function getCustomerArray($customer_id){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE ( (C.idCustomer = $customer_id) AND (C.id_state = S.idState) )";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }
		
        
        public function getAllOrders(){
            $query = "SELECT O.*, B.*, C.name as customer, C.phone as customerPhone, 
						C.email as customerEmail, S.name as customerState, S.abbr as customerStateAbbr
						FROM `order` O, customer C, state S, ball B
						WHERE ( (O.id_customer = C.idCustomer) AND (O.id_ball = B.idBall) 
								AND (C.id_state = S.idState) )";
			
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		
		public function getAllOrdersArray(){
            $query = "SELECT O.*, B.*, C.name as customer, C.phone as customerPhone, 
						C.email as customerEmail, S.name as customerState, S.abbr as customerStateAbbr
						FROM `order` O, customer C, state S, ball B
						WHERE ( (O.id_customer = C.idCustomer) AND (O.id_ball = B.idBall) 
								AND (C.id_state = S.idState) )";
			
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
        }
		
        
        public function getOrder($customer_id, $ball_id){
            $query = "SELECT O.*, B.*, C.name as customer, C.phone as customerPhone, 
						C.email as customerEmail, S.name as customerState, S.abbr as customerStateAbbr
						FROM `order` O, customer C, state S, ball B
						WHERE ( (O.id_customer = $customer_id) AND (O.id_ball = $ball_id) AND 
							   (O.id_customer = C.idCustomer) AND (O.id_ball = B.idBall) 
								AND (C.id_state = S.idState) )";
			
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		
		public function getOrderArray($customer_id, $ball_id){
            $query = "SELECT O.*, B.*, C.name as customer, C.phone as customerPhone, 
						C.email as customerEmail, S.name as customerState, S.abbr as customerStateAbbr
						FROM `order` O, customer C, state S, ball B
						WHERE ( (O.id_customer = $customer_id) AND (O.id_ball = $ball_id) AND 
							   (O.id_customer = C.idCustomer) AND (O.id_ball = B.idBall) 
								AND (C.id_state = S.idState) )";
			
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
        }
        
		
		public function getOrderByDate($date){
            $query = "SELECT O.*, B.*, C.name as customer, C.phone as customerPhone, 
						C.email as customerEmail, S.name as customerState, S.abbr as customerStateAbbr
						FROM `order` O, customer C, state S, ball B
						WHERE ( (O.date LIKE '$date%' ) AND 
							   (O.id_customer = C.idCustomer) AND (O.id_ball = B.idBall) 
								AND (C.id_state = S.idState) )";
			
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		
		public function getCustomerOrders($customer_id){
            $query = "SELECT O.*, B.*, C.name as customer, C.phone as customerPhone, 
						C.email as customerEmail, S.name as customerState, S.abbr as customerStateAbbr
						FROM `order` O, customer C, state S, ball B
						WHERE ( (O.id_customer = $customer_id) AND 
							   (O.id_customer = C.idCustomer) AND (O.id_ball = B.idBall) 
								AND (C.id_state = S.idState) )";
			
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		
		
        public function getAllStates(){
            $query = "SELECT * FROM state";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		public function getAllStatesArray(){
            $query = "SELECT * FROM state";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
        }
        
        public function getState($state_id){
			 $query = "SELECT * FROM state WHERE (idState = $state_id)";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		
		public function getStateArray($state_id){
			 $query = "SELECT * FROM state WHERE (idState = $state_id)";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
        }
		
		
		//**************************** SEARCHES *************************************
		
		public function searchCustomerBy($term, $text){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE ( (C.$term LIKE '%$text%') AND (C.id_state = S.idState) )";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
            
        }
		
		public function searchCustomerByName($name){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE ( (C.name LIKE '%$name%') AND (C.id_state = S.idState) )";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
            
        }
		
		
		public function searchCustomerByEmail($email){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE ( (C.email LIKE '%$email%') AND (C.id_state = S.idState) )";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
            
        }
		
		
		public function searchCustomerByPhone($phone){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE ( (C.phone LIKE '%$phone%') AND (C.id_state = S.idState) )";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
            
        }
		
		
		public function searchState($name){
			$query = "SELECT * FROM state WHERE (name LIKE '%$name%')";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
        }
		
		public function searchBy($table, $term, $text)
		{
			$query = "SELECT * FROM $table 
						WHERE ( $term LIKE '%$text%')";
				
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
		}
		
		public function searchOrderBy($term, $text)
		{
			$query = "SELECT O.*, B.*, C.name as customer, C.phone as customerPhone, 
						C.email as customerEmail, S.name as customerState, S.abbr as customerStateAbbr
						FROM `order` O, customer C, state S, ball B
						WHERE ( (O.id_customer = $customer_id) AND 
							   (O.id_customer = C.idCustomer) AND (O.id_ball = B.idBall) 
								AND (C.id_state = S.idState) AND ( $term LIKE '%$text%') )";
			
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($results);
		}
        
		//********************************* STRUCTURE *****************************
		
		public function getColumns($table)
		{
			$query = "SELECT * FROM `$table`";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$columns = array_keys($result);
			
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($columns);
			return $columns;
		}
		
		
		public function getIdColumn($table)
		{
			$query = "SELECT * FROM `$table`";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$columns = array_keys($result);
			
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($columns[0]);
			return $columns[0];
		}
		
		
		public function getOrderIdColumns()
		{
			$query = "SELECT * FROM `order`";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$columns = array_keys($result);
			
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode( array($columns[0], $columns[1]) );
			return array($columns[0], $columns[1]);
		}
		
		
		public function getColumnsCustomersView(){
            $query = "SELECT C.*, S.Name as State, S.abbr as StateAbbr FROM customer C, state S 
						WHERE (C.id_state = S.idState)";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$columns = array_keys($result);
			
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($columns);
			return $columns;
		}
		
		
		public function getColumnsOrdersView(){
            $query = "SELECT O.*, B.*, C.name as customer, C.phone as customerPhone, 
						C.email as customerEmail, S.name as customerState, S.abbr as customerStateAbbr
						FROM `order` O, customer C, state S, ball B
						WHERE ( (O.id_customer = C.idCustomer) AND (O.id_ball = B.idBall) 
								AND (C.id_state = S.idState) )";
			
			$statement = $this->conn->prepare($query);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$columns = array_keys($result);
			
			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode($columns);
			return $columns;
		}
		
    }

?>
