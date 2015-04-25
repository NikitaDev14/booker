var TIMEZONE_OFFSET = (new Date()).getTimezoneOffset()/60;

booker.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.when('', '/');

    $urlRouterProvider.otherwise('/error_404');

    $stateProvider
        .state('default', {
            url: '/',
            templateUrl: 'Resources/html/calendar.html',
            controller: 'calendarController'
        })
        .state('event', {
            url: '/event/:id',
            templateUrl: 'Resources/html/event.html',
            controller: 'eventController'
        })
        .state('anotherDate', {
            url: '/:y/:m',
            templateUrl: 'Resources/html/calendar.html',
            controller: 'calendarController'
        })
        .state('login', {
            url: '/login',
            templateUrl: 'Resources/html/login.html',
            controller: 'userController'
        })
        .state('book', {
            url: '/book',
            templateUrl: 'Resources/html/book.html',
            controller: 'bookController'
        })
        .state('employeeList', {
            url: '/employee-list',
            templateUrl: 'Resources/html/employeeList.html',
            controller: 'userController'
        })
        .state('error 404', {
            url: '/error_404',
            templateUrl: 'Resources/html/404.html'
        });
});
