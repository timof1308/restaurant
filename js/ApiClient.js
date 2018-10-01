var api_client = new ApiClient();

function ApiClient() {
    this.base_url = "http://localhost/restaurant/";
}

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
    this.request('get', 'gerichte', null, function (data) {
        return _callback(data);
    });
};

ApiClient.prototype.getGerichteByKategorie = function(kategorie_id, _callback) {
    this.request('get', 'kategorie_gerichte/' + kategorie_id, null, function (data) {
        return _callback(data);
    });
};

ApiClient.prototype.getBestellung = function (table_id, _callback) {
    this.request('get', 'tisch_bestellung/' + table_id, null, function (data) {
        return _callback(data);
    });
};

ApiClient.prototype.getKategorien = function (_callback) {
    this.request('get', 'kategorien', null, function (data) {
        return _callback(data);
    });
};
