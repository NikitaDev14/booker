booker.factory('userFactory', function () {
    var self = this;

    this.user = {
        'isValid' : false,
        'id' : null,
        'name' : null,
        'isAdmin' : null
    };

    this.user.save = function (id, name, isAdmin) {

        self.user.id = id;
        self.user.name = name;
        self.user.isAdmin = Boolean(Number(isAdmin));
    };

    this.user.remove = function () {

        self.user.id = self.user.name = self.user.isAdmin = null;
    };

    return this.user;
});