app.controller('DoCtrl', function($scope, Data, $http) {

            Data.get('/getdohistory').then(function (results) {
          // alert(JSON.stringify(results));
              $scope.allItems =results;
              $scope.resetAll();
        });

     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ;

     };

$scope.dosearch = function()
    {

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){

                     return dosearchUtil(item,$scope.doText);
                 });

        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    };

    $scope.doDelhistorydo = function (donum) {

        Data.post('Delhistorydo', {
            donum:donum
        }).then(function (results) {

            if (results == "success") {
                alert('Do Number Deleted');
                //$location.path('job');
                Data.get('/getdohistory').then(function (results) {
                    //alert(JSON.stringify(results));
                    $scope.allItems =results;
                    $scope.resetAll();
                });
            }
        });
    };

    /* Search Text in all 3 fields */
    function dosearchUtil(item,toSearch)
    {
        /* Search Text in all 3 fields */

        return ( item.donum.toLowerCase().indexOf(toSearch.toLowerCase()) > -1
            || item.companyname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1
            || item.locationname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1
            || item.datecreated.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 )
            ? true : false ;
    }


});



