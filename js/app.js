/*
 Warte bis HTML DOM fertig geladen
 */

$(document).ready(function () {
    // Mobile Menu
    $('#toggleNav').click(function () {
        $(this).toggleClass('open');
        $('#mobileMenu').toggleClass('open');
    });

    // Home Seite - klick zum runterscrollen
    $('#anchor').on('click', function (e) {
        e.preventDefault();
        scrollToElement('#steps')
    });

    $('#tables_list .card').on('click', function () {
        // id von tisch erhalten
        var id = $(this).data('id');
        // weiterleiten zu tisch ansicht
        window.location = window.location.href + "/" + id;
    });

    if (isUrl(/(tisch\/(\d{1,}))/)) {
        seite_bestellung();
    }

    /*
     * Tisch Platz Auswahl
     */
    $('.place').find('input[type="checkbox"]').on('change', function (e) {
        // alle platze am tisch
        var $seats = $(this).closest('.table').find('.place').find('input[type="checkbox"]');

        // geklickten platz zwischenspeichern
        var $_this = $(this);
        // jeder platz
        $seats.each(function () {
            // platz nummer vergleichen
            if ($_this.data('nr') !== $(this).data('nr')) {
                // wenn platz nummern unterschiedl -> unchecken
                $(this).prop('checked', false);
            }
        });
    });

});

/*
 Eigene Funktionen
 */

function seite_bestellung() {
    // DEFINITIONEN
    const TABLE_ID = $(document).find('.res_table').data('id'),
        DRINKS_MODAL = $('#gerichte_modal_drinks'),
        DRINKS_MODAL_CONTENT = DRINKS_MODAL.find('.modal-body'),
        DRINKS_MODAL_NEXT = DRINKS_MODAL.find('.modal-footer').find('.btn.next'),
        STARTER_MODAL = $('#gerichte_modal_starter'),
        STARTER_MODAL_CONTENT = STARTER_MODAL.find('.modal-body'),
        STARTER_MODAL_PREV = STARTER_MODAL.find('.modal-footer').find('.btn.prev'),
        STARTER_MODAL_NEXT = STARTER_MODAL.find('.modal-footer').find('.btn.next'),
        MAIN_MODAL = $('#gerichte_modal_main'),
        MAIN_MODAL_CONTENT = MAIN_MODAL.find('.modal-body'),
        MAIN_MODAL_PREV = MAIN_MODAL.find('.modal-footer').find('.btn.prev'),
        MAIN_MODAL_NEXT = MAIN_MODAL.find('.modal-footer').find('.btn.next'),
        DESERT_MODAL = $('#gerichte_modal_desert'),
        DESERT_MODAL_CONTENT = DESERT_MODAL.find('.modal-body'),
        DESERT_MODAL_PREV = DESERT_MODAL.find('.modal-footer').find('.btn.prev'),
        DESERT_MODAL_NEXT = DESERT_MODAL.find('.modal-footer').find('.btn.next'),
        PLACEHOLDER = '<div class="d-flex placeholder">' +
            '<div class="col-md-8 align-self-center">' +
            '<div class="placeholder-paragraph"></div>' +
            '</div><div class="col-md-4">' +
            '<div class="placeholder-image"></div></div></div>';

    var ORDER = {
        '1': [],
        '2': [],
        '3': [],
        '4': [],
    };

    /*
        api_client.getKategorien(function (response) {
            console.log(response);
            for (var i = 0; i < response.data.length; i++) {
                var kategorie = response.data[i];
                api_client.getGerichteByKategorie(kategorie.id, function (kat_response) {
                    console.log(kat_response);
                });
            }
        });
        */

    api_client.getBestellung(TABLE_ID, function (response) {
        console.log(response);
    });

    /*
     * Bei click auf einen platz
     */
    $('.place').find('input[type="checkbox"]').on('change', function (e) {
        // modal nur oeffnen, wenn checkbox aktiviert wirds
        if ($(this).prop('checked')) {
            DRINKS_MODAL.modal('show');
        }
    });

    DRINKS_MODAL.on('show.bs.modal', function () {
        api_client.getGerichteByKategorie(1, function (kat_response) {
            DRINKS_MODAL_CONTENT.html(PLACEHOLDER);
            if (kat_response.status === 200) {
                var drinks = kat_response.data;
                loop_append_data(drinks, DRINKS_MODAL_CONTENT)
            }
        });
    });

    STARTER_MODAL.on('show.bs.modal', function () {
        api_client.getGerichteByKategorie(2, function (kat_response) {
            DRINKS_MODAL_CONTENT.html(PLACEHOLDER);
            if (kat_response.status === 200) {
                var drinks = kat_response.data;
                loop_append_data(drinks, STARTER_MODAL_CONTENT)
            }
        });
    });

    MAIN_MODAL.on('show.bs.modal', function () {
        api_client.getGerichteByKategorie(3, function (kat_response) {
            DRINKS_MODAL_CONTENT.html(PLACEHOLDER);
            if (kat_response.status === 200) {
                var drinks = kat_response.data;
                loop_append_data(drinks, MAIN_MODAL_CONTENT)
            }
        });
    });

    DESERT_MODAL.on('show.bs.modal', function () {
        api_client.getGerichteByKategorie(4, function (kat_response) {
            DRINKS_MODAL_CONTENT.html(PLACEHOLDER);
            if (kat_response.status === 200) {
                var drinks = kat_response.data;
                loop_append_data(drinks, DESERT_MODAL_CONTENT)
            }
        });
    });

    /*
     * NAVIGIEREN ZWISCHEN MODALS / GERICHT KATEGORIEN
     */
    DRINKS_MODAL_NEXT.on('click', function () {
        DRINKS_MODAL.modal('hide');
        get_order_items(DRINKS_MODAL, ORDER);
        STARTER_MODAL.modal('show');
    });
    STARTER_MODAL_PREV.on('click', function () {
        STARTER_MODAL.modal('hide');
        get_order_items(STARTER_MODAL, ORDER);
        DRINKS_MODAL.modal('show');
    });
    STARTER_MODAL_NEXT.on('click', function () {
        STARTER_MODAL.modal('hide');
        get_order_items(STARTER_MODAL, ORDER);
        MAIN_MODAL.modal('show');
    });
    MAIN_MODAL_PREV.on('click', function () {
        MAIN_MODAL.modal('hide');
        get_order_items(MAIN_MODAL, ORDER);
        STARTER_MODAL.modal('show');
    });
    MAIN_MODAL_NEXT.on('click', function () {
        MAIN_MODAL.modal('hide');
        get_order_items(MAIN_MODAL, ORDER);
        DESERT_MODAL.modal('show');
    });
    DESERT_MODAL_PREV.on('click', function () {
        DESERT_MODAL.modal('hide');
        get_order_items(DESERT_MODAL, ORDER);
        console.log(ORDER);
        MAIN_MODAL.modal('show');
    });

}

