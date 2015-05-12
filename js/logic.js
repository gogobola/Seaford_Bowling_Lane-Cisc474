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
			.otherwise({redirectTo: '/view1'});
		}]);
		
			

		bowlingApp.controller('SimpleController', ["$scope","$routeParams", 
		function($scope, $routeParams) {
		  
		  
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
      function($scope) {

                $scope.title = "Balls";
                $scope.balls = [];

		var dbBowling = new bowlingDatabase();

        dbBowling.getAllBalls($scope, "balls");

	 }]);
	 
	 
	 
	 bowlingApp.controller('OrderController', ["$scope",
      function($scope) {

                $scope.title = "Orders";
                $scope.orders = [];

		var dbBowling = new bowlingDatabase();

        dbBowling.getAllOrders($scope, "orders");

	 }]);
