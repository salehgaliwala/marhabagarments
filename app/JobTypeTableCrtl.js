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

                     return jobsearchUtil(item,$scope.jobtypesearchText);
                 });

        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    }
 $scope.doDeljobtype = function (id) {

     Data.post('deljobtype', {
         id:id
     }).then(function (results) {

         if (results == "success") {
             alert('JobType Deleted');
             //$location.path('job');
             Data.get('/jobtypes').then(function (results) {
                 //alert(JSON.stringify(results));
                 $scope.allItems =results;
                 $scope.resetAll();
             });
         }
     });
 }

    /* Search Text in all 3 fields */
    function jobsearchUtil(item,toSearch)
    {
        /* Search Text in all 3 fields */

        return ( item.companyname.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.jobtypeid.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.jobtypename.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 )
            ? true : false ;
    }



 });