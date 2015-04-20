booker.controller('bookController', function ($scope, eventService, userService, userFactory, langFactory, roomFactory, $log) {
    var self = this;

    this.user = userFactory;
    this.lang = langFactory;
    this.baseDate = new Date(Number(localStorage.getItem('baseDate')));

    if(true === this.user.isAdmin) {
        userService.getAllUsers(function (response) {
            self.users = response['users'];
        });
    }
    else {
        $scope.employee = self.user.id;
    }

    this.addEvent = function () {
        var temp = new Date($scope.date);

        var date =
            temp.getFullYear()+'-'+
            (temp.getMonth()+1)+'-'+
            temp.getDate();

        var start =
            $scope.start.getHours()+':'+
            (($scope.start.getMinutes() === 0) ?
                '00' : $scope.start.getMinutes());

        var end =
            $scope.end.getHours()+':'+
            (($scope.end.getMinutes() === 0) ?
                '00' : $scope.end.getMinutes());

        eventService.addEvent(date, start, end, roomFactory.get(), $scope.employee, $scope.description, $scope.recurring, $scope.duration, function (response) {
            console.log(response);
        });
    };

    $scope.date = (new Date()).getTime();

    // Disable weekend selection
    $scope.disabled = function(date, mode) {
        return (mode === 'day'
            && (date.getDay() === 0
            || date.getDay() === 6));
    };

    $scope.minDate = new Date();


    $scope.open = function($event) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.opened = true;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.format = 'dd.MM.yyyy';

    //////////////////////////////////////////////////////////////

    var start = new Date((new Date).setMinutes(0));
    var end = new Date((new Date(start)).setHours(start.getHours()+1));

    $scope.start = start;
    $scope.end = end;

    $scope.hstep = 1;
    $scope.mstep = 15;

    $scope.ismeridian = localStorage.getItem('timeForm') === 'hh:mm a';

    /*
    $scope.update = function() {
        var d = new Date();
        d.setHours( 14 );
        d.setMinutes( 0 );
        $scope.mytime = d;
    };
    */
});