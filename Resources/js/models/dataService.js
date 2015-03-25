var booker = angular.module('booker', ['ui.router']);

booker.service('dataServ', function ($http) {
    this.getData = function (callback) {
        $http.get('https://localhost/booker/').success(callback);
    };
});