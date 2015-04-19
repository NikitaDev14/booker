booker.controller('userController',
    function ($scope, $http, userService, roomService, roomFactory, calendarFactory, langFactory, $location) {
        this.template = {
            email: '[0-9a-z_]+@[0-9a-z_]+\\.[a-z]{1,3}',
            password: '.{4,}'
        };

        var self = this;

        this.lang = langFactory;
        this.calendar = calendarFactory;
        this.room = roomFactory;

        userService.isValidUser(function (response) {

            self.isValidUser = Boolean(response);

            if(false === self.isValidUser) {
                $location.path('/login');
            }
            else {
                self.user = response;

                roomService.getRooms(function (rooms) {
                    self.rooms = rooms['rooms'];
                });
            }
        });

        userService.isValidAdmin(function (response) {
            self.isValidAdmin = Boolean(response);
        });

        this.login = function () {
            userService.login($scope.email,
                $scope.password, function (response) {

                if ('' === response) {
                    self.response = self.lang.template.login.wrongDataMess;
                }
                else {
                    $location.path('/');
                }
            });
        };

        this.logout = function () {
            userService.logout(function () {
                $location.path('/login');
            });
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