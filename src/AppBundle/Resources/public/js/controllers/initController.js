app.controller("InitController", function ($rootScope, $http, $scope) {

    $scope.getCourses = function () {
        $http.get('data/courses/level/1').
            success(function (data) {
                $rootScope.beginnerCourses = data;
                console.log(data);
            });

        $http.get('data/courses/level/2').
            success(function (data) {
                $rootScope.intermediateCourses = data;
                //console.log(data);
            });

        $http.get('data/courses/level/3').
            success(function (data) {
                $rootScope.advancedCourses = data;
                //console.log(data);
            });
    };
});