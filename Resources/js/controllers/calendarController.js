booker.controller('calendarController', function ($scope, langFactory, calendarFactory, paginatorFactory, $stateParams) {

    var self = this;
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

    this.lang = langFactory;

    this.paginator.init(date);
    this.calendar.init(date, $scope.firstDay, self.lang.template.days);
});