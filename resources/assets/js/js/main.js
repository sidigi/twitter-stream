let seconds = 5,
    msnry;

Array.prototype.diff = function(a) {
    return this.filter(function(i) {return a.indexOf(i) < 0;});
};

msnry = new Masonry('.tweets-masonry', {
    itemSelector: '.tweet-box'
});

setInterval(function(){
    $.ajax({
        url: location.href,
        success: function(data){
            $('.page-wrapper').html($(data).find('.page-wrapper').html());
            msnry = new Masonry('.tweets-masonry', {
                itemSelector: '.tweet-box'
            });
        }
    });
}, seconds * 1000);