booker.controller('bookController',
    function ($scope, eventService, userService,
              userFactory, langFactory, roomFactory) {

    var self = this;

    this.user = userFactory;
    this.lang = langFactory;
    this.baseDate = new Date(Number(localStorage.getItem('baseDate')));
    this.form = $scope;

    if(true === this.user.isAdmin) {
        userService.getAllUsers(function (response) {
            self.users = response['users'];

            $scope.employee = self.user.id;
        });
    }
    else {
        $scope.employee = self.user.id;
    }

    this.addEvent = function () {
        eventService.addEvent(
            (new Date($scope.date).getTime()/1000+'').split('.')[0],
            ($scope.start.getTime()/1000+'').split('.')[0],
            ($scope.end.getTime()/1000+'').split('.')[0],
            roomFactory.get(),
            $scope.employee,
            $scope.description || '',
            $scope.isRecurring,
            ('0' === $scope.isRecurring)? '' : $scope.recurring,
            ('0' === $scope.isRecurring)? '' : $scope.duration,
            function (response) {

            if('' === response) {
                self.messHead = self.lang.template.book.messHeadErr;
                self.messText = self.lang.template.book.messTextErr;
            }
            else if('0' === response) {
                self.messHead = self.lang.template.book.messHeadFail;
                self.messText = self.lang.template.book.messTextFail;
            }
            else if('1' === response) {

                /*
                var start = new Date($scope.start.getTime());
                start.setUTCHours(start.getUTCHours() + TIMEZONE_OFFSET);

                var end = new Date($scope.end.getTime());
                end.setUTCHours(end.getUTCHours() + TIMEZONE_OFFSET);
                */

                $scope.date = '';

                self.messHead = self.lang.template.book.messHeadSucc;
                self.messText = self.lang.template.book.messTextSucc +
                    $scope.start.getHours()+':'+$scope.start.getMinutes()+
                    '-'+$scope.end.getHours()+':'+$scope.end.getMinutes()+
                    '. '+$scope.description;
            }
        });
    };

    $scope.isRecurring = '0';
    $scope.recurring = 'weekly';
    $scope.duration = 1;

    // Disable weekend selection
    $scope.disabled = function(date, mode) {
        return (mode === 'day'
            && (date.getUTCDay() === 0
            || date.getUTCDay() === 6));
    };

    $scope.minDate = (new Date()).getTime();

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

    var start = new Date();
    //start.setUTCHours(start.getHours()-TIMEZONE_OFFSET);
    //start.setUTCMinutes(0);

    start.setMinutes(0);
 
    var end = new Date(start);
    //end.setUTCHours(start.getUTCHours()+1);

    end.setHours(start.getHours()+1);

    $scope.start = start;
    $scope.end = end;

    $scope.hstep = 1;
    $scope.mstep = 15;

    $scope.ismeridian = localStorage.getItem('timeForm') === 'hh:mm a';
});
