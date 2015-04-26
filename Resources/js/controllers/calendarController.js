booker.controller('calendarController', function ($scope, eventService, roomFactory, langFactory, calendarFactory, paginatorFactory, $stateParams, $window) {

    var self = this;

    $scope.firstDay = localStorage.getItem('firstDay') || 'mon';

    $scope.timeFormat = $scope.timeFormat || 'HH:mm';

    this.showEvent = function (id) {
        $window.open('#/event/'+id, '_blank',
            'width=500,height=650,resizable=0,status=0,menubar=0,toolbar=0,location=0,scrollbars=0');
    };

    this.setTimeFormat = function (timeForm) {

        $scope.timeFormat = timeForm || localStorage.getItem('timeForm') || 'HH:mm';

        localStorage.setItem('timeForm', $scope.timeFormat);
    };

    this.setTimeFormat();

    if($stateParams.y !== undefined && $stateParams.m !== undefined) {
        self.date = new Date($stateParams.y, $stateParams.m - 1, 1);
    }
    else {
        self.date = new Date();
    }

    this.paginator = paginatorFactory;
    this.calendar = calendarFactory;

    this.lang = langFactory;

    this.paginator.init(self.date);

    this.calendar.init(self.date, $scope.firstDay, self.lang.template.days, roomFactory.get());
    this.calendar.load();
});
