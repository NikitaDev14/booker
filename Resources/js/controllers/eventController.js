booker.controller('eventController', function ($scope, userService, eventService, userFactory, langFactory, roomFactory, calendarFactory, $stateParams, $window) {
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
    });

    this.updateEvent = function () {

        eventService.updateEvent(self.event['idAppointment'], $scope.employee, Number($scope.recurred), ($scope.start.getTime()/1000+'').split('.')[0], ($scope.end.getTime()/1000+'').split('.')[0], $scope.description, function (response) {
            console.log(response);

            if('' === response) {
                self.messHead = 'Error';
                self.messText = 'You are not admin';
            }
            else if('0' === response) {
                self.messHead = 'Fail';
                self.messText = 'The event could not be updated';
            }
            else {
                self.messHead = 'Success';
                self.messText = 'The event updated successfully';

                $('#event').on('hidden.bs.modal', function (e) {
                    $window.location.reload();
                    $window.opener.location.reload();
                })
            }
        });
    };

    this.deleteEvent = function () {
        eventService.deleteEvent(self.event['idAppointment'], self.user.id, Number($scope.recurred), function (response) {
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

                $('#event').on('hidden.bs.modal', function (e) {
                    $window.opener.location.reload();
                    $window.close();
                })
            }
        });
    };
});