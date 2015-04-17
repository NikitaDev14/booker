booker.factory('paginatorFactory', function () {
    var baseDate;

    this.paginator = {};

    this.paginator.init = function (date) {
        baseDate = new Date(date);
    };

    this.paginator.prev = function () {
        var temp = new Date(baseDate);

        temp.setMonth(baseDate.getMonth() - 1);

        return temp;
    };

    this.paginator.next = function () {
        var temp = new Date(baseDate);

        temp.setMonth(baseDate.getMonth() + 1);

        return temp;
    };

    this.paginator.monthToString = function () {
        return baseDate.toDateString().substring(4, 7);
    };

    this.paginator.getBaseDate = function () {
        return new Date(baseDate);
    };

    return this.paginator;
});