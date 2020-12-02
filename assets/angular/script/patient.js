// JavaScript Document

var base_url= window.location.origin;


var myApp = angular .module("hcare",["ngMaterial",'angular-media-preview','ui.bootstrap'])
.controller("patientReviewCtrl", function($scope,$http,$window,$timeout){
		  /* $scope.urlpending = base_url+"/patient/angular_pending_review";
		   $http.post($scope.urlpending,{'patientid':patient_id})
							.success(function(data, status, headers, config)
							{
								$scope.hpatientPendingreview = data;
								//console.log(data);
								if(data==''){
									$scope.nofound= true;
									}
							// $window.location.href = base_url+'/hospital';
							})
							.error(function(data, status, headers, config)
							{
							alert('error');
							});*/
			$scope.url = base_url+"/patient/angular_recent_review";
			$http.post($scope.url,{'patientid':patient_id})
							.success(function(data, status, headers, config)
							{
								$scope.hpatientRecentreview = data;
								console.log(data);
								if(data==''){
									$scope.nofound= true;
									}
							// $window.location.href = base_url+'/hospital';
							})
							.error(function(data, status, headers, config)
							{
							alert('error');
							});
			$scope.limit= 5;
		// loadMore function
		$scope.loadMore = function() {
			$scope.loader12= true;
			
			$scope.increamented = $scope.limit + 3;
			
			$timeout( function(){ 
			        $scope.loader12= false; },800);
			
			$scope.limit = $scope.increamented >  $scope.hpatientRecentreview.length ?  $scope.hpatientRecentreview.length : $scope.increamented;
			
			if($scope.increamented > $scope.hpatientRecentreview.length){
				$scope.loadmore= true;
				$scope.message= true;
			}
		else{
		
		    }
		}
	})
	.controller("specialistForPatientCtrl", function($scope,$http,$window,$timeout){
		
			$scope.url = base_url+"/patient/angular_specialist_patient";
			$http.post($scope.url,{'specialistID':specialistID})
							.success(function(data, status, headers, config)
							{
								$scope.hspecialistpatients = data;
								//alert($scope.hspecialistpatients);
								$scope.language = data[0].language;
								
								$scope.award = data[0].award;	
								
								//alert($scope.award);
								
							})
							.error(function(data, status, headers, config)
							{
							alert('error');
							});
						
							
	});
/* only for example */
var myApp = angular
    .module("myangular",["ngMaterial"])
    .config(function($mdThemingProvider){
        $mdThemingProvider.theme('default')
            .primaryPalette('teal')
            .accentPalette('orange');
    }).controller("studentController", function($scope,$http) {
        var url = base_url+"/ajax.php?q=rqvgqngn";
        $http.get(url).success( function(response) {
            $scope.students = response;
            //alert( $scope.students);
        });


    }).controller("formCtrl", function($scope,$http) {
        $scope.url = base_url+'/ajax.php?q=rqvgqngn';

        $scope.formsubmit = function(isValid) {
            if (isValid) {

                $http.post($scope.url, {"name": $scope.name, "email": $scope.email, "message": $scope.message}).
                    success(function(data, status) {
                        console.log(data);
                        $scope.status = status;
                        $scope.data = data;
                        $scope.result = data;
                    })
            }else{
                alert('Form is not valid');
            }
        }
    });
	
