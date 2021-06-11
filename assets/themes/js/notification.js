$(window).on('load', function() {
    WebPush.init({
        subscribe: sendEndpoint,
        unsubscribe: deleteEndpoint,
        denied: deniedPush,
        notSupport: notSupport,

    });
});

$(document).click(function(e) {
    var target = e.target;
    if(!$(target).is('.box-confirm-notification') && !$(target).is('#btn-notification') && !$(target).is('#img-notification')){
        $('.box-confirm-notification').removeClass('show');
    }
});

$(document).ready(function() {
    if (WebPush.isSupport()) {
        if (Notification.permission === 'denied') {
            deniedPush();
        }

        if (WebPushConfig.is_login && WebPushConfig.is_subscribed && !WebPush.subscribed) {
            ga('send', 'event', 'pushnotification', 'click ', 'dangky-tb-khac', 1);
            WebPush.subscribe();
        }

        $('#btn-notification').on('click', function () {
            if ($(this).parents('.frame-top').hasClass('no-pushnotification')) {
                ga('send', 'event', 'pushnotification', 'click ', 'dangnhap', 1);
                window.location.href = $(this).find('.redirect_url').val();
                return false;
            }

            if ($(this).hasClass('client_denied_notification')) {
                ga('send', 'event', 'pushnotification', 'click ', 'popup', 1);
                $('#modal_push_notification').modal('show');
                return false;
            }

            var $this = $(this);
            if ($this.find('#img-notification-week').length) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: WebPushConfig.confirm_url,
                    data: {},
                    success: function (data) {
                        $this.find('#img-notification-week').remove();
                    }
                });
            }

            if ($this.hasClass('btn-confirmation')) {
                if ($(this).find('.box-confirm-notification').hasClass('show')) {
                    $(this).find('.box-confirm-notification').removeClass('show');
                } else {
                    if ($(this).hasClass('denied_notification')) {
                        $(this).find('.box-register').addClass('show');
                    } else {
                        $(this).find('.box-cancel').addClass('show');
                    }
                }
            } else if ($this.hasClass('btn-subscribe')) {
                console.log('Subscribe');
                ga('send', 'event', 'pushnotification', 'click ', 'dangky', 1);
                WebPush.subscribe();
            }
        });
        $('.box-confirm-notification').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
        });
        $('.box-confirm-notification button').on('click', function () {
            $('.box-confirm-notification').removeClass('show');
        });
        $('#btn-notification .btn-unsubscribe').on('click', function () {
            console.log('Unsubscribe');
            ga('send', 'event', 'pushnotification', 'click ', 'huydangky', 1);
            deleteEndpoint();
            // WebPush.unsubscribe();
        });
        $('#btn-notification .btn-subscribe').on('click', function () {
            console.log('Subscribe 2');
            ga('send', 'event', 'pushnotification', 'click ', 'dangky', 1);
            WebPush.subscribe();
        });

        if (WebPushConfig.is_login && !WebPushConfig.is_subscribed && WebPushConfig.show_tip) {
            $('#btn-notification').popover({
                placement: 'top',
                title: false,
                originalTitle: false,
                html: true,
                content: 'Bật nhận thông báo để không bỏ lỡ việc làm phù hợp mỗi ngày!'
            }).on("show.bs.popover", function () {
                $(this).data("bs.popover").tip().addClass('new-function-tip');

                setTimeout(function () {
                    $('#btn-notification').popover('destroy');
                }, 5000);
            }).popover('show');
        }
    } else {
        // hide some items
    }
});

var sendEndpoint = function() {
    console.log('Hello');
    $.ajax({
        type: 'post',
        dataType : 'json',
        url: WebPushConfig.subscribe_url,
        data: {
            user_agent: navigator.userAgent,
            subscription: WebPush.subscription
        },
        success: function(data) {
            $('#btn-notification').removeClass('denied_notification').addClass('btn-confirmation');
            $('#btn-notification').attr("data-original-title", "Bạn đã cho phép nhận thông báo");
        }
    });
};

var deleteEndpoint = function() {
    $.ajax({
        type: 'post',
        dataType : 'json',
        url: WebPushConfig.unsubscribe_url,
        data: {
            subscription: WebPush.subscription
        },
        success: function(data) {
            $('#btn-notification').addClass('denied_notification');
            $('#btn-notification').attr("data-original-title", "Bạn đã từ chối nhận thông báo");
        }
    });
};

var deniedPush = function () {
    $('#btn-notification').addClass('denied_notification').addClass('client_denied_notification');
    $('#btn-notification').attr("data-original-title", "Bạn đã từ chối nhận thông báo");
};

var notSupport = function() {
    $('.box-notification').css('display', 'none');
    $('div.frame-top').addClass('no-pushnotification');
};