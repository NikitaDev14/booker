booker.controller('calendarController', function ($scope, dataServ, calendarFact, paginatorFact, $stateParams) {
    var date;

    $scope.firstDay = $stateParams.d || 'mon';

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