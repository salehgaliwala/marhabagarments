app.controller('ProdCtrl', function($scope, Data, $http) {
    
            Data.get('/getprodhistory').then(function (results) {
          // alert(JSON.stringify(results));        
              $scope.allItems =results;              
              $scope.resetAll(); 
        }); 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     };

    $scope.prodsearch = function()
    {

        console.log("here");

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return productionsearchUtil(item,$scope.doText);
                 });
        
        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    };

    $scope.doDelhistoryprod = function (prodnum) {

        Data.post('Delhistoryprod', {
            prodnum:prodnum
        }).then(function (results) {

            if (results == "success") {
                alert('Production Number Deleted');
                //$location.path('job');
                Data.get('/getprodhistory').then(function (results) {
                    //alert(JSON.stringify(results));
                    $scope.allItems =results;
                    $scope.resetAll();
                });
            }
        });
    };

    /* Search Text in all 3 fields */
    function productionsearchUtil(item,toSearch)
    {
        /* Search Text in all 3 fields */

        return ( item.prodnum.toLowerCase().indexOf(toSearch.toLowerCase()) > -1
                 || item.companyname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1
                 || item.locationname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1
            || item.datecreated.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 )
            ? true : false ;
    }

});



