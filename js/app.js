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
