booker.factory('roomFactory', function () {

    this.room = {};

    this.room.set = function (room) {
        localStorage.setItem('room', room || '1');
    };
    this.room.get = function () {
        return localStorage.getItem('room') || '1';
    };

    return this.room;
});