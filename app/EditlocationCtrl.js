app.controller('EditLocationControler',[
  '$scope','$http','$location','$routeParams',
  function ($scope, $http, $location, $routeParams) {
      var id = $routeParams.id;
      var obj = {};
      $http.get('api/v1/editlocation/'+id).then(function(results) {
           // alert(JSON.stringify(results));
            obj.get = results.data;
           $scope.editlocations = obj;
  });

$scope.saveLocation = function (location) {
       // alert(JSON.stringify(location));
       $http.post('api/v1/savelocation', {
            location: location
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
           //alert(results.status);
            if (results.status == 200) {
                $scope.messages = 'Location Saved';
               $location.path('location');

            }
        });
    };    
     
  }
]);