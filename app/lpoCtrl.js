app.controller('lpoAddEditCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {

    $scope.doAddLpo = function (lpo,dress) {
        // alert(JSON.stringify(customer));
        // alert(JSON.stringify(lpo));
        Data.post('addlpo', {
            lpo: lpo, dress :dress
        }).then(function (results) {
            //  alert(JSON.stringify(results));
            Data.toast(results);
            //alert(results.message);
            if (results.status == "success") {
                $scope.messages = 'LPO Added';
                // alert($scope.messages);
                $location.path('lpo');

            }
            else
            {
                $scope.messages = results.message;
            }
        });
    };

    $scope.dresses = [];

    var id = $routeParams.id;
    var obj = {};
    $http.get('api/v1/editlpo/'+id).then(function(results) {
        // alert(JSON.stringify(results));
        // obj.get = results.data;
        $scope.lpo = results.data;

        var temp = results.data;
        $scope.plponum = temp[0].lponum;
        for(i=0 ; i < temp.length ;i++){
            $scope.dresses.push({'id': 'dress' + i,'dressid': temp[i].dressid ,'jobtype' : temp[i].jobtype , 'qty' : temp[i].qty, 'lpoid': temp[i].id});
            }
    });

    $scope.saveLpo = function (lpo,dress,plponum) {
        // alert(JSON.stringify(lpo));
        // alert(JSON.stringify(dress));
        $http.post('api/v1/savelpo', {
            lpo: lpo, dress : dress, plponum : plponum
        }).then(function (results) {
            // alert(JSON.stringify(results));
            //Data.toast(results);
            // alert(results.data.status);
            if (results.data.status == "success") {

                $scope.messages = 'Lpo Saved';
                $location.path('lpo');

            }
        });
    };

    //for same scope dress id
    $scope.addNewChoice = function () {
        var newItemNo = $scope.dresses.length + 1;
        $scope.dresses.push({'id': 'dress' + newItemNo});
    };

    $scope.removeChoice = function () {
        var lastItem = $scope.dresses.length - 1;
        $scope.dresses.splice(lastItem);
    };
    // Dress id lpo end

    $scope.populatecompany = function () {
        var obj1 = {};
        //Duplicated due to scope issues
        $http.get('api/v1/companies').then(function (results) {
            // alert(JSON.stringify(results));
            obj1.get = results.data;
            $scope.companies = results.data;
        });
    };

    $scope.x = '';
    $scope.populatejobtypes = function(companyid) {
        var obj2 = {};
        $http.get('api/v1/populatejobtypes/'+companyid).then(function(results) {
            // alert(JSON.stringify(results));
            obj2.get = results.data;
            $scope.jobtypes = results.data;
        });
    };
    //Added new
    $scope.populatelocation = function(companyid) {
        var obj3 = {};
        $http.get('api/v1/populatelocation/'+companyid).then(function(results) {
            // alert(JSON.stringify(results));
            // alert(JSON.stringify(companyid));
            obj3.get = results.data;
            $scope.locations = results.data;
            // alert(JSON.stringify($scope.locations));
        });
    };

    $scope.populatelocationbyid = function(locationid) {
        var obj4 = {};
        $http.get('api/v1/populatelocationbyid/'+locationid).then(function(results) {
            // alert(JSON.stringify(results));
            obj4.get = results.data;
            $scope.locations = results.data;
        });
    };

    //dress
    $scope.populatedress = function() {
        var obj = {};
        $http.get('api/v1/dresses').then(function(results) {
            // alert(JSON.stringify(results));
            obj.get = results.data;
            $scope.dresslist = results.data;
            // alert(JSON.stringify($scope.locations));
        });
    };
});
