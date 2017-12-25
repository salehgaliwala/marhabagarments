//Demo of Searching and Sorting Table with AngularJS
var myApp = angular.module('myApp',[]);
  
 myApp.controller('TableCtrl', ['$scope', function($scope) {  
    
    $scope.allItems = getDummyData(); 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
         $scope.newEmpId = '';
         $scope.newName = '';
         $scope.newEmail = '';
         $scope.searchText = ''; 
     }
     
     
     $scope.add = function()
     {
         $scope.allItems.push({EmpId : $scope.newEmpId, name : $scope.newName, Email:$scope.newEmail});
         $scope.resetAll();  
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
    
    $scope.resetAll();       
}]);
 
/* Search Text in all 3 fields */
function searchUtil(item,toSearch)
{
    /* Search Text in all 3 fields */
    return ( item.name.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.Email.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.EmpId == toSearch
                            )                              
                     ? true : false ;
}

/*Get Dummy Data for Example*/
function getDummyData()
{
    return [
         {EmpId:2, name:'Jitendra', Email: 'jz@gmail.com'},
         {EmpId:1, name:'Minal', Email: 'amz@gmail.com'},
         {EmpId:3, name:'Rudra', Email: 'ruz@gmail.com'} 
        ];
}