var Mile = (function () {
    var errors   = [];
    var status   = 0;
    var messages = {
        "planStartDate": 'Please enter a valid date (yyyy-mm-dd).',
        "amount"       : 'Please enter a valid number.',
        "error"        : 'Please check the start date & amount at row ',
        "missing"      : 'Unexpected error occurred at row ',
        "unexpected"   : 'Unexpected error occurred.',
    };
    var errorsMsgSelector = '.errorsMsg';
    var startDateSelector = 'input[name = "startDate[]"]';
    var amountSelector    = 'input[name = "amount[]"]';
    var rowSelector       = '.rowActive';
    var saveBtnSelector   = '.btnSave';

    function Mile() { }

    // update each schedule setting when changed
    Mile.prototype.updateBasic = function (objThis) {
        if (status == 0) { status = 1; }

        // remove error message if exists
        this.removeErrorMessage($(objThis));
        $(errorsMsgSelector).html('');

        // get inputs & its values
        var form    = $(objThis).closest('form');
        var rowThis = $(objThis).closest(rowSelector);
        var inputStartDate = rowThis.find(startDateSelector);
        var inputAmount    = rowThis.find(amountSelector);
        var startDate = inputStartDate.val();
        var amount    = inputAmount.val();
        var idSDate   = inputStartDate.attr('id');
        var idAmount  = inputAmount.attr('id');
        
        // validate StartDate
        if (this.isValidDateYmd(startDate, '-')) {
            // remove error of startDate if exists
            this.removeError(idSDate);
            // validate amount
            if (!this.is_numeric(amount)) {
                // add error for amount
                this.addError(idAmount);
                // remove error message if exists
                this.removeErrorMessage(inputAmount);
                // show new error message
                this.showError(messages.amount, inputAmount);
            } else {
                // remove error & error message if exists
                this.removeError(idAmount);
                this.removeErrorMessage(inputAmount);
                this.removeErrorMessage(inputStartDate);
                console.log('---Updating schedule setting---');
                var type_id = rowThis.data('id').split('-');
                if (type_id.length == 2) { // both type & id
                    var data = {
                        'plan_start_date': startDate,
                        'amount': amount,
                        "type": type_id[0],
                        'id': Number(type_id[1])
                    };
                    var url   = form.data('url');
                    var token = form.data('token');
                    var _this = this;
                    console.log(data);
                    $.ajax({
                        url : url,
                        method: 'POST',
                        data: {_method: 'post', _token: token, data: data},
                        dataType: 'json',
                    }).done(function (data) {
                        console.log(data);
                        // show popup for success
                        if (data && data.success === true) {
                            alert('updated successfully.');
                        } else {
                            $(errorsMsgSelector).html(_this.getErrorElementStr(data.message ? data.message : 'Could not update.'));
                        }
                    }).fail(function (response) {
                        console.log(response);
                        $(errorsMsgSelector).html(_this.getErrorElementStr(messages.unexpected));
                    });
                } else {
                    $(errorsMsgSelector).html(this.getErrorElementStr(messages.missing+rowThis.data('row')));
                }
            }
        } else {
            // add error for startDate
            this.addError(idSDate);
            // remove error message if exists
            this.removeErrorMessage(inputStartDate);
            // show new error message
            this.showError(messages.planStartDate, inputStartDate);
        }

        // enable/disable save button
        this.trackSaveBtn();
    };
    
    // save all scheduled settings
    Mile.prototype.save = function(e, identityForm) {
        e.preventDefault();

        var form  = identityForm ? $(identityForm) : $(e.target).closest('form');
        var url   = form.attr('action');
        var token = form.data('token');
        var rows  = form.find(rowSelector);
        var data  = [];
        var _this = this;
        
        // loop for getting all the scheduled settings
        rows.each(function (i, v) {
            var currRow = $(this);
            var type_id = currRow.data('id').split('-');
            var sDate   = currRow.find(startDateSelector).val();
            var amount  = currRow.find(amountSelector).val();
            // validate startDate & amount
            if (_this.isValidDateYmd(sDate, '-') && _this.is_numeric(amount)) {
                if (type_id.length == 2) { // both type & id
                    data.push({
                        "startDate": sDate,
                        "amount": amount,
                        "type": type_id[0],
                        'id': Number(type_id[1])
                    });
                } else { // missing type or id
                    $(errorsMsgSelector).html(_this.getErrorElementStr(messages.missing+(i+1)));
                    return false;
                }
            } else {
                $(errorsMsgSelector).html(_this.getErrorElementStr(messages.error+(i+1)));
                return false;
            }
        });
        console.log(data);
        $.ajax({
            url : url,
            method: 'POST',
            data: {_method: 'post', _token: token, data: data},
            dataType: 'json',
        }).done(function (data) {
            console.log(data);
            // show popup for success
            if (data && data.success === true) {
                alert('Saved successfully.');
            } else {
                $(errorsMsgSelector).html(_this.getErrorElementStr(data.message ? data.message : 'Could not save.'));
            }
        }).fail(function (response) {
            console.log(response);
            $(errorsMsgSelector).html(_this.getErrorElementStr(messages.unexpected));
        });
    };

    // destroy
    Mile.prototype.destroyMile = function (objThis) {
        //event.preventDefault();
        //var objThis = event.target;
        var url = $(objThis).data('url');
        var form = $(objThis).closest('form');
        var token = form.data('token');
        var rowThis = $(objThis).closest(rowSelector);
        var type_id = rowThis.data('id').split('-');
        var i = rowThis.data('row');
        var _this = this;
        console.log(type_id);
        if (type_id.length == 2) {
            var data = {
                "id": type_id[1],
                'type': type_id[0]
            };
            console.log(url);
            console.log(token);
            console.log(data);
            $.ajax({
                url : url,
                method: 'POST',
                data: {_method: 'post', _token: token, data: data},
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
                // show popup for success
                if (data && data.success === true) {
                    alert('delete successfully.');
                } else {
                    $(errorsMsgSelector).html(_this.getErrorElementStr(data.message ? data.message : 'Could not update.'));
                }
            }).fail(function (response) {
                console.log(response);
                $(errorsMsgSelector).html(_this.getErrorElementStr(messages.unexpected));
            });
        } else { // missing type or id
            $(errorsMsgSelector).html(_this.getErrorElementStr(messages.missing+(i)));
        }
    };

    // enable/disable save button
    Mile.prototype.trackSaveBtn = function() {
        if (errors.length === 0 && status == 1) {
            $(saveBtnSelector).removeAttr('disabled');
        } else {
            $(saveBtnSelector).attr('disabled', true);
        }
    };
    
    // remove error from errors array
    Mile.prototype.removeError = function(id) {
        var pos = errors.indexOf(id);
        if (pos !== -1) {
            errors.splice(pos, 1);
        }
    };
    
    // add error to an errors array
    Mile.prototype.addError = function(id) {
        if (errors.indexOf(id) === -1) {
            errors.push(id);
        }
    };
    
    // remove error message from screen
    Mile.prototype.removeErrorMessage = function(obj) {
        obj.parent().find('label.error').remove();
    };
    
    // show error message when value of input changed is wrong
    Mile.prototype.showError = function(message, obj) {
        $(this.getErrorElementStr(message)).insertBefore(obj);
    };

    // show error message when value of input changed is wrong
    Mile.prototype.getErrorElementStr = function(message) {
        return '<label style="color:red;" class="error">' + message + '</label>';
    };

    // check is numeric
    Mile.prototype.is_numeric = function(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    };

    // Validate date with format "yyyy/mm/dd"
    Mile.prototype.isValidDateYmd = function(dateStr, delimiter) {
        delimiter = delimiter ? delimiter : '/';
    
        // for yyyy-mm-dd
        var s = "^\\d{4}\\" + delimiter + "\\d{1,2}\\" + delimiter + "\\d{1,2}$";
        var pattern = new RegExp(s, "gi");
    
        // check format
        if(!pattern.test(dateStr)) {
            return false;
        }

        // get each part of date
        var p = dateStr.split(delimiter);
        var d = parseInt(p[2], 10);
        var m = parseInt(p[1], 10);
        var y = parseInt(p[0], 10);

        // Check month and year
        if(y < 1970 || m <= 0 || m > 12) {
            return false;
        }
            
        // number of days Of the each month in a year
        var numDaysOfMonth = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

        // Adjust for leap years
        if(y % 400 == 0 || (y % 100 != 0 && y % 4 == 0)) {
            numDaysOfMonth[1] = 29;
        }

        // Check the range of the day
        return d > 0 && d <= numDaysOfMonth[m - 1];
    };

    return new Mile();
})();