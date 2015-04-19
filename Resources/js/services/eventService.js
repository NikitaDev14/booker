booker.service('eventService', function ($http) {
    this.getEvents = function (year, month, room, callback) {
        $http.get('index.php?controller=Index' +
            '&action=getAppointments'+
            '&year='+year+
            '&month='+month+
            '&room='+room
        ).success(callback);
    };
});