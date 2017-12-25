app.controller('ReportCtrl',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
    var obj = {};
 /* $http.get('api/v1/getemployeejobreport').then(function(results) {   
         // alert(JSON.stringify(results));        
            obj.get = results.data; 
            $scope.item = results.data;
  });*/
  $scope.getemployeejobreport= function(i,j,k) {
        $http.post('api/v1/getemployeejobreport', {
            datefrom: i,
            dateto : j,
            userid:k,
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            obj.get = results.data; 
            $scope.items = results.data;
        });
    };    
        //your code here for storing in db
   
$scope.x = 'ABC';
}
]);