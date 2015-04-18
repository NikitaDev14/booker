booker.factory('calendarFactory', function () {
    var params = {
        baseDate: null,
        firstDay: null
    };

    this.calendar = {};

    this.calendar.init = function (date, firstDay, header) {
        params.baseDate = new Date(date);
        params.firstDay = firstDay;

        var tempHeader = [];

        for(var item in header) {
            tempHeader.push(item)
        }

        this.createHeader(tempHeader);
        this.createBody();
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
                'day': date.getDay()
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
                    'day': date.getDay()
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

    this.calendar.createHeader = function (header) {
        this.header = header;

        if(this.header[6] === params.firstDay) {
            this.header.unshift(this.header.pop());
        }
        else if(this.header[1] === params.firstDay) {
            this.header.push(this.header.shift());
        }
    };

    return this.calendar;
});