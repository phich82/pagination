(function ($, Context) { 'use strict';
    // if exists in global context
    if ('Common' in Context) return;

    Context.Common = {};
    Context.Common.http = {};

    Context.Common.loadHtml = function (url, data, identity, processError, processData) {
        this.http.get(url, data, function (err, result) {
            if (err) {
                if (typeof processError === 'function') {
                    processError(err);
                }
            } else {
                if (typeof processData === 'function') {
                    processData(result);
                } else {
                    $(identity).html(result);
                }
            }
        }, 'html');
    };

    Context.Common.loadHtmlPost = function (url, data, identity, processError, processData) {
        this.http.post(url, data, function (err, result) {
            if (err) {
                if (typeof processError === 'function') {
                    processError(err);
                }
            } else {
                if (typeof processData === 'function') {
                    processData(result);
                } else {
                    $(identity).html(result);
                }
            }
        }, 'html');
    };

    Context.Common.http.post = function () {
        var url, data, callback, dataType, args = arguments;
        if (args.length === 0) {
            showError('Only accept minimum 1 argument or maximum 4 arguments.');
        }

        url = args[0];

        switch (args.length) {
            case 1:
                data = {};
                callback = null;
                dataType = 'json';
                break;
            case 2:
                dataType = 'json';
                if (typeof args[1] === 'function') {
                    data = {};
                    callback = args[1];
                } else {
                    data = args[1];
                    callback = null;
                }
                break;
            case 3:
                if (typeof args[1] === 'function') {
                    data = {};
                    callback = args[1];
                    dataType = args[2];
                } else if (typeof args[2] !== 'function') {
                    data = args[1];
                    callback = null;
                    dataType = args[2];
                } else {
                    data = args[1];
                    callback = args[2];
                    dataType = 'json';
                }
                break;
            case 4:
                if (typeof args[2] !== 'function') {
                    showError('Third argument should be a callback function.');
                }
                data = args[1];
                callback = args[2];
                dataType = args[3];
                break;
            default:
                showError('Only accept minimum 1 argument or maximum 4 arguments.');
        }
        this.callAjax(url, 'POST', data, dataType, callback);
    };

    Context.Common.http.get = function () {
        var url, data, callback, dataType, args = arguments;
        if (args.length === 0) {
            showError('Only accept minimum 1 argument or maximum 4 arguments.');
        }

        url = args[0];

        switch (args.length) {
            case 1:
                data = {};
                callback = null;
                dataType = 'json';
                break;
            case 2:
                dataType = 'json';
                if (typeof args[1] === 'function') {
                    data = {};
                    callback = args[1];
                } else {
                    data = args[1];
                    callback = null;
                }
                break;
            case 3:
                if (typeof args[1] === 'function') {
                    data = {};
                    callback = args[1];
                    dataType = args[2];
                } else if (typeof args[2] !== 'function') {
                    data = args[1];
                    callback = null;
                    dataType = args[2];
                } else {
                    data = args[1];
                    callback = args[2];
                    dataType = 'json';
                }
                break;
            case 4:
                if (typeof args[2] !== 'function') {
                    showError('Third argument should be a callback function.');
                }
                data = args[1];
                callback = args[2];
                dataType = args[3];
                break;
            default:
                showError('Only accept minimum 1 argument or maximum 4 arguments.');
        }
        
        // call ajax
        this.callAjax(url, 'GET', data, dataType, callback);
    };

    Context.Common.http.callAjax = function(url, type, data, dataType, callback) {
        $.ajax({
            url: url,
            type: type,
            data: data,
            dataType: dataType,
            success: function (data, status, xhr) {
                if (typeof callback === 'function') {
                    callback(null, data);
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
                if (typeof callback === 'function') {
                    callback(jqXhr, null);
                }
            }
        });
    };

    function showError(msg) {
        throw new Error(msg);
    }
})(jQuery, this);