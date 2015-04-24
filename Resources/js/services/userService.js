booker.service('userService', function ($http) {
    this.isValidUser = function (callback) {
        $http.get('index.php?controller=User&action=validateUser').
            success(callback);
    };
    this.isValidAdmin = function (callback) {
        $http.get('index.php?controller=User&action=validateAdmin').
            success(callback);
    };
    this.getAllUsers = function (callback) {
        $http.get('index.php?controller=User&action=getAllUsers').
            success(callback);
    };
    this.logout = function (callback) {
        $http.get('index.php?controller=User&action=logout').
            success(callback);
    };
    this.login = function (email, password, callback) {
        $http.post('index.php', {
            controller: 'User',
            action: 'login',
            email: email,
            password: password
        }).success(callback);
    };
    this.signup = function (name, email, isAdmin, password, passwordRepeat, callback) {
        $http.post('index.php', {
            controller: 'User',
            action: 'signup',
            name: name,
            email: email,
            isAdmin: isAdmin,
            password: password,
            passwordRepeat: passwordRepeat
        }).success(callback);
    };
    this.removeUser = function (idEmpl, callback) {
        $http.get('index.php' +
            '?controller=User' +
            '&action=removeUser' +
            '&idEmpl='+idEmpl
        ).success(callback);
    };
    this.updateUser = function (idEmpl, newName, newEmail, callback) {
        $http.post('index.php', {
            controller: 'User',
            action: 'updateUser',
            idEmpl: idEmpl,
            name: newName,
            email: newEmail
        }).success(callback);
    };
});