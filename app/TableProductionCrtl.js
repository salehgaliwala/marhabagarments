app.controller('TableProductionCtrl', function($scope, Data) {
    
            Data.get('/production').then(function (results) {
          // alert(JSON.stringify(results));


              $scope.allItems = ProductionTableCal(results);
             // $scope.resetAll(); 
        });

    ProductionTableCal = function (results) {


        var allItems = [],i,j;

        for(j = 0,i= 0 ; j < results.length;i++) {


            allItems.push({jobid: results[j].jobid, slipno: results[j].slipno, name: results[j].name , status: results[j].status,
                           company: results[j].company, companyname: results[j].companyname, po: results[j].po,
                           jobtypename: results[j].jobtypename, locationname: results[j].locationname,
                           eid: results[j].eid, date: results[j].date, Total : 0});

            while(allItems[i].jobid === results[j].jobid){

                if(typeof allItems[i][results[j].dressname] === 'undefined')
                    allItems[i][results[j].dressname] = 0;

                allItems[i][results[j].dressname] += parseInt(results[j].qty);
                allItems[i]['Total'] +=  parseInt(results[j].qty);

                if(++j > results.length-1)
                    break;

            }
        }

        // console.log(allItems);

        return allItems;
    }
      
     $scope.resetAll = function()
     {
         $scope.filteredList = $scope.allItems ; 
        
     }

$scope.search = function()
    { 

        $scope.filteredList  = _.filter($scope.allItems,
                 function(item){  
                  
                     return searchUtilProd(item,$scope.searchCompany);
                 });
        
        if($scope.searchText == '')
        {
            $scope.filteredList = $scope.allItems ;
        }
    }  
    
   
 });

 /* Search Text in 2 fields */
function searchUtilProd(item,toSearchCompany)
{
    /* Search Text in 2 fields */

    return ( item.company.toLowerCase() === toSearchCompany.toLowerCase())
                     ? true : false ;
}
