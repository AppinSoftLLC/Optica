!function (s) {
    "use strict";

    function e() { }
    e.prototype.init = function () {
        var _select = s(".select2").select2({
            tags: true,
            formatResult: function (e) {
                console.log(e.text + ' : ' + e.id);
            }
        }, s('.add-item').on('click', function () {
            console.log(_select.val());
        }))

        //     ,s("#timepicker").timepicker({
        //     icons: {
        //         up: "mdi mdi-chevron-up",
        //         down: "mdi mdi-chevron-down"
        //     },
        //     appendWidgetTo: "#timepicker-input-group1"
        // })
    }, s.AdvancedForm = new e, s.AdvancedForm.Constructor = e
}(window.jQuery),
    function () {
        "use strict";
        window.jQuery.AdvancedForm.init();
    }();

