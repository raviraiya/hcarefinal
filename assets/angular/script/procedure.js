// JavaScript Document
var base_url= window.location.origin ;

var myApp = angular
    .module("hcare",["ngMaterial"])
    .controller("procedurecntrl", function($scope,$http) {
        var url = base_url+"/angular/get_procedure_cat_icon/";
        $http.get(url).success( function(response) {
            $scope.pro_icon = response;
        });
        $scope.getprocedures = function(id) {
            var url = base_url+"/angular/get_procedures/"+id;
            $http.get(url).success( function(response) {
                $scope.procedures=response;
                //console.log(response);
                //$scope.pro_cats = response;

            });

            //console.log($scope.selitem);
            // use $scope.selectedItem.code and $scope.selectedItem.name here
            // for other stuff ...
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