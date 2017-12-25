app.controller('EditCompanyControler',[
  '$scope','$http','$location','$routeParams',
  function ($scope, $http, $location, $routeParams) {
      var id = $routeParams.id;
      var obj = {};
      $http.get('api/v1/editcompany/'+id).then(function(results) {
           // alert(JSON.stringify(results));
            obj.get = results.data;
           $scope.editCompanies = obj;
  });

$scope.saveCompany = function (company) {
       // alert(JSON.stringify(signup));
       $http.post('api/v1/savecompany', {
            company: company
        }).then(function (results) {
          // alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            // alert(results.data.status);
            if (results.data.status == "success") {
            
               $scope.messages = 'Company Saved';
               $location.path('companies');

            }
        });
    };    
     
  }
]);