var api_client = new ApiClient();

/**
 * ApiClient prototype "Klasse"
 * @constructor
 */
function ApiClient() {
    this.base_url = "http://localhost/restaurant/";
}

/**
 * Ajax Request-Definition
 * @param type
 * @param url
 * @param input
 * @param _callback
 */
ApiClient.prototype.request = function (type, url, input, _callback) {
    jQuery.ajax({
        type: type,
        dataType: 'json',
        url: this.base_url + url,
        data: input,
        success: function (data, textStatus, response) {
            var result = {
                'data': data,
                'status': response.status
            };
            return _callback(result);
        },
        error: function (err) {
            console.log(err);
            toast('<i class="fas fa-exclamation-triangle"></i> ERROR GETTING DATA', 'danger');
            return _callback(err);
        }
    });
};

/**
 * AJAX - Alle Gerichte erhalten
 */
ApiClient.prototype.getGerichte = function (_callback) {
    this.request('get', 'gerichte', null, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Alle Gerichte für eine Kategorie erhalten
 * @param kategorie_id
 * @param _callback
 */
ApiClient.prototype.getGerichteByKategorie = function (kategorie_id, _callback) {
    this.request('get', 'kategorie_gerichte/' + kategorie_id, null, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Bestellung für einen Tisch erhalten
 * @param table_id
 * @param _callback
 */
ApiClient.prototype.getBestellung = function (table_id, _callback) {
    this.request('get', 'tisch_bestellung/' + table_id, null, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Alle Kategorien erhalten
 * @param _callback
 */
ApiClient.prototype.getKategorien = function (_callback) {
    this.request('get', 'kategorien', null, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Position für Bestellung erstellen
 * @param order_id
 * @param data
 * @param _callback
 */
ApiClient.prototype.postPosition = function (order_id, data, _callback) {
    this.request('post', 'position', data, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Bestellung erstellen
 * @param data
 * @param _callback
 */
ApiClient.prototype.createOrder = function (data, _callback) {
    this.request('post', 'bestellung', data, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Positionen für Bestellung erhalten
 * @param order_id
 * @param _callback
 */
ApiClient.prototype.getPositionsByOrder = function (order_id, _callback) {
    this.request('get', 'bestellung_position/' + order_id, null, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Bestell Status ändern
 * @param order_id
 * @param data
 * @param _callback
 */
ApiClient.prototype.updateStatus = function (order_id, data, _callback) {
    this.request('post', 'bestellung/' + order_id, data, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Gericht mit ID erhalten
 * @param gericht_id
 * @param _callback
 */
ApiClient.prototype.getGericht = function (gericht_id, _callback) {
    this.request('get', 'gericht/' + gericht_id, null, function (res) {
        return _callback(res);
    });
};

/**
 * AJAX - Position entfernen
 * @param position_id
 * @param _callback
 */
ApiClient.prototype.revokePosition = function (position_id, _callback) {
    this.request('get', 'revoke_position/' + position_id, null, function (res) {
        return _callback(res);
    });
};
