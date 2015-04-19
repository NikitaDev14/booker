booker.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('default', {
            url: '/',
            templateUrl: 'Resources/html/calendar.html',
            controller: 'calendarController'
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
        .state('event', {
            url: '/event/:id',
            templateUrl: 'Resources/html/event.html',
            controller: 'calendarController'
        })
        .state('error 404', {
            url: '/error_404',
            templateUrl: 'Resources/html/404.html'
        })
});