app.controller('authCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
    $scope.editJob = {};
    $scope.doLogin = function (customer) {
        //alert(JSON.stringify(customer));
        Data.post('login', {
            customer: customer
        }).then(function (results) {
            Data.toast(results);
            //alert(results.role);
            if (results.role == "0") {
                //$scope.messages = results.status;
                $location.path('job');

            }
            if (results.role == "1") {
                //$scope.messages = results.status;
               // $location.path('addjobstandalone');
               $location.path('job');

            }
            if (results.role == "2") {
                //$scope.messages = results.status;
                $location.path('jobassign');

            }
        });
    };
    $scope.goToDoJobs = function (customer) {
            $location.path('dojobs');
      };
	  $scope.goToJob = function (customer) {
	  		$location.path('job');
	  };
    $scope.goTolpo = function (customer) {
        $location.path('job');
    };
      $scope.goToAddJob = function (customer) {
            $location.path('addjob');
      };
      $scope.goToAddLpo = function (customer) {
            $location.path('addlpo');
      };
      $scope.goToUser = function (customer) {
            $location.path('users');
      };
	  $scope.goToAdduser = function (customer) {
	  		$location.path('adduser');
	  };
        $scope.goToCompany = function (customer) {
            $location.path('companies');
      };
      $scope.goToAddCompany = function (customer) {
            $location.path('addcompany');
      };
      $scope.goToAddJobType = function (customer) {
            $location.path('addjobtype');
      };
     $scope.doAddjob = function (customer) {
        // alert(JSON.stringify(customer));

        Data.post('addjob', {
            customer: customer
        }).then(function (results) {
        	//alert(JSON.stringify(results));
            Data.toast(results);
            $scope.companies = results;
            if (results.status == "success") {
                $scope.messages = 'Job Added';
                alert("Job Created");
               // alert($scope.messages);
                // $location.path('job');
                 $scope.addJob.eid = '';
                 $scope.addJob.name = '';
                 // $scope.addJob.location = '';
                 $scope.addJob.dressid1 = ''; 
                 $scope.addJob.dressid2 = ''; 
                 $scope.addJob.dressid3 = ''; 
                 $scope.addJob.qty1 = '';
                 $scope.addJob.qty2 = '';
                 $scope.addJob.qty3 = '';
                 $scope.addJob.item1.s1 = '';
                 $scope.addJob.item1.s2 = '';
                 $scope.addJob.item1.s3 = '';
                 $scope.addJob.item1.s4 = '';
                 $scope.addJob.item1.s5 = '';
                 $scope.addJob.item1.s6 = '';
                 $scope.addJob.item1.s7 = '';
                 $scope.addJob.item1.s8 = '';

                 $scope.addJob.item2.s1 = '';
                 $scope.addJob.item2.s2 = '';
                 $scope.addJob.item2.s5 = '';
                 $scope.addJob.item2.s9 = '';
                 $scope.addJob.item2.s14 = '';
                 $scope.addJob.item2.s10 = '';
                 $scope.addJob.item2.s11 = '';

                 $scope.addJob.item3.s1 = '';
                 $scope.addJob.item3.s2 = '';
                 $scope.addJob.item3.s3 = '';
                 $scope.addJob.item3.s4 = '';
                 $scope.addJob.item3.s5 = '';
                 $scope.addJob.item3.s6 = '';
                 $scope.addJob.item3.s12 = '';
                 $scope.addJob.item3.s13 = '';

                 $scope.addJob.qtytie = '';
                 $scope.addJob.qtybelt = '';
                 $scope.addJob.qtybow = '';
                 $scope.addJob.qtycap = '';
                 $scope.addJob.qtyscarf = '';
                 $scope.addJob.qtyapron = '';
                 $scope.addJob.qtycoverall = '';
                 $scope.addJob.qtyshoes = '';
                 $scope.addJob.qtyother = '';
                 $scope.addJob.slipno = '';

/*                 $scope.addJob.others = '';
                 $scope.addJob.qty4 = ''; */


            }
            else
            {
              $scope.messages = results.message;
            }  
        });
    };
    
    $scope.doAddcompany = function (company) {
       // alert(JSON.stringify(customer));
        Data.post('addcompany', {
            company: company
        }).then(function (results) {
          //  alert(JSON.stringify(results));
            Data.toast(results);
            
            if (results.data.status == "success") {
                $scope.messages = 'Company Added';
               // alert($scope.messages);
                 $location.path('companies');

            }
        });
    };
    
    $scope.doAddLpo = function (lpo,dress) {
       // alert(JSON.stringify(customer));
       alert(JSON.stringify(lpo));
       alert(JSON.stringify(dress));
        Data.post('addlpo', {
            lpo: lpo, dress :dress
        }).then(function (results) {
          //  alert(JSON.stringify(results));
            Data.toast(results);
            //alert(results.message);
            if (results.status == "success") {
                $scope.messages = 'LPO Added';
               // alert($scope.messages);
                 $location.path('lpo');

            }
            else
            {
               $scope.messages = results.message;
            }
        });
    };


    //for same scope dress id
    $scope.dresses = [{id: 'dress1'}, {id: 'dress2'}];

    $scope.addNewChoice = function () {
        var newItemNo = $scope.dresses.length + 1;
        $scope.dresses.push({'id': 'dress' + newItemNo});
    };

    $scope.removeChoice = function () {
        var lastItem = $scope.dresses.length - 1;
        $scope.dresses.splice(lastItem);
    };
    // Dress id lpo end

    $scope.doAddJobType = function (jobtype) {
       // alert(JSON.stringify(customer));
        Data.post('addjobtype', {
            jobtype: jobtype
        }).then(function (results) {
          //  alert(JSON.stringify(results));
            Data.toast(results);

            if (results.status == "success") {
                $scope.messages = 'Job Type Added';
               // alert($scope.messages);
                 $location.path('jobtype');

            }
        });
    };

    $scope.loadcompany = function() {
        var obj = {};
        $http.get('api/v1/companies').then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.companies = results.data;
        });
      }
    $scope.signup = {username:'',password:'',name:''};
    $scope.signUp = function (customer) {
        Data.post('adduser', {
            customer: customer
        }).then(function (results) {
            Data.toast(results);
            if (results.status == "success") {
                $location.path('login');
            }
        });
    };
    $scope.logout = function () {
        Data.get('logout').then(function (results) {
            Data.toast(results);
            $location.path('login');
        });
    }

    //Location
    $scope.goToAddLocation = function () {
        $location.path('addlocation');
    };

    $scope.doAddLocation = function (location) {
        // locationalert(JSON.stringify(location));
        Data.post('addlocation', {
            location: location
        }).then(function (results) {
            //  alert(JSON.stringify(results));
            Data.toast(results);

            if (results.status == "success") {
                $scope.messages = 'Location Added';
                // alert($scope.messages);
                //   $location.path('location');

            }
        });
    };
});