app.controller('JobTypeCtrl', function($scope, Data) {  
    
            Data.get('/jobtypes').then(function (results) {
          // alert(JSON.stringify(results));        
              $scope.allItems =results;              
              $scope.resetAll(); 
        }); 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     }

$scope.jobtypesearch = function()
    { 

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return companysearchUtil(item,$scope.jobtypesearchText); 
                 });
        
        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    }  
    
   
 });

 /* Search Text in all 3 fields */
function companysearchUtil(item,toSearch)
{
    /* Search Text in all 3 fields */

    return ( item.companyname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.jobtypeid.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.jobtypename.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 )                              
                     ? true : false ;
}


     function getDummyData()
{
return [
 {JobId:2, company:'Jitendra', name: 'jz@gmail.com'},
 {JobId:1, company:'Minal', name: 'amz@gmail.com'},
 {JobId:3, company:'Rudra', name: 'ruz@gmail.com'} 
];
}
    