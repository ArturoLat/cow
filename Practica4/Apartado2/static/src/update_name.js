$(document).ready(function() {
    $('#dialog-confirm').dialog({
        autoOpen: true,
        resizable: false,
        height: 'auto',
        width: 400,
        modal: true,
        buttons: {
            'Actualizar Nombre': function() {
                $(this).dialog('close');
                $('#form-update-name').submit();
            },
            Cancelar: function() {
                $(this).dialog('close');
            }
        }
    });
});