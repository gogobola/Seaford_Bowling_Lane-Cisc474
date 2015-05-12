
var bowlingDatabase = function() {
	this.dbname="bowling_ball";
};


bowlingDatabase.prototype.getAllCustomers = function(scope, customersAtribute){
		var dbHandler = new $.Deferred();
		
		$.ajax({
          url: 'database/customer.php?func="getAllCustomers"',
          type: "GET",
          data: {"key":"value"},
          success: function(data){
			dbHandler.resolve(data);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(data){
			//scope.customers = arguments[0];
			scope[customersAtribute] = arguments[0];
			scope.$apply();
			
		});
		
	};
	
	
	
bowlingDatabase.prototype.getCustomerView = function(scope, scopeVariable, id){
		var dbHandler = new $.Deferred();
		
		$.ajax({
          url: 'database/customer.php?func="getCustomerView"&id='+id,
          type: "GET",
          data: {"key":"value"},
          success: function(data){
			dbHandler.resolve(data);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(data){
			
			scope[scopeVariable] = arguments[0][0];
			scope.$apply();
			
		});
		
	};
	

	
	
bowlingDatabase.prototype.getCustomer = function(scope, scopeVariable, id){
		var dbHandler = new $.Deferred();
		
		$.ajax({
          url: 'database/customer.php?func="getCustomer"&id='+id,
          type: "GET",
          data: {"key":"value"},
          success: function(data){
			dbHandler.resolve(data);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(data){
			
			scope[scopeVariable] = arguments[0][0];
			scope.$apply();
			console.log(scope.selectedCustomer);
		});
		
	};
	

	
bowlingDatabase.prototype.getAllStates = function(scope, scopeVariable){
		var dbHandler = new $.Deferred();
		
		$.ajax({
          url: 'database/customer.php?func="getAllStates"',
          type: "GET",
          data: {"key":"value"},
          success: function(data){
			dbHandler.resolve(data);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(data){
			
			scope[scopeVariable] = arguments[0];
			scope.$apply();
			
		});
		
	};


bowlingDatabase.prototype.getState = function(scope, scopeVariable, id){
    var dbHandler = new $.Deferred();
    
    $.ajax({
           url: 'database/customer.php?func="getState"&id='+id,
           type: "GET",
           data: {"key":"value"},
           success: function(data){
           dbHandler.resolve(data);
           
           },
           error: function(){
           //$('body').html("Error happened");
           return null;
           }
           });
    
    dbHandler.promise().done(function(data){
                             
                             scope[scopeVariable] = arguments[0];
                             scope.$apply();
                             
                             });
    
};



bowlingDatabase.prototype.getAllBalls = function(scope, scopeVariable){
    var dbHandler = new $.Deferred();
    
    $.ajax({
           url: 'database/orderBall.php?func="getAllBalls"',
           type: "GET",
           data: {"key":"value"},
           success: function(data){
           dbHandler.resolve(data);
           
           },
           error: function(){
           //$('body').html("Error happened");
           return null;
           }
           });
    
    dbHandler.promise().done(function(data){
                             
                             scope[scopeVariable] = arguments[0];
                             scope.$apply();
                             
                             });
    
};





bowlingDatabase.prototype.getBall = function(scope, scopeVariable, id){
    var dbHandler = new $.Deferred();
    
    $.ajax({
           url: 'database/orderBall.php?func="getBall"&id='+id,
           type: "GET",
           data: {"key":"value"},
           success: function(data){
           dbHandler.resolve(data);
           
           },
           error: function(){
           //$('body').html("Error happened");
           return null;
           }
           });
    
    dbHandler.promise().done(function(data){
                             
                             scope[scopeVariable] = arguments[0];
                             scope.$apply();
                             
                             });
    
};



bowlingDatabase.prototype.getAllOrders = function(scope, scopeVariable){
    var dbHandler = new $.Deferred();
    
    $.ajax({
           url: 'database/orderBall.php?func="getAllOrders"',
           type: "GET",
           data: {"key":"value"},
           success: function(data){
           dbHandler.resolve(data);
           
           },
           error: function(){
           //$('body').html("Error happened");
           return null;
           }
           });
    
    dbHandler.promise().done(function(data){
                             
                             scope[scopeVariable] = arguments[0];
                             scope.$apply();
                             
                             });
    
};



bowlingDatabase.prototype.getOrder = function(scope, scopeVariable, id){
    var dbHandler = new $.Deferred();
    
    $.ajax({
           url: 'database/orderBall.php?func="getOrder"&id='+id,
           type: "GET",
           data: {"key":"value"},
           success: function(data){
           dbHandler.resolve(data);
           
           },
           error: function(){
           //$('body').html("Error happened");
           return null;
           }
           });
    
    dbHandler.promise().done(function(data){
                             
                             scope[scopeVariable] = arguments[0];
                             scope.$apply();
                             
                             });
    
};



bowlingDatabase.prototype.getUser = function(scope, scopeVariable, id){
    var dbHandler = new $.Deferred();
    
    $.ajax({
           url: 'database/login.php?func="getUser"&id='+id,
           type: "GET",
           data: {"key":"value"},
           success: function(data){
           dbHandler.resolve(data);
           
           },
           error: function(){
           //$('body').html("Error happened");
           return null;
           }
           });
    
    dbHandler.promise().done(function(data){
                             
                             scope[scopeVariable] = arguments[0];
                             scope.$apply();
                             
                             });
    
};



bowlingDatabase.prototype.login = function(scope, scopeVariable, user, pass){
    var dbHandler = new $.Deferred();
    
    $.ajax({
           url: 'database/login.php?func="login"&user='+id+'&pass='+pass,
           type: "GET",
           data: {"key":"value"},
           success: function(data){
           dbHandler.resolve(data);
           
           },
           error: function(){
           //$('body').html("Error happened");
           return null;
           }
           });
    
    dbHandler.promise().done(function(data){
                             
                             scope[scopeVariable] = arguments[0];
                             scope.$apply();
                             
                             });
    
};




//****************************************************************************************
	
bowlingDatabase.prototype.insert = function(scope, scopeVariable, table){
		var dbHandler = new $.Deferred();
		
		$.ajax({
          url: 'database/database.php?func="insert"&table='+table,
          type: "POST",
          data: {
				name: scope[scopeVariable].name,
				address: scope[scopeVariable].address,
				city: scope[scopeVariable].city,
				id_state: scope[scopeVariable].id_state,
				zip: scope[scopeVariable].zip,
				phone: scope[scopeVariable].phone,
				cell: scope[scopeVariable].cell,
				email: scope[scopeVariable].email,
				},
          success: function(msg){
			dbHandler.resolve(msg);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(msg){
			
			scope.msgBox = arguments[0];
			//scope[scopeTable].push(scope[scopeVariable]);
			scope.$apply();
			
		});
		
	};
	
	
	
bowlingDatabase.prototype.edit = function(scope, scopeVariable, table){
		var dbHandler = new $.Deferred();
		
		console.log("NAME: ");
		console.log(scope[scopeVariable].city);
		
		$.ajax({
          url: 'database/database.php?func="edit"&table='+table,
          type: "POST",
          data: {
			    idCustomer: scope[scopeVariable].idCustomer,
				name: scope[scopeVariable].name,
				address: scope[scopeVariable].address,
				city: scope[scopeVariable].city,
				id_state: scope[scopeVariable].id_state,
				zip: scope[scopeVariable].zip,
				phone: scope[scopeVariable].phone,
				cell: scope[scopeVariable].cell,
				email: scope[scopeVariable].email,
				},
          success: function(msg){
			alert(msg);
			console.log("MESSAGE");
			console.log(msg);
			dbHandler.resolve(msg);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(msg){
			
			scope.msgBox = arguments[0];
			//scope[scopeTable].push(scope[scopeVariable]);
			scope.$apply();
			console.log("NAME at databaseJS");
			console.log(scope[scopeVariable].name);
		});
		
	};
	
	
bowlingDatabase.prototype.remove = function(id, table){
		var dbHandler = new $.Deferred();
		
		$.ajax({
          url: 'database/database.php?func="del"&table='+table,
          type: "POST",
          data: {
			    idCustomer: id
				},
          success: function(msg){
			dbHandler.resolve(msg);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(msg){
			
			scope.msgBox = arguments[0];
			//scope[scopeTable].push(scope[scopeVariable]);
			scope.$apply();
			
		});
		
	};
	
	
bowlingDatabase.prototype.search = function(scope, scopeVariable, table, text, searchBy){
		var dbHandler = new $.Deferred();
		
		$.ajax({
          url: 'database/database.php?func="search"&text='+text+"&searchBy="+searchBy+'&table='+table,
          type: "GET",
          data: {"key":"value"},
          success: function(data){
			dbHandler.resolve(data);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(data){
			//scope.customers = arguments[0];
			scope[scopeVariable] = arguments[0];
			scope.$apply();
			
		});
		
	};
	

bowlingDatabase.prototype.searchCustomer = function(scope, scopeVariable, text, searchBy){
		var dbHandler = new $.Deferred();
		
		$.ajax({
          url: 'database/customer.php?func="searchCustomer"&text='+text+"&searchBy="+searchBy,
          type: "GET",
          data: {"key":"value"},
          success: function(data){
			dbHandler.resolve(data);
			
          }, 
          error: function(){
            //$('body').html("Error happened");
			return null;
          }
        });  
		
		dbHandler.promise().done(function(data){
			//scope.customers = arguments[0];
			scope[scopeVariable] = arguments[0];
			scope.$apply();
			
		});
		
	};