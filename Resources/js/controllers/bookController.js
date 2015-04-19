booker.controller('bookController', function ($scope, userService, userFactory, langFactory) {
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
});