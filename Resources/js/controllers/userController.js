booker.controller('userController',
    function ($scope, $http, userService, roomService, userFactory,
              roomFactory, calendarFactory, langFactory, $location, $window) {
        this.template = {
            email: '[0-9a-z_]+@[0-9a-z_]+\\.[a-z]{1,3}',
            password: '.{4,}',
            name : '[A-Za-z\- ]{3,}'
        };

        var self = this;

        this.lang = langFactory;
        this.user = userFactory;
        this.calendar = calendarFactory;
        this.room = roomFactory;

        userService.isValidUser(function (response) {

            self.isValidUser = Boolean(response);

            if(false === self.isValidUser) {

                self.user.remove();

                $location.path('/login');
            }
            else {
                self.user.save(response);

                roomService.getRooms(function (rooms) {
                    self.rooms = rooms['rooms'];
                });
            }
        });

        userService.isValidAdmin(function (response) {
            self.isValidAdmin = Boolean(response);

            if(true === self.isValidAdmin) {
                userService.getAllUsers(function (users) {
                    self.userList = users['users'];
                });
            }
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
                $window.location.reload();
            });
        };

        this.addUser = function (name, email, isAdmin,
                                 password, passwordRepeat) {

            userService.signup(name, email, isAdmin || 0,
                password, passwordRepeat, function (response) {

                    var mess = '';

                    if(true === Boolean(response)) {
                        mess = self.lang.template.emplList.addMessSucc;

                        $scope.newUserName =
                            $scope.newUserEmail =
                            $scope.newUserPassword =
                            $scope.newUserPasswordRepeat = '';

                        $window.location.reload;
                    }
                    else {
                        mess = self.lang.template.emplList.addMessFail;
                    }

                    alert(mess);
                });
        };

        this.removeUser = function (id) {
            if(true === confirm('Are you sure?')) {
                userService.removeUser(id, function (response) {
                    var mess = '';

                    if('1' === response) {
                        $window.location.reload();

                        mess = self.lang.template.emplList.addMessSucc;
                    }
                    else {
                        mess = self.lang.template.emplList.delMessFail;
                    }

                    alert(mess);
                });
            }
        };

        this.showUpdateMenu = function (id, name, email) {
            self.activeIdUser = id;
            $scope.userName = name;
            $scope.userEmail = email;
        };

        this.updateUser = function (newName, newEmail) {
            userService.updateUser(self.activeIdUser, newName,
                newEmail, function (response) {

                    if('1' === response) {
                        $('#employee').modal('hide');
                        $window.location.reload();
                    }
            });
        };
    });
