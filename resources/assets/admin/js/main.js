const token = $('meta[name="csrf-token"]').attr('content');
let interval;
let reload = function(){
    $.ajax({
        url: location.href,
        beforeSend: function() {
            $('.ajax-wr').css({
                'opacity': '.2',
            })
        },
        complete: function() {
            $('.ajax-wr').css({
                'opacity': '1',
            })
        }
    })
    .done(function(data){
        var domStr = '.ajax-wr',
            response = $(data).find(domStr);

        $(domStr).html(response.html());
    });
};

$(function(){

    if ($('.reload-page').length){
        if (localStorage.getItem('autoReload')){
            $('#auto-reload').prop('checked', true);
        }

        var seconds = $('.seconds').val();
        var interval = setInterval(function(){
            if ($('#auto-reload').prop('checked')){
                reload();
            }
        }, seconds * 1000);
    }
});


$(document).on('keyup', '.seconds', function(event){
    seconds = parseInt($(this).val()) || 1;

    clearInterval(interval);
    interval = setInterval(function(){
        if ($('#auto-reload').prop('checked')){
            reload();
        }
    }, seconds * 1000);
});


$(document).on('click', '.reload', function(event){
    event.preventDefault();
    reload();
});

$(document).on('change', '#auto-reload', function(event){
    var _this = $(this);

    if (_this.prop('checked')){
        localStorage.setItem('autoReload', 'true');
    }else{
        localStorage.setItem('autoReload', '');
    }

});

$(document).on('change', '.create-content-form #type', function(event){
    event.preventDefault();

    var _this = $(this),
        form = _this.closest('form'),
        value = _this.val();

    form.find('.show-for').hide();

    form.find('.for-' + value).show();
    form.find('.for-' + value).show();
});
var formTypeInput = $('.create-content-form #type');
if (formTypeInput.length){
    formTypeInput.change();
}

$(document).on('change', '.app-mode-image', function(event){
    event.preventDefault();

    var _this = $(this),
        form = _this.closest('form');

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize() + '&_token=' + token,
    });

    return false;
});

$(document).on('change', '.app-video-mode', function(event){
    event.preventDefault();

    var _this = $(this),
        form = _this.closest('form');

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize() + '&_token=' + token,
    });

    return false;
});

$("#delete-no-moderated").submit(function( event ) {
    if (confirm('Delete all tweets with no moderate?')){
        return true;
    }

    event.preventDefault();
});

$(document).on('change', '.approve-action', function(event){
    event.preventDefault();

    var _this = $(this),
        form = _this.closest('form'),
        tweet = _this.closest('.tweet');

    _this.closest('.tweet').removeClass('unread');
    _this.closest('.tweet').find('input[type="radio"]').prop('checked', false);
    _this.prop('checked', true);

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize() + '&_token=' + token,
        beforeSend: function() {
            _this.closest('.tweet').css({
                'opacity': '.1',
            })
        },
        complete: function() {
            _this.closest('.tweet').css({
                'opacity': '1',
            })
        }
    })
        .done(function(){
            $.ajax({
                url: tweet.attr('data-moderate-url'),
                type: 'post',
                data: {
                    _token : token,
                    tweet : tweet.attr('data-tweet-id'),
                },
            })
        });

    return false;
});

$(document).on('click', '.delete-tweet', function(event){
    if (confirm('Are you shure?')){
        var
            _this = $(this),
            tweet = _this.closest('.tweet'),
            form = _this.closest('form');

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize() + '&_token=' + token,
            beforeSend: function() {
                tweet.css({
                    'opacity': '.1',
                })
            },
            complete: function() {
                tweet.remove();
            }
        })
    }
    event.preventDefault();
});

$(document).on('click', '.delete-content', function(event){
    if (confirm('Are you shure?')){
        var
            _this = $(this),
            card = _this.closest('.card'),
            form = _this.closest('form');

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize() + '&_token=' + token,
            beforeSend: function() {
                card.css({
                    'opacity': '.1',
                })
            },
            complete: function() {
                card.remove();
            }
        })
    }
    event.preventDefault();
});

$(document).on('keyup', '#tweet', function(){
    let _this = $(this),
        val = _this.val().split('/').pop(),
        form = _this.closest('form'),
        url = form.attr('data-get-tweet-url').replace('#', val);

    $('.save-tweet').prop('disabled', true);

    if (val.length <= 3){
        return;
    }

    _this.addClass('loading');

    $.ajax({
        url: url,
        beforeSend: function() {
            $('#result').css({
                'opacity': '.2',
            })
        },
        complete: function() {
            $('#result').css({
                'opacity': '1',
            })
            _this.removeClass('loading');
        }
    })
        .fail(function () {
            $('#result').html('No tweets was found');
            _this.removeClass('loading');
        })
        .done(function(data){
            $('#result').html($(data).html());
            $('.save-tweet').prop('disabled', false);
        });
});


$(function () {
    $('.date-input').datetimepicker({
        format: 'DD-MM-YYYY HH:mm:ss',
        locale: 'ru',
    }).on('dp.change', function(e){
        console.log($(e.currentTarget).val());
    });
});

$(document).on('change', '.mark-default', function(event){
    event.preventDefault();

    var _this = $(this),
        form = _this.closest('form');

    if (_this.prop('checked')){
        $('.mark-default').prop('checked', false);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize() + '&_token=' + token,
        });
    }

    _this.prop('checked', true);

    return false;
});