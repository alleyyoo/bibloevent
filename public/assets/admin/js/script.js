$.fn.extend({
    animateCss: function (animationName, callback) {
        var animationEnd = (function (el) {
            var animations = {
                animation: 'animationend',
                OAnimation: 'oAnimationEnd',
                MozAnimation: 'mozAnimationEnd',
                WebkitAnimation: 'webkitAnimationEnd',
            };
            for (var t in animations) {
                if (el.style[t] !== undefined) {
                    return animations[t];
                }
            }
        })(document.createElement('div'));
        this.addClass('animated ' + animationName).one(animationEnd, function () {
            $(this).removeClass('animated ' + animationName);
            if (typeof callback === 'function') callback();
        });
        return this;
    },
});

$(function () {

    let state = "expanded";
    $('#open').click(function () {
        if (state === "expanded") {
            $('aside').addClass('open');
            //$('section').addClass('open');
            state = "minimized";
        } else {
            if (state === "minimized") {
                $('aside').removeClass('open');
                //$('section').removeClass('open');
                state = "expanded";
            }
        }
    });

});
