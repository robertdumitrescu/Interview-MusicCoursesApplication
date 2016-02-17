var app = angular.module('myApp', []);

app.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

app.controller("InitController", function ($rootScope, $http, $scope) {

    $scope.getCourses = function () {
        $http.get('data/courses/1').
            success(function (data) {
                $rootScope.beginnerCourses = data;
                console.log(data);
            });

        $http.get('data/courses/2').
            success(function (data) {
                $rootScope.intermediateCourses = data;
                console.log(data);
            });

        $http.get('data/courses/3').
            success(function (data) {
                $rootScope.advancedCourses = data;
                console.log(data);
            });
    };
});

app.controller("CourseController", function ($rootScope, $http, $scope) {

    $scope.getCourse = function (level, id) {
        $http.get('data/course/' + level + "/" + id).
            success(function (data) {
                $rootScope.currentCourse = data;
                console.log(data);
            });
    };
});