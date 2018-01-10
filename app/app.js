var app = angular.module('myApp', ['ngRoute', 'ngAnimate', 'toaster', 'ngTableToCsv']);

app.config(['$routeProvider',
  function ($routeProvider) {
        $routeProvider.
        when('/login', {
            title: 'Login',
            templateUrl: 'partials/login.html',
            controller: 'authCtrl'
        })
            .when('/logout', {
                title: 'Logout',
                templateUrl: 'partials/login.html',
                controller: 'logoutCtrl'
            })
            .when('/adduser', {
                title: 'Adduser',
                templateUrl: 'partials/signup.html',
                controller: 'authCtrl'
            })
            .when('/addcompany', {
                title: 'Addcompany',
                templateUrl: 'partials/addcompany.html',
                controller: 'authCtrl'
            })
            .when('/addlpo', {
                title: 'Addlpo',
                templateUrl: 'partials/addlpo.html',
                controller: 'lpoAddEditCtrl'
            })
            .when('/addjobtype', {
                title: 'AddJobType',
                templateUrl: 'partials/addjobtype.html',
                controller: 'authCtrl'
            })
            .when('/addjobstandalone', {
                title: 'Addcompany',
                templateUrl: 'partials/addjobstandalone.html',
                controller: 'authCtrl'
            })
            .when('/jobassign', {
                title: 'AssignJobs',
                templateUrl: 'partials/jobassign.html',
                controller: 'authCtrl'
            })
            .when('/dashboard', {
                title: 'Dashboard',
                templateUrl: 'partials/dashboard.html',
                controller: 'authCtrl'
            })
            .when('/addjob', {
                title: 'AddJob',
                templateUrl: 'partials/addjob.html',
                controller: 'authCtrl'
            })
             .when('/editjob/:id',
              {
                templateUrl: 'partials/editjob.html',
                controller: 'EditJobControler'
            })
             .when('/editlpo/:id',
              {
                templateUrl: 'partials/editlpo.html',
                controller: 'lpoAddEditCtrl'
            })
             .when('/edituser/:id',
              {
                templateUrl: 'partials/edituser.html',
                controller: 'EditUserControler'
            })
             .when('/editcompany/:id',
              {
                templateUrl: 'partials/editcompany.html',
                controller: 'EditCompanyControler'
            })
            .when('/editjobtype/:id',
              {
                templateUrl: 'partials/editjobtype.html',
                controller: 'EditJobtypeControler'
            }) 
            .when('/job', {
                title: 'Job',
                templateUrl: 'partials/job.html',
                controller: 'authCtrl'
            })
            .when('/lpo', {
                title: 'Job',
                templateUrl: 'partials/lpo.html',
                controller: 'authCtrl'
            })
            .when('/jobtype', {
                title: 'Job',
                templateUrl: 'partials/jobtype.html',
                controller: 'authCtrl'
            })
            .when('/employee-job-report', {
                title: 'Employee Job Report',
                templateUrl: 'partials/employeeJobReport.html',
                controller: 'authCtrl'
            })
               .when('/dojobs', {
                title: 'Delivery Orders Job',
                templateUrl: 'partials/dojobs.html',
                controller: 'authCtrl'
            })
               .when('/queue', {
                title: 'Job Queue',
                templateUrl: 'partials/queue.html',
                controller: 'authCtrl'
            })
              .when('/users', {
                title: 'users',
                templateUrl: 'partials/users.html',
                controller: 'authCtrl'
            })
               .when('/companies', {
                title: 'users',
                templateUrl: 'partials/companies.html',
                controller: 'authCtrl'
            })
               .when('/reportproduction', {
                title: 'users',
                templateUrl: 'partials/reportproduction.html',
                controller: 'authCtrl'
            })
            .when('/', {
                title: 'Login',
                templateUrl: 'partials/login.html',
                controller: 'authCtrl',
                role: '0'
            })
            .when('/location', {
                title: 'Location',
                templateUrl: 'partials/location.html',
                controller: 'authCtrl'
            })
            .when('/addlocation', {
                title: 'AddLocation',
                templateUrl: 'partials/addlocation.html',
                controller: 'authCtrl'
            })
            .when('/editlocation/:id',
                {
                    templateUrl: 'partials/editlocation.html',
                    controller: ''
                })
            .otherwise({
                redirectTo: '/login'
            });
  }])
    .run(function ($rootScope, $location, Data) {
        $rootScope.$on("$routeChangeStart", function (event, next, current) {
            $rootScope.authenticated = false;
            Data.get('session').then(function (results) {
                if (results.uid) {
                    $rootScope.authenticated = true;
                    $rootScope.uid = results.uid;
                    $rootScope.name = results.name;
                    $rootScope.email = results.email;
                } else {
                    var nextUrl = next.$$route.originalPath;
                    if (nextUrl == '/signup' || nextUrl == '/login') {

                    } else {
                        $location.path("/login");
                    }
                }
            });
        });
    });