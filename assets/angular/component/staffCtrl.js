// JavaScript Document
var baseUrl = "http://demo.grouperocket.ca/";
hCareApp.controller("staffListCtrl", function($scope, $http){
	$scope.datailslits = '';
	$scope.showData = function(){
		$http.get(baseUrl+'staff/get_staff_list/').then(function(data){
			$scope.datailslits = data.data ;	
		});
				
		//show more functionality
		var pagesShown = 1;
		var pageSize = 3;
		
		$scope.paginationLimit = function(data) {
			return pageSize * pagesShown;
		};
		$scope.hasMoreItemsToShow = function() {
			return pagesShown < ($scope.datailslits.length / pageSize);
		};
		$scope.showMoreItems = function() {
			pagesShown = pagesShown + 1;       
		};	
	}
});
