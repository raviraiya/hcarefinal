var base_url= window.location.origin;

var hospital_app = angular.module("hcare",["ngMaterial",'angular-media-preview','ui.bootstrap'])
    .controller("hphysican_patients_Ctrl", function($scope,$http,$window,$timeout){alert(hphy_id);
        $scope.url = base_url+"homephysician/angular_patients";
        $http.post($scope.url,{'hphy_id':hphy_id})
            .success(function(data, status, headers, config)
            {
			    $scope.hpatientdata = data;
                console.log(data);
            })
            .error(function(data, status, headers, config)
            {
                alert('error');
            });
        $scope.limit= 5;
        // loadMore function
        $scope.loadMore = function() {
            $scope.loader12= true;
            $scope.increamented = $scope.limit + 1;
            $timeout( function(){
                $scope.loader12= false; },800);
            $scope.limit = $scope.increamented >  $scope.hpatientdata.length ?  $scope.hpatientdata.length : $scope.increamented;
            if($scope.increamented > $scope.hpatientdata.length){
                $scope.loadmore= true;
                $scope.message= true;
            }
            else{
            }
        }
    })
    .controller("get_patient_reviewCtrl", function($scope,$http,$window,$timeout){
        $scope.get_patient_review= function(patientid){
            $scope.url = base_url+"homephysician/angular_patients_review";
            $http.post($scope.url,{'hphy_id':hphy_id,'patientid':patientid})
                .success(function(data, status, headers, config)
                {
                    $scope.hpatientreview = data;
                    console.log(data);
                    if(data==''){
                        $scope.nofound= true;
                    }
                })
                .error(function(data, status, headers, config)
                {
                    alert('error');
                });
        }     
    });