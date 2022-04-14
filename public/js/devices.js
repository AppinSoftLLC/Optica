$(function () {
    $('.add-item').on('click', function () {
        var _val = $('.check option:selected').val();
        if (_val != 0) {
            var _text = $('.check option:selected').text();
            var _li = $('<li/>', {
                'data-id': _val
            });
            var _group = $('<div/>').addClass('input-group');
            var _input = $('<input/>', {
                type: 'text',
                class: 'form-control',
                value: _text,
                readonly: 'readonly'
            });
            var _btn = $('<button/>', {
                type: 'button',
                text: 'Delete',
                class: 'btn btn-primary delete-check'
            });

            _group.append(_input).append(_btn);
            _li.append(_group);

            if ($(".message-list").find(`[data-id='${_val}']`).length) { 
                toastr["error"]("This is already added");
            } else {
                $('.message-list').append(_li);
                collectChecks();                
            }
            $(".check").val($(".check option:first").val());  
        } else {
            toastr["info"]("You need to select check item.");

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
    });

    $('body').on('click', '.delete-check', function () {
        $(this).parent().parent().remove();
        collectChecks();
    });
});

function collectChecks() {
    var _i = [];
    $('.message-list li').each(function () {
        _i.push($(this).data('id'));
        $('#devices_items').val(_i.join(':'));
    });
}