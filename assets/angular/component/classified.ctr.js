var base_url= window.location.origin+"/hcare";
myApp.controller("classified", function($scope, $http){
	$http.get(base_url+'/angular/').then(function(data){
		$scope.classifieds = data.data ;	
	});
});
