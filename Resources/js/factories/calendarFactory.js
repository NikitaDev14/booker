booker.factory('calendarFactory', function (eventService) {
    var params = {};

    var self = this;

    var getEventsOfDay = function (day) {
        var result = [];

        for(var event in params.events) {
            if((new Date(params.events[event].Date)).getDate() === day) {
                result.push(params.events[event]);
            }
        }

        return result;
    };

    this.calendar = {};

    this.calendar.setFirstDay = function (firstDay) {
        params.firstDay = firstDay;

        this.createHeader();
        this.createBody();

        localStorage.setItem('firstDay', firstDay);
    };

    this.calendar.setRoom = function (room) {
        params.room = room;

        this.load();

        localStorage.setItem('room', room);
    };

    this.calendar.load = function () {
        eventService.getEvents(params.baseDate.getFullYear(), params.baseDate.getMonth() + 1, params.room, function (response) {

            params.events = response['events'];

            self.calendar.createHeader();
            self.calendar.createBody();
        });
    };

    this.calendar.init = function (date, firstDay, header, room) {
        params.baseDate = new Date(date);
        params.firstDay = firstDay;
        params.header = [];
        params.room = room;

        for(var item in header) {
            params.header.push(item);
        }
    };

    this.calendar.createBody = function () {
        this.month = [];

        var date = new Date(params.baseDate);

        date.setDate(date.getDay() - date.getDay() + 1);

        var offset = (params.firstDay === 'mon')?
            (date.getDay() || 7) - 1 : date.getDay();

        var week = [];
        var month = date.getMonth();

        for(var i = 0; i < offset; i++) {
            week.push(null);
        }

        for(i = 0; i < 7 - offset; i++) {

            week.push({
                'date': date.getDate(),
                'day': date.getDay(),
                'events': getEventsOfDay(date.getDate())
            });

            date.setDate(date.getDate() + 1);
        }

        this.month.push(week);

        while(date.getMonth() === month) {
            week = [];

            for(i = 0; i < 7; i++) {
                if(date.getMonth() !== month) {
                    break;
                }

                week.push({
                    'date': date.getDate(),
                    'day': date.getDay(),
                    'events': getEventsOfDay(date.getDate())
                });

                date.setDate(date.getDate() + 1);
            }

            this.month.push(week);
        }

        date.setDate(date.getDate() - 1);

        offset = (params.firstDay === 'mon')?
            7 - (date.getDay() || 7) : 6 - date.getDay();

        for(i = 0; i < offset; i++) {
            week.push(null);
        }
    };

    this.calendar.createHeader = function () {
        this.header = params.header;

        if(this.header[6] === params.firstDay) {
            this.header.unshift(this.header.pop());
        }
        else if(this.header[1] === params.firstDay) {
            this.header.push(this.header.shift());
        }
    };

    return this.calendar;
});