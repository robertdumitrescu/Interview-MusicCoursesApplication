app.controller("loginHandlerController", function ($http, $scope, ngDialog) {

    $scope.open = function() {
        ngDialog.open({
            template: '/loginForm',
            controller: 'loginFormController'
        });
    };

});