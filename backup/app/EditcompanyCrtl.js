app.controller('EditCompanyControler',[
  '$scope','$http','$location','$routeParams',
  function ($scope, $http, $location, $routeParams) {
      var id = $routeParams.id;
      var obj = {};
      $http.get('api/v1/editcompany/'+id).then(function(results) {
           // alert(JSON.stringify(results));
            obj.get = results.data;
           $scope.editUsers = obj;
  });

$scope.saveCompany = function (signup) {
       // alert(JSON.stringify(signup));
       $http.post('api/v1/savecompany', {
            signup: signup
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.status == "success") {
                $scope.messages = 'Company Saved';
               $location.path('companies');

            }
        });
    };    
     
  }
]);