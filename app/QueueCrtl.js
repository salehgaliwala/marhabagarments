app.controller('QueueCtrl', function($scope, Data) {  
    
            Data.get('/queue').then(function (results) {
           //alert(JSON.stringify(results));        
              $scope.allItems =results;              
              $scope.resetAll(); 
        }); 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     }

$scope.queuesearch = function()
    { 

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return queuesearchUtil(item,$scope.queuesearchText); 
                 });
        
        if($scope.queuesearchText == '')
        {
                $scope.filteredList = $scope.allItems ;
        }
    }  
    
   
 });

 /* Search Text in all 3 fields */
function queuesearchUtil(item,toSearch)
{
    /* Search Text in all 3 fields */

    return ( item.jobitemid == toSearch || item.companyname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 ||  item.name.toLowerCase().indexOf(toSearch.toLowerCase()) > -1)                             
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
    