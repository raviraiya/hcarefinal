var base_url= window.location.origin;
var hospital_app = angular.module("hcare",["ngMaterial"]);
    hospital_app.controller("classified", function($scope, $http){
        $scope.classifieds = "" ;
        $scope.showData = function( ){
            //var url = base_url+"/test/json_data";
            $http.get(base_url+'/reviews/dataList').then(function(data){
            $scope.classifieds = data.data ;    
        }); 
         //show more functionality
        var pagesShown = 1;
        var pageSize = 1;
        $scope.paginationLimit = function(data) {
            return pageSize * pagesShown;
        };
        $scope.hasMoreItemsToShow = function() {
            return pagesShown < ($scope.classifieds.length / pageSize);
        };
        $scope.showMoreItems = function() {
            pagesShown = pagesShown + 1;       
        }; 
    }
});

var reviewapp = angular.module("hcare",["ngMaterial"]);
reviewapp.controller("homephyreviews", function($scope, $http,$window,$timeout){
    $scope.classifieds = "" ;
    $scope.showData = function( ){
        $http.get(base_url+'/homephysician/get_reviews').then(function(data){
            $scope.classifieds = data.data ;
        });
        //show more functionality
        var pagesShown = 1;
        var pageSize = 5;
        $scope.paginationLimit = function(data) {
            return pageSize * pagesShown;
        };
        $scope.hasMoreItemsToShow = function() {
            return pagesShown < ($scope.classifieds.length / pageSize);
        };
        $scope.showMoreItems = function() {
            pagesShown = pagesShown + 1;
        };
    }
});

reviewapp.controller("hphysican_patients_Ctrl", function($scope,$http,$window,$timeout){
    $scope.url = base_url+"homephysician/angular_patients";
    $http.post($scope.url,{'hphy_id': hphy_id})
        .success(function(data, status, headers, config)
        {
            $scope.hpatientdataObj = data;
            console.log(data);
        })
        .error(function(data, status, headers, config)
        {
            alert('error');
        });
    $scope.limit = 10;
    // loadMore function
    $scope.loadMore = function() {
        $scope.loader12 = true;
        $scope.increamented = $scope.limit + 10;
        $timeout( function(){
            $scope.loader12= false; 
        },800);
        $scope.limit = $scope.increamented >  $scope.hpatientdataObj.length ?  $scope.hpatientdataObj.length : $scope.increamented;
        if($scope.increamented > $scope.hpatientdataObj.length){
            $scope.loadmore= true;
            $scope.message= true;
        }
        else{

        }
    }
});

reviewapp.controller("get_patient_reviewCtrl", function($scope,$http,$window,$timeout){
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

reviewapp.controller("hphysican_patients_invite_today_Ctrl", function($scope,$http,$window,$timeout){
    $scope.url = base_url+"homephysician/angular_patients_invite_today";
    $http.post($scope.url)
        .success(function(data, status, headers, config)
        {
            $scope.hpatientInviteTodaydataObj = data;
            console.log($scope.hpatientInviteTodaydataObj);
        })
        .error(function(data, status, headers, config)
        {
            alert('error');
        });
    $scope.limit = 10;
    // loadMore function
    $scope.loadMore = function() {
        $scope.loader12 = true;
        $scope.increamented = $scope.limit + 10;
        $timeout( function(){
            $scope.loader12= false; 
        },800);
        $scope.limit = $scope.increamented >  $scope.hpatientInviteTodaydataObj.length ?  $scope.hpatientInviteTodaydataObj.length : $scope.increamented;
        if($scope.increamented > $scope.hpatientInviteTodaydataObj.length){
            $scope.loadmore= true;
            $scope.message= true;
        }
        else{

        }
    }
});

reviewapp.controller("hphysican_patients_invite_yest_Ctrl", function($scope,$http,$window,$timeout){
    $scope.url = base_url+"homephysician/angular_patients_invite_yesterday";
    $http.post($scope.url)
        .success(function(data, status, headers, config)
        {
            $scope.hpatientInviteYesterdaydataObj = data;
            console.log($scope.hpatientInviteYesterdaydataObj);
        })
        .error(function(data, status, headers, config)
        {
            alert('error');
        });
    $scope.limit = 10;
    // loadMore function
    $scope.loadMore = function() {
        $scope.loader12 = true;
        $scope.increamented = $scope.limit + 10;
        $timeout( function(){
            $scope.loader12= false; 
        },800);
        $scope.limit = $scope.increamented >  $scope.hpatientInviteYesterdaydataObj.length ?  $scope.hpatientInviteYesterdaydataObj.length : $scope.increamented;
        if($scope.increamented > $scope.hpatientInviteYesterdaydataObj.length){
            $scope.loadmore= true;
            $scope.message= true;
        }
        else{

        }
    }
});

reviewapp.controller("hphysican_patients_invite_less_Ctrl", function($scope,$http,$window,$timeout){
    $scope.url = base_url+"homephysician/angular_patients_invite_less";
    $http.post($scope.url)
        .success(function(data, status, headers, config)
        {
            $scope.hpatientInviteLessdataObj = data;
            console.log($scope.hpatientInviteLessdataObj);
        })
        .error(function(data, status, headers, config)
        {
            alert('error');
        });
    $scope.limit = 10;
    // loadMore function
    $scope.loadMore = function() {
        $scope.loader12 = true;
        $scope.increamented = $scope.limit + 10;
        $timeout( function(){
            $scope.loader12= false; 
        },800);
        $scope.limit = $scope.increamented >  $scope.hpatientInviteLessdataObj.length ?  $scope.hpatientInviteLessdataObj.length : $scope.increamented;
        if($scope.increamented > $scope.hpatientInviteLessdataObj.length){
            $scope.loadmore= true;
            $scope.message= true;
        }
        else{

        }
    }
});