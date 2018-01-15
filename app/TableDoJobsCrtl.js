app.controller('TableDojobsCtrl', function($scope, Data) {  
    
            Data.get('/dojobs').then(function (results) {
          // alert(JSON.stringify(results));        
              $scope.allItems =results;              
             // $scope.resetAll(); 
        }); 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     }

$scope.search = function()
    { 

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return searchUtil(item,$scope.searchLocation,$scope.searchCompany);
                 });
        
        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    }  
    
   
 });

 /* Search Text in 2 fields */
function searchUtil(item,toSearchLocation,toSearchCompany)
{
    /* Search Text in 2 fields */

    return ( item.locationname.toLowerCase() === toSearchLocation.toLowerCase()  && item.company.toLowerCase() === toSearchCompany.toLowerCase())
                     ? true : false ;
}
