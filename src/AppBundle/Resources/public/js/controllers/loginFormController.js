app.controller("loginFormController", function($scope, $http) {
    $scope.loginAttempt = function () {
        console.log($scope.loginFormUsername);
        console.log($scope.loginFormPassword);

        $http({
            url: '/login_check',
            method: "POST",
            data: {
                "username": $scope.loginFormUsername,
                "password": $scope.loginFormPassword
            }
        })
            .then(function (response) {

                    console.log(response);

            });
    }
});