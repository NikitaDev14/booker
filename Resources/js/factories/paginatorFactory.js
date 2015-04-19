booker.factory('paginatorFactory', function () {
    var baseDate;

    this.paginator = {};

    this.paginator.init = function (date) {
        baseDate = new Date(date);

        localStorage.setItem('baseDate', baseDate.getTime());
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

    this.paginator.getBaseDate = function () {
        return new Date(baseDate);
    };

    return this.paginator;
});