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
    this.signup = function (email, password, passwordRepeat, callback) {
        $http.post('index.php', {
            controller: 'User',
            action: 'signup',
            email: email,
            password: password,
            passwordRepeat: passwordRepeat
        }).success(callback);
    };
});