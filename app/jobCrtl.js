app.controller('EditJobControler',[
  '$scope','$http','$location','$routeParams',
  function ($scope, $http, $location, $routeParams) {
      var id = $routeParams.id;
      var obj = {};


      $http.get('api/v1/editjob/'+id).then(function(results) {
            // alert(JSON.stringify(results));
           obj.get = results.data;
           $scope.editJobs = obj;

  });
      

  $scope.doeditJob = function (customer) {
       // alert(JSON.stringify(customer));
       $http.post('api/v1/savejob', {
            customer: customer
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.data.status == "success") {
               $scope.messages = 'Job Saved';
               alert("Job Saved");
               $location.path('job');

            }
        });
    };    
     
  }


]);

app.controller('companycrtl',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
        var obj = {};
        $http.get('api/v1/companies').then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.companies = results.data;                  
        });
        $scope.x = 'ABC';
        $scope.populatejobtypes = function(companyid) {
        var obj = {};
        $http.get('api/v1/populatejobtypes/'+companyid).then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.jobtypes = results.data;
        });   
      };

       $scope.populatejobtypesbyid = function(jobtypeid) {
           var obj = {};
           $http.get('api/v1/populatejobtypesbyid/'+jobtypeid).then(function(results) {
               //alert(JSON.stringify(results));
               obj.get = results.data;
               $scope.jobtypes = results.data;
           });
       };

       //Added new
       $scope.populatelocation = function(companyid) {
           var obj = {};
           $http.get('api/v1/populatelocation/'+companyid).then(function(results) {
               // alert(JSON.stringify(results));
               obj.get = results.data;
               $scope.locations = results.data;
               // alert(JSON.stringify($scope.locations));
           });
       };

       $scope.populatelocationbyid = function(locationid) {
           var obj = {};
           $http.get('api/v1/populatelocationbyid/'+locationid).then(function(results) {
               // alert(JSON.stringify(results));
               obj.get = results.data;
               $scope.locations = results.data;
           });
       };

       $scope.populateLocationJobtypebylpo = function (lponum) {
          var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

           $http.get('api/v1/populatelocationjobtypebylponum/' + Base64.encode(lponum)).then(function (results) {

               $scope.jobtypes = results.data;
               $scope.locations = results.data;
               if(typeof $scope.locations[0].location !== 'undefined')
               $scope.addJob.location = $scope.locations[0].location;

           });
       }



   }

    
]);

app.controller('jobtypecrtljob',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {

      $scope.populatejobtypes = function(companyid) {
        var obj = {};
        $http.get('api/v1/populatejobtypes/'+companyid).then(function(results) {   
               // alert(JSON.stringify(results));        
                  obj.get = results.data; 
                  $scope.jobtypes = results.data;
        });   
      };
      $scope.populatejobtypesbyid = function(jobtypeid) {  
            var obj = {};         
            $http.get('api/v1/populatejobtypesbyid/'+jobtypeid).then(function(results) {
            //alert(JSON.stringify(results));
            obj.get = results.data; 
            $scope.jobtypes = results.data;
         });
     };       

    }   
]);

app.controller('jobcrtl',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
    var obj = {};
$scope.setStatus= function(k,i) {
        $http.post('api/v1/setStatus', {
            status: k,
            jobid : i
        }).then(function (results) {
            //alert(JSON.stringify(results));
            //Data.toast(results);
           // $scope.companies = results;
            if (results.data.status == "success") {
                $scope.messages = 'Status Changed';
                

            }
        });
    };    
        //your code here for storing in db
   

}
]);

app.controller('queuestatuscrtl',[
  '$scope','$http','$location','$routeParams',
   function($scope, $http) {
    var obj = {};
$scope.setItemStatus= function(k,i) {
        $http.post('api/v1/setItemStatus', {
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
        //your code here for storing in db
   

}
]);
