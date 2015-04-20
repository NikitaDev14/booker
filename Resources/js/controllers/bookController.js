booker.controller('bookController', function ($scope, eventService, userService, userFactory, langFactory, roomFactory) {
    var self = this;

    Date.prototype.daysInMonth = function() {
        return 33 - new Date(this.getFullYear(), this.getMonth(), 33).getDate();
    };

    this.user = userFactory;
    this.lang = langFactory;
    this.baseDate = new Date(Number(localStorage.getItem('baseDate')));

    $scope.month = '3';

    if(true === this.user.isAdmin) {
        userService.getAllUsers(function (response) {
            self.users = response['users'];
        });
    }
    else {
        $scope.employee = self.user.id;
    }

    this.addEvent = function () {
        var date = $scope.year+'-'+$scope.month+'-'+$scope.day;
        var start = (($scope.startFormat === 'PM')? Number($scope.startHour) + 12 : $scope.startHour) +':'+$scope.startMin;
        var end = (($scope.endFormat === 'PM')? Number($scope.endHour) + 12 : $scope.endHour) +':'+$scope.endMin;

        eventService.addEvent(date, start, end, roomFactory.get(), $scope.employee, $scope.description, $scope.recurring, $scope.duration, function (response) {
            console.log(response);
        });
    };
});