booker.controller('eventController', function ($scope, userService, eventService, userFactory, langFactory, roomFactory, calendarFactory, $stateParams) {
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
        $scope.employee = self.user.id;
    }

    eventService.getEventDetails($stateParams.id, function (response) {
        self.event = response['event'][0];

        $scope.start = new Date((response['event'][0]['Start'].split('.'))[0]*1000);
        $scope.end = new Date((response['event'][0]['End'].split('.'))[0]*1000);

        $scope.hstep = 1;
        $scope.mstep = 15;

        $scope.ismeridian = localStorage.getItem('timeForm') === 'hh:mm a';
        $scope.recurred = false;
        $scope.description = self.event.Description;

        self.disabled = self.user.isAdmin == false || self.event.idRecurring == null || self.event.idEmployee != self.user.id || $scope.start < (new Date());
    });

    this.updateEvent = function () {

    };

    this.deleteEvent = function () {
        eventService.deleteEvent(self.event['idAppointment'], self.event['idEmployee'], $scope.recurred, function (response) {
            console.log(response);

            if('' === response) {
                self.messHead = 'Error';
                self.messText = 'You are not admin';
            }
            else if('0' === response) {
                self.messHead = 'Fail';
                self.messText = 'The event could not be deleted';
            }
            else {
                self.messHead = 'Success';
                self.messText = 'The event deleted successfully';
            }
        });
    };
});