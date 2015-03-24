var booker = angular.module('booker', ['ui.router']);

booker.service('dataServ', function ($http) {
    this.getData = function (callback) {
        $http.get('https://localhost/booker/').success(callback);
    };
});

booker.factory('paginatorFact', function () {
    var baseDate;

    this.paginator = {};

    this.paginator.init = function (date) {
        baseDate = new Date(date);
    };

    this.paginator.prev = function () {
        var temp = new Date(baseDate);

        temp.setMonth(baseDate.getMonth() - 1);

        return temp;
    };

    this.paginator.next = function () {
        var temp = new Date(baseDate);

        temp.setMonth(baseDate.getMonth() + 1);

        return temp;
    };
    
    this.paginator.monthToString = function () {
        return baseDate.toDateString().substring(4, 7);
    };

    this.paginator.getBaseDate = function () {
        return new Date(baseDate);
    };

    return this.paginator;
});

booker.factory('calendarFact', function () {
    var params = {
        baseDate: null,
        firstDay: null
    };

    this.calendar = {};

    this.calendar.init = function (date, firstDay) {
        params.baseDate = new Date(date);
        params.firstDay = firstDay;

        this.createBody();
    };

    this.calendar.createBody = function () {
        this.month = [];

        var date = new Date(params.baseDate);

        date.setDate(date.getDay() - date.getDay() + 1);

        var offset = (date.getDay() || 7) - 1;
        var week = [];
        var month = date.getMonth();

        for(var i = 0; i < offset; i++) {
            week.push(null);
        }

        for(i = 0; i < 7 - offset; i++) {
            week.push(date.getDate());

            date.setDate(date.getDate() + 1);
        }

        this.month.push(week);

        while(date.getMonth() === month) {
            week = [];

            for(i = 0; i < 7; i++) {
                if(date.getMonth() !== month) {
                    break;
                }

                week.push(date.getDate());

                date.setDate(date.getDate() + 1);
            }

            this.month.push(week);
        }

        date.setDate(date.getDate() - 1);

        offset = 7 - (date.getDay() || 7);

        for(i = 0; i < offset; i++) {
            week.push(null);
        }

        return this.month;
    };

    this.calendar.createHeader = function () {
        this.header = [];

        alert()
    };

    return this.calendar;
});

booker.controller('calendarCtrl', function ($scope, dataServ, calendarFact, paginatorFact, $stateParams) {
    var date;
    $scope.firstDay = $scope.firstDay || 'Mon';

    if($stateParams.y !== undefined && $stateParams.m !== undefined) {
        date = new Date($stateParams.y, $stateParams.m - 1, 1);
    }
    else {
        date = new Date();
    }

    this.paginator = paginatorFact;
    this.calendar = calendarFact;

    this.paginator.init(date);
    this.calendar.init(date, $scope.firstDay);
});

booker.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('default', {
            url: '/',
            templateUrl: 'Resources/html/calendar.html',
            controller: 'calendarCtrl'
        })
        .state('anotherDate', {
            url: '/:y/:m',
            templateUrl: 'Resources/html/calendar.html',
            controller: 'calendarCtrl'
        })
});