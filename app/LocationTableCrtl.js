app.controller('LocationCtrl', function($scope, Data) {
    
            Data.get('/locations').then(function (results) {
           // alert(JSON.stringify(results));
              $scope.allItems =results;              
              $scope.resetAll(); 
        }); 
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     }

    $scope.locationsearch = function()
    {

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){

                     return companysearchUtil(item,$scope.locationsearchText);
                 });
        
        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    }

    $scope.doDellocation = function (locationid) {

        Data.post('/dellocation', {
            locationid :locationid
        }).then(function (results) {

            if (results == "success") {
                alert('Location Deleted');
                //$location.path('job');
                Data.get('/locations').then(function (results) {
                    //alert(JSON.stringify(results));
                    $scope.allItems =results;
                    $scope.resetAll();
                });
            }
        });
    }
 });


 /* Search Text in all 3 fields */
function companysearchUtil(item,toSearch)
{
    /* Search Text in all 3 fields */

    return ( item.companyname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.locationid.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.locationname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 )
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
    