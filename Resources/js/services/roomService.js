booker.service('roomService', function ($http) {
    this.getRooms = function (callback) {
        $http.get('index.php?controller=Index&action=getRooms')
            .success(callback);
    };
});