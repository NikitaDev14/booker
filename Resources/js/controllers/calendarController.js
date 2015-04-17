booker.controller('calendarController', function ($scope, userService, calendarFactory, paginatorFactory, $stateParams, $location) {

    userService.isValidUser(function (response) {
        if('' === response) {
            $location.path('/login');
        }
    });

    var date;

    $scope.firstDay = $stateParams.d || 'mon';

    if($stateParams.y !== undefined && $stateParams.m !== undefined) {
        date = new Date($stateParams.y, $stateParams.m - 1, 1);
    }
    else {
        date = new Date();
    }

    this.paginator = paginatorFactory;
    this.calendar = calendarFactory;

    this.paginator.init(date);
    this.calendar.init(date, $scope.firstDay);
});