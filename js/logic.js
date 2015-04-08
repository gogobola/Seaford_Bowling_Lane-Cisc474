var bowlingApp = angular.module('bowlingApp', ['ngRoute']);

		bowlingApp.config(function($routeProvider){
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
			.otherwise({redirectTo: '/view1'});
		});
		


		bowlingApp.controller('SimpleController', SimpleController);