// JavaScript Document

var baseUrl = get_base_url();  

var hCareApp = angular.module("hcare",["ngMaterial"]);

hCareApp.controller("staffListCtrl", function($scope, $http){

	$scope.datailslists = '';

	$scope.showData = function(){

		$http.get(baseUrl+'staff/get_staff_list/').then(function(data){

			$scope.datailslists = data.data ;	
			//alert($scope.datailslists.length);
		});

				

		//show more functionality

		var pagesShown = 1;

		var pageSize = 3;

		

		$scope.paginationLimit = function(data) {

			return pageSize * pagesShown;

		};

		$scope.hasMoreItemsToShow = function() {

			return pagesShown < ($scope.datailslists.length / pageSize);

		};

		$scope.showMoreItems = function() {

			pagesShown = pagesShown + 1;       

		};	

	}

});

