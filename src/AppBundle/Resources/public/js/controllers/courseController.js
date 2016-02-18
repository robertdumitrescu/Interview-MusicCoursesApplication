app.controller("CourseController", function ($rootScope, $http, $scope) {

    $scope.getCourse = function (level, id) {
        $http.get('data/course/' + level + "/" + id).
            success(function (data) {
                $rootScope.currentCourse = data;
                console.log(data);
            });
    };
});