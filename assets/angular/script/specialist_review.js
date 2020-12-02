// JavaScript Document

var baseUrl = get_base_url(); 

var reviewapp = angular.module("hcare",["ngMaterial"]);

reviewapp.controller("specialistreviews", function($scope, $http){
    $scope.classifieds = "" ;
    $scope.showData = function( ){
      
        $http.get(base_url+'specialist/get_reviews').then(function(data){

            $scope.classifieds = data.data ;
            //alert(base_url+'specialist/get_reviews');
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