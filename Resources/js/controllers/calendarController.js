booker.controller('calendarController', function ($scope, eventService, roomFactory, langFactory, calendarFactory, paginatorFactory, $stateParams) {

    var self = this;
    var date;

    $scope.firstDay = $stateParams.d || 'mon';
    $scope.timeFormat = $scope.timeFormat || 'HH:mm';

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

    this.events = eventService.getEvents(date.getFullYear(), date.getMonth() + 1, roomFactory.get(), function (response) {
        self.events = response['events'];

        self.calendar.init(date, $scope.firstDay, self.lang.template.days, response['events']);
    });
});