app.controller('EditUserControler',[
  '$scope','$http','$location','$routeParams',
  function ($scope, $http, $location, $routeParams) {
      var id = $routeParams.id;
      var obj = {};
      $http.get('api/v1/edituser/'+id).then(function(results) {
           // alert(JSON.stringify(results));
            obj.get = results.data;
           $scope.editUsers = obj;
  });

$scope.saveUser = function (signup) {
       // alert(JSON.stringify(signup));
       $http.post('api/v1/saveuser', {
            signup: signup
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.data.status == "success") {
                $scope.messages = 'User Saved';
                $location.path('users');

            }
        });
    };    
     
  }
]);

app.controller('usercrtl',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
    var obj = {};
  $http.get('api/v1/users').then(function(results) {   
         // alert(JSON.stringify(results));        
            obj.get = results.data; 
            $scope.users = results.data;
  });
  $scope.setAssignto= function(k,i) {
        $http.post('api/v1/assignuser', {
            id: k,
            itemid : i
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.data.status == "success") {
                $scope.messages = 'User Saved';
                

            }
        });
    };    
        //your code here for storing in db
   
$scope.x = 'ABC';
}
]);