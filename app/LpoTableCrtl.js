app.controller('lpoCtrl', function($scope, Data) {  
    
            Data.get('/lpo').then(function (results) {
           //alert(JSON.stringify(results));        
              $scope.allItems =results;              
              $scope.resetAll(); 
        }); 
        
    $scope.doDellpo = function (id) {
        
        Data.post('dellpo', {
            id:id
        }).then(function (results) {           
            
            if (results == "success") {
                alert('LPO Deleted');
                //$location.path('job');
                  Data.get('/lpo').then(function (results) {
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

$scope.searchlpo = function()
    { 

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return lposearchUtil(item,$scope.searchText); 
                 });
        
        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    }  
    
   
 });

 /* Search Text in all 3 fields */
function lposearchUtil(item,toSearch)
{
    /* Search Text in all 3 fields */

    return (item.companyname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.lponum.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 )                              
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
    

app.controller('lpocrtljob',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
     $scope.populatelpos = function(companyid) {
        var obj = {};
        $http.get('api/v1/lpos/'+companyid).then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.lpos = results.data;
        });      
        
        } 
     // Initialize the LPOS on load for edit
     
     $scope.populatelpobynum = function(lponum) {
        var obj = {};
        $http.get('api/v1/populatelpobynum/'+lponum).then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.lpos = results.data;
        });      
        
        }             
    }
]);

app.controller('EditLpoControler',[
  '$scope','$http','$location','$routeParams',
  function ($scope, $http, $location, $routeParams) {
      var id = $routeParams.id;
      var obj = {};
      $http.get('api/v1/editlpo/'+id).then(function(results) {
           // alert(JSON.stringify(results));
            obj.get = results.data;
           $scope.editlpos = obj;
  });

$scope.saveLpo = function (lpo) {
       // alert(JSON.stringify(signup));
       $http.post('api/v1/savelpo', {
            lpo: lpo
        }).then(function (results) {
          // alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            // alert(results.data.status);
            if (results.data.status == "success") {
            
               $scope.messages = 'Lpo Saved';
               $location.path('lpo');

            }
        });
    };    
     
  }
]);