var booker = angular.module('booker', ['ui.router']);

booker.service('dataServ', function ($http) {
    this.getData = function (callback) {
        $http.get('https://localhost/booker/').success(callback);
    };
});

booker.factory('paginator', function () {
    this.paginator = {
        baseDate: new Date()
    };

    this.paginator.prev = function () {
        var temp = new Date(this.baseDate);

        temp.setMonth(this.baseDate.getMonth() - 1);

        return temp;
    };

    this.paginator.next = function () {
        var temp = new Date(this.baseDate);

        temp.setMonth(this.baseDate.getMonth() + 1);

        return temp;
    };
    
    this.paginator.monthToString = function () {
        return this.baseDate.toDateString().substring(4, 7);
    };

    return this.paginator;
});

booker.factory('calendarFact', function () {
    this.calendar = {
        month: []
    };

    this.calendar.create = function (date) {
        this.month = [];
        this.baseDate = new Date(date);

        this.baseDate.setDate(this.baseDate.getDay() - this.baseDate.getDay() + 1);

        var offset = (this.baseDate.getDay() || 7) - 1;
        var week = [];
        var month = this.baseDate.getMonth();

        for(var i = 0; i < offset; i++) {
            week.push(null);
        }

        for(i = 0; i < 7 - offset; i++) {
            week.push(this.baseDate.getDate());

            this.baseDate.setDate(this.baseDate.getDate() + 1);
        }

        this.month.push(week);

        while(this.baseDate.getMonth() === month) {
            week = [];

            for(i = 0; i < 7; i++) {
                if(this.baseDate.getMonth() !== month) {
                    break;
                }

                week.push(this.baseDate.getDate());

                this.baseDate.setDate(this.baseDate.getDate() + 1);
            }

            this.month.push(week);
        }

        this.baseDate.setDate(this.baseDate.getDate() - 1);

        offset = 7 - (this.baseDate.getDay() || 7);

        for(i = 0; i < offset; i++) {
            week.push(null);
        }
    };

    return this.calendar;
});

booker.controller('calendarCtrl', function (dataServ, calendarFact, paginator, $stateParams) {
    var date;

    if($stateParams.y !== undefined && $stateParams.m !== undefined) {
        date = new Date($stateParams.y, $stateParams.m - 1, 1);
    }
    else{
        date = new Date();
    }

    paginator.baseDate = date;
    calendarFact.create(date);

    this.paginator = paginator;
    this.calendar = calendarFact;
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