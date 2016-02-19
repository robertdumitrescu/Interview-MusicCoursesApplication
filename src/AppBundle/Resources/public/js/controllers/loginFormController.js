app.controller("loginFormController", function($scope, $http) {
    $scope.loginAttempt = function () {
        console.log($scope.loginFormUsername);
        console.log($scope.loginFormPassword);

        $http({
            url: '/app_dev.php/login_check',
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param({
                "_username" : $scope.loginFormUsername,
                "_password": $scope.loginFormPassword
            })
        })
            .then(function (response) {

                    console.log(response);

            });
    }
});