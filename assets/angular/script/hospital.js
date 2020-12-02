var base_url= window.location.origin;







var hospital_app = angular.module("hcare",["ngMaterial",'angular-media-preview','ui.bootstrap','ngSanitize'])

    .controller("hospitalStaffCtrl", function($scope,$http){





        var url = base_url+"/specialist/get_data_staff";

        $http.get(url).success( function(response) {

            // console.log(response);

            $scope.hstaf_data = response;





        });



    }).controller("hospitalfacilitiesCtrl", function($scope,$http){









        var url = base_url+"/specialist/get_data_facilities";

        $http.get(url).success( function(response) {

            //console.log(response);

            $scope.hfacilities_data = response;

            //alert(response);







        });

    }).controller("hospitalDataCtrl", function($scope,$http){

        var url = base_url+"/specialist/get_data_hospital";

        $http.get(url).success( function(response) {

            $scope.hhospital_data = response;

        });

    })

    .controller("hospital_logo_user_dataCtrl", function($scope,$http){

        var url = base_url+"/specialist/get_data_hospital";

        $http.get(url).success( function(response) {

            $scope.hhospitalLogoUserData = response;

            //alert(response);

        });

    })

    .controller("hospital_profile_imageCtrl", function($scope,$http){

        //alert('ssssss');

        var url = base_url+"/specialist/get_hospital_image";

        $http.get(url).success( function(response) {



            $scope.slides = response;

            //alert(response);







        });

        $scope.myInterval = 15000000;



    })

    .controller("hospital_profile_images_info", function($scope,$http,$window){

        //alert('ssssss');

        var url = base_url+"/specialist/get_hospital_image";

        $http.get(url).success( function(response) {

            //alert('ssssss');

            $scope.slides = response;

            //alert(response);







        });

        $scope.myInterval = 15000000;



        $scope.delete = function(evnt) {


          
            $scope.ID= evnt;
            if ($window.confirm("Are you sure you want to delete this image?")) {



                data = {'ID': evnt};

                $scope.url = base_url+"specialist/remove_hospital_image";



                $http.post($scope.url,{'ID': $scope.ID})

                    .success(function(data, status, headers, config)

                    {
						$('#del'+$scope.ID).parent().remove();

                    })

                    .error(function(data, status, headers, config)

                    {

                        alert('error');

                    });

            }



            else {



            }

        }





    })

    .controller("hospital_working_timeCtrl", function($scope,$http){
		

        $scope.data = {

            availableOptions: [

                {id: '1', name: 'Enable'},

                {id: '0', name: 'Disable'},



            ],

            selectedOption: {id: '1', name: 'Enable'} //This sets the default value of the select in the ui

        };



        $scope.working_time_update= function(workingday,houseid,from_hr,to_hr,status){

            //alert(status);
			alert();

            // alert(workingday+''+houseid+''+from_hr+''+to_hr);



            data = {'userid': houseid,'houseid': houseid,'dayid':workingday,'from_hr':from_hr,'to_hr':to_hr,'status':status};

            $scope.url = base_url+'/specialist/update_working_hours';



            $http.post($scope.url,data)

                .success(function(data, status, headers, config)

                {



                    alert(data);

                    //$window.location.href = base_url+'/specialist';

                })

                .error(function(data, status, headers, config)

                {

                    alert('error');

                });
        }



    })

    .controller("hospital_working_hours_list", function($scope,$http){
        var url = base_url+"/specialist/get_working_hours_details";
        $http.get(url).success( function(response) {
            console.log(response);
            $scope.working_hours = response;
        });
    })

    .controller("hfaciltyCtrl", function($scope,$http){
        $scope.get_facility_data= function(hospitalid){
            $scope.url = base_url+"/specialist/get_hfaciliy_details";
            $http.post($scope.url,{'hospitalid':hospitalid})
                .success(function(data, status, headers, config)
                {
                    if(data){
                        $scope.hfacilitydata = data;    
                    }
                })
                .error(function(data, status, headers, config)
                {
                    alert('error');

                });
           }
        $scope.facilityDelete= function(facilityid){

            // alert('ssssssssss');



            //$scope.url = base_url+"/specialist/delete_hfaciliy_details";

            ///$http.post($scope.url,{'facilityid':facilityid})

            //.success(function(data, status, headers, config)

            //{

            //$scope.hfacilitydata = data;

            //	//alert(data);

            //$window.location.href = base_url+'/specialist';

            //})

            //.error(function(data, status, headers, config)

            //{

            //alert('error');

            //});







        }









    })

    .controller("hphysican_patients_Ctrl", function($scope,$http,$window,$timeout){



        // set the default amount of items being displayed



        $scope.url = base_url+"/homephysican/angular_patients";

        $http.post($scope.url,{'hphy_id':hphy_id})

            .success(function(data, status, headers, config)

            {

                $scope.hpatientdata = data;

                //console.log(data);

                // $window.location.href = base_url+'/specialist';

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











    })

    .controller("get_patient_reviewCtrl", function($scope,$http,$window,$timeout){



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

                    // $window.location.href = base_url+'/specialist';

                })

                .error(function(data, status, headers, config)

                {

                    alert('error');

                });



        }





    })

    .controller("patientReviewCtrl", function($scope,$http,$window,$timeout){



        //alert(patient_id);



        $scope.urlpending = base_url+"/patient/angular_pending_review";

        $http.post($scope.urlpending,{'patientid':patient_id})

            .success(function(data, status, headers, config)

            {

                $scope.hpatientPendingreview = data;

                console.log(data);

                if(data==''){

                    $scope.nofound= true;

                }

                // $window.location.href = base_url+'/specialist';

            })

            .error(function(data, status, headers, config)

            {

                alert('error');

            });







        $scope.url = base_url+"/patient/angular_recent_review";

        $http.post($scope.url,{'patientid':patient_id})

            .success(function(data, status, headers, config)

            {

                $scope.hpatientRecentreview = data;

                console.log(data);

                if(data==''){

                    $scope.nofound= true;

                }

                // $window.location.href = base_url+'/specialist';

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



    }).controller("editStaffCtrl", function($scope,$http,$window,$timeout){

		 

		$scope.get_details_for_staff =function(staff_id){

			$scope.divHtmlVar= "";

			$scope.url = base_url+"specialist/getSatffDetails";

            $http.post($scope.url,{'staff_id':staff_id})

			 .success(function(data, status, headers, config)

                {

                    $scope.hstaffdtailsByID = data;

                  $scope.divHtmlVar = $scope.divHtmlVar + '<br/><input type=text>';

                    if(data==''){

                        $scope.nofound= true;

                      }

                    // $window.location.href = base_url+'/specialist';

                })

                .error(function(data, status, headers, config)

                {

                      alert('error');

                });

			

		}

    });

var hospital_app = angular.module("hcare1",["ngMaterial",'angular-media-preview','ui.bootstrap'])



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



hospital_app.directive('fancybox',function($compile, $timeout){

    return {

        link: function($scope, element, attrs) {

            element.fancybox({

                hideOnOverlayClick:false,

                hideOnContentClick:false,

                enableEscapeButton:false,

                showNavArrows:false,

                onComplete: function(){

                    $timeout(function(){

                        $compile($(".modal-body"))($scope);

                        $scope.$apply();

                        $.fancybox.resize();

                    })

                }

            });

        }

    }

});

