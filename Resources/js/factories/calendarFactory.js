booker.factory('calendarFactory', function () {
    var params = {
        baseDate: null,
        firstDay: null
    };

    this.calendar = {};

    this.calendar.init = function (date, firstDay) {
        params.baseDate = new Date(date);
        params.firstDay = firstDay;

        this.createHeader();
        this.createBody();
    };

    this.calendar.createBody = function () {
        this.month = [];

        var date = new Date(params.baseDate);

        date.setDate(date.getDay() - date.getDay() + 1);

        var offset = (params.firstDay === 'mon')? (date.getDay() || 7) - 1 : date.getDay();
        var week = [];
        var month = date.getMonth();

        for(var i = 0; i < offset; i++) {
            week.push(null);
        }

        for(i = 0; i < 7 - offset; i++) {
            week.push(date.getDate());

            date.setDate(date.getDate() + 1);
        }

        this.month.push(week);

        while(date.getMonth() === month) {
            week = [];

            for(i = 0; i < 7; i++) {
                if(date.getMonth() !== month) {
                    break;
                }

                week.push(date.getDate());

                date.setDate(date.getDate() + 1);
            }

            this.month.push(week);
        }

        date.setDate(date.getDate() - 1);

        offset = (params.firstDay === 'mon')? 7 - (date.getDay() || 7) : 6 - date.getDay();

        for(i = 0; i < offset; i++) {
            week.push(null);
        }
    };

    this.calendar.createHeader = function () {
        this.header = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        if(this.header[6].toLowerCase().indexOf(params.firstDay) >= 0) {
            this.header.unshift(this.header.pop());
        }
        else if(this.header[1].toLowerCase().indexOf(params.firstDay) >= 0) {
            this.header.push(this.header.shift());
        }
    };

    return this.calendar;
});