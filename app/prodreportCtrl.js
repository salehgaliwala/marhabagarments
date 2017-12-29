app.controller('prodreportCtrl', function($scope, Data) {  
    
    Data.get('/prodreport').then(function (results) {     
      // Lets keep the report empty initially.
      $scope.records ='';              
     
    }); 

     $scope.searchProdReport = function (prodreport) {
        Data.post('/prodreport', {
              prodreport:prodreport,

          }).then(function (results) {
                    $scope.records = results;               
            
          });

     }

     
});