/**
 * Erhalten von Menu-Auswahl des Nutzers
 * @param element
 * @param order_array
 */
function get_order_items(element, order_array) {
    var $form_boxes = element.find('.form-check');
    var kategorie_id = null;
    $form_boxes.each(function () {
        var $checkbox = $(this).find('input[type="checkbox"]');
        if ($checkbox.prop('checked')) {
            var gericht_id = $checkbox.val();
            kategorie_id = $checkbox.attr('name');
            if (!order_array[kategorie_id].includes(parseInt(gericht_id))) {
                order_array[kategorie_id].push(parseInt(gericht_id));
            }
        }
    });
    var comment = element.find('textarea[name="comment"]').val();
    if (kategorie_id !== null) {
        order_array[kategorie_id].push(comment);
    }
}

/**
 * Fügt liste von elementen in dom ein
 * @param data
 * @param element
 */
function loop_append_data(data, element) {
    const HELPER_TAG = $(document).find('.helper');
    var comment_label = HELPER_TAG.data('comment');
    element.empty();
    for (var i = 0; i < data.length; i++) {
        var _dish = data[i];
        var content = '<div class="d-flex">' +
            '<div class="col-md-6 align-self-center">' +
            '<div class="form-check d-flex">' +
            '<input class="form-check-input align-self-center" type="checkbox" name="' +
            _dish.kategorie_id +
            '" value="' +
            _dish.id +
            '" id="dish_checkbox_' +
            _dish.id +
            '">' +
            '<label class="form-check-label" for="dish_checkbox_' +
            _dish.id +
            '">' +
            _dish.name +
            '<div class="text-muted extra">' +
            _dish.beschreibung +
            '</div></label></div></div>' +
            '<div class="col-md-2 align-self-center">' +
            _dish.preis + ' €' +
            '</div>' +
            '<div class="col-md-4 align-self-center"></div>' +
            '</div></div>';
        element.append(content);
        if (i < data.length - 1) {
            element.append('<hr>');
        } else {
            var comment_input = '<div class="form-group mt-4">' +
                '<label for="comment">' +
                comment_label +
                '</label>' +
                '<textarea class="form-control" id="comment" name="comment" rows="3"></textarea>' +
                '</div>';
            element.append(comment_input);
        }
    }
}

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

/**
 * Check if URL matches REGEX pattern
 * @param pattern
 * @returns {boolean}
 */
function isUrl(pattern) {
    var re = new RegExp(pattern, "g");
    var url = window.location.href;
    return re.test(url);
}
