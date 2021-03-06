app.controller('lpoCtrl', function($scope, Data) {  
    
            Data.get('/lpo').then(function (results) {
           // alert(JSON.stringify(results));


                $scope.allItems =lpoTableCal(results);
              $scope.resetAll(); 
        });


    lpoTableCal = function (results) {


        var allItems = [],i,j;

        for(j = 0,i= 0 ; j < results.length;i++) {


            allItems.push({lpoid: results[j].lpoid,lponum: results[j].lponum, companyname: results[j].companyname, location: results[j].location , Total : 0});

            while(allItems[i].lponum === results[j].lponum){

                if(typeof allItems[i][results[j].dressname] === 'undefined')
                allItems[i][results[j].dressname] = 0;

                allItems[i][results[j].dressname] += parseInt(results[j].qty);
                allItems[i]['Total'] +=  parseInt(results[j].qty);

                if(++j > results.length-1)
                    break;

            }
        }

        return allItems;
    }


    $scope.doDellpo = function (lponum) {
        
        Data.post('dellpo', {
            lponum:lponum
        }).then(function (results) {           
            
            if (results == "success") {
                alert('LPO Deleted');
                //$location.path('job');
                  Data.get('/lpo').then(function (results) {
            //alert(JSON.stringify(results));

              $scope.allItems =lpoTableCal(results);
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
