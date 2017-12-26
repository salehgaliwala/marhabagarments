app.controller('EditJobControler',[
  '$scope','$http','$location','$routeParams',
  function ($scope, $http, $location, $routeParams) {
      var id = $routeParams.id;
      var obj = {};     
      $http.get('api/v1/editjob/'+id).then(function(results) {
            //alert(JSON.stringify(results));
           obj.get = results.data;
           $scope.editJobs = obj;
 
  });
      
      


  $scope.doeditJob = function (customer) {
       // alert(JSON.stringify(customer));
       $http.post('api/v1/savejob', {
            customer: customer
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.data.status == "success") {
               $scope.messages = 'Job Saved';
               alert("Job Saved");
               $location.path('job');

            }
        });
    };    
     
  }


]);

app.controller('companycrtl',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
        var obj = {};
        $http.get('api/v1/companies').then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.companies = results.data;                  
        });
        $scope.x = 'ABC';
        $scope.populatejobtypes = function(companyid) {
        var obj = {};
        $http.get('api/v1/populatejobtypes/'+companyid).then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.jobtypes = results.data;
        });   
      };
    }

    
]);

app.controller('jobtypecrtljob',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {

      $scope.populatejobtypes = function(companyid) {
        var obj = {};
        $http.get('api/v1/populatejobtypes/'+companyid).then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.jobtypes = results.data;
        });   
      };
      $scope.populatejobtypesbyid = function(jobtypeid) {  
            var obj = {};         
            $http.get('api/v1/populatejobtypesbyid/'+jobtypeid).then(function(results) {
            //alert(JSON.stringify(results));
            obj.get = results.data; 
            $scope.jobtypes = results.data;
         });
     };       

    }   
]);

app.controller('jobcrtl',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
    var obj = {};
$scope.setStatus= function(k,i) {
        $http.post('api/v1/setStatus', {
            status: k,
            jobid : i
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.data.status == "success") {
                $scope.messages = 'Status Changed';
                

            }
        });
    };    
        //your code here for storing in db
   

}
]);

app.controller('queuestatuscrtl',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
    var obj = {};
$scope.setItemStatus= function(k,i) {
        $http.post('api/v1/setItemStatus', {
            status: k,
            jobitemid : i
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.data.status == "success") {
                $scope.messages = 'Status Changed';
                

            }
        });
    };    
        //your code here for storing in db
   

}
]);