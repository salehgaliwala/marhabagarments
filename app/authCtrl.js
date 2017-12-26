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
        //alert(JSON.stringify(customer));     

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
                 $scope.addJob.location = '';
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

                 $scope.addJob.others = ''; 
                 $scope.addJob.qty4 = ''; 
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
    
    $scope.doAddLpo = function (lpo) {
       // alert(JSON.stringify(customer));
        Data.post('addlpo', {
            lpo: lpo
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
});