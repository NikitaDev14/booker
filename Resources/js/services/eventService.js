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
    this.addEvent = function (date, start, end, room, empl, descr,
                              isRecurr, recurr, dur, callback) {
        $http.get('index.php'+
            '?controller=Appointment'+
            '&action=addAppointment'+
            '&date='+date+
            '&start='+start+
            '&end='+end+
            '&room='+room+
            '&empl='+empl+
            '&descr='+descr+
            '&isRecurr='+isRecurr+
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
    this.updateEvent = function (idEvent, idEmpl, isRecurr,
                                 start, end, descr, callback) {
        $http.get('index.php'+
            '?controller=Appointment'+
            '&action=updateAppointment'+
            '&idAppn='+idEvent+
            '&idEmpl='+idEmpl+
            '&isRecurr='+isRecurr+
            '&start='+start+
            '&end='+end+
            '&descr='+descr
        ).success(callback);
    };
    this.deleteEvent = function (idEvent, idEmpl, recurred, callback) {
        $http.get('index.php'+
            '?controller=Appointment'+
            '&action=deleteAppointment'+
            '&idAppn='+idEvent+
            '&idEmpl='+idEmpl+
            '&isRecurred='+recurred
        ).success(callback);
    };
});