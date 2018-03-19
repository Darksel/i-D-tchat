var App = (function() {

    var tchatSelector = '#tchat'
    var formSelector = '#post-message';
    var contentMessageSelector = '#content-message';

    var init = function() {

        refreshMessage();

        if ($(formSelector).length > 0) {
            $(document).on('submit', formSelector, postMessage);
            $(document).on('keyup', contentMessageSelector, removeErrorClass);
        }
    };

    var postMessage = function(e) {
        e.preventDefault();
        $form = $(this);

        $.post($form.attr('action'),
            {
                content: $form.find('input[name="content"]').val()
            }, function(data) {
                var status = data['status'];

                if (status == true) {
                    $(tchatSelector).html(data['view']);
                    $(contentMessageSelector).val('');
                    $(tchatSelector).scrollTop($(tchatSelector)[0].scrollHeight);
                } else {
                    $(formSelector).addClass('has-error');
                }
            }
        );
    }

    var removeErrorClass = function() {
        $input = $(this);
        $form = $(this).parent();

        if ($form.hasClass('has-error')) {
            $form.removeClass('has-error');
        }
    }

    var refreshMessage = function() {
        var interval = 3000;
        var refresh = function() {

            $.ajax({
                url: '/?controller=message&action=refresh',
                success: function(data) {
                    var status = data['status'];

                    if (status == true) {
                        $(tchatSelector).html(data['view']);
                    }
                    setTimeout(function() {
                        refresh();
                    }, interval);
                }
            });
        };
        refresh();
    }

    return {
        init: init
    };
})();

$(document).ready(function() {
    App.init();
});
