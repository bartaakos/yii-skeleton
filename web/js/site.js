var site = site || {};

$(document).ready(function () {
    var tmpSite = site;

    site = {
        init: function () {
            this.foo();
        },

        foo: function () {
            // bar
        }
    };

    site.init();
});