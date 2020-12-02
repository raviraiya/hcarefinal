// JavaScript Document
//var base_url= window.location.origin ;
var baseUrl = get_base_url();  
//var hCareApp = angular.module("staffList",["ngMaterial"]);


//alert(base_url);
var hCareApp = angular.module("hcare",["ngMaterial"]);
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




// var base_url= window.location.origin;
// myApp.controller("classified", function($scope, $http){
//     $http.get(base_url+'/angular/').then(function(data){
//         $scope.classifieds = data.data ;
//     });
// });

var myApp = angular.module("hcare",["ngMaterial"]).controller("hospitalStaffCtrl", function($scope,$http){


    var url = base_url+"/hospital/get_data_staff";
    $http.get(url).success( function(response) {
        //console.log(response);
        $scope.pro_cats = response;
        alert(response);

    });

});



var myApp1 = angular
    .module("hcare",["ngMaterial"]);
myApp1.controller("patientBookingClassified", function($scope, $http){
    //alert("xcc");
    $scope.patientBookingClassifieds = "" ;
    $http.get(base_url+'/specialist/dataList').then(function(data){
        //alert(data);  
        console.log(data);
        $scope.patientBookingClassifieds = data.data ;  
    }); 
    $scope.showData1 = function(category_name, procedure_name ){
        //alert(category_name);
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

var reviewapp = angular.module("hcare",["ngMaterial"]);

reviewapp.controller("specialistreviews", function($scope, $http){
    $scope.classifieds = "" ;
    $scope.showData = function( ){
      
        $http.get(base_url+'/specialist/get_reviews').then(function(data){

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

var specialistapp = angular.module("hcare",["ngMaterial"]);

specialistapp.controller("specialistcntrl", function($scope,$http) {
        var url = base_url+"/angular/get_procedure_cat_icon/";

        $http.get(url).success( function(response) {
            // console.log(response);
            $scope.pro_icon = response;

        });

        $scope.getproceduresname = function() {
            var url = base_url+"/angular/get_procedure_name";
            $http.get(url).success( function(response) {
                //console.log(response);
                $scope.pro_name = response;
            });
        }

        $scope.getspecialistdetail = function() {
            var url = base_url+"/angular/get_specialist_details_for_setting";
            $http.get(url).success( function(response) {
                // console.log(response);
                $scope.spDetails = response;
            });
        }

        $scope.getspecialistgeneralInfo = function() {
            var url = base_url+"/angular/get_specialist_general_info";
            $http.get(url).success( function(response) {
                $scope.spinfo = response;
                console.log(response);
            });
        }


        $scope.getspecialistLicense = function() {
            var url = base_url+"/angular/get_specialist_license_info";
            $http.get(url).success( function(response) {
                $scope.spLicence = response;
            });
        }


        $scope.getspecialistLanguages = function() {
            var url = base_url+"/angular/get_specialist_language";
            $http.get(url).success( function(response) {
//                console.log(response);
                var arr = $.map(response, function(el) { return el });
                if(arr != ''){
                    var aa = JSON.parse(arr);
                    $scope.spLanguage = aa.toString();
                    $('.langs').tagsinput('add', aa.toString());
                }
            });
        }



        $scope.getspecialistSpecialization = function() {
            var url = base_url+"/angular/get_specialist_specialization";
            $http.get(url).success( function(response) {
//                console.log(response);
                    var arr1 = $.map(response, function(el) { return el });
                    if(arr1  != ''){
                        var SPS = JSON.parse(arr1);
                        $scope.spSpliz = SPS.toString();
                        $('.specl').tagsinput('add', SPS.toString());
                    }

            });
        }

        $scope.getspecialistAward = function() {
            var url = base_url+"/angular/get_specialist_award";
            $http.get(url).success( function(response) {
                var arrS = $.map(response, function(el) { return el });
                if(arrS  != ''){
                    var arr1 = JSON.parse(arrS);
                        var cnt = arr1.length;
                         var award = [];
                        for(var k = 0; k < cnt ; k++){
                            award.push(arr1[k]['award_text'] + " Year: " + arr1[k]['award_date']);
                        }
                    $('.awards').tagsinput('add', award.toString());
                }
            });
        }



        $scope.getspecialistEducation= function() {
            var url = base_url+"/angular/get_specialist_education_list";
            $http.get(url).success( function(response) {
                // console.log(response);
                $scope.spEdu = response;
                });
        }


        $scope.getstaffCat = function() {
            var url = base_url+"/angular/get_staff_category";
            $http.get(url).success( function(response) {
                //console.log(response);
                $scope.pro_name = response;

            });

        }

        $scope.getstaffName = function() {
            var url = base_url+"/angular/get_staff_name";
            $http.get(url).success( function(response) {
                //console.log(response);
                $scope.pro_name = response;

            });

        }

        $scope.gethospitalDetails = function() {
            var url = base_url+"/angular/get_sp_hospital";
            $http.get(url).success( function(response) {
                // console.log(response);
                $scope.hospital = response;
            });

        }




//        $scope.getproceduresicon = function() {
//            var url = base_url+"/angular/get_procedure_cat_icon/";
//            $http.get(url).success( function(response) {
//                $scope.pro_icon = response;
//            });
//        }




    });