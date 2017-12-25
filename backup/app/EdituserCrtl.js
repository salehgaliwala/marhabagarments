app.controller('EdituserCtrl', function($scope, Data) {  
    
           $scope.doEdituser = function (customer) {
	        $location.path('edituser');
	        Data.post('edituser', {
	            customer: customer
	        }).then(function (results) {           
	              $scope.messages = results.results;
	           
	        });
  		  };
        }); 