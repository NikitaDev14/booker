booker.factory('langFactory', function (langService) {
    var self = this;

    this.lang = {
        template: {}
    };

    this.lang.set = function (lang) {
        localStorage.setItem('lang', lang || 'ua');
    };
    this.lang.get = function () {
        return localStorage.getItem('lang') || 'ua';
    };

    this.lang.changeLang = function (lang) {
        self.lang.set(lang);

        langService.getLang(self.lang.get(), function (data) {
            self.lang.template = data;
        });
    };

    this.lang.changeLang(this.lang.get());

    return this.lang;
});