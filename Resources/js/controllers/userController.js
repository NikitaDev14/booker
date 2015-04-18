booker.controller('userController',
    function ($scope, $http, userService, userFactory, langFactory, $location) {
        this.template = {
            email: '[0-9a-z_]+@[0-9a-z_]+\\.[a-z]{1,3}',
            password: '.{4,}'
        };

        var self = this;

        this.lang = langFactory;
        this.user = userFactory;

        userService.isValidUser(function (response) {

            self.isValidUser = Boolean(response);

            if(false === self.isValidUser) {
                self.user.remove();

                $location.path('/login');
            }
            else {
                self.user.save(response.idUser, response.name, response.isAdmin);
            }
        });

        this.login = function () {
            userService.login($scope.email, $scope.password, function (response) {

                if ('' === response) {
                    self.response = self.lang.template.login.wrongDataMess;
                }
                else {
                    self.user.save(response.idUser, response.name, response.isAdmin);

                    $location.path('/');
                }
            });
        };

        this.logout = function () {
            userService.logout();

            self.user.remove();

            $location.path('/login');
        };

        this.signup = function () {
            userService.signup($scope.email, $scope.password,
                $scope.passwordRepeat, function (data) {

                    if ('1' === data) {
                        $location.path('/');
                    }
                    else {
                        self.message = 'This email has already registered.';
                    }
                });
        };
    });