var errors   = [];
var status   = 0;
var messages = {
    'planStartDate': 'Please enter a valid date (yyyy-mm-dd).',
    'amount': 'Please enter a valid number.'
};

// update each schedule setting when changed
function updateBasic(objThis) {
    if (status == 0) { status = 1; }

    // remove error message if exists
    removeErrorMessage($(objThis));
    var rowThis = $(objThis).closest('div.row');

    var inputStartDate = rowThis.find('input[name="startDate"]'); // $(objThis).val();
    var inputAmount    = rowThis.find('input[name="amount"]');
    var startDate = inputStartDate.val();
    var amount    = inputAmount.val();
    var idSDate   = inputStartDate.attr('id');
    var idAmount  = inputAmount.attr('id');
    
    // validate StartDate
    if (isValidDateYmd(startDate, '-')) {
        // remove error of startDate if exists
        removeError(idSDate);
        // validate amount
        if (!is_numeric(amount)) {
            // add error for amount
            addError(idAmount);
            // remove error message if exists
            removeErrorMessage(inputAmount);
            // show new error message
            showError(messages.amount, inputAmount);
        } else {
            removeError(idAmount);
            removeErrorMessage(inputAmount);
            removeErrorMessage(inputStartDate);
            console.log('---Updating schedule setting---');
        }
    } else {
        // add error for startDate
        addError(idSDate);
        // remove error message if exists
        removeErrorMessage(inputStartDate);
        // show new error message
        showError(messages.planStartDate, inputStartDate);
    }

    // enable/disable save button
    trackSaveBtn();
}

// save all scheduled settings
function save(e) {
    e.preventDefault();
    var form = $('#frmBasic');
    var data = form.serialize();
    $.ajax({
        url : '/basic/update',
        method: 'post',
        data: data,
        dataType: 'json',
    }).done(function (data) {
        console.log(data);
    }).fail(function () {
        console.log('Posts could not be loaded.');
    });
}

// enable/disable save button
function trackSaveBtn() {
    if (errors.length === 0 && status == 1) {
        $('.btnSave').removeAttr('disabled');
    } else {
        $('.btnSave').attr('disabled', true);
    }
}

// remove error from errors array
function removeError(id) {
    var pos = errors.indexOf(id);
    if (pos !== -1) {
        errors.splice(pos, 1);
    }
}

// add error to an errors array
function addError(id) {
    if (errors.indexOf(id) === -1) {
        errors.push(id);
    }
}

// remove error message from screen
function removeErrorMessage(obj) {
    obj.parent().find('label.error').remove();
}

// show error message when value of input changed is wrong
function showError(message, obj) {
    $('<label style="color:red;" class="error">' + message + '</label>').insertBefore(obj);
}

// check is numeric
function is_numeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

// Validate date with format "yyyy/mm/dd"
function isValidDateYmd(dateStr, delimiter) {
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
}