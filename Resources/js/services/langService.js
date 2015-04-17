booker.service('langService', function ($http) {
    this.getLang = function (lang, callback) {
        $http.get('Resources/langs/' + lang + '.json').success(callback);
    };
});