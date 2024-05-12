$(document).ready(function() {
    $('#client-entry-date').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        onClose: function(selectedDate) {
            $('#client-departure-date').datepicker("option", "minDate", selectedDate);
        }
    });
    $('#client-departure-date').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        onClose: function(selectedDate) {
            $('#client-entry-date').datepicker("option", "maxDate", selectedDate);
        }
    });
});
