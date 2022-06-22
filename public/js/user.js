$(function () {
    $('.dropzone').html5imageupload({
        onAfterProcessImage: function () {
            var field = $(this.element).data('field');
            $('#' + field).val($(this.element).data('name'));
        },
        onAfterCancel: function () {
            var field = $(this.element).data('field');
            if ($('#' + field).val().length == 0) {
                $('#' + field).val('');
            }
        },
        onAfterRemoveImage: function () {
            var field = $(this.element).data('field');
            if (this.image == null) {
                $('#' + field).val('/images/user-1.jpg');
            }
        },
        onAfterResetImage: function () {
        }
    });
})