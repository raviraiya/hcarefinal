// JavaScript Document
//var hCareApp = angular.module("staffList",["ngMaterial"]);
var base_url= window.location.origin;
var myApp = angular
    .module("myangular",["ngMaterial"])
    .config(function($mdThemingProvider){
        $mdThemingProvider.theme('default')
            .primaryPalette('teal')
            .accentPalette('orange');
    })
var mynewApp = angular
    .module("patientBookingApp",["ngMaterial"])
myApp.controller("classified", function($scope, $http){
    $scope.classifieds = "" ;
    $scope.showData = function( ){
        var url = base_url+"/test/json_data";
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

mynewApp.controller("patientBookingClassified", function($scope, $http){
    //alert("xcc");
    $scope.patientBookingClassifieds = "" ;
    $scope.showData1 = function( ){
        var url = base_url+"/test/json_data";
        $http.get(base_url+'/specialist/dataList').then(function(data){
            //alert(data);
            $scope.patientBookingClassifieds = data.data ;
        });
        //show more functionality
        var pagesShown = 1;
        var pageSize = 1;
        $scope.paginationLimit1 = function(data) {
            return pageSize * pagesShown;
        };
        $scope.hasMoreItemsToShow1 = function() {
            return pagesShown < ($scope.patientBookingClassifieds.length / pageSize);
        };
        $scope.showMoreItems1 = function() {
            pagesShown = pagesShown + 1;
        };
        $scope.sortColumn = 'fname'
    }


});

var myApp = angular .module("hcare",["ngMaterial",'angular-media-preview','ui.bootstrap'])
    .controller("procedurecntrl", function($scope,$http) {

        var url = base_url+"/ajax.php?q=trg__ceb_pngrtbevrf_qebcqbja";
        $http.get(url).success( function(response) {
            //console.log(response);
            $scope.pro_cats = response;

        });
        $scope.getprocedures = function() {
            var url = base_url+"/ajax.php?q=trg__ceb_pngrtbevrf_qebcqbja&p1="+$scope.selitem;
            $http.get(url).success( function(response) {
                //console.log(response);
                $scope.pro_cats = response;

            });

            //console.log($scope.selitem);
            // use $scope.selectedItem.code and $scope.selectedItem.name here
            // for other stuff ...
        }

    }).controller("hospitalStaffCtrl", function($scope,$http){


        var url = base_url+"/ajax.php?hdata=Z2V0X2RhdGFfc3RhZmY=";
        $http.get(url).success( function(response) {
            //console.log(response);
            $scope.hstaf_data = response;


        });

    }).controller("hospitalfacilitiesCtrl", function($scope,$http){




        var url = base_url+"/hospital/get_data_facilities";
        $http.get(url).success( function(response) {
            //console.log(response);
            $scope.hfacilities_data = response;
            //alert(response);



        });

    }).controller("hospitalDataCtrl", function($scope,$http){

        var url = base_url+"/hospital/get_data_hospital";
        $http.get(url).success( function(response) {
            //console.log(response);
            $scope.hhospital_data = response;
            //alert(response);
            console.log(response);


        });
    }).controller("hospital_logo_user_dataCtrl", function($scope,$http){
        //alert('ssssss');
        var url = base_url+"/hospital/get_data_hospital";
        $http.get(url).success( function(response) {
            console.log(response);
            $scope.hhospital_logo_user_data = response;
            //alert(response);



        });
    }).controller("hospital_profile_imageCtrl", function($scope,$http){
        //alert('ssssss');
        var url = base_url+"/hospital/get_hospital_image";
        $http.get(url).success( function(response) {
            console.log(response);
            $scope.slides = response;
            //alert(response);



        });
        $scope.myInterval = 15000000;

    }).controller("hospital_profile_images_info", function($scope,$http,$window){
        //alert('ssssss');
        var url = base_url+"/hospital/get_hospital_image";
        $http.get(url).success( function(response) {
            console.log(response);
            $scope.slides = response;
            //alert(response);



        });
        $scope.myInterval = 15000000;

        $scope.delete = function(evnt) {

            $scope.ID= evnt;
            if ($window.confirm("Are you sure you want to delete this image?")) {

                data = {'ID': evnt};
                $scope.url = base_url+"/hospital/remove_hospital_image";

                $http.post($scope.url,{'ID': $scope.ID})
                    .success(function(data, status, headers, config)
                    {
                        $window.location.href = base_url+'/hospital';
                    })
                    .error(function(data, status, headers, config)
                    {
                        alert('error');
                    });
            }

            else {

            }
        }


    }).controller("hospital_working_timeCtrl", function($scope,$http){
        $scope.data = {
            availableOptions: [
                {id: '1', name: 'Enable'},
                {id: '0', name: 'Disable'},

            ],
            selectedOption: {id: '1', name: 'Enable'} //This sets the default value of the select in the ui
        };

        $scope.working_time_update= function(workingday,houseid,from_hr,to_hr,status){
            alert(status);
            // alert(workingday+''+houseid+''+from_hr+''+to_hr);

            data = {'userid': houseid,'houseid': houseid,'dayid':workingday,'from_hr':from_hr,'to_hr':to_hr,'status':status};
            $scope.url = base_url+'/hospital/update_working_hours';

            $http.post($scope.url,data)
                .success(function(data, status, headers, config)
                {

                    alert(data);
                    //$window.location.href = base_url+'/hospital';
                })
                .error(function(data, status, headers, config)
                {
                    alert('error');
                });



        }

    }).controller("hospital_working_hours_list", function($scope,$http){
        //alert('ssssss');
        var url = base_url+"/hospital/get_working_hours_details";
        $http.get(url).success( function(response) {
            console.log(response);
            $scope.working_hours = response;
            //alert(response);



        });


    }).controller("hfaciltyCtrl", function($scope,$http){
        //alert('ssssss');
        $scope.get_facility_data= function(hospitalid){

            $scope.url = base_url+"/hospital/get_hfaciliy_details";
            $http.post($scope.url,{'hospitalid':hospitalid})
                .success(function(data, status, headers, config)
                {
                    $scope.hfacilitydata = data;
                    //alert(data);
                    //$window.location.href = base_url+'/hospital';
                })
                .error(function(data, status, headers, config)
                {
                    alert('error');
                });



        }

        $scope.facilityDelete= function(facilityid){
            alert('ssssssssss');

            //$scope.url = base_url+"/hospital/delete_hfaciliy_details";
            ///$http.post($scope.url,{'facilityid':facilityid})
            //.success(function(data, status, headers, config)
            //{
            //$scope.hfacilitydata = data;
            //	//alert(data);
            //$window.location.href = base_url+'/hospital';
            //})
            //.error(function(data, status, headers, config)
            //{
            //alert('error');
            //});



        }




    }).controller("hphysican_patients_Ctrl", function($scope,$http,$window,$timeout){

        // set the default amount of items being displayed

        $scope.url = base_url+"/homephysican/angular_patients";
        $http.post($scope.url,{'hphy_id':hphy_id})
            .success(function(data, status, headers, config)
            {
                $scope.hpatientdata = data;
                //console.log(data);
                // $window.location.href = base_url+'/hospital';
            })
            .error(function(data, status, headers, config)
            {
                alert('error');
            });

        $scope.limit= 10;

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





    }).controller("get_patient_reviewCtrl", function($scope,$http,$window,$timeout){

        $scope.get_patient_review= function(patientid){

            $scope.url = base_url+"/homephysican/angular_patients_review";
            $http.post($scope.url,{'hphy_id':hphy_id,'patientid':patientid})
                .success(function(data, status, headers, config)
                {
                    $scope.hpatientreview = data;
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



        }



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