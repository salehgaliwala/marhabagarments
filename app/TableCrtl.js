app.controller('TableCtrl', function($scope, Data) {  
    
            Data.get('/job').then(function (results) {
           //alert(JSON.stringify(results));        
              $scope.allItems =results;              
              $scope.resetAll(); 
        }); 
        
    $scope.doDeljob = function (id) {
        
        Data.post('deljob', {
            id:id
        }).then(function (results) {           
            
            if (results == "success") {
                alert('Job Deleted');
                //$location.path('job');
                  Data.get('/job').then(function (results) {
            //alert(JSON.stringify(results));        
              $scope.allItems =results;              
              $scope.resetAll(); 
               }); 
            }
        });
    }; 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     }

$scope.search = function()
    { 

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return searchUtil(item,$scope.searchText); 
                 });
        
        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    }  
    
   
 });

 /* Search Text in all 3 fields */
function searchUtil(item,toSearch)
{
    /* Search Text in all 3 fields */

    return ( item.name.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.companyname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.jobid == toSearch
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
    