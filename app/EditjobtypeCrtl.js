app.controller('EditJobtypeControler',[
  '$scope','$http','$location','$routeParams',
  function ($scope, $http, $location, $routeParams) {
      var id = $routeParams.id;
      var obj = {};
      $http.get('api/v1/editjobtype/'+id).then(function(results) {
           // alert(JSON.stringify(results));
            obj.get = results.data;
           $scope.editjobtypes = obj;
  });

$scope.saveJobtype = function (jobtype) {
       // alert(JSON.stringify(signup));
       $http.post('api/v1/savejobtype', {
            jobtype: jobtype
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
           //alert(results.status);
            if (results.status == 200) {
                $scope.messages = 'Jobtype Saved';
               $location.path('jobtype');

            }
        });
    };    
     
  }
]);