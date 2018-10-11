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

    if (isUrl(/(kueche)/)) {
        seite_kueche();
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
 EIGENE FUNTIONEN
 */

/*
 * Bei geladener Küchen-Seite
 */
function seite_kueche() {
    const OPEN_MODAL_BTNS = $('.openOrderModal'),
        BESTELLUNG_MODAL = $('#bestellung_modal'),
        BESTELLUNG_MODAL_HEAD_NR = BESTELLUNG_MODAL.find('.modal-title').find('span'),
        BESTELLUNG_MODAL_TABLE = BESTELLUNG_MODAL.find('.table').find('tbody');

    var TABLE_ID;

    OPEN_MODAL_BTNS.on('click', function () {
        var $btn = $(this);
        TABLE_ID = $btn.parents('.card-body').find('.table').data('id');
        BESTELLUNG_MODAL_HEAD_NR.html(TABLE_ID);
        BESTELLUNG_MODAL.modal('show');
    });

    /*
     * Calling Status aufhaben
     */
    $(document).on('click', '.res_table.calling', function () {
        var body = {
            status: 0
        };
        var order_id = $(this).data('order');
        var $_this = $(this);
        api_client.updateStatus(order_id, body, function (res) {
            if (res.status === 200) {
                // tisch hintergrundfarbe entfernen
                $_this.toggleClass('calling');
                // toast einblenden
                toast('Tischruf zurückgesetzt!', 'success');
            }
        });
    });

    /*
     * Calling Status aufhaben
     */
    $(document).on('click', '.res_table.paying', function () {
        var order_id = $(this).data('id');
        var prompt = confirm('Bezahlung abschließen?');
        if (prompt === true) {
            window.location = api_client.base_url + '/order_payed/' + order_id;
        }
    });

    /*
     * Rechnung für Bestellung sehen
     */
    $(document).on('click', '.viewBillBtn', function () {
        var order_id = $(this).parents('.card').find('.res_table').data('id');
        var _new = window.open(api_client.base_url + '/view_bill/' + order_id, '_blank');
        _new.focus();
    });

    /*
     * Bei sich öffnendem Bestellübersicht-Modal
     */
    BESTELLUNG_MODAL.on('show.bs.modal', function () {
        // tabelle leeren
        BESTELLUNG_MODAL_TABLE.html('');
        // bestellung abfragen
        api_client.getBestellung(TABLE_ID, function (response) {
            if (response.data !== null) {
                // bestell positionen abfragen
                api_client.getPositionsByOrder(response.data.id, function (res) {
                    if (res.status === 200) {
                        var content = '';
                        if (res.data !== null) {
                            for (var i = 0; i < res.data.length; i++) {
                                // zeitdifferenz berechnen
                                var today = new Date();
                                var timestamp = res.data[i]['updated_at'].split(/[- :]/);
                                timestamp = new Date(timestamp[0], timestamp[1] - 1, timestamp[2], timestamp[3], timestamp[4], timestamp[5]);
                                var seconds = Math.floor((today - timestamp) / 1000);
                                var minutes = Math.floor(seconds / 60);
                                var hours = Math.floor(minutes / 60);
                                var diff = "";
                                var highlight = false;
                                if (seconds < 60) {
                                    highlight = true;
                                    diff = "vor " + seconds + " Sekunden";
                                } else if (minutes < (60)) {
                                    if (minutes <= 5) {
                                        highlight = true;
                                    }
                                    diff = "vor " + minutes + " Minuten";
                                } else if (hours < (24)) {
                                    diff = "vor " + hours + " Stunden";
                                } else {
                                    diff = "vor " + Math.floor(hours / 24) + " Tag(en)";
                                }

                                // tabelleneinträge generieren
                                content += '<tr data-id="' + res.data[i]['id'] + '"' +
                                    ((highlight === true) ? 'class="bg-success"' : "") +
                                    '>' +
                                    '<td>' + res.data[i]['gericht_id'] + '</td>' +
                                    '<td>' + res.data[i]['name'] + '</td>' +
                                    '<td>' + res.data[i]['kommentar'] + '</td>' +
                                    '<td>' + res.data[i]['platz_id'] + '</td>' +
                                    '<td>' + diff + '</td>' +
                                    '</tr>';
                            }
                        } else {
                            content = '<tr><td colspan="5">Keine Bestellungen befunden</td></tr>';
                        }
                        // tabelle befüllen
                        BESTELLUNG_MODAL_TABLE.html(content);
                    }
                });
            } else {
                BESTELLUNG_MODAL_TABLE.html('<tr><td colspan="5" class="text-center">Keine Bestellungen befunden</td></tr>');
            }
        });
    });

    var $tables = $(document).find('.res_table');
    $tables.each(function () {
        var $table = $(this);
        var TABLE_ID = $table.data('id');
        var _storage = {};
        // bestellung für tisch erhalten
        api_client.getBestellung(TABLE_ID, function (response) {
            if (response.data !== null) {
                if (response.data.status === "1") {
                    $table.toggleClass('calling');
                } else if (response.data.status === "2") {
                    $table.toggleClass('paying');
                }
                // bestell id in dom einfügen
                $table.data('order', response.data.id);
                api_client.getPositionsByOrder(response.data.id, function (res) {
                    if (res.status === 200) {
                        var positions = res.data;
                        if (positions.length > 0) {
                            for (var i = 0; i < positions.length; i++) {
                                if (typeof _storage[positions[i].platz_id] === "undefined") {
                                    _storage[positions[i].platz_id] = [];
                                }
                                _storage[positions[i].platz_id].push(positions[i]);
                            }
                        }
                    }
                    for (var key in _storage) {
                        // liste mit bestellung pro platz erstellen
                        var content = '<ul>';
                        for (var i = 0; i < _storage[key].length; i++) {
                            content += '<li>' +
                                _storage[key][i]['name'];
                            if (_storage[key][i]['kommentar'] !== "") {
                                content += ' - ' + _storage[key][i]['kommentar']
                            }
                            content += '</li>';
                        }
                        if (_storage[key].length === 0) {
                            content = "keine Bestellung"
                        }
                        content += '</ul>';
                        var $input = $table.find('input[data-nr="' + key + '"]');
                        // sitz einfärben
                        $input.parents('.place').toggleClass('submitted');
                        // popover generieren
                        $input.popover({
                            html: true,
                            triger: 'hover focus',
                            title: 'Platz ' + key,
                            content: content,
                            placement: 'auto'
                        });
                    }
                });
            }
        });
    });
}

/*
 * Bei geladener Bestellungs-Seite
 */
function seite_bestellung() {
    // DEFINITIONEN
    const TABLE_ID = $(document).find('.res_table').data('id'),
        DRINKS_MODAL = $('#gerichte_modal_drinks'),
        DRINKS_MODAL_CONTENT = DRINKS_MODAL.find('.modal-body').find('.tab-pane#menuDrinks'),
        DRINKS_MODAL_CONTENT_ORDERS = DRINKS_MODAL.find('.modal-body').find('.tab-pane#orderDrinks').find('tbody'),
        DRINKS_MODAL_NEXT = DRINKS_MODAL.find('.modal-footer').find('.btn.next'),
        STARTER_MODAL = $('#gerichte_modal_starter'),
        STARTER_MODAL_CONTENT = STARTER_MODAL.find('.modal-body').find('.tab-pane#menuStarter'),
        STARTER_MODAL_CONTENT_ORDERS = STARTER_MODAL.find('.modal-body').find('.tab-pane#orderStarter').find('tbody'),
        STARTER_MODAL_PREV = STARTER_MODAL.find('.modal-footer').find('.btn.prev'),
        STARTER_MODAL_NEXT = STARTER_MODAL.find('.modal-footer').find('.btn.next'),
        MAIN_MODAL = $('#gerichte_modal_main'),
        MAIN_MODAL_CONTENT = MAIN_MODAL.find('.modal-body').find('.tab-pane#menuMain'),
        MAIN_MODAL_CONTENT_ORDERS = MAIN_MODAL.find('.modal-body').find('.tab-pane#orderMain').find('tbody'),
        MAIN_MODAL_PREV = MAIN_MODAL.find('.modal-footer').find('.btn.prev'),
        MAIN_MODAL_NEXT = MAIN_MODAL.find('.modal-footer').find('.btn.next'),
        DESERT_MODAL = $('#gerichte_modal_desert'),
        DESERT_MODAL_CONTENT = DESERT_MODAL.find('.modal-body').find('.tab-pane#menuDesert'),
        DESERT_MODAL_CONTENT_ORDERS = DESERT_MODAL.find('.modal-body').find('.tab-pane#orderDesert').find('tbody'),
        DESERT_MODAL_PREV = DESERT_MODAL.find('.modal-footer').find('.btn.prev'),
        MENU_MODAL_SEND = DESERT_MODAL.find('.modal-footer').find('.btn.send'),
        CALL_WAITER_BTN = $('.callWaiterBtn'),
        GO_PAYING_BTN = $('.goPayingBtn'),
        DRINKS = 1,
        STARTER = 2,
        MAIN = 3,
        DESERT = 4,
        PLACEHOLDER = '<div class="d-flex placeholder">' +
            '<div class="col-md-8 align-self-center">' +
            '<div class="placeholder-paragraph"></div>' +
            '</div><div class="col-md-4">' +
            '<div class="placeholder-image"></div></div></div>';

    var ORDER_ID = null;
    var PLATZ_NR = null;
    var _ERROR_ = false;
    var ORDER = {
        '1': {
            id: [],
            comment: ""
        },
        '2': {
            id: [],
            comment: ""
        },
        '3': {
            id: [],
            comment: ""
        },
        '4': {
            id: [],
            comment: ""
        },
    };

    /*
     * Weiter zum Bezahlen
     * Bestätigung des Nutzers einholen und dann weiterleitung zur Rechnung (=Tomcat)
     */
    GO_PAYING_BTN.on('click', function () {
        var prompt = confirm("Weiter zum bezahlen?");
        if (prompt === true) {
            window.location.href = 'http://localhost/restaurant/paying/' + ORDER_ID;
        }
    });

    /*
     * Erhalte offene Bestellung für Tischnummer
     */
    api_client.getBestellung(TABLE_ID, function (response) {
        if (response.data !== null) {
            ORDER_ID = response.data.id;
        } else {
            var data = {
                'table_id': TABLE_ID
            };
            // Neue Bestellung für Tisch erstellen
            api_client.createOrder(data, function (response) {
                if (response.status !== 200) {
                    // Fehler beim erstellen (SQL / PHP)
                    toast('ERROR CREATING ORDER', 'danger');
                } else {
                    // ORDER_ID = Rückgabewert
                    ORDER_ID = response.data.id;
                }
            })
        }
    });

    /*
     * Bei click auf einen platz
     */
    $('.place').find('input[type="checkbox"]').on('change', function (e) {
        // modal nur oeffnen, wenn checkbox aktiviert wirds
        if ($(this).prop('checked')) {
            PLATZ_NR = $(this).data('nr');
            DRINKS_MODAL.modal('show');
        }
    });

    /*
     * Rufe Kellner
     */
    CALL_WAITER_BTN.on('click', function () {
        var body = {
            status: 1
        };
        api_client.updateStatus(ORDER_ID, body, function (res) {
            if (res.status === 200) {
                $('#callSubmit').show();
            }
        });
    });

    $(document).on('click', '.revokeOrder', function () {
        var $tr = $(this).parents('tr');
        var position_id = $tr.data('id');
        api_client.revokePosition(position_id, function (response) {
            if (response.status === 200) {
                // aus tabelle löschen
                toast('<i class="far fa-hand-pointer"></i> <i class="fas fa-trash-alt"></i> <i class="far fa-check-circle"></i>!', 'success');
                $tr.remove();

                // aus cookie löschen
                var cookie = JSON.parse(getCookie(PLATZ_NR));
                for (var key in cookie) {
                    for (var i = 0; i < cookie[key]['id'].length; i++) {
                        if (cookie[key]['id'][i]['position_id'] === position_id) {
                            cookie[key]['id'].splice(i, 1);
                        }
                    }
                }
                setCookie(PLATZ_NR, JSON.stringify(cookie));
            }
        });
    });

    /*
     * Navigieren zw. Speise Kategorien / Modals
     */
    DRINKS_MODAL.on('show.bs.modal', function () {
        api_client.getGerichteByKategorie(1, function (kat_response) {
            DRINKS_MODAL_CONTENT.html(PLACEHOLDER);
            if (kat_response.status === 200) {
                var drinks = kat_response.data;
                loop_append_data(drinks, DRINKS_MODAL_CONTENT);
                DRINKS_MODAL.modal('handleUpdate');
            }
        });
        revoke_handler(PLATZ_NR, DRINKS_MODAL_CONTENT_ORDERS, DRINKS);
    });

    STARTER_MODAL.on('show.bs.modal', function () {
        api_client.getGerichteByKategorie(2, function (kat_response) {
            STARTER_MODAL_CONTENT.html(PLACEHOLDER);
            if (kat_response.status === 200) {
                var drinks = kat_response.data;
                loop_append_data(drinks, STARTER_MODAL_CONTENT);
                STARTER_MODAL.modal('handleUpdate');
            }
        });
        revoke_handler(PLATZ_NR, STARTER_MODAL_CONTENT_ORDERS, STARTER);
    });

    MAIN_MODAL.on('show.bs.modal', function () {
        api_client.getGerichteByKategorie(3, function (kat_response) {
            MAIN_MODAL_CONTENT.html(PLACEHOLDER);
            if (kat_response.status === 200) {
                var drinks = kat_response.data;
                loop_append_data(drinks, MAIN_MODAL_CONTENT);
                MAIN_MODAL.modal('handleUpdate');
            }
        });
        revoke_handler(PLATZ_NR, MAIN_MODAL_CONTENT_ORDERS, MAIN);
    });

    DESERT_MODAL.on('show.bs.modal', function () {
        api_client.getGerichteByKategorie(4, function (kat_response) {
            DESERT_MODAL_CONTENT.html(PLACEHOLDER);
            if (kat_response.status === 200) {
                var drinks = kat_response.data;
                loop_append_data(drinks, DESERT_MODAL_CONTENT);
                DESERT_MODAL.modal('handleUpdate');
            }
        });
        revoke_handler(PLATZ_NR, DESERT_MODAL_CONTENT_ORDERS, DESERT);
    });

    /*
     * NAVIGIEREN ZWISCHEN MODALS / GERICHT KATEGORIEN
     */
    DRINKS_MODAL_NEXT.on('click', function () {
        get_order_items(DRINKS_MODAL, ORDER);
        DRINKS_MODAL.modal('hide');
        STARTER_MODAL.modal('show');
    });
    STARTER_MODAL_PREV.on('click', function () {
        get_order_items(STARTER_MODAL, ORDER);
        STARTER_MODAL.modal('hide');
        DRINKS_MODAL.modal('show');
    });
    STARTER_MODAL_NEXT.on('click', function () {
        get_order_items(STARTER_MODAL, ORDER);
        STARTER_MODAL.modal('hide');
        MAIN_MODAL.modal('show');
    });
    MAIN_MODAL_PREV.on('click', function () {
        get_order_items(MAIN_MODAL, ORDER);
        MAIN_MODAL.modal('hide');
        STARTER_MODAL.modal('show');
    });
    MAIN_MODAL_NEXT.on('click', function () {
        get_order_items(MAIN_MODAL, ORDER);
        MAIN_MODAL.modal('hide');
        DESERT_MODAL.modal('show');
    });
    DESERT_MODAL_PREV.on('click', function () {
        get_order_items(DESERT_MODAL, ORDER);
        DESERT_MODAL.modal('hide');
        MAIN_MODAL.modal('show');
    });

    MENU_MODAL_SEND.on('click', function () {
        get_order_items(DESERT_MODAL, ORDER);
        var counter = 0;
        for (var j = 1; j < 5; j++) {
            for (var k = 0; k < ORDER[j].id.length; k++) {
                counter++;
            }
        }
        var COOKIE_CONTENT = null;
        // Cookie vorbereiten
        if (getCookie(String(PLATZ_NR)) === "") { // kein cookie gefunden
            // JSON koopieren
            COOKIE_CONTENT = JSON.parse(JSON.stringify(ORDER));
            for (var key in COOKIE_CONTENT) {
                for (var i = 0; i < COOKIE_CONTENT[key].id.length; i++) {
                    // positions-id abfangen und zwischenspeichern
                    var gericht_id = COOKIE_CONTENT[key].id[i];
                    var obj = {
                        gericht_id: gericht_id,
                        position_id: null
                    };
                    COOKIE_CONTENT[key].id[i] = obj;
                }
            }
        } else {
            COOKIE_CONTENT = JSON.parse(getCookie(String(PLATZ_NR)));
        }
        var checker = 0;
        for (var k = 1; k < 5; k++) {
            var _order = ORDER[k];
            var KATEGORIE_ID = k;
            for (var id_index = 0; id_index < _order.id.length; id_index++) {
                var post_data = {
                    'bestellung_id': ORDER_ID,
                    'gericht_id': _order.id[id_index],
                    'comment': _order.comment,
                    'platz_nr': PLATZ_NR,
                    'kategorie_id': KATEGORIE_ID
                };
                api_client.postPosition(ORDER_ID, post_data, function (response) {
                    checker++;
                    if (response.status !== 200) {
                        _ERROR_ = true;
                    } else {
                        var INDEX = null;
                        for (var _index = 0; _index < COOKIE_CONTENT[response.data.kategorie_id]['id'].length; _index++) {
                            if (COOKIE_CONTENT[response.data.kategorie_id]['id'][_index]['gericht_id'] = response.data.gericht_id) {
                                INDEX = _index;
                                break;
                            }
                        }
                        COOKIE_CONTENT[response.data.kategorie_id]['id'][INDEX]['position_id'] = response.data.id;
                        COOKIE_CONTENT[response.data.kategorie_id]['comment'] = post_data.comment;
                    }
                    check_if_completed(checker, counter, COOKIE_CONTENT);
                });
            }
        }

        ORDER = {
            '1': {
                id: [],
                comment: ""
            },
            '2': {
                id: [],
                comment: ""
            },
            '3': {
                id: [],
                comment: ""
            },
            '4': {
                id: [],
                comment: ""
            },
        };
    });

    /*
     * Warten bis alle Postitionen in Datenbank erfasst
     */
    function check_if_completed(index, max, cookie) {
        if (index === max) {
            var $seat = $('.place').find("[data-nr='" + PLATZ_NR + "']");
            var $place = $seat.parents('.place');
            if (_ERROR_ === false) {
                $place.toggleClass('submitted');
                $('#orderSuccess').show();
            } else {
                $place.toggleClass('error');
                $('#orderAlert').find('span').html('' + PLATZ_NR);
                $('#orderAlert').show();
            }
            setCookie(String(PLATZ_NR), JSON.stringify(cookie));
        }
        DESERT_MODAL.modal('hide');
    }
}

/**
 * Cookie mit namen = platz für 10 minuten speichern
 * @param cname
 * @param cvalue
 */
function setCookie(cname, cvalue) {
    var expires = "max-age=" + (60 * 10); // 10 mins
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/**
 * Cookie mit bestimmten Namen erhalten
 * @param cname
 * @returns {string}
 */
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
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
            if (!order_array[kategorie_id].id.includes(parseInt(gericht_id))) {
                order_array[kategorie_id].id.push(parseInt(gericht_id));
            }
        }
    });
    var comment = element.find('textarea[name="comment"]').val().trim();
    if (kategorie_id !== null) {
        order_array[kategorie_id].comment = comment;
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
            '<div class="col-md-4 align-self-center">';

        var re = new RegExp(/\w*\.jpg/, "g");
        if (re.test(_dish.bild)) {
            content += '<img src="' + _dish.bild + '" alt="' + _dish.name + '" class="img-thumbnail" title="' + _dish.name + '">'
        }

        content += '</div>' +
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
 * Gerichte aus cookie anzeigen
 * @param platz_nr
 * @param element
 * @param kategorie
 */
function revoke_handler(platz_nr, element, kategorie) {
    element.parents('.modal-body').find('.nav-pills').find('a:last-child()').removeClass('disabled');
    if (getCookie(platz_nr) !== "") {
        var cookie = JSON.parse(getCookie(platz_nr));
        element.empty();
        for (var g = 0; g < cookie[kategorie]['id'].length; g++) {
            var index = g;
            api_client.getGericht(cookie[kategorie]['id'][g].gericht_id, function (response) {
                if (response.status === 200) {
                    var content = '' +
                        '<tr data-id="' + cookie[kategorie]['id'][index].position_id +
                        '">' +
                        '    <td>' + response.data.name +
                        '</td>' +
                        '    <td class="text-right"><i class="fas fa-trash-alt revokeOrder"></i></td>' +
                        '</tr>';

                    element.append(content);
                }
            });
        }
    } else {
        element.parents('.modal-body').find('.nav-pills').find('a:last-child()').addClass('disabled');
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
