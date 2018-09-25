/*
 Warte bis HTML DOM fertig geladen
 */

$(document).ready(function () {

    // Home Seite - klick zum runterscrollen
    $('#anchor').on('click', function (e) {
        e.preventDefault();
        scrollToElement('#steps')
    });

});

/*
 Eigene Funktionen
 */

/**
 * Scroll To Element
 * @param id
 */
function scrollToElement(id) {
    var $target = $(document).find(id);
    $('html, body').animate({
        scrollTop: $target.offset().top
    }, 750);
}

/**
 * Toast Notification
 * @param content
 * @param type
 * @returns {jQuery.fn.init|jQuery|HTMLElement}
 */
function toast(content, type) {
    var $toast = $('<div class="toast-alert fade in">' + content + '</div>');
    type = type || 'default';
    $toast.addClass('toast-' + type);
    $('body').append($toast);
    window.setTimeout(function () {
        $toast.remove();
    }, 7500);
    return $toast;
}
