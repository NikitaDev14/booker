booker.controller('eventController', function ($scope, userService, eventService, roomFactory, userFactory, langFactory, calendarFactory, paginatorFactory, $stateParams, $window, $location) {
    var self = this;

    this.lang = langFactory;
    this.user = userFactory;

    if(true === this.user.isAdmin) {
        userService.getAllUsers(function (response) {
            self.users = response['users'];

            $scope.employee = self.user.id;
        });
    }
    else {
        $scope.employee = self.user.name;
    }

    eventService.getEventDetails($stateParams.id, function (response) {
        self.event = response['event'][0];

        $scope.start = new Date(Number(self.event.Start)*1000);
        $scope.end = new Date(Number(self.event.End)*1000);

        $scope.hstep = 1;
        $scope.mstep = 15;

        $scope.ismeridian = localStorage.getItem('timeForm') === 'hh:mm a';
    });
});