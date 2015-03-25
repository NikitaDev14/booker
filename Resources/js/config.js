booker.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('default', {
            url: '/',
            templateUrl: 'Resources/html/calendar.html',
            controller: 'calendarCtrl'
        })
        .state('anotherDate', {
            url: '/:y/:m/:d',
            templateUrl: 'Resources/html/calendar.html',
            controller: 'calendarCtrl'
        })
});