var api_client = new ApiClient();

/**
 * ApiClient prototype "Klasse"
 * @constructor
 */
function ApiClient() {
    this.base_url = "http://localhost/restaurant/";
}

/**
 * Ajax Request definition
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

ApiClient.prototype.getGerichte = function (_callback) {
    this.request('get', 'gerichte', null, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.getGerichteByKategorie = function(kategorie_id, _callback) {
    this.request('get', 'kategorie_gerichte/' + kategorie_id, null, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.getBestellung = function (table_id, _callback) {
    this.request('get', 'tisch_bestellung/' + table_id, null, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.getKategorien = function (_callback) {
    this.request('get', 'kategorien', null, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.postPosition = function (order_id, data, _callback) {
    this.request('post', 'position', data, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.createOrder = function (data, _callback) {
    this.request('post', 'bestellung', data, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.getPositionsByOrder = function (order_id, _callback) {
    this.request('get', 'bestellung_position/' + order_id, null, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.updateStatus = function (order_id, data, _callback) {
    this.request('post', 'bestellung/' + order_id, data, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.getGericht = function (gericht_id, _callback) {
    this.request('get', 'gericht/' + gericht_id, null, function (res) {
        return _callback(res);
    });
};

ApiClient.prototype.revokePosition = function (position_id, _callback) {
    this.request('get', 'revoke_position/' + position_id, null, function (res) {
        return _callback(res);
    });
};
