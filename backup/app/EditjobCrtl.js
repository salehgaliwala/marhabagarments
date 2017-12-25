app.controller('EditjobCtrl', function($scope, Data) {  
    
           $scope.doEditjob = function (customer) {
	        $location.path('editjob');
	        Data.post('editjob', {
	            customer: customer
	        }).then(function (results) {           
	              $scope.messages = results.results;
	           
	        });
  		  };
        }); 