app.controller('JobAssignCtrl', function($scope, Data,$http) {  
    
            Data.get('/queue').then(function (results) {
           //alert(JSON.stringify(results));        
              $scope.allItems =results;              
             // $scope.resetAll(); 
        }); 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     }

$scope.jobassignsearch = function()
    { 

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return jobassignsearchUtil(item,$scope.jobassignsearchText); 
                 });
        
        if($scope.jobassignsearchText == '')
        {
            //    $scope.filteredList = $scope.allItems ;
        }
    }  
 $scope.SetItemStatusForWorker = function(k,i) {
        $http.post('api/v1/SetItemStatusForWorker', {
            status: k,
            jobitemid : i
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.data.status == "success") {
                $scope.messages = 'Status Changed';
                

            }
    
    });
    };           
   
 });

 /* Search Text in all 3 fields */
function jobassignsearchUtil(item,toSearch)
{
    /* Search Text in all 3 fields */

    return ( item.jobitemid == toSearch )                              
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
    