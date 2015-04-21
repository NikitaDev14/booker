booker.service('eventService', function ($http) {
    this.getEvents = function (year, month, room, callback) {
        $http.get('index.php'+
            '?controller=Index'+
            '&action=getAppointments'+
            '&year='+year+
            '&month='+month+
            '&room='+room
        ).success(callback);
    };
    this.addEvent = function (date, start, end, room, empl, descr, recurr, dur, callback) {
        $http.get('index.php'+
            '?controller=Appointment'+
            '&action=addAppointment'+
            '&date='+date+
            '&start='+start+
            '&end='+end+
            '&room='+room+
            '&empl='+empl+
            '&descr='+descr+
            '&recurr='+recurr+
            '&dur='+dur
        ).success(callback);
    };
    this.getEventDetails = function (idEvent, callback) {
        $http.get('index.php'+
            '?controller=Appointment'+
            '&action=getAppointmentDetails'+
            '&idAppn='+idEvent
        ).success(callback);
    };
});