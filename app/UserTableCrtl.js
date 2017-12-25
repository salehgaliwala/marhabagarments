app.controller('UserTableCtrl', function($scope, Data) {  
    
            Data.get('/users').then(function (results) {
          // alert(JSON.stringify(results));        
              $scope.allItems =results;              
              $scope.resetAll(); 
        }); 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     }

$scope.usersearch = function()
    { 

      // alert("Test");
        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return usersearchUtil(item,$scope.usersearchText); 
                 });
        
        if($scope.usersearchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    }  
    
   
 });

 /* Search Text in all 3 fields */
function usersearchUtil(item,toSearch)
{
    /* Search Text in all 3 fields */

    return ( item.name.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.username.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.uid == toSearch
                            )                              
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
    