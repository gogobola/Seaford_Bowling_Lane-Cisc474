var bowlingApp = angular.module('bowlingApp', ['ngRoute']);

		bowlingApp.config(["$routeProvider", function($routeProvider){
			$routeProvider
			.when('/view1',
				{
					controller: 'SimpleController',
					templateUrl: 'Partials/View1.html'
				})
			.when('/view2',
				{
					controller: 'SimpleController',
					templateUrl: 'Partials/View2.html'

				})
               .when('/main',
                     {
                     controller: 'SimpleController',
                     templateUrl: 'mainpage.html'
                     })
               .when('/customers',
                     {
                     controller: 'CustomerController',
                     templateUrl: 'Partials/customer.html'
                     
                     })
               .when('/balls',
                     {
                     controller: 'BallController',
                     templateUrl: 'Partials/ballinfo.html'
                     
                     })
               .when('/orders',
                     {
                     controller: 'OrderController',
                     templateUrl: 'Partials/orderInfo.html'
                     
                     })
               .otherwise({redirectTo: '/main'});

		}]);
		
			

    bowlingApp.controller('SimpleController', ["$scope", "$location", "$routeParams",
       function($scope, $location, $routeParams) {
       
       $('#login').hide();
       
       $('#loginMsg').hide();
       
	   /*
       $('#toggle-login').click(function(){
                $('#login').toggle();
                $('#loginMsg').hide();
        });
		*/
		$scope.toggleLogin = function toggleLogin()
		{
			$('#login').toggle();
             $('#loginMsg').hide();
		}
       
       $scope.login = function login(){
       
       var user = $scope.email;
       var pass = $scope.pass;
       $.ajax({
              url: 'database/login.php?func="login"&user='+user+'&pass='+pass,
              type: "GET",
              data: {"key":"value"},
              success: function(data){
             // alert(data);
              if(data == "1")
              {
                $location.path( "/orders" );
                $scope.$apply();
              }
              else
              {
              
                $("#loginMsg").html("Incorrect email or password!");
                $("#loginMsg").show();
              
              }
              
              },
              error: function(){
              
                $("#loginMsg").html("Login error");
                $("#loginMsg").show;
              }
              });
       
       };
       
       }]);

		
		
	bowlingApp.controller('CustomerController', ["$scope", 
      function($scope) {

		$scope.title = "Customers";
		$scope.customers = [];
		$scope.states = [];
		$scope.searchBy = "name";
		$scope.customerSearchByOptions = [{option:"Name", attr:"name"}, {option:"Id", attr:"idCustomer"}, {option:"City", attr:"city"}, {option:"State", attr:"State"}, {option:"Email", attr:"email"}, {option:"Phone", attr:"phone"}];
		
		
		var dbBowling = new bowlingDatabase();
		
        dbBowling.getAllCustomers($scope, "customers");
		
		
		$scope.view = function view(id){
			dbBowling.getCustomerView($scope, "selectedCustomer", id);
			$('#customerModal').modal('show');
		};
		
		$scope.edit = function edit(id){
			$scope.addEditTitle = "Edit Customer";
			$scope.addEditBtnText = "Save changes";
			dbBowling.getAllStates($scope, "states");
			dbBowling.getCustomer($scope, "selectedCustomer", id);
			$('#customerAddEditModal').modal('show');
		};
		
		
		$scope.remove = function remove(){
			dbBowling.remove($scope.delId, "customer");
			$('#customerDelModal').modal('hide');
			location.reload();
		};
		
		$scope.del = function del(id, name){
			$scope.delCustomerName = name;
			$scope.delId = id;
			$('#customerDelModal').modal('show');
			
		};
		
		
		
		$scope.newCustomer = function newCustomer(){
			$scope.addEditTitle = "New Customer";
			$scope.addEditBtnText = "Add customer";
			$scope.selectedCustomer = null;
			dbBowling.getAllStates($scope, "states");
			//dbBowling.getCustomer($scope, "selectedCustomer", id);
			$('#customerAddEditModal').modal('show');
		};
		
		
		$scope.addEdit = function addEdit(){
			
			if($scope.addEditBtnText == "Add customer")
				dbBowling.insert($scope, "selectedCustomer", "customer");
			else
				dbBowling.edit($scope, "selectedCustomer", "customer");
			
			$('#customerAddEditModal').modal('hide');
			location.reload();
		};
		
		
		$scope.searchCustomer = function searchCustomer(){
			dbBowling.search($scope, "customers", "customer", $scope.searchText, $scope.searchBy);
			
		};
		
		
		$('#customerAddEditModal').on('shown.bs.modal', function () {
		  $('#name').focus()
		})
		
        
	}]);


	
	bowlingApp.controller('BallController', ["$scope",
      function ballController($scope) {
		$scope.title ="Balls";
		$scope.balls = [];
		$scope.searchBy = "idBall";
		$scope.ballSearchByOptions = [
										{
											option : "ID",
											attr: "name"
										},
										{
											option : "Hand",
											attr : "hand"
										},
										{
											option : "Weight",
											attr : "weight"
										},
										{
											option : "Layout",
											attr : "Layout"
										},
										{
											option : "Size",
											attr : "size"
										}
		]
		var dbBowling = new bowlingDatabase();

        dbBowling.getAllBalls($scope, "balls");

        $scope.view = function view(id) {
        	dbBowling.getBall($scope, "selectedBall", id);
        	$("#ballModal").modal('show');
        }

        $scope.edit = function edit(id){
			$scope.addEditTitle = "Edit Ball";
			$scope.addEditBtnText = "Save changes";
        	dbBowling.getBall($scope, "selectedBall", id);
			$('#ballAddEditModal').modal('show');
		};
		
		
		$scope.remove = function remove(){
			dbBowling.remove($scope.delBallID, "customer");
			$('#ballDelModal').modal('hide');
			location.reload();
		};
		
		$scope.del = function del(id, name){
			$scope.delBallID = id;
			$scope.delId = id;
			$('#ballDelModal').modal('show');
			
		};
		
		
		
		$scope.newBall = function newBall(){
			$scope.addEditTitle = "New Ball";
			$scope.addEditBtnText = "Add Ball";
			$scope.selectedBall = null;
			//dbBowling.getAllStates($scope, "states");
			//dbBowling.getCustomer($scope, "selectedCustomer", id);
			$('#ballAddEditModal').modal('show');
		};
		
		
		$scope.addEdit = function addEdit(){
			
			if($scope.addEditBtnText == "Add Ball") {
				dbBowling.insertBall($scope, "selectedBall", "ball");
			}
			else {
				dbBowling.edit($scope, "selectedBall", "ball");
			}
			$('#customerAddEditModal').modal('hide');
			location.reload();
		};
		
		$scope.searchBall = function searchBall(){
			dbBowling.search($scope, "balls", "ball", $scope.searchText, $scope.searchBy);
			
		};
		
		
		$('#ballAddEditModal').on('shown.bs.modal', function () {
		  $("#name").focus()
		})
		


	}]);
	 
	 
	 
	 bowlingApp.controller('OrderController', ["$scope",
      function($scope) {

                $scope.title = "Orders";
                $scope.orders = [];

		var dbBowling = new bowlingDatabase();

        dbBowling.getAllOrders($scope, "orders");

	 }]);
