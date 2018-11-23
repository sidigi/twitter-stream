let seconds = 5,
    appMode,
    msnry;

Array.prototype.diff = function(a) {
    return this.filter(function(i) {return a.indexOf(i) < 0;});
};

if ($('.page-wrapper').length){
    msnry = new Masonry('.tweets-masonry', {
        itemSelector: '.tweet-box'
    });
}

setInterval(function(){
    $.ajax({
        url: location.href,
        cache: false,
        success: function(data){
            var mode = $(data).find('.app-mode').attr('data-app-mode');

            if (appMode !== mode){
                $('.app-wrapper').html($(data).find('.app-wrapper'));
                appMode = mode;
                return;
            }else{
                if (mode === 'tweet-list' && $('.page-wrapper').length){
                    $('.page-wrapper').html($(data).find('.page-wrapper').html());
                    msnry = new Masonry('.tweets-masonry', {
                        itemSelector: '.tweet-box'
                    });
                }

                if (mode === 'image'){
                    $('.app-wrapper').html($(data).find('.app-wrapper'));
                }
            }
        }
    });
}, seconds * 1000);